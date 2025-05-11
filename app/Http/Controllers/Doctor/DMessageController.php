<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class DMessageController extends Controller
{
    /**
     * Display all messages sent by the doctor.
     */
    public function index()
    {
        $doctor = Auth::user()->doctor;

        $messages = Message::whereHas('appointment', function ($query) use ($doctor) {
            $query->where('doctor_id', $doctor->id);
        })->with('appointment.patient.user')->latest()->get();

        return view('doctor.messages', compact('messages'));
    }

    /**
     * Show the form to create a new message to a patient.
     */
    public function create()
    {
        $doctor = Auth::user()->doctor;

        $appointments = Appointment::with('patient.user')
            ->where('doctor_id', $doctor->id)
            ->get();

        // Ensure patients are unique
        $uniqueAppointments = $appointments->unique('patient_id')->values();

        return view('doctor.messages-create', compact('uniqueAppointments'));
    }

    /**
     * Store the doctor's message to a patient.
     */
    public function store(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Message::create([
            'appointment_id' => $request->appointment_id,
            'subject' => $request->subject,
            'content' => $request->content,
        ]);

        return redirect()->route('doctor.messages')->with('success', 'Message sent to patient.');
    }
}
