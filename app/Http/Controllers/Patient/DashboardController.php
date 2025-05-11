<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\MedicalRecord;
use App\Models\Invoice;

class DashboardController extends Controller
{
    public function index()
    {
        $patient = Auth::user()->patient;

        // 1. Count of future scheduled appointments
        $upcomingAppointmentsCount = Appointment::where('patient_id', $patient->id)
            ->where('status', 'confirmed')
            ->whereDate('appointment_date', '>=', now())
            ->count();

        // 2. Count of all medical records linked to this patient via appointments
        $medicalRecordsCount = $patient->medicalRecords()->count();

        // 3. Sum of all unpaid invoices (not marked 'paid')
        $outstandingBalance = Invoice::whereHas('appointment', function ($query) use ($patient) {
                $query->where('patient_id', $patient->id);
            })
            ->where('status', '!=', 'paid')
            ->sum('total_amount');

        return view('patient.dashboard', compact(
            'upcomingAppointmentsCount',
            'medicalRecordsCount',
            'outstandingBalance'
        ));
    }
}
