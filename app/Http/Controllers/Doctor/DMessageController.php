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

    /**
     * Display a specific message and its conversation thread.
     */
    public function show(Message $message)
    {
        $doctor = Auth::user()->doctor;

        // Check if the message belongs to the authenticated doctor
        if ($message->appointment->doctor_id !== $doctor->id) {
            return redirect()->route('doctor.messages')
                ->with('error', 'You do not have permission to view this message.');
        }

        // Mark the message as read if it's unread
        if ($message->unread) {
            $message->update(['unread' => false]);
        }

        // Get all messages between this doctor and patient (the conversation thread)
        $thread = Message::where('appointment_id', $message->appointment_id)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('doctor.message-show', compact('message', 'thread'));
    }

    /**
     * Reply to a message.
     */
    public function reply(Request $request, Message $message)
    {
        $doctor = Auth::user()->doctor;

        // Check if the message belongs to the authenticated doctor
        if ($message->appointment->doctor_id !== $doctor->id) {
            return redirect()->route('doctor.messages')
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
            'sender_type' => 'doctor', // Indicate this is from the doctor
        ]);

        return redirect()->route('doctor.messages.show', $message->id)
            ->with('success', 'Reply sent successfully.');
    }

    /**
     * Show form to forward a message.
     */
    public function forward(Message $message)
    {
        $doctor = Auth::user()->doctor;

        // Check if the message belongs to the authenticated doctor
        if ($message->appointment->doctor_id !== $doctor->id) {
            return redirect()->route('doctor.messages')
                ->with('error', 'You do not have permission to forward this message.');
        }

        $appointments = Appointment::with('patient.user')
            ->where('doctor_id', $doctor->id)
            ->get();

        // Ensure patients are unique
        $uniqueAppointments = $appointments->unique('patient_id')->values();

        return view('doctor.messages-forward', compact('message', 'uniqueAppointments'));
    }

    /**
     * Delete a message.
     */
    public function destroy(Message $message)
    {
        $doctor = Auth::user()->doctor;

        // Check if the message belongs to the authenticated doctor
        if ($message->appointment->doctor_id !== $doctor->id) {
            return redirect()->route('doctor.messages')
                ->with('error', 'You do not have permission to delete this message.');
        }

        $message->delete();

        return redirect()->route('doctor.messages')
            ->with('success', 'Message deleted successfully.');
    }
}