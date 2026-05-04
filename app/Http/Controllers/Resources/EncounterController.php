<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resources\Encounter\CreateEncounterRequest;
use App\Models\Resources\Encounter;
use App\Queries\Icd9QueryBuilder;
use App\Queries\Resources\ProcedureQueryBuilder;
use App\Services\Diagnosis\DiagnosisSearchService;
use Inertia\Inertia;

class EncounterController extends Controller
{
    public function index(
        Encounter $encounter,
        DiagnosisSearchService $diagnosis_search,
        ProcedureQueryBuilder $procedure
    ) {
        return Inertia::render('encounter/Index', [
            'encounter' => $encounter->load([
                'patient',
                'subjective',
                'objective',
                'assessment.assessmentDiagnoses',
                'plan.procedures'
            ]),
            'diagnosis_codes' => $diagnosis_search->search(10),
            'procedures' => $procedure->get(),
        ]);
    }

    public function store(CreateEncounterRequest $request)
    {
        $this->authorize('create', Encounter::class);
        $data = $request->validated();
        $encounter = Encounter::create([
            ...$data,
            'date' => now()
        ]);
        return redirect()->to(route('encounter.index', [
            'encounter' => $encounter->uuid
        ]));
    }
}
