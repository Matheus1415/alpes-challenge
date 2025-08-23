<?php

// Controller
use App\Http\Controllers\tokenGenerate;
use App\Http\Controllers\VehicleController;

// Libs
use Illuminate\Support\Facades\Route;

Route::get('/token-generate',[tokenGenerate::class,'generate'])->name('generate.token');

