<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ApplicantController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\EventController;
use Illuminate\Support\Facades\Route;

// Public API Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Protected API Routes
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    
    // Events
    Route::get('/events', [EventController::class, 'index']);
    Route::get('/events/{event}', [EventController::class, 'show']);
    
    // Applicants
    Route::post('/events/{event}/register', [ApplicantController::class, 'store']);
    Route::get('/applicant/qr/{qr_code}', [ApplicantController::class, 'lookup']);
    
    // Companies
    Route::get('/company/visits', [CompanyController::class, 'visits']);
    Route::post('/company/visits', [CompanyController::class, 'addVisit']);
});
