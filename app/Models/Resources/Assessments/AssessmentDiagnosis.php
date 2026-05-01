<?php

namespace App\Models\Resources\Assessments;

use App\Enums\DiagnosisRole;
use App\Enums\DiagnosisStatus;
use App\Models\Resources\Assessments\Assessment;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class AssessmentDiagnosis extends Model
{
    protected $fillable = [
        'diagnosis_role',
        'diagnosis_status',
        'code',
        'system',
        'display'
    ];

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }

    public function diagnosisRole(): Attribute
    {
        return Attribute::make(
            get: fn($value) => DiagnosisRole::from($value)->label()
        );
    }

    public function diagnosisStatus(): Attribute
    {
        return Attribute::make(
            get: fn($value) => DiagnosisStatus::from($value)->label()
        );
    }
}
