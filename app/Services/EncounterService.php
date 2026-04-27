<?php

namespace App\Services;

use App\Http\Requests\Resources\Encounter\CreateSubjectiveRequest;
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
}
