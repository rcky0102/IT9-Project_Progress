<?php
// app/Http/Controllers/AppointmentController.php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\AppointmentType;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ApmtController extends Controller
{
    /**
     * Display a listing of the appointments.
     */
    public function index()
    {
        $patient = Auth::user()->patient;
        
        if (!$patient) {
            return redirect()->route('appointments.create')
                ->with('warning', 'Please complete your patient profile before scheduling appointments.');
        }
        
        $upcomingAppointments = $patient->appointments()->upcoming()->get();
        $pastAppointments = $patient->appointments()->past()->get();
        
        return view('appointments.index', [
            'upcomingAppointments' => $upcomingAppointments,
            'pastAppointments' => $pastAppointments,
        ]);
    }

    /**
     * Show the form for creating a new appointment.
     */
    public function create()
    {
        $patient = Auth::user()->patient;
        
        if (!$patient) {
            return redirect()->route('appointments.create')
                ->with('warning', 'Please complete your patient profile before scheduling appointments.');
        }
        
        $doctors = Doctor::where('is_active', true)->get();
        $appointmentTypes = AppointmentType::where('is_active', true)->get();
        
        return view('appointments.create', [
            'patient' => $patient,
            'doctors' => $doctors,
            'appointmentTypes' => $appointmentTypes,
        ]);
    }

    /**
     * Get available dates for a doctor.
     */
    public function getAvailableDates(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
        ]);
        
        $doctor = Doctor::findOrFail($request->doctor_id);
        
        // Get the doctor's schedule
        $schedules = $doctor->schedules()
            ->where('is_available', true)
            ->get()
            ->pluck('day_of_week')
            ->toArray();
        
        // Generate dates for the next 30 days
        $availableDates = [];
        $startDate = Carbon::today();
        $endDate = Carbon::today()->addDays(30);
        
        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $dayOfWeek = strtolower($date->format('l'));
            
            if (in_array($dayOfWeek, $schedules)) {
                $availableDates[] = [
                    'date' => $date->format('Y-m-d'),
                    'formatted' => $date->format('l, F j, Y'),
                ];
            }
        }
        
        return response()->json($availableDates);
    }

    /**
     * Get available time slots for a doctor on a specific date.
     */
    public function getAvailableTimeSlots(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'date' => 'required|date|after_or_equal:today',
        ]);
        
        $doctor = Doctor::findOrFail($request->doctor_id);
        $timeSlots = $doctor->getAvailableTimeSlots($request->date);
        
        return response()->json($timeSlots);
    }

    /**
     * Store a newly created appointment in storage.
     */
    public function store(Request $request)
    {
        $patient = Auth::user()->patient;
        
        if (!$patient) {
            return redirect()->route('appointments.create')
                ->with('warning', 'Please complete your patient profile before scheduling appointments.');
        }
        
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_type_id' => 'required|exists:appointment_types,id',
            'date' => 'required|date|after_or_equal:today',
            'time_slot' => 'required|string',
            'is_virtual' => 'boolean',
            'notes' => 'nullable|string|max:500',
        ]);
        
        // Parse the time slot
        list($startTime, $endTime) = explode(' - ', $request->time_slot);
        $startTime = Carbon::createFromFormat('g:i A', $startTime)->format('H:i:s');
        $endTime = Carbon::createFromFormat('g:i A', $endTime)->format('H:i:s');
        
        // Check if the time slot is still available
        $isSlotAvailable = Appointment::where('doctor_id', $request->doctor_id)
            ->where('date', $request->date)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->where(function ($q) use ($startTime, $endTime) {
                    $q->where('start_time', '<=', $startTime)
                      ->where('end_time', '>', $startTime);
                })->orWhere(function ($q) use ($startTime, $endTime) {
                    $q->where('start_time', '<', $endTime)
                      ->where('end_time', '>=', $endTime);
                })->orWhere(function ($q) use ($startTime, $endTime) {
                    $q->where('start_time', '>=', $startTime)
                      ->where('end_time', '<=', $endTime);
                });
            })
            ->where('status', '!=', 'cancelled')
            ->doesntExist();
        
        if (!$isSlotAvailable) {
            return back()->withErrors(['time_slot' => 'This time slot is no longer available. Please select another time.'])->withInput();
        }
        
        try {
            DB::beginTransaction();
            
            // Create the appointment
            $appointment = new Appointment([
                'patient_id' => $patient->id,
                'doctor_id' => $request->doctor_id,
                'appointment_type_id' => $request->appointment_type_id,
                'date' => $request->date,
                'start_time' => $startTime,
                'end_time' => $endTime,
                'status' => 'pending',
                'is_virtual' => $request->has('is_virtual'),
                'notes' => $request->notes,
            ]);
            
            $appointment->save();
            
            DB::commit();
            
            return redirect()->route('appointments.index')
                ->with('success', 'Appointment scheduled successfully! We will notify you once it is confirmed.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()->withErrors(['error' => 'An error occurred while scheduling your appointment. Please try again.'])->withInput();
        }
    }

    /**
     * Display the specified appointment.
     */
    public function show(Appointment $appointment)
    {
        $this->authorize('view', $appointment);
        
        return view('appointments.show', [
            'appointment' => $appointment,
        ]);
    }

    /**
     * Cancel the specified appointment.
     */
    public function cancel(Request $request, Appointment $appointment)
    {
        $this->authorize('cancel', $appointment);
        
        $request->validate([
            'cancellation_reason' => 'nullable|string|max:500',
        ]);
        
        $appointment->status = 'cancelled';
        $appointment->cancellation_reason = $request->cancellation_reason;
        $appointment->save();
        
        return redirect()->route('appointments.index')
            ->with('success', 'Appointment cancelled successfully.');
    }

    /**
     * Reschedule the specified appointment.
     */
    public function reschedule(Request $request, Appointment $appointment)
    {
        $this->authorize('update', $appointment);
        
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time_slot' => 'required|string',
        ]);
        
        // Parse the time slot
        list($startTime, $endTime) = explode(' - ', $request->time_slot);
        $startTime = Carbon::createFromFormat('g:i A', $startTime)->format('H:i:s');
        $endTime = Carbon::createFromFormat('g:i A', $endTime)->format('H:i:s');
        
        // Check if the time slot is still available
        $isSlotAvailable = Appointment::where('doctor_id', $appointment->doctor_id)
            ->where('date', $request->date)
            ->where('id', '!=', $appointment->id)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->where(function ($q) use ($startTime, $endTime) {
                    $q->where('start_time', '<=', $startTime)
                      ->where('end_time', '>', $startTime);
                })->orWhere(function ($q) use ($startTime, $endTime) {
                    $q->where('start_time', '<', $endTime)
                      ->where('end_time', '>=', $endTime);
                })->orWhere(function ($q) use ($startTime, $endTime) {
                    $q->where('start_time', '>=', $startTime)
                      ->where('end_time', '<=', $endTime);
                });
            })
            ->where('status', '!=', 'cancelled')
            ->doesntExist();
        
        if (!$isSlotAvailable) {
            return back()->withErrors(['time_slot' => 'This time slot is no longer available. Please select another time.'])->withInput();
        }
        
        $appointment->date = $request->date;
        $appointment->start_time = $startTime;
        $appointment->end_time = $endTime;
        $appointment->status = 'pending';
        $appointment->save();
        
        return redirect()->route('appointments.index')
            ->with('success', 'Appointment rescheduled successfully! We will notify you once it is confirmed.');
    }
}