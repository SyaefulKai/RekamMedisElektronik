<?php

use App\Http\Controllers\Resources\AssessmentController;
use App\Http\Controllers\Resources\PlanController;
use App\Http\Controllers\Resources\AssessmentDiagnosisController;
use App\Http\Controllers\Resources\EncounterController;
use App\Http\Controllers\Resources\ObjectiveController;
use App\Http\Controllers\Resources\SubjectiveController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('encounters')->group(function() {
    Route::get('/{encounter:uuid}/show', [EncounterController::class, 'show'])->name('encounter.show');
    Route::get('/{encounter:uuid}', [EncounterController::class, 'index'])->name('encounter.index');
    Route::post('/', [EncounterController::class, 'store'])->name('encounter.store');

    Route::prefix('/{encounter:uuid}/subjectives')->group(function() {
        Route::post('/', [SubjectiveController::class, 'store'])->name('subjective.store');
    });

    Route::prefix('/{encounter:uuid}/objectives')->group(function() {
        Route::post('/', [ObjectiveController::class, 'store'])->name('objective.store');
    });

    Route::prefix('/{encounter:uuid}/assessments')->group(function() {
        Route::post('/', [AssessmentController::class, 'store'])->name('assessment.store');
        Route::delete('/diagnoses/{diagnosis}', [AssessmentDiagnosisController::class, 'delete'])->name('assessment.diagnosis.delete');
    });

    Route::prefix('/{encounter:uuid}/plans')->group(function() {
        Route::post('/', [PlanController::class, 'store'])->name('plan.store');
        Route::delete('/{type}/{item}', [PlanController::class, 'destroy'])->name('plan.destroy');
    });

    Route::put('/{encounter:uuid}/finish', [EncounterController::class, 'finish'])->name('encounter.finish');
});
