<?php

use App\Http\Controllers\QueueController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('queues')->group(function() {
    Route::get('/', [QueueController::class,'index'])->name('queue.index');
    Route::post('/{patient}', [QueueController::class, 'store'])->name('queue.store');
});
