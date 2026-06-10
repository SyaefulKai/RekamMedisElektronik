<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resources\Medication\AddMedicationStock;
use App\Models\Resources\Medications\Medication;
use App\Models\Resources\Medications\MedicationStock;
use App\Queries\Resources\MedicationQueryBuilder;
use App\Services\MedicationService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MedicationStockController extends Controller
{
    public function create(
        MedicationQueryBuilder $query
    )
    {
        return Inertia::render('medication/StockCreate', [
            'medications' => $query->paginate(10),
        ]);
    }

    public function bulkStore(
        AddMedicationStock $request,
        MedicationService $service
    )
    {
        $data = $request->validated();
        $medications = $data['medications'] ?? [];
        $service->addBulkMedicationStock($medications);
        Inertia::flash('medicationStockCreated', 'Stok obat berhasil ditambah.');
        return to_route('medication.stock.create');
    }
}
