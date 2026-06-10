<?php

use App\Enums\DiagnosisRole;
use App\Enums\DiagnosisStatus;
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

            $table->foreignId('assessment_id')
                ->constrained('assessments')
                ->cascadeOnDelete();

            $table->string('code');
            $table->string('system');
            $table->string('display')->nullable();

            $table->enum('diagnosis_status', array_column(DiagnosisStatus::cases(), 'value'));
            $table->enum('diagnosis_role', array_column(DiagnosisRole::cases(), 'value'))->nullable();

            $table->timestamps();
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
