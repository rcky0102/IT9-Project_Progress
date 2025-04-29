<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\AppointmentType;
use App\Models\Specialization;
use Illuminate\Http\Request;

class AppointmentTypeController extends Controller
{
    public function index()
    {
        $appointmenttypes = AppointmentType::all(); 
        return view('admin.settings.appointment_types.index', compact('appointmenttypes'));
    }

    public function create()
    {
        $specializations = Specialization::all(); 
        return view('admin.settings.appointment_types.create', compact('specializations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'specialization_ids' => 'required|array',
            'specialization_ids.*' => 'exists:specializations,id',
        ]);

        $appointmentType = AppointmentType::create([
            'name' => $request->name,
        ]);

        $appointmentType->specializations()->sync($request->specialization_ids);

        return redirect()->route('admin.settings.appointment_types.index')->with('success', 'Appointment type created successfully.');
    }
}

