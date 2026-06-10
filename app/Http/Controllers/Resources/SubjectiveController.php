<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resources\Encounter\CreateSubjectiveRequest;
use App\Models\Resources\Encounter;
use App\Models\Resources\Subjective;
use App\Services\EncounterService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubjectiveController extends Controller
{
    public function store(
        Encounter $encounter,
        CreateSubjectiveRequest $request,
        EncounterService $service
    ) {
        $this->authorize('update', $encounter);
        $data = $request->validated();
        $service->storeSubjective($encounter, $data);
        Inertia::flash('subjectiveCreated', 'Data subjektif berhasil disimpan.');
        return redirect()->back();
    }
}
