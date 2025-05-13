<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecordType extends Model
{
    protected $fillable = ['name', 'charge','custom_fields'];
    protected $casts = [
        'custom_fields' => 'array',
    ];
}
