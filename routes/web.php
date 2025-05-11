<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\Settings\AppointmentTypeController;
use App\Http\Controllers\Admin\Settings\DepartmentController;
use App\Http\Controllers\Admin\Settings\SpecializationController;
use App\Http\Controllers\Admin\Settings\RecordTypeController;
use App\Http\Controllers\Doctor\DAppointmentController;
use App\Http\Controllers\Doctor\PatientController;
use App\Http\Controllers\Doctor\MedicalRecordController;
use App\Http\Controllers\Doctor\PrescriptionController;
use App\Http\Controllers\Doctor\ScheduleController;
use App\Http\Controllers\Doctor\DMessageController;



use App\Http\Controllers\Patient\AppointmentController;
use App\Http\Controllers\Patient\MedicationController;
use App\Http\Controllers\Patient\PMedicalRecordController;
use App\Http\Controllers\Patient\PaymentController;
use App\Http\Controllers\Patient\MessageController;

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

    /* Doctor-medical-records*/
    Route::get('/doctor/medical-records', [MedicalRecordController::class, 'index'])->name('doctor.medical-records');
    Route::get('/doctor/medical-records-create', [MedicalRecordController::class, 'create'])->name('doctor.medical-records-create');
    Route::post('/doctor/medical-records', [MedicalRecordController::class, 'store'])->name('doctor.medical-records-store');
    
    /* Doctor-prescriptions*/
    Route::get('/doctor/prescriptions', [PrescriptionController::class, 'index'])->name('doctor.prescriptions');
    Route::get('/doctor/prescription-create', [PrescriptionController::class, 'create'])->name('doctor.prescription-create');
    Route::post('/doctor/prescriptions', [PrescriptionController::class, 'store'])->name('doctor.prescription-store');


    /* Doctor-Messages*/
    Route::get('/doctor/messages', [DMessageController::class, 'index'])->name('doctor.messages');
    Route::get('/doctor/message-create', [DMessageController::class, 'create'])->name('doctor.message-create');
    Route::post('/doctor/message-store', [DMessageController::class, 'store'])->name('doctor.message-store');
    Route::get('/doctor/messages/{message}', [DMessageController::class, 'show'])->name('doctor.messages.show');
    Route::post('/doctor/messages/{message}/reply', [DMessageController::class, 'reply'])->name('doctor.messages.reply');
    Route::get('/doctor/messages/{message}/forward', [DMessageController::class, 'forward'])->name('doctor.messages.forward');
    Route::delete('/doctor/messages/{message}', [DMessageController::class, 'destroy'])->name('doctor.messages.destroy');



    /* patient's route */
    Route::get('/patient/dashboard', function () {
        return view('patient.dashboard');
    })->name('patient.dashboard');


    /* Patient-appointments */
    Route::get('/patient/appointments', [AppointmentController::class, 'index'])->name('patient.appointments');
    Route::get('/get-doctors/{appointmentType}', [AppointmentController::class, 'getDoctorsByType']);
    Route::get('/doctor/{doctorId}/availability', [AppointmentController::class, 'getDoctorAvailability']); 
    Route::get('/patient/patient_crud/create', [AppointmentController::class, 'create'])->name('patient.patient_crud.create');
    Route::post('patient/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/patient/appointments/show/{id}', [AppointmentController::class, 'show'])->name('patient.patient_crud.show');
    Route::get('/patient/patient_crud/{id}/edit', [AppointmentController::class, 'edit'])->name('patient.patient_crud.edit');
    Route::put('/patient/appointments/{id}', [AppointmentController::class, 'update'])->name('appointments.update');
    Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');

    /* Patient-medications */
    Route::get('/patient/medications', [MedicationController::class, 'index'])->name('patient.medications');

    /* Patient-medical-records */
    Route::get('/patient/medical-records', [PMedicalRecordController::class, 'index'])->name('patient.medical-records');

    /* Patient-medical-records */
    Route::get('/patient/medical-records', [PMedicalRecordController::class, 'index'])->name('patient.medical-records');

    /* Patient-payments */
    Route::get('/patient/payments', [PaymentController::class, 'index'])->name('patient.payments');
    Route::get('/patient/payments/create', [PaymentController::class, 'create'])->name('patient.payments-create');
    Route::get('/patient/payments-invoice-details/{invoiceId}', [PaymentController::class, 'invoiceDetails'])->name('patient.payments-invoice-details');
    Route::get('/patient/payments-paynow/{invoiceId}', [PaymentController::class, 'payNow'])->name('patient.payments-paynow');
    Route::post('/patient/payments-invoice-details/{invoiceId}', [PaymentController::class, 'storePayment'])->name('patient.payments-paynow-store');
    Route::get('/patient/payment-methods/create', [PaymentController::class, 'createPaymentMethod'])->name('patient.payment-methods');
    Route::post('/patient/payment-methods', [PaymentController::class, 'storePaymentMethod'])->name('patient.payment-methods-store');

    /* Patient-messages */
    Route::get('/patient/messages', [MessageController::class, 'index'])->name('patient.messages');
    Route::get('/patient/messages/create', [MessageController::class, 'create'])->name('patient.messages.create');
    Route::post('/patient/messages', [MessageController::class, 'store'])->name('patient.messages.store');
    Route::get('/patient/messages/{message}', [MessageController::class, 'show'])->name('patient.messages.show');
    Route::post('/patient/messages/{message}/reply', [MessageController::class, 'reply'])->name('patient.messages.reply');

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
        
        Route::get('/doctors/{id}/edit', [DoctorController::class, 'edit'])->name('doctors.edit');
        Route::put('/doctors/{id}', [DoctorController::class, 'update'])->name('doctors.update');
        
        
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



        // Route::get('admin/settings/record-types', [RecordTypeController::class, 'index'])->name('admin.settings.record-types');;
        // Route::get('admin/settings/record-types/create', [RecordTypeController::class, 'create'])->name('record-types.create');
        // Route::post('admin/settings/record-types', [RecordTypeController::class, 'store'])->name('record-types.store');



        Route::prefix('settings')->name('settings.')->group(function () {

            Route::get('/settings', [SettingsController::class, 'index'])->name('admin.settings.index');

                Route::get('/appointment_types', [AppointmentTypeController::class, 'index'])->name('appointment_types.index');
                Route::get('/appointment_types/create', [AppointmentTypeController::class, 'create'])->name('appointment_types.create');
                Route::post('appointment_types', [AppointmentTypeController::class, 'store'])->name('appointment_types.store');
                Route::get('/appointment_types/{id}/edit', [AppointmentTypeController::class, 'edit'])->name('appointment_types.edit');
                Route::put('/appointment_types/{id}', [AppointmentTypeController::class, 'update'])->name('appointment_types.update');
                Route::delete('/appointment_types/{id}', [AppointmentTypeController::class, 'destroy'])->name('appointment_types.destroy');

 
                Route::get('/record-types', [RecordTypeController::class, 'index'])->name('record-types.index');;
                Route::get('/record-types/create', [RecordTypeController::class, 'create'])->name('record-types.create');
                Route::post('/record-types', [RecordTypeController::class, 'store'])->name('record-types.store');

                Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');
                Route::get('/departments/create', [DepartmentController::class, 'create'])->name('departments.create');
                Route::post('departments', [DepartmentController::class, 'store'])->name('departments.store');
                Route::get('/departments/{department}/edit', [DepartmentController::class, 'edit'])->name('departments.edit');
                Route::put('/departments/{department}', [DepartmentController::class, 'update'])->name('departments.update');
                Route::delete('/departments/{id}', [DepartmentController::class, 'destroy'])->name('departments.destroy');


                Route::get('/specializations', [SpecializationController::class, 'index'])->name('specializations.index');
                Route::get('/specializations/create', [SpecializationController::class, 'create'])->name('specializations.create');
                Route::post('/specializations', [SpecializationController::class, 'store'])->name('specializations.store');
                Route::get('specializations/{id}/edit', [SpecializationController::class, 'edit'])->name('specializations.edit');
                Route::put('specializations/{id}', [SpecializationController::class, 'update'])->name('specializations.update');
                Route::delete('specializations/{id}', [SpecializationController::class, 'destroy'])->name('specializations.destroy');

        
        });  
    });

});
        