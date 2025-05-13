<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = ['user_id', 'specialization_id']; 

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class); 
    }

    // Add appointments relationship
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    // Add a fullName method to get the doctor's full name
    public function getFullNameAttribute()
    {
        return $this->user->first_name . ' ' . $this->user->middle_name . ' ' . $this->user->last_name;
    }

    // Optionally get all messages via appointments
    public function messages()
    {
        return $this->hasManyThrough(Message::class, Appointment::class);
    }
    public function availabilities()
    {
        return $this->hasMany(Availability::class);
    }
}



