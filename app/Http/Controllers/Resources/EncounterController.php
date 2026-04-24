<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resources\Encounter\CreateEncounterRequest;
use App\Models\Resources\Encounter;
use Inertia\Inertia;

class EncounterController extends Controller
{
    public function index(Encounter $encounter)
    {
        return Inertia::render('encounter/Index', [
            'encounter' => $encounter->load('patient'),
        ]);
    }

    public function store(CreateEncounterRequest $request)
    {
        $this->authorize('create', Encounter::class);
        $data = $request->validated();
        Encounter::create([
            ...$data,
            'date' => now()
        ]);
        return redirect()->to(route('encounter.index'));
    }
}
