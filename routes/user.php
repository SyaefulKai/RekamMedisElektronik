<?php

use App\Http\Controllers\Auth\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::post('/', [UserController::class, 'store'])->name('user.store');
    Route::get('/create', [UserController::class, 'create'])->name('user.create');
    Route::get('/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::patch('/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/{user}', [UserController::class, 'delete'])->name('user.delete');
});
