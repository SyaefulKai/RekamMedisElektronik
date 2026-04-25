<?php

use App\Http\Controllers\Resources\EncounterController;
use App\Http\Controllers\Resources\SubjectiveController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('encounters')->group(function() {
    Route::get('/{encounter:uuid}', [EncounterController::class, 'index'])->name('encounter.index');
    Route::post('/', [EncounterController::class, 'store'])->name('encounter.store');

    Route::prefix('/{encounter:uuid}/subjectives')->group(function() {
        Route::post('/', [SubjectiveController::class, 'store'])->name('subjective.store');
    });
});
