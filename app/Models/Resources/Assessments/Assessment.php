<?php

namespace App\Models\Resources\Assessments;

use App\Models\Resources\Assessments\AssessmentDiagnosis;
use App\Models\Resources\Encounter;
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

    public function assessmentDiagnoses()
    {
        return $this->hasMany(AssessmentDiagnosis::class);
    }
}
