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
        $doctor = Auth::user()->doctor;

        $prescriptions = Prescription::with('appointment.patient.user')
            ->whereHas('appointment', function ($query) use ($doctor) {
                $query->where('doctor_id', $doctor->id);
            })
            ->get();

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

    public function show($id)
{
    $doctor = Auth::user()->doctor;

    $prescription = Prescription::with('appointment.patient.user')
        ->whereHas('appointment', function ($query) use ($doctor) {
            $query->where('doctor_id', $doctor->id);
        })
        ->findOrFail($id);

    return view('doctor.prescription-show', compact('prescription'));
}

public function edit($id)
{
    $doctor = Auth::user()->doctor;

    $prescription = Prescription::with('appointment.patient.user')
        ->whereHas('appointment', function ($query) use ($doctor) {
            $query->where('doctor_id', $doctor->id);
        })
        ->findOrFail($id);

    $appointments = Appointment::with('patient.user')
        ->where('doctor_id', $doctor->id)
        ->get();

    return view('doctor.prescription-edit', compact('prescription', 'appointments'));
}

public function update(Request $request, $id)
{
    $doctor = Auth::user()->doctor;

    $prescription = Prescription::whereHas('appointment', function ($query) use ($doctor) {
            $query->where('doctor_id', $doctor->id);
        })
        ->findOrFail($id);

    $validated = $request->validate([
        'appointment_id' => 'required|exists:appointments,id',
        'medication' => 'required|string|max:255',
        'dosage' => 'required|string|max:255',
        'frequency' => 'required|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        'instructions' => 'nullable|string',
    ]);

    $prescription->update($validated);

    return redirect()->route('doctor.prescription-show', ['id' => $prescription->id])->with('success', 'Prescription updated successfully.');
}
  public function destroy($id)
    {
        $prescription = Prescription::findOrFail($id);
        $prescription->delete();

        return redirect()->route('doctor.prescriptions')->with('success', 'Prescription deleted successfully!');
    }

}

