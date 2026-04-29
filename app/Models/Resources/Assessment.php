<?php

namespace App\Models\Resources;

use App\Models\Icd10;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{

    protected $fillable = [
        'encounter_id',
        'icd10'
    ];

    public function encounter()
    {
        return $this->belongsTo(Encounter::class);
    }

    public function icd10s()
    {
        return $this->belongsToMany(Icd10::class, 'assessment_diagnoses', 'assessment_id', 'icd10_id');
    }
}
