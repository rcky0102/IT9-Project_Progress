<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AppointmentType extends Model
{
    use HasFactory;

    // Optional: Specify fillable fields if using mass assignment
    protected $fillable = [
        'name',
    ];

    /**
     * The specializations that belong to the appointment type.
     */
    public function specializations()
    {
        return $this->belongsToMany(Specialization::class, 'appointment_type_specialization');
    }
}
