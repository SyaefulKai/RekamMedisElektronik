<?php

use App\Http\Controllers\Resources\MedicationController;
use App\Http\Controllers\Resources\MedicationStockController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::prefix('medications')->group(function () {
        Route::get('/', [MedicationController::class, 'index'])->name('medication.index');
        Route::post('/', [MedicationController::class, 'store'])->name('medication.store');
    });

    Route::prefix('medication-stocks')->group(function () {
        Route::get('/create', [MedicationStockController::class, 'create'])
            ->name('medication.stock.create');
        Route::post('/bulk', [MedicationStockController::class, 'bulkStore'])
            ->name('medication.stock.bulk.store');
    });
});