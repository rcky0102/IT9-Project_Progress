<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = User::where('role', 'doctor')->with('doctor.specialization')->get();
        return view('admin.doctors.index', compact('doctors'));
    }
    
    
    public function create()
    {
        $specializations = Specialization::all(); 
        return view('admin.doctors.create', compact('specializations'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'specialization_id' => 'required|string|max:255',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'role' => 'doctor', 
            'password' => Hash::make($request->password),
        ]);

        Doctor::create([
            'user_id' => $user->id,
            'specialization_id' => $request['specialization_id'],
        ]);

        return redirect()->route('admin.doctors.index')
            ->with('success', 'Doctor account created successfully');
    }

    public function edit($id)
    {
        $doctor = User::with('doctor')->findOrFail($id);
        $specializations = Specialization::all();
    
        return view('admin.doctors.edit', compact('doctor', 'specializations'));
    }

    public function update(Request $request, $id)
    {
        $doctor = User::findOrFail($id);
    
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $doctor->id,
            'password' => 'nullable|min:6|confirmed',
        ]);
    
        $doctor->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            // Only update password if provided
            'password' => $request->password ? Hash::make($request->password) : $doctor->password,
        ]);
        if ($request->filled('password')) {
            $doctor->password = Hash::make($request->password);
            $doctor->save();
            
        }
            $doctor->doctor->specialization_id = $request->specialization_id;
            $doctor->doctor->save();
        return redirect()->route('admin.doctors.index')
            ->with('success', 'Doctor information updated successfully');
    }

    public function destroy($id)
    {
        $doctor = User::findOrFail($id);
        $doctor->delete();

        return redirect()->route('admin.doctors.index')
            ->with('success', 'Doctor account deleted successfully');
    }
}