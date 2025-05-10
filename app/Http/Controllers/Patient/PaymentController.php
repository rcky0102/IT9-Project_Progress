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
            'amount_paid' => 'required|numeric',
            'payment_method_id' => 'required|exists:payment_methods,id', // Ensure payment method is valid
        ]);
    
        // Retrieve the invoice
        $invoice = Invoice::findOrFail($invoiceId);
    
        // Create the payment record
        $payment = new Payment([
            'invoice_id' => $invoice->id,
            'payment_method_id' => $request->payment_method_id,  // Assuming this is part of the form
            'amount_paid' => $request->amount_paid,
            'status' => 'paid', // Set payment status to 'paid'
            'paid_at' => now(),  // Add payment timestamp
        ]);
    
        // Save the payment record
        $payment->save();
    
        // Update the invoice status to 'paid' if payment is successfully made
        $invoice->status = 'paid';
        $invoice->save(); // Save the updated invoice
    
        // Redirect with a success message
        return redirect()->route('patient.invoice-details', ['invoiceId' => $invoice->id])
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
