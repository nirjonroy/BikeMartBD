<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\SiteInformationController;

// Public API routes (No authentication required)
Route::post('/login', [AuthController::class, 'login']); // ✅ Public route
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum'); // ✅ Requires authentication
Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum'); // ✅ Requires authentication

// Secure API route with Sanctum authentication
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/site-information', [SiteInformationController::class, 'index']);   
});
