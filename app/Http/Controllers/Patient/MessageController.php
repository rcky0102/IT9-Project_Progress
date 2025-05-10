<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;
use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        // Get the currently authenticated user's patient
        $patient = Auth::user()->patient;

        // Get doctors associated with appointments that the patient has
        $doctors = Doctor::with('user')  // Eager load the user (doctor's details)
                        ->whereHas('appointments', function ($query) use ($patient) {
                            $query->where('patient_id', $patient->id);
                        })
                        ->get();

        // Fetch the messages for the patient (this is optional if you still want to display messages)
        $messages = Message::with(['appointment.doctor.user'])
            ->whereHas('appointment', function ($query) use ($patient) {
                $query->where('patient_id', $patient->id);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('patient.messages', compact('doctors', 'messages'));
    }
    
}

