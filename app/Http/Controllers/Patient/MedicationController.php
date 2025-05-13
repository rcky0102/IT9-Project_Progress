<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Prescription;

class MedicationController extends Controller
{
    public function index()
    {
        $patient = Auth::user()->patient;

        $prescriptions = Prescription::with('appointment')
            ->whereHas('appointment', function ($query) use ($patient) {
                $query->where('patient_id', $patient->id);
            })
            ->get();

        return view('patient.medications', compact('prescriptions'));
    }


    public function show($id)
    {
        $prescription = Prescription::with('appointment')->findOrFail($id);
        return view('patient.medication-show', compact('prescription'));
    }


}
