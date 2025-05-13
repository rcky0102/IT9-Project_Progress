<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\AppointmentType;
use App\Models\Specialization;
use Illuminate\Http\Request;

class AppointmentTypeController extends Controller
{
    public function index(Request $request)
    {
        // Get the search term from the request (if present)
        $search = $request->input('search');

        // Query the database for appointment types, applying the search filter if present
        $appointmenttypes = AppointmentType::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('charge', 'like', '%' . $search . '%')
                        ->orWhereHas('specializations', function ($query) use ($search) {
                            return $query->where('specialization_name', 'like', '%' . $search . '%');
                        });
        })->get();

        // Return the view with the filtered appointment types
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
            'charge' => 'required|numeric|min:0', 
            'specialization_ids' => 'required|array',
            'specialization_ids.*' => 'exists:specializations,id',
        ]);

        $appointmentType = AppointmentType::create([
            'name' => $request->name,
            'charge' => $request->charge, 
        ]);

        $appointmentType->specializations()->sync($request->specialization_ids);

        return redirect()->route('admin.settings.appointment_types.index')->with('success', 'Appointment type created successfully.');
    }
    public function edit($id)
    {
        $appointmentType = AppointmentType::findOrFail($id);
        $specializations = Specialization::all();
        return view('admin.settings.appointment_types.edit', compact('appointmentType', 'specializations'));
    }
    public function destroy($id)
        {
            $appointmentType = AppointmentType::findOrFail($id);
            $appointmentType->delete();

            return redirect()->route('admin.settings.appointment_types.index')->with('success', 'Appointment Type deleted successfully.');
        }
        public function update(Request $request, $id)
        {
            $request->validate([
                'name' => 'required|string',
                'charge' => 'required|numeric|min:0',
                'specialization_ids' => 'required|array',
            ]);
        
            $appointmentType = AppointmentType::findOrFail($id);
            $appointmentType->update([
                'name' => $request->name,
                'charge' => $request->charge,
            ]);
        
            $appointmentType->specializations()->sync($request->specialization_ids);
        
            return redirect()->route('admin.settings.appointment_types.index')->with('success', 'Appointment Type updated successfully.');
        }
        
        

}
