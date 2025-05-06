<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MedicalRecord;

class PMedicalRecordController extends Controller
{
    public function index()
    {
        // Retrieve the logged-in patient's data
        $patient = Auth::user()->patient; // Ensure the user has an associated patient

        // Guard clause to handle missing patient
        if (!$patient) {
            abort(403, 'Unauthorized access - Patient profile not found.');
        }

        // Retrieve the medical records for the authenticated patient
        $medicalRecords = MedicalRecord::with(['appointment.patient', 'appointment.doctor', 'recordType'])
            ->whereHas('appointment', function ($query) use ($patient) {
                $query->where('patient_id', $patient->id); // Get only records for the current patient
            })
            ->orderByDesc('date') // Sort by date (most recent first)
            ->get()
            ->groupBy(function ($record) {
                // Group records by year (for timeline display)
                return \Carbon\Carbon::parse($record->date)->format('Y');
            });

        return view('patient.medical-records', compact('medicalRecords'));
    }
}
