<?php

namespace App\Policies;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PatientPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Patient $patient): bool
    {
        // User can view their own patient profile
        if ($user->patient && $user->patient->id === $patient->id) {
            return true;
        }
        
        // Admin can view any patient
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // User with role 'patient' can create a patient profile if they don't have one
        if ($user->role === 'patient' && !$user->patient) {
            return true;
        }
        
        // Admin can create patient profiles
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Patient $patient): bool
    {
        // User can update their own patient profile
        if ($user->patient && $user->patient->id === $patient->id) {
            return true;
        }
        
        // Admin can update any patient
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Patient $patient): bool
    {
        // Only admin can delete patient profiles
        return $user->role === 'admin';
    }
}