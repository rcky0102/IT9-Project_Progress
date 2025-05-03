<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'birthdate',
        'gender',
        'contact_number',
        'address',
        'medical_history',
    ];

    /**
     * Get the user that owns the patient record.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the appointments for the patient.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }

    /**
     * Accessor for the patient's full name.
     */
    public function getFullNameAttribute()
    {
        return $this->user->first_name . ' ' . $this->user->middle_name . ' ' . $this->user->last_name;
    }
}
