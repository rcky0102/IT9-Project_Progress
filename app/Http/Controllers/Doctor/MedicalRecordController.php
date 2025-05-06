<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MedicalRecord;
use App\Models\Appointment;
use App\Models\RecordType;
use Illuminate\Support\Facades\Auth;

class MedicalRecordController extends Controller
{
    public function index()
    {
        $doctor = Auth::user()->doctor;

        $medicalRecords = MedicalRecord::with('appointment.patient.user', 'recordType')
            ->whereHas('appointment', function ($query) use ($doctor) {
                $query->where('doctor_id', $doctor->id);
            })
            ->get();

        return view('doctor.medical-records', compact('medicalRecords'));
    }

    public function create()
    {
        $doctor = Auth::user()->doctor;

        $appointments = Appointment::with('patient.user')
            ->where('doctor_id', $doctor->id)
            ->get();

        $recordTypes = RecordType::all();

        return view('doctor.medical-records-create', compact('appointments', 'recordTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'appointment_id'     => 'required|exists:appointments,id',
            'record_type_id'     => 'required|exists:record_types,id',
            'date'               => 'required|date',
            'diagnosis'          => 'required|string|max:255',
            'blood_pressure'     => 'nullable|string|max:50',
            'temperature'        => 'nullable|string|max:50',
            'heart_rate'         => 'nullable|string|max:50',
            'respiratory_rate'   => 'nullable|string|max:50',
            'notes'              => 'required|string',
        ]);

        MedicalRecord::create($validated);

        return redirect()->route('doctor.medical-records')->with('success', 'Record created successfully.');
    }
}
