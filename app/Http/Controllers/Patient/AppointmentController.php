<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('user_id', Auth::id())
            ->orderBy('appointment_date', 'asc')
            ->get();

        $appointmentsCount = $appointments->count();

        return view('patient.appointment', compact('appointments', 'appointmentsCount'));
    }

    public function create()
    {
        return view('patient.patient_crud.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'appointmentType' => 'required|string',
            'doctor' => 'required|string',
            'date' => 'required|string',
            'time' => 'required',
            'reason' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $formattedDate = Carbon::parse($validated['date'])->format('Y-m-d');

        Appointment::create([
            'user_id' => Auth::id(), // Store the user_id
            'appointment_type' => $validated['appointmentType'],
            'doctor' => $validated['doctor'],
            'appointment_date' => $formattedDate,
            'appointment_time' => $validated['time'],
            'reason' => $validated['reason'],
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->route('patient.appointments')->with('success', 'Appointment successfully scheduled!');
    }

    public function show($id)
    {
        $appointment = Appointment::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('patient.patient_crud.show', compact('appointment'));
    }

    public function edit($id)
    {
        $appointment = Appointment::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('patient.patient_crud.edit', compact('appointment'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'appointmentType'   => 'required|string|max:255',
            'doctor'            => 'required|string|max:255',
            'date'              => 'required|string',
            'time'              => 'required|string',
            'reason'            => 'required|string',
            'notes'             => 'nullable|string',
        ]);

        $appointment = Appointment::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $formattedDate = Carbon::parse($validated['date'])->format('Y-m-d');

        $appointment->update([
            'appointment_type' => $validated['appointmentType'],
            'doctor' => $validated['doctor'],
            'appointment_date' => $formattedDate,
            'appointment_time' => $validated['time'],
            'reason' => $validated['reason'],
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->route('patient.patient_crud.show', $appointment->id)
                         ->with('success', 'Appointment updated successfully!');
    }

    public function destroy($id)
    {
        $appointment = Appointment::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $appointment->delete();

        return redirect()->route('patient.appointments')
                         ->with('success', 'Appointment cancelled successfully!');
    }
}

