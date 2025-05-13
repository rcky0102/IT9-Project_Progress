<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\MedicalRecord;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\Doctor;

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

        // Get the authenticated user's patient record
        $patient = Patient::where('user_id', Auth::id())->first();

        $appointments = Appointment::with('appointmentType')
            ->where('patient_id', $patient->id)
            ->take(3)
            ->orderBy('appointment_date', 'asc')
            ->get();

        $appointmentsCount = Appointment::where('patient_id', $patient->id)
            ->where('status', 'confirmed')
            ->whereDate('appointment_date', '>=', now())
            ->count();

        $pastAppointmentsCount = $appointments->where('status', 'completed')->count();

        $doctorCount = Appointment::where('patient_id', $patient->id)
            ->whereHas('doctor') 
            ->pluck('doctor_id')
            ->unique()
            ->count();


        $doctorNames = Doctor::with('user')
            ->get()
            ->mapWithKeys(function ($doctor) {
                return [$doctor->id => $doctor->user->first_name . ' ' . $doctor->user->middle_name . ' ' . $doctor->user->last_name];
            });

        return view('patient.dashboard', compact(
            'upcomingAppointmentsCount',
            'medicalRecordsCount',
            'outstandingBalance',
            'appointments'
        ));
    }
}

