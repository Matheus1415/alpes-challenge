<?php

// Controller
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VehicleController;

// Libs
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('/token-generate',[AuthController::class,'generate'])->name('generate.token');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Private routes
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('vehicles', VehicleController::class);
});