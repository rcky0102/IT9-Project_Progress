<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class Appointment extends Model
{
    protected $fillable = [
        'patient_id',
        'appointment_type_id',
        'doctor_id',
        'appointment_date',
        'appointment_time',
        'appointment_end_time',
        'reason',
        'notes',
        'status',
    ];

    protected $dates = ['appointment_date', 'appointment_time', 'appointment_end_time'];

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
        static::updated(function ($appointment) {
            // Only proceed if status changed and is now "confirmed"
            if ($appointment->isDirty('status') && strtolower($appointment->status) === 'confirmed') {

                // Log status change
                Log::info("Appointment #{$appointment->id} updated to confirmed");

                // Prevent duplicate invoices
                if (!$appointment->invoice) {
                    $appointment->loadMissing('appointmentType', 'doctor', 'patient');

                    $charge = $appointment->appointmentType->charge ?? 0;
                    $invoiceNumber = 'INV-' . str_pad($appointment->id, 6, '0', STR_PAD_LEFT);

                    // Create invoice
                    $appointment->invoice()->create([
                        'invoice_number' => $invoiceNumber,
                        'total_amount' => $charge,
                        'status' => 'unpaid',
                        'due_date' => now()->addDays(7),
                    ]);

                    // Generate system message
                    $doctorName = $appointment->doctor->full_name ?? 'Doctor';
                    $patientName = $appointment->patient->full_name ?? 'Patient';
                    $date = Carbon::parse($appointment->appointment_date)->format('F d, Y');
                    $time = Carbon::parse($appointment->appointment_time)->format('h:i A');

                    $subject = 'New Appointment Confirmed';
                    $content = "Hello Dr. {$doctorName},\n\n"
                             . "You have a confirmed appointment with {$patientName} on {$date} at {$time}.\n"
                             . "Reason: {$appointment->reason}";

                    $appointment->messages()->create([
                        'subject' => $subject,
                        'content' => $content,
                        'sender_type' => 'system',
                    ]);
                }
            }
        });
    }
}
