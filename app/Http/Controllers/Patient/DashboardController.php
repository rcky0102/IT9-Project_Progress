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
        $outstandingBalance = Invoice::where(function ($query) use ($patient) {
                $query->whereHasMorph('billable', [Appointment::class], function ($q) use ($patient) {
                    $q->where('patient_id', $patient->id);
                })
                ->orWhereHasMorph('billable', [MedicalRecord::class], function ($q) use ($patient) {
                    $q->whereHas('appointment', function ($q) use ($patient) {
                        $q->where('patient_id', $patient->id);
                    });
                });
            })
            ->where('status', '!=', 'paid')
            ->get()
            ->sum(function ($invoice) {
                return $invoice->total_amount - $invoice->payments->sum('amount_paid');
            });

        return view('patient.dashboard', compact(
            'upcomingAppointmentsCount',
            'medicalRecordsCount',
            'outstandingBalance'
        ));
    }
}

