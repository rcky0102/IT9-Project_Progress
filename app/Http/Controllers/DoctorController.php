<?php
// app/Http/Controllers/DoctorController.php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the doctors.
     */
    public function index()
    {
        $doctors = Doctor::where('is_active', true)->get();
        
        return view('doctors.index', [
            'doctors' => $doctors,
        ]);
    }

    /**
     * Display the specified doctor.
     */
    public function show(Doctor $doctor)
    {
        return view('doctors.show', [
            'doctor' => $doctor,
        ]);
    }
}