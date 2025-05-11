<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Field;
use App\Models\Specialization;

class RecordType extends Model
{
    protected $fillable = ['name'];

    // Define the many-to-many relationship
    public function specializations()
    {
        return $this->belongsToMany(Specialization::class, 'record_type_specialization', 'record_type_id', 'specialization_id');
    }

    // Define the relationship with fields (if any)
    public function fields()
    {
        return $this->hasMany(Field::class); // Assuming you have a Field model
    }
}
