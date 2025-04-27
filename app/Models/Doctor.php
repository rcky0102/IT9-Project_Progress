<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = ['user_id', 'specialization'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

