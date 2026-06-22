<?php

namespace App\Http\Controllers\Resources;

use App\Enums\EncounterStatus;
use App\Enums\QueueStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Resources\Encounter\CreateEncounterRequest;
use App\Models\Resources\Encounter;
use App\Queries\Icd9QueryBuilder;
use App\Queries\Resources\MedicationQueryBuilder;
use App\Queries\Resources\ProcedureQueryBuilder;
use App\Services\Diagnosis\DiagnosisSearchService;
use Inertia\Inertia;

class EncounterController extends Controller
{
    public function show(Encounter $encounter)
    {
        return Inertia::render('encounter/Show', [
            'encounter' => $encounter->load([
                'patient',
                'practitioner.user',
                'subjective',
                'objective',
                'assessment.assessmentDiagnoses',
                'plan.procedures',
                'plan.medications.medication',
            ]),
        ]);
    }

    public function index(
        Encounter $encounter,
        DiagnosisSearchService $diagnosis_search,
        ProcedureQueryBuilder $procedure,
        MedicationQueryBuilder $medication
    ) {
        return Inertia::render('encounter/Index', [
            'encounter' => $encounter->load([
                'patient',
                'subjective',
                'objective',
                'assessment.assessmentDiagnoses',
                'plan.procedures',
                'plan.medications.medication',
            ]),
            'diagnosis_codes' => $diagnosis_search->search(10),
            'procedures' => $procedure->get(),
            'medications' => $medication->paginate(10),
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

    public function finish(Encounter $encounter)
    {
        $encounter->update([
            'status' => EncounterStatus::Finished,
        ]);

        $encounter->queue()->update([
            'status' => QueueStatus::Finished,
        ]);

        return redirect()->to(route('dashboard'));
    }
}
