<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with('user')->get(); 
        $patients = Patient::with('user')->get();
        $messages = Message::with(['appointment.patient.user', 'appointment.doctor.user'])
                        ->latest()
                        ->paginate(10);

        return view('admin.messages.index', compact('doctors', 'patients', 'messages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'recipient_type' => 'required|in:doctor,patient',
            'recipient_id' => 'required|numeric',
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Find an existing appointment or create a dummy one for the message
        $appointment = Appointment::firstOrCreate([
            'patient_id' => $request->recipient_type === 'patient' ? $request->recipient_id : null,
            'doctor_id' => $request->recipient_type === 'doctor' ? $request->recipient_id : null,
            'appointment_date' => now(),
            'status' => 'message_only',
        ], [
            'appointment_type_id' => 1, // Default type
            'reason' => 'System message',
        ]);

        Message::create([
            'appointment_id' => $appointment->id,
            'subject' => $request->subject,
            'content' => $request->content,
            'sender_type' => 'admin',
        ]);

        return redirect()->route('messages.index')
            ->with('success', 'Message sent successfully!');
    }
}