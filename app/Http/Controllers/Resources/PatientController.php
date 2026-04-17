<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resources\Patient\CreatePatientRequest;
use App\Http\Requests\Resources\Patient\UpdatePatientRequest;
use App\Models\Resources\Patient;
use App\Queries\Resources\PatientQueryBuilder;
use Illuminate\Support\Str;
use Inertia\Inertia;

class PatientController extends Controller
{
    public function index(PatientQueryBuilder $query)
    {
        return Inertia::render('patient/Index', [
            'patients' => $query->paginate(10),
        ]);
    }

    public function create()
    {
        return Inertia::render('patient/Create', [
            'medical_record_number' => Str::padLeft(Patient::count() + 1, 6, '000000'),
        ]);
    }

    public function store(CreatePatientRequest $request)
    {
        $data = $request->validated();
        Patient::create($data);
        return redirect()->to(route('patient.index'));
    }

    public function edit(Patient $patient)
    {
        return Inertia::render('patient/Edit', [
            'patient' => $patient->makeVisible('nik'),
        ]);
    }

    public function update(Patient $patient, UpdatePatientRequest $request)
    {
        $data = $request->validated();
        $patient->update($data);
        return redirect()->to(route('patient.index'));
    }
}
