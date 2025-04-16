<?php
// app/Models/AppointmentType.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AppointmentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'duration',
        'price',
        'is_active',
    ];

    protected $casts = [
        'duration' => 'integer',
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Get the appointments for the appointment type.
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}