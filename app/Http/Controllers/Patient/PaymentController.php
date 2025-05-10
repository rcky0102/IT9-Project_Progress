<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
