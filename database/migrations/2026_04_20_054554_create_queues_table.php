<?php

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
        Schema::create('queues', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('queue_number');
            $table->foreignId('practitioner_id');
            $table->foreignId('patient_id');
            $table->enum('status', [
                'planned',
                'in-progress',
                'finished',
                'cancelled'
            ])->default('planned');
            $table->timestamps();

            $table->unique([
                'patient_id',
                'date',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('queues');
    }
};
