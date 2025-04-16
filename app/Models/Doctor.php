<?php
// app/Models/Doctor.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'specialty',
        'email',
        'phone',
        'bio',
        'avatar',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the user that owns the doctor.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the doctor's full name.
     */
    public function getFullNameAttribute(): string
    {
        return "Dr. {$this->first_name} {$this->last_name}";
    }

    /**
     * Get the appointments for the doctor.
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Get the schedules for the doctor.
     */
    public function schedules(): HasMany
    {
        return $this->hasMany(DoctorSchedule::class);
    }

    /**
     * Get available time slots for a specific date.
     */
    public function getAvailableTimeSlots(string $date): array
    {
        $dayOfWeek = strtolower(date('l', strtotime($date)));
        
        // Get the doctor's schedule for the day
        $schedule = $this->schedules()
            ->where('day_of_week', $dayOfWeek)
            ->where('is_available', true)
            ->first();
        
        if (!$schedule) {
            return [];
        }
        
        // Get all appointments for the doctor on the given date
        $appointments = $this->appointments()
            ->where('date', $date)
            ->where('status', '!=', 'cancelled')
            ->get();
        
        // Generate time slots (30-minute intervals)
        $startTime = strtotime($schedule->start_time);
        $endTime = strtotime($schedule->end_time);
        $interval = 30 * 60; // 30 minutes in seconds
        
        $timeSlots = [];
        
        for ($time = $startTime; $time < $endTime; $time += $interval) {
            $slotStart = date('H:i', $time);
            $slotEnd = date('H:i', $time + $interval);
            
            // Check if the time slot is already booked
            $isBooked = $appointments->filter(function ($appointment) use ($slotStart, $slotEnd) {
                $appointmentStart = $appointment->start_time;
                $appointmentEnd = $appointment->end_time;
                
                return ($slotStart >= $appointmentStart && $slotStart < $appointmentEnd) ||
                       ($slotEnd > $appointmentStart && $slotEnd <= $appointmentEnd) ||
                       ($slotStart <= $appointmentStart && $slotEnd >= $appointmentEnd);
            })->count() > 0;
            
            if (!$isBooked) {
                $timeSlots[] = [
                    'start' => $slotStart,
                    'end' => $slotEnd,
                    'formatted' => date('g:i A', $time) . ' - ' . date('g:i A', $time + $interval),
                ];
            }
        }
        
        return $timeSlots;
    }
}