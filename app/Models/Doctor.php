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

    // Add a fullName method to get the doctor's full name
    public function getFullNameAttribute()
    {
        // Assuming 'user' relationship is loaded, access the user's name
        return $this->user->first_name . ' ' . $this->user->middle_name . ' ' . $this->user->last_name;
    }
}



