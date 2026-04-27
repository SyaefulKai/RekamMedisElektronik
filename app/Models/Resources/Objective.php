<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    protected $fillable = [
        'encounter_id',
        'vital_signs',
        'physical_examination'
    ];

    public function encounter()
    {
        return $this->belongsTo(Encounter::class);
    }

    public function vitalSigns(): Attribute
    {
        return Attribute::make(
            set: fn($value) => json_encode($value),
            get: fn($value) => json_decode($value, true)
        );
    }
}
