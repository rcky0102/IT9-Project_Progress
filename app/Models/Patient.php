<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }

    public function getFullNameAttribute()
    {
        return $this->user->first_name . ' ' . $this->user->middle_name . ' ' . $this->user->last_name;
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->birthdate)->age;
    }
}
