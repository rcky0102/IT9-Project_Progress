<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'birthdate' => 'required|date',
            'gender' => 'required|string|in:male,female,other',
            'contact_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'medical_history' => 'nullable|string',
        ]);

        
        $user = User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'role' => 'patient', 
            'password' => Hash::make($request->password),
        ]);

        
        Patient::create([
            'user_id' => $user->id,
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'contact_number' => $request->contact_number,
            'address' => $request->address,
            'medical_history' => $request->medical_history,
        ]);

        
        Auth::login($user);

        return redirect()->route('patient.dashboard');
    }
}
