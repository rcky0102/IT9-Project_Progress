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

    public function show($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('patient.patient_crud.show', compact('appointment'));
    }
    
    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('patient.patient_crud.edit', compact('appointment'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $validated = $request->validate([
            'appointmentType'   => 'required|string|max:255',
            'doctor'            => 'required|string|max:255',
            'date'              => 'required|string', // still submitted as a string like "April 3, 2025"
            'time'              => 'required|string',
            'reason'            => 'required|string',
            'notes'             => 'nullable|string',
        ]);
    
        // Find the appointment by ID
        $appointment = Appointment::findOrFail($id);
    
        // Ensure the date is properly parsed and formatted as Y-m-d
        $formattedDate = Carbon::parse($validated['date'])->format('Y-m-d');
    
        // Update appointment details (removed the unwanted fields)
        $appointment->appointment_type   = $validated['appointmentType'];
        $appointment->doctor             = $validated['doctor'];
        $appointment->appointment_date   = $formattedDate;
        $appointment->appointment_time   = $validated['time'];
        $appointment->reason             = $validated['reason'];
        $appointment->notes              = $validated['notes'] ?? null;
    
        // Save the changes
        $appointment->save();
    
        // Redirect back to the details page for the updated appointment with success message
        return redirect()->route('patient.patient_crud.show', $appointment->id)
                         ->with('success', 'Appointment updated successfully!');
    }
    


}
