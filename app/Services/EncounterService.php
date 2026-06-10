<?php

namespace App\Services;

use App\Models\Resources\Assessments\Assessment;
use App\Models\Resources\Encounter;
use App\Models\Resources\Medications\MedicationMovement;
use App\Models\Resources\Medications\MedicationStock;
use App\Models\Resources\Objective;
use App\Models\Resources\Plans\Plan;
use App\Models\Resources\Subjective;

class EncounterService
{
    public function storeSubjective(Encounter $encounter, array $data): Subjective
    {
        return Subjective::updateOrCreate(
            ['encounter_id' => $encounter->id],
            $data
        );
    }

    public function storeObjective(Encounter $encounter, array $data): Objective
    {
        return Objective::updateOrCreate(
            ['encounter_id' => $encounter->id],
            $data
        );
    }

    public function storeAssessment(Encounter $encounter, array $data): Assessment
    {
        $assessment = Assessment::updateOrCreate(
            ['encounter_id' => $encounter->id],
            $data
        );

        $this->storeAssessmentDiagnosis($assessment, $data['diagnoses']);
        return $assessment;
    }

    public function storeAssessmentDiagnosis(Assessment $assessment, array $data)
    {
        foreach ($data as $diagnosis) {
            $assessment->assessmentDiagnoses()->create([
                'diagnosis_role' => $diagnosis['diagnosis_role'],
                'diagnosis_status' => $diagnosis['diagnosis_status'],
                'code' => $diagnosis['code'],
                'system' => $diagnosis['system'],
                'display' => $diagnosis['display'],
            ]);
        }
    }

    public function storePlan(Encounter $encounter, array $data): Plan
    {
        $plan = Plan::updateOrCreate(
            ['encounter_id' => $encounter->id],
            $data
        );

        if (isset($data['procedures'])) {
            $this->storeProcedure($plan, $data['procedures']);
        }

        if (isset($data['medications'])) {
            $this->storeMedication($plan, $data['medications']);
        }

        return $plan;
    }

    public function storeProcedure(Plan $plan, array $data)
    {
        foreach ($data as $procedure) {
            $plan->procedures()->create([
                'code' => $procedure['code'],
                'system' => $procedure['system'],
                'display' => $procedure['display'],
                'name' => $procedure['name'],
            ]);
        }
    }

    public function storeMedication(Plan $plan, array $data)
    {
        foreach ($data as $medication) {
            $medicationId = $medication['medication_id'];
            $quantityNeeded = $medication['quantity'];

            // Find the earliest-expiring stock that has enough quantity
            $stock = MedicationStock::where('medication_id', $medicationId)
                ->where('quantity', '>=', $quantityNeeded)
                ->orderBy('expired_at', 'asc')
                ->orderBy('id', 'asc')
                ->first();

            if (!$stock) {
                // If no single batch has enough, try to use the sum of available stock
                $totalAvailable = MedicationStock::where('medication_id', $medicationId)
                    ->sum('quantity');

                if ($totalAvailable < $quantityNeeded) {
                    abort(422, "Stok obat tidak mencukupi. Tersedia: {$totalAvailable}, dibutuhkan: {$quantityNeeded}");
                }

                // Deduct from the stock with earliest expiry first
                $stocks = MedicationStock::where('medication_id', $medicationId)
                    ->where('quantity', '>', 0)
                    ->orderBy('expired_at', 'asc')
                    ->orderBy('id', 'asc')
                    ->get();

                $remaining = $quantityNeeded;
                $firstStockId = null;

                foreach ($stocks as $s) {
                    if ($remaining <= 0) break;

                    $deduct = min($s->quantity, $remaining);
                    $quantityBefore = $s->quantity;
                    $s->decrement('quantity', $deduct);
                    $s->refresh();
                    $quantityAfter = $s->quantity;
                    $remaining -= $deduct;

                    if ($firstStockId === null) {
                        $firstStockId = $s->id;
                    }

                    MedicationMovement::create([
                        'medication_stock_id' => $s->id,
                        'type' => 'out',
                        'quantity' => $deduct,
                        'quantity_before' => $quantityBefore,
                        'quantity_after' => $quantityAfter,
                        'note' => 'Penggunaan untuk rencana terapi (encounter)',
                        'moved_at' => now(),
                    ]);
                }

                $plan->medications()->create([
                    'medication_id' => $medicationId,
                    'medication_stock_id' => $firstStockId,
                    'dose' => $medication['dose'] ?? null,
                    'dose_per_take' => $medication['dose_per_take'] ?? null,
                    'frequency_per_day' => $medication['frequency_per_day'] ?? null,
                    'duration_days' => $medication['duration_days'] ?? null,
                    'quantity' => $quantityNeeded,
                    'instruction' => $medication['instruction'] ?? null,
                ]);
            } else {
                // Single stock batch with enough quantity
                $quantityBefore = $stock->quantity;
                $stock->decrement('quantity', $quantityNeeded);
                $stock->refresh();
                $quantityAfter = $stock->quantity;

                MedicationMovement::create([
                    'medication_stock_id' => $stock->id,
                    'type' => 'out',
                    'quantity' => $quantityNeeded,
                    'quantity_before' => $quantityBefore,
                    'quantity_after' => $quantityAfter,
                    'note' => 'Penggunaan untuk rencana terapi (encounter)',
                    'moved_at' => now(),
                ]);

                $plan->medications()->create([
                    'medication_id' => $medicationId,
                    'medication_stock_id' => $stock->id,
                    'dose' => $medication['dose'] ?? null,
                    'dose_per_take' => $medication['dose_per_take'] ?? null,
                    'frequency_per_day' => $medication['frequency_per_day'] ?? null,
                    'duration_days' => $medication['duration_days'] ?? null,
                    'quantity' => $quantityNeeded,
                    'instruction' => $medication['instruction'] ?? null,
                ]);
            }
        }
    }
}
