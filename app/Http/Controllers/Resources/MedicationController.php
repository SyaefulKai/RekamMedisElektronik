<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resources\Medication\CreateMedicationMasterRequest;
use App\Models\Resources\Medications\Medication;
use App\Queries\Resources\MedicationQueryBuilder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MedicationController extends Controller
{
    public function index(
        MedicationQueryBuilder $query
    )
    {
        return Inertia::render('medication/Index', [
            'medications' => $query->search(withSum: true)
        ]);
    }

    public function store(
        CreateMedicationMasterRequest $request
    )
    {
        $data = $request->validated();
        Medication::create($data);
        Inertia::flash('medicationCreated', 'Data master obat berhasil dibuat.');
        return to_route('medication.index');
    }

}
