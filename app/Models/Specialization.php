<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    use HasFactory;

    protected $fillable = [
        'specialization_name', 
        'department_id',
        'description',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function appointmentTypes()
    {
        return $this->belongsToMany(AppointmentType::class);
    }

}
