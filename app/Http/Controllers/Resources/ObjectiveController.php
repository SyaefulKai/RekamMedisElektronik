<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resources\Encounter\CreateObjectiveRequest;
use App\Models\Resources\Encounter;
use App\Services\EncounterService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ObjectiveController extends Controller
{
    public function store(
        Encounter $encounter,
        CreateObjectiveRequest $request,
        EncounterService $service
    ) {
        $this->authorize('update', $encounter);
        $data = $request->validated();
        $service->storeObjective($encounter, $data);
        Inertia::flash('objectiveCreated', 'Data objective berhasil disimpan.');
        return redirect()->back();
    }
}
