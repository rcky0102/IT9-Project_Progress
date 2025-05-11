<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\MedicalRecord;

class PMedicalRecordController extends Controller
{
    public function index()
    {
        $patient = Auth::user()->patient;

        if (!$patient) {
            abort(403, 'Unauthorized access - Patient profile not found.');
        }

        // Get all records grouped by year for the timeline
        $medicalRecords = MedicalRecord::with(['appointment.patient', 'appointment.doctor', 'recordType'])
            ->whereHas('appointment', function ($query) use ($patient) {
                $query->where('patient_id', $patient->id);
            })
            ->orderByDesc('date')
            ->get()
            ->groupBy(function ($record) {
                return \Carbon\Carbon::parse($record->date)->format('Y');
            });

        // Get the most recent record with vital signs for the health summary
        $latestRecord = MedicalRecord::whereHas('appointment', function ($query) use ($patient) {
                $query->where('patient_id', $patient->id);
            })
            ->whereNotNull('blood_pressure')
            ->orWhereNotNull('heart_rate')
            ->orWhereNotNull('temperature')
            ->orWhereNotNull('respiratory_rate')
            ->orderByDesc('date')
            ->first();

        // Fetch latest diagnoses (distinct and recent)
        $latestDiagnoses = MedicalRecord::whereHas('appointment', function ($query) use ($patient) {
            $query->where('patient_id', $patient->id);
        })
        ->whereNotNull('diagnosis')
        ->orderByDesc('date')
        ->limit(5)
        ->pluck('diagnosis', 'date');


        return view('patient.medical-records', compact('medicalRecords', 'latestRecord', 'latestDiagnoses'));

    }

    public function show($id)
    {
        $patient = Auth::user()->patient;

        if (!$patient) {
            abort(403, 'Unauthorized access - Patient profile not found.');
        }

        // Load the MedicalRecord with its appointment and related models
        $medicalRecord = MedicalRecord::with([
                'appointment.patient',
                'appointment.doctor',
                'recordType',
            ])
            ->where('id', $id)
            ->whereHas('appointment', function ($query) use ($patient) {
                $query->where('patient_id', $patient->id);
            })
            ->firstOrFail();

        return view('patient.medical-record-show', [
            'appointment' => $medicalRecord->appointment, // For your view to work
            'medicalRecord' => $medicalRecord
        ]);
    }
}
