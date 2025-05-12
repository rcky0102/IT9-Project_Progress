<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DAppointmentController extends Controller
{
    public function index()
    {
        $doctorId = Auth::user()->doctor->id;

        $appointments = Appointment::with(['patient.user', 'appointmentType'])
            ->where('doctor_id', $doctorId)
            ->orderBy('appointment_date', 'asc')
            ->get();

        return view('doctor.appointments', compact('appointments'));
    }

    public function show(Appointment $appointment)
    {
        $appointment->load(['patient.user', 'appointmentType']);

        return view('doctor.appointment-show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        return view('doctor.appointment-edit', compact('appointment'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|date_format:H:i',
            'appointment_end_time' => 'nullable|date_format:H:i|after:appointment_time',
            'status' => 'required|in:confirmed,pending,completed,cancelled',
        ]);

        // Convert times into full datetime if necessary (especially if you're using datetime columns)
        $appointment->appointment_date = $request->appointment_date;
        $appointment->appointment_time = $request->appointment_time;
        $appointment->appointment_end_time = $request->appointment_end_time; // Must be nullable
        $appointment->status = $request->status;

        $appointment->save();

        return redirect()->route('doctor.appointment-show', $appointment->id)->with('success', 'Appointment updated successfully.');
    }




}
