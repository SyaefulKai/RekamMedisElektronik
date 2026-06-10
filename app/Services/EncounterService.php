<?php

namespace App\Services;

use App\Models\Resources\Assessments\Assessment;
use App\Models\Resources\Encounter;
use App\Models\Resources\Objective;
use App\Models\Resources\Plans\Plan;
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

    public function storePlan(Encounter $encounter, array $data): Plan
    {
        $plan = Plan::updateOrCreate(
            ['encounter_id' => $encounter->id],
            $data
        );

        if (isset($data['procedures'])) {
            $this->storeProcedure($plan, $data['procedures']);
        }

        if (isset($data['medications'])) {
            $this->storeMedication($plan, $data['medications']);
        }

        return $plan;
    }

    public function storeProcedure(Plan $plan, array $data)
    {
        foreach ($data as $procedure) {
            $plan->procedures()->create([
                'code' => $procedure['code'],
                'system' => $procedure['system'],
                'display' => $procedure['display'],
                'name' => $procedure['name'],
            ]);
        }
    }

    public function storeMedication(Plan $plan, array $data)
    {
        foreach ($data as $medication) {
            $plan->medications()->create([
                'medication_id' => $medication['medication_id'],
                'dose' => $medication['dose'] ?? null,
                'frequency_per_day' => $medication['frequency_per_day'] ?? null,
                'duration_days' => $medication['duration_days'] ?? null,
                'quantity' => $medication['quantity'],
                'instruction' => $medication['instruction'] ?? null,
            ]);
        }
    }
}
