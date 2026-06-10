<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Queue;
use App\Models\Resources\Medications\Medication;
use App\Models\Resources\Patient;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // Pasien datang hari ini (antrian hari ini)
        $patientsToday = Queue::whereDate('date', $today)
            ->with([
                'patient',
                'practitioner.user',
                'encounter',
            ])
            ->orderBy('queue_number')
            ->get()
            ->map(fn($q) => [
                'id'             => $q->id,
                'queue_number'   => $q->queue_number,
                'patient_name'   => $q->patient->name,
                'patient_id'     => $q->patient->id,
                'practitioner_user_id' => $q->practitioner?->user?->id,
                'encounter_uuid' => $q->encounter?->uuid,
                'status'         => $q->status,
            ]);

        $patientsTodayCount = $patientsToday->count();

        // Stok obat yang menipis (master medication, total per batch <= 10)
        $lowStockMedications = Medication::where('is_active', true)
            ->whereHas('stocks', fn($q) => $q->where('quantity', '<=', 50))
            ->withSum('stocks as total_quantity', 'quantity')
            ->get()
            ->filter(fn($med) => $med->total_quantity <= 50 )
            ->values()
            ->map(fn($med) => [
                'id'            => $med->id,
                'generic_name'  => $med->generic_name,
                'trade_name'    => $med->trade_name,
                'total_quantity' => (int) $med->total_quantity,
                'unit'          => $med->unit,
            ]);

        // Total pasien terdaftar
        $totalPatients = Patient::count();

        // Total antrian hari ini berdasarkan status
        $queueStatusCounts = Queue::whereDate('date', $today)
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        return Inertia::render('Dashboard', [
            'patientsToday'       => $patientsToday,
            'patientsTodayCount'  => $patientsTodayCount,
            'lowStockMedications' => $lowStockMedications,
            'totalPatients'       => $totalPatients,
            'queueStatusCounts'   => $queueStatusCounts,
        ]);
    }
}
