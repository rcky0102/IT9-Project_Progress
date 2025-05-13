<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Appointment;
use App\Models\MedicalRecord;
use Barryvdh\DomPDF\Facade\Pdf;

class BillingController extends Controller
{
    public function index()
    {
        $paymentMethods = PaymentMethod::all();

        $invoices = Invoice::with([
            'billable' => function ($morphTo) {
                $morphTo->morphWith([
                    Appointment::class => ['appointmentType', 'doctor', 'patient'],
                    MedicalRecord::class => ['appointment.doctor', 'appointment.patient'],
                ]);
            }
        ])->get();

        return view('admin.billing.index', compact('paymentMethods', 'invoices'));
    }


    public function show($invoiceId)
    {
        $invoice = Invoice::with([
            'billable' => function ($morphTo) {
                $morphTo->morphWith([
                    Appointment::class => ['patient.user', 'doctor.user', 'appointmentType'],
                    MedicalRecord::class => ['appointment.patient.user', 'appointment.doctor.user', 'appointment.appointmentType']
                ]);
            },
            'payments.paymentMethod'
        ])->findOrFail($invoiceId);

        $payments = $invoice->payments;

        return view('admin.billing.show', compact('invoice', 'payments'));
    }

    public function create($invoiceId)
    {
        $paymentMethods = PaymentMethod::all();

        $invoice = Invoice::findOrFail($invoiceId);
        $outstandingBalance = $invoice->total_amount - $invoice->amount_paid;

        return view('admin.billing.create', compact('paymentMethods', 'invoice', 'outstandingBalance'));
    }

    public function store(Request $request, $invoiceId)
    {
        $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'amount_paid' => 'required|numeric|min:0',
            // 'payment_method_id' => 'required|exists:payment_methods,id',
        ]);

        $invoice = Invoice::findOrFail($invoiceId);

        $totalPayments = $invoice->payments()->sum('amount_paid');
        $outstandingBalance = $invoice->total_amount - $totalPayments;

        if ($request->amount_paid > $outstandingBalance) {
            return back()->withErrors([
                'amount_paid' => 'Payment exceeds the outstanding balance of ₱' . number_format($outstandingBalance, 2)
            ]);
        }

        $invoiceStatus = ($request->amount_paid == $outstandingBalance) ? 'paid' : 'partial';

        $invoice->status = $invoiceStatus;
        $invoice->save();

        $payment = new Payment([
            'invoice_id' => $invoice->id,
            // 'payment_method_id' => $request->payment_method_id,
            'amount_paid' => $request->amount_paid,
            'status' => $invoiceStatus === 'paid' ? 'completed' : 'pending',
            'paid_at' => now(),
        ]);

        $payment->save();

        return redirect()
            ->route('admin.billing.show', ['invoiceId' => $invoice->id])
            ->with('success', 'Payment successfully processed!');
    }

    public function downloadPDF(Payment $payment)
    {
        // Get all payments that share the same invoice_id
        $invoiceId = $payment->invoice_id;
        $allPayments = Payment::where('invoice_id', $invoiceId)->get();

        // Optional: Load patient info (if needed for the PDF)
        $patient = $payment->patient;

        // Load the PDF view
        $pdf = Pdf::loadView('payments.pdf', [
            'invoiceId' => $invoiceId,
            'payments' => $allPayments,
            'patient' => $patient,
        ]);

        return $pdf->download("receipt_invoice_{$invoiceId}.pdf");
    }
}
