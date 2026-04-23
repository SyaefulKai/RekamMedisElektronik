<?php

use App\Http\Controllers\Resources\PractitionerController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('practitioners')->group(function() {
    Route::get('/', [PractitionerController::class, 'index'])->name('practitioner.index');
});
