<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MedicalRecord extends Model
{
    use HasFactory;

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

    public function invoice()
    {
        return $this->morphOne(Invoice::class, 'billable');
    }

    protected static function booted()
    {
        static::created(function ($record) {
            // Fetch charge from associated record type
            $charge = $record->recordType?->charge ?? 0;

            // Generate invoice number specific to medical record
            $invoiceNumber = 'MED-' . str_pad($record->id, 6, '0', STR_PAD_LEFT);

            // Create invoice
            $record->invoice()->create([
                'invoice_number' => $invoiceNumber,
                'total_amount' => $charge,
                'status' => 'unpaid',
                'due_date' => now()->addDays(7),
            ]);
        });
    }
}
