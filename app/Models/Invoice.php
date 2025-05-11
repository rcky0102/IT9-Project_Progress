<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    protected $dates = ['due_date', 'issued_at'];
    
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }


}
