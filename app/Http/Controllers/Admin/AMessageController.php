<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AMessageController extends Controller
{
    public function index()
    {
        $messages = Message::with([
            'appointment.appointmentType',
            'appointment.patient.user',
            'appointment.doctor.user'
        ])->latest()->paginate(10);


        return view('admin.messages.index', compact('messages'));
    }

    public function create()
    {
        $appointments = Appointment::with(['patient.user', 'doctor.user'])
            ->whereIn('status', ['confirmed', 'completed'])
            ->get();

        return view('admin.messages.create', compact('appointments'));
    }

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
            'sender_type' => 'admin',
        ]);

        return redirect()->route('admin.messages.index')
            ->with('success', 'Message sent successfully');
    }

    public function show(Message $message)
    {
        $message->load(['appointment.patient.user', 'appointment.doctor.user']);
        return view('admin.messages.show', compact('message'));
    }
}