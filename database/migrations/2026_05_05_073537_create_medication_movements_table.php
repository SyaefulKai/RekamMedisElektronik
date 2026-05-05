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
        Schema::create('medication_stock_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medication_stock_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->enum('type', ['in', 'out', 'adjustment']);
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('quantity_before');
            $table->unsignedInteger('quantity_after');
            $table->string('note')->nullable();
            $table->timestamp('moved_at')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medication_movements');
    }
};
