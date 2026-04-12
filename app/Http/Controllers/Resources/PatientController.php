<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Models\Resources\Patient;
use App\Queries\Resources\PatientQueryBuilder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PatientController extends Controller
{
    public function index(PatientQueryBuilder $query)
    {
        return Inertia::render('patient/Index', [
            'patients' => $query->paginate(10),
        ]);
    }
}
