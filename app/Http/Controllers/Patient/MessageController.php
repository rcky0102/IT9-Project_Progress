<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Appointment;

class MessageController extends Controller
{
    public function index()
    {
       
        $patient = Auth::user()->patient;
        
        $doctors = Doctor::with('user')  
                        ->whereHas('appointments', function ($query) use ($patient) {
                            $query->where('patient_id', $patient->id);
                        })
                        ->get();

        $messages = Message::with(['appointment.doctor.user'])
            ->whereHas('appointment', function ($query) use ($patient) {
                $query->where('patient_id', $patient->id);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('patient.messages', compact('doctors', 'messages'));
    }

    public function create()
    {
        $patient = Auth::user()->patient; // assuming user is authenticated patient

        // Get all appointments of this patient with eager loading
        $appointments = Appointment::with('doctor.user')
            ->where('patient_id', $patient->id)
            ->get();

        $uniqueAppointments = $appointments->unique('doctor_id');

        return view('patient.messages-create', compact('uniqueAppointments'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $appointment = Appointment::where('id', $request->appointment_id)
            ->where('patient_id', Auth::user()->patient->id)
            ->firstOrFail(); // Ensures the appointment belongs to the authenticated patient

        Message::create([
            'appointment_id' => $appointment->id,
            'subject' => $request->subject,
            'content' => $request->content,
        ]);

        return redirect()->route('patient.messages')->with('success', 'Message sent successfully.');
    }



}