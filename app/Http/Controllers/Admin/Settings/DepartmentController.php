<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all(); 

        return view('admin.settings.departments.index', compact('departments'));
    }

    public function create()
    {
        return view('admin.settings.departments.create');
    }

    public function store(Request $request)
    {
    $validated = $request->validate([
        'department_name' => 'required|string|max:255',
    ]);

    Department::create([
        'department_name' => $validated['department_name'],
    ]);

    return redirect()->route('admin.settings.departments.index')->with('success', 'Department created successfully.');
}



}
