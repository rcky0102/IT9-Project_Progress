<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DAppointmentController extends Controller
{
    public function index()
    {
        $doctorId = Auth::user()->doctor->id;

        $appointments = Appointment::with(['patient.user', 'appointmentType'])
            ->where('doctor_id', $doctorId)
            ->orderBy('appointment_date', 'asc')
            ->get();

        return view('doctor.appointments', compact('appointments'));
    }
}
