<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Appointment extends Model
{
    protected $fillable = [
        'patient_id',             
        'appointment_type_id',   
        'doctor_id',             
        'appointment_date',
        'appointment_time',
        'reason',
        'notes',
        'status',
    ];

    protected $dates = ['appointment_date', 'appointment_time'];

    // This replaces the previous user() relation
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function appointmentType()
    {
        return $this->belongsTo(AppointmentType::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
