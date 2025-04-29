<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Appointment extends Model
{
    protected $fillable = [
        'user_id',        
        'appointment_type',
        'doctor',
        'appointment_date',
        'appointment_time',
        'reason',
        'notes',
    ];

    protected $dates = ['appointment_date', 'appointment_time'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

