<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\AppointmentType;
use App\Models\Doctor;
use App\Models\Availability;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('user_id', Auth::id())
            ->orderBy('appointment_date', 'asc')
            ->get();
    
        // Count the number of appointments
        $appointmentsCount = $appointments->count();
    
        // Retrieve doctors with the related user model to get the full name
        $doctorNames = Doctor::with('user')  // Eager load the user relationship
            ->get()
            ->mapWithKeys(function ($doctor) {
                // Dynamically create full_name using the user's name attributes
                return [$doctor->id => $doctor->user->first_name . ' ' . $doctor->user->middle_name . ' ' . $doctor->user->last_name];
            });
    
        return view('patient.appointments', compact('appointments', 'appointmentsCount', 'doctorNames'));
    }
    
    
    
    
    

    public function create()
    {
        $appointmentTypes = AppointmentType::with('specializations')->get();
        return view('patient.patient_crud.create', compact('appointmentTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'appointmentType' => 'required|exists:appointment_types,id',
            'doctor' => 'required|exists:doctors,id',
            'date' => 'required|date',
            'time' => 'required',
            'reason' => 'required|string',
            'notes' => 'nullable|string',
        ]);
        
        Appointment::create([
            'user_id' => Auth::id(),
            'appointment_type_id' => $validated['appointmentType'],
            'doctor_id' => $validated['doctor'],
            'appointment_date' => Carbon::parse($validated['date'])->format('Y-m-d'),
            'appointment_time' => $validated['time'],
            'reason' => $validated['reason'],
            'notes' => $validated['notes'] ?? null,
        ]);
        
    
        return redirect()->route('patient.appointments')->with('success', 'Appointment successfully scheduled!');
    }

    public function getDoctorsByType($appointmentTypeId)
    {
        $type = AppointmentType::with('specializations')->findOrFail($appointmentTypeId);
        $specializationIds = $type->specializations->pluck('id');
    
        $doctors = Doctor::with(['user', 'specialization']) 
            ->whereIn('specialization_id', $specializationIds)
            ->get();
    
        return response()->json($doctors);
    }
    

    public function getDoctorAvailability($doctorId)
    {
        $availabilities = Availability::where('doctor_id', $doctorId)->get();
    
        return response()->json($availabilities);
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

