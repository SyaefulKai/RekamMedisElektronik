<?php

namespace App\Services;

use App\Models\Resources\Medications\Medication;

class MedicationService
{
    public function addMedicationStock(Medication $medication, array $data)
    {
        return $medication->stocks()->create([
            ...$data
        ]);
    }

    public function addBulkMedicationStock(array $items)
    {
        foreach ($items as $data) {
            $medication = Medication::findOrFail($data['medication_id']);
            $this->addMedicationStock($medication, $data);
        }
    }
}
