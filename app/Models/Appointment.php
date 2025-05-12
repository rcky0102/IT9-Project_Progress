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
        // Automatically create an invoice when an appointment is created
        static::created(function ($appointment) {
            $appointment->loadMissing('appointmentType', 'doctor');  // Eager load the necessary relationships

            // Retrieve the charge for the appointment type (if any)
            $charge = $appointment->appointmentType->charge ?? 0;
            $invoiceNumber = 'INV-' . str_pad($appointment->id, 6, '0', STR_PAD_LEFT);

            // Create an invoice
            $appointment->invoice()->create([
                'invoice_number' => $invoiceNumber,
                'total_amount' => $charge,
                'status' => 'unpaid',
                'due_date' => now()->addDays(7),
            ]);

            // Auto-generate message to doctor
            $doctorName = $appointment->doctor->full_name ?? 'Doctor';
            $patientName = $appointment->patient->full_name ?? 'Patient';
            $date = Carbon::parse($appointment->appointment_date)->format('F d, Y');
            $time = Carbon::parse($appointment->appointment_time)->format('h:i A');

            $subject = 'New Appointment Scheduled';
            $content = "Hello Dr. {$doctorName},\n\n"
                . "You have a new appointment with {$patientName} on {$date} at {$time}.\n"
                . "Reason: {$appointment->reason}";

            // Create a system message to the doctor
            $appointment->messages()->create([
                'subject' => $subject,
                'content' => $content,
                'sender_type' => 'system',
            ]);
        });
    }
}
