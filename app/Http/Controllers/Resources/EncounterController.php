<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resources\Encounter\CreateEncounterRequest;
use App\Models\Icd10;
use App\Models\Resources\Encounter;
use App\Queries\Icd10QueryBuilder;
use Inertia\Inertia;

class EncounterController extends Controller
{
    public function index(
        Encounter $encounter,
        Icd10QueryBuilder $icd10,
    ) {
        return Inertia::render('encounter/Index', [
            'encounter' => $encounter->load([
                'patient',
                'subjective',
                'objective',
                'assessment.icd10s'
            ]),
            'icd10s' => $icd10->paginate(10),
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
