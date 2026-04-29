<?php

use App\Enums\DiagnosisRole;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assessment_diagnoses', function (Blueprint $table) {
            $table->id();
            $table->enum('diagnosis_type', array_column(DiagnosisRole::cases(), 'value'));
            $table->foreignId('assessment_id')->constrained('assessments')->cascadeOnDelete();
            $table->foreignId('icd10_id')->constrained('icd10s')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
