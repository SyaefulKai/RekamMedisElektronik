<?php

use App\Http\Controllers\Auth\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('users')->group(function() {
    Route::get('/', [UserController::class, 'index'])->name('user.index');
});
