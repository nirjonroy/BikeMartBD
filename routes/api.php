<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\SiteInformationController;
use App\Http\Controllers\api\SliderController;

// Public API routes (No authentication required)
Route::post('/login', [AuthController::class, 'login']); // ✅ Public route
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum'); // ✅ Requires authentication
Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum'); // ✅ Requires authentication

// Secure API route with Sanctum authentication
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/site-information', [SiteInformationController::class, 'index']);   
    Route::get('/slider', [SliderController::class, 'index']);   
    Route::get('/brands', [SiteInformationController::class, 'brand']);
    Route::get('/categories', [SiteInformationController::class, 'category']);
    Route::get('/subcategory', [SiteInformationController::class, 'subcategory']);
    Route::get('/childcategory', [SiteInformationController::class, 'childcategory']);
    Route::get('/product', [SiteInformationController::class, 'product']);
    Route::get('/blog', [SiteInformationController::class, 'blog']);

});
