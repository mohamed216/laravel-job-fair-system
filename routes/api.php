<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ApplicantController;
use App\Http\Controllers\Api\CompanyController;
use Illuminate\Support\Facades\Route;

// Public API Routes
Route::post('/api/login', [AuthController::class, 'login']);
Route::post('/api/register', [AuthController::class, 'register']);

// Protected API Routes
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/api/logout', [AuthController::class, 'logout']);
    Route::get('/api/user', [AuthController::class, 'user']);
    
    // Events
    Route::get('/api/events', [App\Http\Controllers\Api\EventController::class, 'index']);
    Route::get('/api/events/{event}', [App\Http\Controllers\Api\EventController::class, 'show']);
    
    // Applicants
    Route::post('/api/events/{event}/register', [ApplicantController::class, 'store']);
    Route::get('/api/applicant/qr/{qr_code}', [ApplicantController::class, 'lookup']);
    
    // Companies
    Route::get('/api/company/visits', [CompanyController::class, 'visits']);
    Route::post('/api/company/visits', [CompanyController::class, 'addVisit']);
});
