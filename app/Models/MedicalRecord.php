<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    protected $fillable = [
        'appointment_id',
        'record_type_id',
        'date',
        'diagnosis',
        'blood_pressure',
        'temperature',
        'heart_rate',
        'respiratory_rate',
        'notes',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function recordType()
    {
        return $this->belongsTo(RecordType::class);
    }
}
