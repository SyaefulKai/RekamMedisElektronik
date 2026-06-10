<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Subjective extends Model
{
    protected $fillable = [
        'encounter_id',
        'chief_complaint',
        'history_of_present_illness',
        'past_medical_history',
        'family_medical_history',
        'allergies',
    ];

    public function encounter()
    {
        return $this->belongsTo(Encounter::class);
    }

    public function allergies(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value),
            set: fn($value) => json_encode($value),
        );
    }
}
