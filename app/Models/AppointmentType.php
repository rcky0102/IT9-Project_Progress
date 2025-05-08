<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AppointmentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'charge', 
    ];

    public function specializations()
    {
        return $this->belongsToMany(Specialization::class, 'appointment_type_specialization');
    }
}
