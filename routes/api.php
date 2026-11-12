<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\InventoryController;
use App\Http\Controllers\Api\MemberController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| SIMKODES RESTful API Routes (JSON Standard)
|--------------------------------------------------------------------------
*/

// Public Authentication
Route::post('/login', [AuthController::class, 'login'])->name('api.login');

// Protected Routes (Sanctum Token Required)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');
    Route::get('/me', [AuthController::class, 'me'])->name('api.me');

    // Anggota (RESTful CRUD API)
    Route::apiResource('members', MemberController::class);

    // Kategori
    Route::get('/categories', [CategoryController::class, 'index'])->name('api.categories.index');
    Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('api.categories.show');

    // Inventaris
    Route::get('/inventories', [InventoryController::class, 'index'])->name('api.inventories.index');
    Route::get('/inventories/{id}', [InventoryController::class, 'show'])->name('api.inventories.show');
});
