<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Carbon\Carbon;

class AppointmentController extends Controller
{
 public function index()
{
    $appointments = Appointment::orderBy('appointment_date', 'asc')->get();

    return view('patient.appointment', compact('appointments'));
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
            'date' => 'required|string', // still coming in as a string like "April 3, 2025"
            'time' => 'required',
            'reason' => 'required|string',
            'notes' => 'nullable|string',
        ]);
    
        $formattedDate = Carbon::parse($validated['date'])->format('Y-m-d');
    
        Appointment::create([
            'appointment_type' => $validated['appointmentType'],
            'doctor' => $validated['doctor'],
            'appointment_date' => $formattedDate,
            'appointment_time' => $validated['time'],
            'reason' => $validated['reason'],
            'notes' => $validated['notes'] ?? null,
        ]);
    
        return redirect()->route('patient.appointments')->with('success', 'Appointment successfully scheduled!');
    }

    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('patient.patient_crud.edit', compact('appointment'));
    }

    public function show($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('patient.patient_crud.show', compact('appointment'));
    }
    





}
