<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AMessageController extends Controller
{
    public function index()
    {
        $messages = Message::with('appointment.doctor', 'appointment.patient')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.messages.index', compact('messages'));
    }

    public function create()
    {
        $appointments = Appointment::with('doctor', 'patient')->get();

        return view('admin.messages.create', compact('appointments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Message::create([
            'appointment_id' => $validated['appointment_id'],
            'subject' => $validated['subject'],
            'content' => $validated['content'],
            'sender_type' => 'admin',
        ]);

        return redirect()->route('admin.messages.index')->with('success', 'Message sent successfully!');
    }

    public function show(Message $message)
    {
        $message->load('appointment.doctor', 'appointment.patient');

        return view('admin.messages.show', compact('message'));
    }
}
