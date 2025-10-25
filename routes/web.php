<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Api\LeadController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// API маршруты для форм
Route::post('/api/leads', [LeadController::class, 'store'])->name('api.leads.store');
