<?php

namespace App\Services;

use App\Http\Requests\Resources\Encounter\CreateSubjectiveRequest;
use App\Models\Resources\Assessments\Assessment;
use App\Models\Resources\Encounter;
use App\Models\Resources\Objective;
use App\Models\Resources\Subjective;

class EncounterService
{
    public function storeSubjective(Encounter $encounter, array $data): Subjective
    {
        return Subjective::updateOrCreate(
            ['encounter_id' => $encounter->id],
            $data
        );
    }

    public function storeObjective(Encounter $encounter, array $data): Objective
    {
        return Objective::updateOrCreate(
            ['encounter_id' => $encounter->id],
            $data
        );
    }

    public function storeAssessment(Encounter $encounter, array $data): Assessment
    {
        $assessment = Assessment::updateOrCreate(
            ['encounter_id' => $encounter->id],
            $data
        );

        $this->storeAssessmentDiagnosis($assessment, $data['diagnoses']);
        return $assessment;
    }

    public function storeAssessmentDiagnosis(Assessment $assessment, array $data)
    {
        foreach ($data as $diagnosis) {
            $assessment->assessmentDiagnoses()->create([
                'diagnosis_role' => $diagnosis['diagnosis_role'],
                'diagnosis_status' => $diagnosis['diagnosis_status'],
                'code' => $diagnosis['code'],
                'system' => $diagnosis['system'],
                'display' => $diagnosis['display'],
            ]);
        }
    }
}
