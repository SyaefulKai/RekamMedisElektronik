<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Resources\Encounter;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReportController extends Controller
{
    public function index()
    {
        return Inertia::render('report/Index');
    }

    public function generatePdf(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = Carbon::parse($request->start_date)->startOfDay();
        $endDate = Carbon::parse($request->end_date)->endOfDay();

        $encounters = Encounter::with([
            'patient',
            'practitioner.user',
            'subjective',
            'assessment.assessmentDiagnoses',
            'objective',
            'plan',
        ])
            ->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date')
            ->orderBy('created_at')
            ->get();

        $totalPatients = $encounters->pluck('patient_id')->unique()->count();

        $pdf = Pdf::loadView('pdfs.report', [
            'encounters' => $encounters,
            'startDate' => Carbon::parse($request->start_date)->format('d M Y'),
            'endDate' => Carbon::parse($request->end_date)->format('d M Y'),
            'totalPatients' => $totalPatients,
            'generatedAt' => Carbon::now()->format('d M Y H:i:s'),
        ]);

        return $pdf->download('laporan-kunjungan-pasien-' . $request->start_date . '-sampai-' . $request->end_date . '.pdf');
    }
}
