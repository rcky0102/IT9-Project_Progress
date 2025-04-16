<?php
// app/Http/Controllers/PatientController.php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    /**
     * Display a listing of the patients.
     */
    public function index()
    {
        $this->authorize('viewAny', Patient::class);
        
        $patients = Patient::all();
        
        return view('patients.index', [
            'patients' => $patients,
        ]);
    }

    /**
     * Show the form for creating a new patient.
     */
    public function create()
    {
        $this->authorize('create', Patient::class);
        
        return view('patients.create');
    }

    /**
     * Store a newly created patient in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Patient::class);
        
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date|before:today',
            'gender' => 'required|in:male,female,other',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'blood_type' => 'nullable|string|max:10',
            'allergies' => 'nullable|string|max:500',
            'medical_conditions' => 'nullable|string|max:500',
            'current_medications' => 'nullable|string|max:500',
            'insurance_provider' => 'nullable|string|max:255',
            'insurance_policy_number' => 'nullable|string|max:255',
        ]);
        
        $patient = new Patient($validated);
        $patient->user_id = Auth::id();
        $patient->save();
        
        return redirect()->route('patients.show', $patient)
            ->with('success', 'Patient profile created successfully.');
    }

    /**
     * Display the specified patient.
     */
    public function show(Patient $patient)
    {
        $this->authorize('view', $patient);
        
        return view('patients.show', [
            'patient' => $patient,
        ]);
    }

    /**
     * Show the form for editing the specified patient.
     */
    public function edit(Patient $patient)
    {
        $this->authorize('update', $patient);
        
        return view('patients.edit', [
            'patient' => $patient,
        ]);
    }

    /**
     * Update the specified patient in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        $this->authorize('update', $patient);
        
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date|before:today',
            'gender' => 'required|in:male,female,other',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'blood_type' => 'nullable|string|max:10',
            'allergies' => 'nullable|string|max:500',
            'medical_conditions' => 'nullable|string|max:500',
            'current_medications' => 'nullable|string|max:500',
            'insurance_provider' => 'nullable|string|max:255',
            'insurance_policy_number' => 'nullable|string|max:255',
        ]);
        
        $patient->update($validated);
        
        return redirect()->route('patients.show', $patient)
            ->with('success', 'Patient profile updated successfully.');
    }
}