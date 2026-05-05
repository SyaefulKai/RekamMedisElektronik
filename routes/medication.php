<?php

use App\Http\Controllers\Resources\MedicationController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('medications')->group(function() {
    Route::get('/', [MedicationController::class, 'index'])->name('medication.index');
    Route::post('/', [MedicationController::class, 'store'])->name('medication.store');
});
