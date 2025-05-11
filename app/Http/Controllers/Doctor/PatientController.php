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

}
