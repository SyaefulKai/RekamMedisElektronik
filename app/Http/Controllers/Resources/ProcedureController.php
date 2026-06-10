<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resources\Procedure\CreateProcedureRequest;
use App\Models\Resources\Procedure;
use App\Queries\Icd9QueryBuilder;
use App\Queries\Resources\ProcedureQueryBuilder;
use Inertia\Inertia;

class ProcedureController extends Controller
{
    public function index(
        Icd9QueryBuilder $icd9,
        ProcedureQueryBuilder $procedure
    ) {
        $this->authorize('viewAny', Procedure::class);
        return Inertia::render('procedure/Index', [
            'codes' => $icd9->search(10),
            'procedures' => $procedure->paginate(10)
        ]);
    }

    public function create(
        Icd9QueryBuilder $icd9
    ) {
        $this->authorize('create', Procedure::class);
        return Inertia::render('procedure/Create', [
            'codes' => $icd9->search(10),
        ]);
    }

    public function store(
        CreateProcedureRequest $request
    ) {
        $data = $request->validated();
        Procedure::create($data);
        Inertia::flash('procedureCreated', 'Tindakan berhasil dibuat.');
        return to_route('procedure.index');
    }
}
