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
            'sender_type' => 'patient', // Set sender type to patient
        ]);

        return redirect()->route('patient.messages')->with('success', 'Message sent successfully.');
    }

    /**
     * Display a specific message and its conversation thread.
     */
    public function show(Message $message)
    {
        $patient = Auth::user()->patient;

        // Check if the message belongs to the authenticated patient
        if ($message->appointment->patient_id !== $patient->id) {
            return redirect()->route('patient.messages')
                ->with('error', 'You do not have permission to view this message.');
        }

        // Get all messages between this patient and doctor (the conversation thread)
        $thread = Message::where('appointment_id', $message->appointment_id)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('patient.message-show', compact('message', 'thread'));
    }

    /**
     * Reply to a message.
     */
    public function reply(Request $request, Message $message)
    {
        $patient = Auth::user()->patient;

        // Check if the message belongs to the authenticated patient
        if ($message->appointment->patient_id !== $patient->id) {
            return redirect()->route('patient.messages')
                ->with('error', 'You do not have permission to reply to this message.');
        }

        $request->validate([
            'content' => 'required|string',
        ]);

        // Create a new message as a reply
        $reply = Message::create([
            'appointment_id' => $message->appointment_id,
            'subject' => 'RE: ' . $message->subject,
            'content' => $request->content,
            'sender_type' => 'patient', // Indicate this is from the patient
        ]);

        return redirect()->route('patient.messages.show', $message->id)
            ->with('success', 'Reply sent successfully.');
    }
}