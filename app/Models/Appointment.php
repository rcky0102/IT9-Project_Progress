<?php
// app/Models/Appointment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'appointment_type_id',
        'date',
        'start_time',
        'end_time',
        'status',
        'is_virtual',
        'notes',
        'cancellation_reason',
    ];

    protected $casts = [
        'date' => 'date',
        'is_virtual' => 'boolean',
    ];

    /**
     * Get the patient that owns the appointment.
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Get the doctor that owns the appointment.
     */
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    /**
     * Get the appointment type that owns the appointment.
     */
    public function appointmentType(): BelongsTo
    {
        return $this->belongsTo(AppointmentType::class);
    }

    /**
     * Scope a query to only include upcoming appointments.
     */
    public function scopeUpcoming($query)
    {
        return $query->where('date', '>=', now()->format('Y-m-d'))
            ->where(function ($q) {
                $q->where('status', 'confirmed')
                  ->orWhere('status', 'pending');
            })
            ->orderBy('date')
            ->orderBy('start_time');
    }

    /**
     * Scope a query to only include past appointments.
     */
    public function scopePast($query)
    {
        return $query->where(function ($q) {
            $q->where('date', '<', now()->format('Y-m-d'))
              ->orWhere(function ($q2) {
                  $q2->where('date', '=', now()->format('Y-m-d'))
                     ->where('end_time', '<', now()->format('H:i:s'));
              });
        })
        ->orderBy('date', 'desc')
        ->orderBy('start_time', 'desc');
    }

    /**
     * Get the formatted date.
     */
    public function getFormattedDateAttribute(): string
    {
        return $this->date->format('M d, Y');
    }

    /**
     * Get the formatted start time.
     */
    public function getFormattedStartTimeAttribute(): string
    {
        return date('g:i A', strtotime($this->start_time));
    }

    /**
     * Get the formatted end time.
     */
    public function getFormattedEndTimeAttribute(): string
    {
        return date('g:i A', strtotime($this->end_time));
    }
}