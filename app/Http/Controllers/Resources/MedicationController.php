<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resources\Medication\CreateMedicationMasterRequest;
use App\Models\Resources\Medications\Medication;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MedicationController extends Controller
{
    public function index()
    {
        return Inertia::render('medication/Index', [
            'medications' => Medication::paginate(10)
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
