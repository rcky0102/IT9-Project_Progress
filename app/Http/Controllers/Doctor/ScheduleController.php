<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Availability;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index()
    {
        // Get the authenticated doctor's ID
        $doctorId = Auth::user()->doctor->id;

        // Retrieve only the availabilities that belong to this doctor
        $availabilities = Availability::where('doctor_id', $doctorId)->with('doctor')->get(); 

        return view('doctor.schedules', compact('availabilities'));
    }


    public function create()
    {
        return view('doctor.schedule-create');
    }

    public function store(Request $request)
{
    $request->validate([
        'availability-name' => 'required|string|max:255',
        // 'effective-from' => 'required|date',
        // 'effective-to' => 'nullable|date|after_or_equal:effective-from',
    ]);
    
    // Get the authenticated doctor
    $doctor = Auth::user()->doctor;
    
    if (!$doctor) {
        return redirect()->back()->withErrors(['doctor' => 'Doctor profile not found.'])->withInput();
    }
    
    $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

    foreach ($days as $day) {
        if ($request->has("{$day}-active")) {
            $startTimes = $request->input("{$day}-start", []);
            $endTimes = $request->input("{$day}-end", []);
    
            foreach ($startTimes as $index => $start) {
                $end = $endTimes[$index] ?? null;

                if ($start && $end) {
                    Availability::create([
                        'doctor_id' => $doctor->id, // Assign to the authenticated doctor
                        'name' => $request->input('availability-name'),
                        'day' => ucfirst($day),
                        'start_time' => $start,
                        'end_time' => $end,
                        'status' => 'Active',
                    ]);
                }
            }
        }
    }

    return redirect()->route('doctor.schedules')->with('success', 'Availability created successfully.');
}   
public function edit($id)
{
    $availability = Availability::findOrFail($id);
    return view('doctor.schedule-edit', compact('availability'));
}

// Update availability
public function update(Request $request, $id)
{
    $availability = Availability::findOrFail($id);
    $availability->update($request->all());
    return redirect()->route('doctor.schedule-index')->with('success', 'Availability updated successfully');
}

// Delete availability
public function destroy($id)
{
    $availability = Availability::findOrFail($id);
    $availability->delete();
    return redirect()->route('doctor.schedule-index')->with('success', 'Availability deleted successfully');
}


    


}
