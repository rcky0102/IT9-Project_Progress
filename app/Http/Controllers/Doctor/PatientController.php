<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\MedicalRecord;

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
}
