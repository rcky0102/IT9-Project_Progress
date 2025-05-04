<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;

class PatientController extends Controller
{
    public function index()
    {
        $doctor = Auth::user()->doctor;

        $patients = Appointment::where('doctor_id', $doctor->id)
            ->with('patient.user') 
            ->get()
            ->pluck('patient')
            ->unique('id'); 

        return view('doctor.patients', compact('patients'));
    }
}
