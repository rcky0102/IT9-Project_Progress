<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\MedicalRecord;
use App\Models\Patient;

class PatientController extends Controller
{
    public function index()
    {
        $doctor = Auth::user()->doctor;

        $patients = Appointment::where('doctor_id', $doctor->id)
            ->with(['patient', 'patient.medicalRecords']) // Eager load the medical records through patient
            ->get()
            ->pluck('patient')
            ->unique('id'); 

        $latestMedicalRecords = MedicalRecord::latest()
            ->get()
            ->unique('patient_id');

        return view('doctor.patients', compact('patients', 'latestMedicalRecords'));
    }

    public function show($id)

    {
        $doctor = Auth::user()->doctor;

        // Check if this patient has an appointment with the current doctor
        $hasAppointment = Appointment::where('doctor_id', $doctor->id)
            ->where('patient_id', $id)
            ->exists();

        if (!$hasAppointment) {
            return redirect()->route('doctor.patients.index')
                ->with('error', 'You do not have permission to view this patient.');
        }

        $patient = Patient::with(['user', 'medicalRecords' => function ($query) {
            $query->latest(); // Sort medical records by newest first
        }])->findOrFail($id);

        return view('doctor.patient-show', compact('patient'));
    }
    public function edit($id)
    {
        $patient = Patient::findOrFail($id); // Load the patient by ID

        return view('doctor.patient-edit', compact('patient')); // Return to edit view
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'contact_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        // Find the patient by ID
        $patient = Patient::findOrFail($id);

        // Update patient details
        $patient->first_name = $request->input('first_name');
        $patient->middle_name = $request->input('middle_name');
        $patient->last_name = $request->input('last_name');
        $patient->email = $request->input('email');
        $patient->contact_number = $request->input('contact_number');
        $patient->address = $request->input('address');
        $patient->save();

        return redirect()->route('doctor.patients.index')->with('success', 'Patient updated successfully.');
    }

}