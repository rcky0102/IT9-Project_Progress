<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\Specialization;
use App\Models\Department;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    public function index()
    {
        $specializations = Specialization::all(); 

        return view('admin.settings.specializations.index', compact('specializations'));
    }

    public function create()
    {
        $departments = Department::all(); 
        return view('admin.settings.specializations.create', compact('departments'));
    }

    public function store(Request $request)
{
    // Validate the incoming request
    $validated = $request->validate([
        'specialization_name' => 'required|string|max:255',
        'department_id' => 'required|exists:departments,id', // Make sure department exists
        'description' => 'nullable|string',
    ]);

    // Create the new specialization
    Specialization::create([
        'specialization_name' => $validated['specialization_name'],
        'department_id' => $validated['department_id'],
        'description' => $validated['description'] ?? null,
    ]);

    // Redirect back with a success message
    return redirect()->route('admin.settings.specializations.index')->with('success', 'Specialization created successfully.');
}


    public function edit($id)
    {
        $specialization = Specialization::findOrFail($id);  // Retrieve the specialization by ID
        $departments = Department::all();  // Retrieve all departments for the dropdown

        return view('admin.settings.specializations.edit', compact('specialization', 'departments'));
    }

    public function update(Request $request, $id)
    {
        $specialization = Specialization::findOrFail($id);
        $specialization->update($request->all());
        return redirect()->route('admin.settings.specializations.index')->with('success', 'Specialization updated successfully.');
    }
    public function destroy($id)
    {
        $specialization = Specialization::findOrFail($id);
        $specialization->delete();
    
        return redirect()->route('admin.settings.specializations.index')
            ->with('success', 'Specialization deleted successfully.');
    }
    
    

}
