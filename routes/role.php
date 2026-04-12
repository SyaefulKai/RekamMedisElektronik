<?php

use App\Http\Controllers\Authorization\RoleController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('roles')->group(function() {
    Route::get('/', [RoleController::class, 'index'])->name('role.index');
    Route::get('/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('/', [RoleController::class, 'store'])->name('role.store');
    Route::delete('/{role}', [RoleController::class, 'delete'])->name('role.delete');
    Route::get('/{role}', [RoleController::class, 'edit'])->name('role.edit');
    Route::patch('/{role}', [RoleController::class, 'update'])->name('role.update');
});
