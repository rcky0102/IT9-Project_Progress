<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Patient\AppointmentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    // Register routes
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    // Login routes
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();

        if ($user->role === 'doctor') {
            return redirect()->route('doctor.dashboard');
        } elseif ($user->role === 'patient') {
            return redirect()->route('patient.dashboard');
        } elseif ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('login')->with('error', 'Role not defined.');
    })->name('dashboard');

    Route::get('/doctor/dashboard', function () {
        return view('doctor.dashboard');
    })->name('doctor.dashboard');

    Route::get('/patient/dashboard', function () {
        return view('patient.dashboard');
    })->name('patient.dashboard');

    Route::get('/patient/appointments', [AppointmentController::class, 'index'])->name('patient.appointments');
    
    Route::get('/patient/patient_crud/create', [AppointmentController::class, 'create'])->name('patient.patient_crud.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/patient/appointments/show/{id}', [AppointmentController::class, 'show'])->name('patient.patient_crud.show');
    Route::get('/patient/patient_crud/{id}/edit', [AppointmentController::class, 'edit'])->name('patient.patient_crud.edit');
    Route::put('/patient/appointments/{id}', [AppointmentController::class, 'update'])->name('appointments.update');



    // Admin routes
    Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
        // Admin dashboard
        Route::get('/dashboard', function () {
            if (Auth::user()->role !== 'admin') {
                return redirect()->route('dashboard')->with('error', 'You do not have permission to access this page.');
            }
            return view('admin.dashboard');
        })->name('dashboard');
        
        // Users management
        Route::get('/users', function () {
            if (Auth::user()->role !== 'admin') {
                return redirect()->route('dashboard')->with('error', 'You do not have permission to access this page.');
            }
            return view('admin.users.index');
        })->name('users.index');
        
        // Doctor management routes
        Route::get('/doctors', function () {
            if (Auth::user()->role !== 'admin') {
                return redirect()->route('dashboard')->with('error', 'You do not have permission to access this page.');
            }
            return app()->make(DoctorController::class)->index();
        })->name('doctors.index');
        
        Route::get('/doctors/create', function () {
            if (Auth::user()->role !== 'admin') {
                return redirect()->route('dashboard')->with('error', 'You do not have permission to access this page.');
            }
            return app()->make(DoctorController::class)->create();
        })->name('doctors.create');
        
        Route::post('/doctors', function (Request $request) {
            if (Auth::user()->role !== 'admin') {
                return redirect()->route('dashboard')->with('error', 'You do not have permission to access this page.');
            }
            return app()->make(DoctorController::class)->store($request);
        })->name('doctors.store');
        
        Route::get('/doctors/{id}/edit', function ($id) {
            if (Auth::user()->role !== 'admin') {
                return redirect()->route('dashboard')->with('error', 'You do not have permission to access this page.');
            }
            return app()->make(DoctorController::class)->edit($id);
        })->name('doctors.edit');
        
        Route::put('/doctors/{id}', function (Request $request, $id) {
            if (Auth::user()->role !== 'admin') {
                return redirect()->route('dashboard')->with('error', 'You do not have permission to access this page.');
            }
            return app()->make(DoctorController::class)->update($request, $id);
        })->name('doctors.update');
        
        Route::delete('/doctors/{id}', function ($id) {
            if (Auth::user()->role !== 'admin') {
                return redirect()->route('dashboard')->with('error', 'You do not have permission to access this page.');
            }
            return app()->make(DoctorController::class)->destroy($id);
        })->name('doctors.destroy');
        
        // Appointments management
        Route::get('/appointments', function () {
            if (Auth::user()->role !== 'admin') {
                return redirect()->route('dashboard')->with('error', 'You do not have permission to access this page.');
            }
            return view('admin.appointments.index');
        })->name('appointments.index');
        
        // Services management
        Route::get('/services', function () {
            if (Auth::user()->role !== 'admin') {
                return redirect()->route('dashboard')->with('error', 'You do not have permission to access this page.');
            }
            return view('admin.services.index');
        })->name('services.index');
        
        // Billing management
        Route::get('/billing', function () {
            if (Auth::user()->role !== 'admin') {
                return redirect()->route('dashboard')->with('error', 'You do not have permission to access this page.');
            }
            return view('admin.billing.index');
        })->name('billing.index');
        
        // Reports
        Route::get('/reports', function () {
            if (Auth::user()->role !== 'admin') {
                return redirect()->route('dashboard')->with('error', 'You do not have permission to access this page.');
            }
            return view('admin.reports.index');
        })->name('reports.index');
        
        // Settings
        Route::get('/settings', function () {
            if (Auth::user()->role !== 'admin') {
                return redirect()->route('dashboard')->with('error', 'You do not have permission to access this page.');
            }
            return view('admin.settings.index');
        })->name('settings.index');
    });
});