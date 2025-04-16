<?php

namespace App\Policies;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AppointmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the appointment.
     */
    public function view(User $user, Appointment $appointment): bool
    {
        // Patient can view their own appointments
        if ($user->patient && $user->patient->id === $appointment->patient_id) {
            return true;
        }
        
        // Doctor can view appointments assigned to them
        if ($user->doctor && $user->doctor->id === $appointment->doctor_id) {
            return true;
        }
        
        // Admin can view all appointments
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can update the appointment.
     */
    public function update(User $user, Appointment $appointment): bool
    {
        // Patient can update their own pending or confirmed appointments that haven't passed
        if ($user->patient && $user->patient->id === $appointment->patient_id) {
            return in_array($appointment->status, ['pending', 'confirmed']) &&
                   $appointment->date >= now()->format('Y-m-d');
        }
        
        // Admin can update any appointment
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can cancel the appointment.
     */
    public function cancel(User $user, Appointment $appointment): bool
    {
        // Patient can cancel their own pending or confirmed appointments that haven't passed
        if ($user->patient && $user->patient->id === $appointment->patient_id) {
            return in_array($appointment->status, ['pending', 'confirmed']) &&
                   $appointment->date >= now()->format('Y-m-d');
        }
        
        // Doctor can cancel appointments assigned to them
        if ($user->doctor && $user->doctor->id === $appointment->doctor_id) {
            return in_array($appointment->status, ['pending', 'confirmed']) &&
                   $appointment->date >= now()->format('Y-m-d');
        }
        
        // Admin can cancel any appointment
        return $user->role === 'admin';
    }
}