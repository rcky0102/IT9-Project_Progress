<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;

class AAppointmentController extends Controller
{
    public function index()
    {
        // Load all appointments with related patient, doctor, and appointment type
        $appointments = Appointment::with(['patient', 'doctor', 'appointmentType'])->get();

        // Create an array of doctor names indexed by their ID
        $doctorNames = Doctor::all()->pluck('full_name', 'id');

        return view('admin.appointments.index', compact('appointments', 'doctorNames'));
    }
}
