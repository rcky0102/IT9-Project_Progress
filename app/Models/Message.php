<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'appointment_id',
        'subject',
        'content',
        'sender_type',
        'unread'
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
