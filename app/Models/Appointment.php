<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'appointment_type',
        'doctor',
        'appointment_date',
        'appointment_time',
        'reason',
        'notes',
    ];
    
}
