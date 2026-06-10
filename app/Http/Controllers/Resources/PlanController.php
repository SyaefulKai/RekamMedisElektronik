<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resources\Encounter\CreatePlanRequest;
use App\Models\Resources\Encounter;
use App\Models\Resources\Medications\MedicationMovement;
use App\Models\Resources\Plans\PlanMedication;
use App\Models\Resources\Plans\PlanProcedure;
use App\Services\EncounterService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PlanController extends Controller
{
    public function store(
        Encounter $encounter,
        CreatePlanRequest $request,
        EncounterService $service
    )
    {
        $data = $request->validated();
        $service->storePlan($encounter, $data);
        return redirect()->back();
    }

    public function destroy(
        Encounter $encounter,
        string $type,
        string $item
    )
    {
        $model = match ($type) {
            'medications' => PlanMedication::findOrFail($item),
            'procedures'  => PlanProcedure::findOrFail($item),
            default       => abort(404, 'Tipe item tidak dikenal.'),
        };

        // Restore stock if deleting a medication
        if ($type === 'medications' && $model->medication_stock_id) {
            $stock = $model->medicationStock;
            if ($stock) {
                $quantityBefore = $stock->quantity;
                $stock->increment('quantity', $model->quantity);
                $stock->refresh();
                $quantityAfter = $stock->quantity;

                MedicationMovement::create([
                    'medication_stock_id' => $stock->id,
                    'type' => 'in',
                    'quantity' => $model->quantity,
                    'quantity_before' => $quantityBefore,
                    'quantity_after' => $quantityAfter,
                    'note' => 'Pembatalan rencana terapi (encounter)',
                    'moved_at' => now(),
                ]);
            }
        }

        $model->delete();

        Inertia::flash('success', 'Item berhasil dihapus dari rencana.');
        return redirect()->back();
    }
}
