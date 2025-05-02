<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\Settings\AppointmentTypeController;
use App\Http\Controllers\Admin\Settings\DepartmentController;
use App\Http\Controllers\Admin\Settings\SpecializationController;
use App\Http\Controllers\Doctor\ScheduleController;
use App\Http\Controllers\Doctor\DAppointmentController;
use App\Http\Controllers\Doctor\PatientController;
use App\Http\Controllers\Doctor\PrescriptionController;
use App\Http\Controllers\Patient\AppointmentController;
use App\Models\Appointment;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


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


    /* doctor's route */
    Route::get('/doctor/dashboard', function () {
        return view('doctor.dashboard');
    })->name('doctor.dashboard');

    /* Doctor-Schedules*/
    Route::get('/doctor/schedules', [ScheduleController::class, 'index'])->name('doctor.schedules');
    Route::get('/doctor/schedule-create', [ScheduleController::class, 'create'])->name('doctor.schedule-create');
    Route::post('/doctor/schedules', [ScheduleController::class, 'store'])->name('doctor.schedule-store');

    /* Doctor-Appointments*/
    Route::get('/doctor/appointments', [DAppointmentController::class, 'index'])->name('doctor.appointments');

    /* Doctor-patients*/
    Route::get('/doctor/patients', [PatientController::class, 'index'])->name('doctor.patients');

    /* Doctor-prescriptions*/
    Route::get('/doctor/prescriptions', [PrescriptionController::class, 'index'])->name('doctor.prescriptions');
    


    /* patient's route */
    Route::get('/patient/dashboard', function () {
        return view('patient.dashboard');
    })->name('patient.dashboard');

    Route::get('/patient/appointments', [AppointmentController::class, 'index'])->name('patient.appointments');
   
    Route::get('/get-doctors/{appointmentType}', [AppointmentController::class, 'getDoctorsByType']);
    Route::get('/doctor/{doctorId}/availability', [AppointmentController::class, 'getDoctorAvailability']);


    
    Route::get('/patient/patient_crud/create', [AppointmentController::class, 'create'])->name('patient.patient_crud.create');
    Route::post('patient/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/patient/appointments/show/{id}', [AppointmentController::class, 'show'])->name('patient.patient_crud.show');
    Route::get('/patient/patient_crud/{id}/edit', [AppointmentController::class, 'edit'])->name('patient.patient_crud.edit');
    Route::put('/patient/appointments/{id}', [AppointmentController::class, 'update'])->name('appointments.update');
    Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');


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







        Route::prefix('settings')->name('settings.')->group(function () {

            Route::get('/settings', [SettingsController::class, 'index'])->name('admin.settings.index');

                Route::get('/settings/appointment_types', [AppointmentTypeController::class, 'index'])->name('appointment_types.index');;
                Route::get('/settings/appointment_types/create', [AppointmentTypeController::class, 'create'])->name('appointment_types.create');
                Route::post('/settings/appointment_types', [AppointmentTypeController::class, 'store'])->name('appointment_types.store');
 
                Route::get('/settings/departments', [DepartmentController::class, 'index'])->name('departments.index');;
                Route::get('/settings/departments/create', [DepartmentController::class, 'create'])->name('departments.create');
                Route::post('/settings/departments', [DepartmentController::class, 'store'])->name('departments.store');

                Route::get('/settings/specializations', [SpecializationController::class, 'index'])->name('specializations.index');;
                Route::get('/settings/specializations/create', [SpecializationController::class, 'create'])->name('specializations.create');
                Route::post('/settings/specializations', [SpecializationController::class, 'store'])->name('specializations.store');
        
        });  
    });

});
        