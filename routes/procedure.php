<?php

use App\Http\Controllers\Resources\ProcedureController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('procedures')->group(function() {
    Route::get('/', [ProcedureController::class, 'index'])->name('procedure.index');
    Route::get('/create', [ProcedureController::class, 'create'])->name('procedure.create');
    Route::post('/', [ProcedureController::class, 'store'])->name('procedure.store');
});
