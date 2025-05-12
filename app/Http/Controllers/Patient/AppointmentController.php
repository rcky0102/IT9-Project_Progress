<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\AppointmentType;
use App\Models\Doctor;
use App\Models\Availability;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{

    public function index()
    {
        // Get the authenticated user's patient record
        $patient = Patient::where('user_id', Auth::id())->first();

        $appointments = Appointment::with('appointmentType')
            ->where('patient_id', $patient->id)
            ->orderBy('appointment_date', 'asc')
            ->get();

        $appointmentsCount = Appointment::where('patient_id', $patient->id)
            ->where('status', 'confirmed')
            ->whereDate('appointment_date', '>=', now())
            ->count();

        $pastAppointmentsCount = $appointments->where('status', 'completed')->count();

        $doctorCount = Appointment::where('patient_id', $patient->id)
            ->whereHas('doctor') 
            ->pluck('doctor_id')
            ->unique()
            ->count();


        $doctorNames = Doctor::with('user')
            ->get()
            ->mapWithKeys(function ($doctor) {
                return [$doctor->id => $doctor->user->first_name . ' ' . $doctor->user->middle_name . ' ' . $doctor->user->last_name];
            });

        return view('patient.appointments', compact('appointments', 'appointmentsCount', 'pastAppointmentsCount', 'doctorCount', 'doctorNames'));
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
        
        // Get the authenticated patient's ID
        $patient = Patient::where('user_id', Auth::id())->first();

        Appointment::create([
            'patient_id' => $patient->id, // Assign patient_id here
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
        $appointment = Appointment::with(['appointmentType', 'doctor.user']) 
            ->where('id', $id)
            ->where('patient_id', Auth::user()->patient->id) // Use patient_id
            ->firstOrFail();
    
        return view('patient.patient_crud.show', compact('appointment'));
    }
    

    public function edit($id)
    {
        $appointment = Appointment::where('id', $id)
            ->where('patient_id', Auth::user()->patient->id) 
            ->firstOrFail();

        
        $appointmentTypes = AppointmentType::all();

        
        $doctors = Doctor::with('user')->get();

        return view('patient.patient_crud.edit', compact('appointment', 'appointmentTypes', 'doctors'));
    }


    public function update(Request $request, $id)
    {
        
        $validated = $request->validate([
            'appointmentType'   => 'required|exists:appointment_types,id',
            'doctor'            => 'required|exists:doctors,id',
            'date'              => 'required|date',
            'time'              => 'required|string',
            'reason'            => 'required|string',
            'notes'             => 'nullable|string',
        ]);

        
        $appointment = Appointment::where('id', $id)
            ->where('patient_id', Auth::user()->patient->id) // Ensure the authenticated user is the owner of the appointment
            ->firstOrFail();

        // Format the date to the required format (Y-m-d)
        $formattedDate = Carbon::parse($validated['date'])->format('Y-m-d');

        // Update the appointment record with the validated data
        $appointment->update([
            'appointment_type_id' => $validated['appointmentType'], 
            'doctor_id'        => $validated['doctor'], 
            'appointment_date' => $formattedDate,
            'appointment_time' => $validated['time'],
            'reason'           => $validated['reason'],
            'notes'            => $validated['notes'] ?? null,
        ]);


        
        return redirect()->route('patient.patient_crud.show', $appointment->id)
                        ->with('success', 'Appointment updated successfully!');
    }


    public function destroy($id)
    {
        $appointment = Appointment::where('id', $id)
            ->where('patient_id', Auth::user()->patient->id) // Use patient_id
            ->firstOrFail();

        $appointment->delete();

        return redirect()->route('patient.appointments')
                         ->with('success', 'Appointment cancelled successfully!');
    }
}
