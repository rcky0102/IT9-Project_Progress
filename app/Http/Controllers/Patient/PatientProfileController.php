<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PatientProfileController extends Controller
{
    
    public function edit()
    {
        // Explicitly get patient record for authenticated user
        $patient = Patient::where('user_id', Auth::id())->firstOrFail();
        $user = $patient->user; // Now safely accessible via relationship
        
        return view('patient.profile', compact('user', 'patient'));
    }

    public function update(Request $request)
    {
        // Get patient and user records in one query
        $patient = Patient::with('user')->where('user_id', Auth::id())->firstOrFail();
        $user = $patient->user;

        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'birthdate' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'contact_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'medical_history' => 'nullable|string',
            'password' => 'nullable|min:6|confirmed'
        ]);

        // Update User
        $user->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password 
                ? Hash::make($request->password) 
                : $user->password
        ]);

        // Update Patient
        $patient->update([
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'contact_number' => $request->contact_number,
            'address' => $request->address,
            'medical_history' => $request->medical_history
        ]);

        return redirect()->route('patient.dashboard')
               ->with('success', 'Profile updated successfully!');
    }
}