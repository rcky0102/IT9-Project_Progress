<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\PaymentMethod;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function index()
    {
        $paymentMethods = PaymentMethod::all(); 

        $invoices = Invoice::with([
            'appointment.appointmentType',
            'appointment.doctor'
        ])
        ->whereHas('appointment', function ($query) {
            $query->where('patient_id', Auth::user()->patient->id);
        })
        ->get();

        return view('patient.payments', compact('paymentMethods', 'invoices'));
    }

    public function payNow($invoiceId)
    {
        $paymentMethods = PaymentMethod::all();

        $invoice = Invoice::findOrFail($invoiceId); // Get the invoice details
    
        // Calculate outstanding balance if it exists
        $outstandingBalance = $invoice->total_amount - $invoice->amount_paid;
    
        return view('patient.payments-paynow', compact('paymentMethods', 'invoice', 'outstandingBalance'));
    }


    public function storePayment(Request $request, $invoiceId)
    {
        // Validate incoming data
        $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'amount_paid' => 'required|numeric|min:0',
            'payment_method_id' => 'required|exists:payment_methods,id',
        ]);
    
        // Retrieve the invoice
        $invoice = Invoice::findOrFail($invoiceId);
    
        // Calculate the outstanding balance
        $totalPayments = $invoice->payments()->sum('amount_paid');
        $outstandingBalance = $invoice->total_amount - $totalPayments;
    
        // Restrict overpayment
        if ($request->amount_paid > $outstandingBalance) {
            return back()->withErrors(['amount_paid' => 'Payment exceeds the outstanding balance of ₱' . number_format($outstandingBalance, 2)]);
        }
    
        // Determine invoice status
        $invoiceStatus = ($request->amount_paid == $outstandingBalance) ? 'paid' : 'partial';
    
        // Update invoice status
        $invoice->status = $invoiceStatus;
        $invoice->save();
    
        // Create the payment
        $payment = new Payment([
            'invoice_id' => $invoice->id,
            'payment_method_id' => $request->payment_method_id,
            'amount_paid' => $request->amount_paid,
            'status' => $invoiceStatus === 'paid' ? 'completed' : 'pending',
            'paid_at' => now(),
        ]);
    
        $payment->save();
    
        return redirect()
            ->route('patient.payments-invoice-details', ['invoiceId' => $invoice->id])
            ->with('success', 'Payment successfully processed!');
    }
    
    
    
    
    



    public function invoiceDetails($invoiceId)
    {
        $invoice = Invoice::with([
            'appointment.patient.user',
            'appointment.doctor.user',
            'appointment.appointmentType',
            'payments.paymentMethod' // eager load payments and their method
        ])->findOrFail($invoiceId);
    
        // Get payments associated with this invoice
        $payments = $invoice->payments;
    
        return view('patient.payments-invoice-details', compact('invoice', 'payments'));
    }


    
    
    

    public function create()
    {
        $paymentMethods = PaymentMethod::all();
        
        return view('patient.payments-create', compact('paymentMethods'));
    }


    public function createPaymentMethod()
    {
        return view('patient.payment-methods');
    }

    public function storePaymentMethod(Request $request)
    {
        
        $validatedData = $request->validate([
            'cardholder_name' => 'required|string|max:255',
            'card_number' => 'required|string|size:16', 
            'expiration_month' => ['required', 'regex:/^(0[1-9]|1[0-2])$/'],
            'expiration_year' => 'required|digits:4|integer|gte:' . date('Y'),
            'security_code' => 'nullable|string|size:3', 
        ]);

        
        PaymentMethod::create([
            'cardholder_name' => $validatedData['cardholder_name'],
            'card_number' => $validatedData['card_number'],
            'expiration_month' => $validatedData['expiration_month'],
            'expiration_year' => $validatedData['expiration_year'],
            'security_code' => $validatedData['security_code'],
        ]);

        
        return redirect()->route('patient.payments')->with('message', 'Payment method added successfully!');
    }

    

 
}
