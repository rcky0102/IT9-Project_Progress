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

    public function invoice()
    {
        return $this->morphOne(Invoice::class, 'billable');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }

    protected static function booted()
    {
        static::created(function ($appointment) {
            // Eager-load appointmentType if not already loaded
            $appointment->loadMissing('appointmentType');

            $charge = $appointment->appointmentType->charge ?? 0;

            $invoiceNumber = 'INV-' . str_pad($appointment->id, 6, '0', STR_PAD_LEFT);

            $appointment->invoice()->create([
                'invoice_number' => $invoiceNumber,
                'total_amount' => $charge,
                'status' => 'unpaid',
                'due_date' => now()->addDays(7),
            ]);
        });
    }
}
