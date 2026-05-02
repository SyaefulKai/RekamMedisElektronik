<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Models\Resources\Assessments\AssessmentDiagnosis;
use App\Models\Resources\Encounter;
use Inertia\Inertia;

class AssessmentDiagnosisController extends Controller
{
    public function delete(
        Encounter $encounter,
        AssessmentDiagnosis $diagnosis
    )
    {
        $diagnosis->delete();
        Inertia::flash('diagnosisDeleted', 'Diagnosa berhasil dihapus.');
        return redirect()->back();
    }
}
