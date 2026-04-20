<?php

use App\Http\Controllers\QueueController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('queues')->group(function() {
    Route::post('/{patient}', [QueueController::class, 'store'])->name('queue.store');
});
