<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prescription;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class PrescriptionController extends Controller
{
    public function index()
    {
        $prescriptions = Prescription::with('appointment.patient.user')->get();
        return view('doctor.prescriptions', compact('prescriptions'));
    }

    public function create()
    {
        $doctor = Auth::user()->doctor;
    
        $appointments = Appointment::with('patient.user')
            ->where('doctor_id', $doctor->id)
            ->get();
    
        return view('doctor.prescription-create', compact('appointments'));
    }
    

    public function store(Request $request)
    {
        $validated = $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'medication' => 'required|string|max:255',
            'dosage' => 'required|string|max:255',
            'frequency' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'instructions' => 'nullable|string',
        ]);

        Prescription::create($validated);

        return redirect()->route('doctor.prescriptions')->with('success', 'Prescription created successfully.');
    }
}

