<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resources\Encounter\CreatePlanRequest;
use App\Models\Resources\Encounter;
use App\Services\EncounterService;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function store(
        Encounter $encounter,
        CreatePlanRequest $request,
        EncounterService $service
    )
    {
        $data = $request->validated();
        $service->storePlan($encounter, $data);
        return redirect()->back();
    }
}
