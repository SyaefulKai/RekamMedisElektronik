<?php

namespace Database\Seeders;

use App\Models\Resources\Medications\Medication;
use Illuminate\Database\Seeder;

class MedicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Medication::factory()->count(20)->create();
    }
}
