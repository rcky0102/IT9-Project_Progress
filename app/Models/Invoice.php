<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'appointment_id',
        'invoice_number',
        'total_amount',
        'status',
        'issued_at',
        'due_date',
        'notes',
        'payment_method',
    ];
    
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

}
