<?php

use App\Http\Controllers\Resources\PatientController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('patients')->group(function() {
    Route::get('/', [PatientController::class, 'index'])->name('patient.index');
    Route::get('/create', [PatientController::class, 'create'])->name('patient.create');
    Route::post('/', [PatientController::class, 'store'])->name('patient.store');
});
