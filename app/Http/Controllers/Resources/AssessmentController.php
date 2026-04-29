<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resources\Encounter\CreateAssessmentRequest;
use App\Models\Resources\Encounter;
use App\Services\EncounterService;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function store(
        Encounter $encounter,
        CreateAssessmentRequest $request,
        EncounterService $service
    ) {
        $data = $request->validated();
        $service->storeAssessment($encounter, $data);
        return redirect()->back();
    }
}
