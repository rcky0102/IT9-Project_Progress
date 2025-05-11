<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\PaymentMethod;

class BillingController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with([
            'appointment.patient',
            'appointment.doctor',
            'appointment.appointmentType'
        ])->get();

        return view('admin.billing.index', compact('invoices'));
    }

        public function show($invoiceId)
    {
        $invoice = Invoice::with([
            'appointment.patient.user',
            'appointment.doctor.user',
            'appointment.appointmentType',
            'payments.paymentMethod' // eager load payments and their method
        ])->findOrFail($invoiceId);
    
        // Get payments associated with this invoice
        $payments = $invoice->payments;
    
        return view('admin.billing.show', compact('invoice', 'payments'));
    }

        public function create($invoiceId)
    {
        $paymentMethods = PaymentMethod::all();

        $invoice = Invoice::findOrFail($invoiceId); // Get the invoice details
    
        // Calculate outstanding balance if it exists
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
            return back()->withErrors(['amount_paid' => 'Payment exceeds the outstanding balance of ₱' . number_format($outstandingBalance, 2)]);
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
    

}

