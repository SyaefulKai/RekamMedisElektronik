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
        Schema::table('plan_medications', function (Blueprint $table) {
            $table->foreignId('medication_stock_id')
                ->nullable()
                ->after('medication_id')
                ->constrained('medication_stocks')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plan_medications', function (Blueprint $table) {
            $table->dropForeign(['medication_stock_id']);
            $table->dropColumn('medication_stock_id');
        });
    }
};
