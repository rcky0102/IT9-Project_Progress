<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;

// Registration Routes (only for guests)
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register.form');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
});

// Logout Route (only for authenticated users)
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// Dashboard Route (only for authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();

        // Redirect based on user role
        if ($user->role === 'doctor') {
            return redirect()->route('doctor.dashboard');
        } elseif ($user->role === 'patient') {
            return redirect()->route('patient.dashboard');
        }

        return redirect()->route('login.form')->with('error', 'Role not defined.');
    })->name('dashboard');

    // Doctor Dashboard
    Route::get('/doctor/dashboard', function () {
        return view('doctor.dashboard');
    })->name('doctor.dashboard');

    // Patient Dashboard
    Route::get('/patient/dashboard', function () {
        return view('patient.dashboard');
    })->name('patient.dashboard');
});

