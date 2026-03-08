<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanyVisitController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TimeSlotController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [DashboardController::class, 'index'])->name('home');
Route::get('/event/{event}/register', [ApplicantController::class, 'register'])->name('applicant.register');
Route::post('/event/{event}/register', [ApplicantController::class, 'store'])->name('applicant.store');
Route::get('/event/{event}/applicant/{applicant}/qrcode', [ApplicantController::class, 'showQrCode'])->name('applicant.qrcode');
Route::get('/scan', [ApplicantController::class, 'scanQr'])->name('applicant.scan');
Route::post('/scan', [ApplicantController::class, 'searchByQr'])->name('applicant.search');

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard')->middleware('role:admin');
    Route::get('/company/dashboard', [DashboardController::class, 'company'])->name('company.dashboard')->middleware('role:company');
    
    // Events (Admin only)
    Route::resource('events', EventController::class)->middleware('role:admin');
    
    // Time Slots (Admin only)
    Route::get('/event/{event}/time-slots/create', [TimeSlotController::class, 'create'])->name('time-slots.create')->middleware('role:admin');
    Route::post('/event/{event}/time-slots', [TimeSlotController::class, 'store'])->name('time-slots.store')->middleware('role:admin');
    Route::get('/time-slots/{timeSlot}/edit', [TimeSlotController::class, 'edit'])->name('time-slots.edit')->middleware('role:admin');
    Route::put('/time-slots/{timeSlot}', [TimeSlotController::class, 'update'])->name('time-slots.update')->middleware('role:admin');
    Route::delete('/time-slots/{timeSlot}', [TimeSlotController::class, 'destroy'])->name('time-slots.destroy')->middleware('role:admin');
    
    // Companies
    Route::resource('companies', CompanyController::class)->middleware('role:admin');
    Route::get('/my-company', [CompanyController::class, 'show'])->name('company.profile')->middleware('role:company');
    Route::get('/my-company/edit', [CompanyController::class, 'edit'])->name('company.edit')->middleware('role:company');
    
    // Company QR Scanner
    Route::get('/company/scan', [CompanyVisitController::class, 'scan'])->name('company.scan')->middleware('role:company');
    Route::post('/company/scan', [CompanyVisitController::class, 'lookup'])->name('company.lookup')->middleware('role:company');
    Route::get('/company/visits', [CompanyVisitController::class, 'myVisits'])->name('company.visits')->middleware('role:company');
    Route::post('/company/applicant/{applicant}/note', [CompanyVisitController::class, 'saveNote'])->name('company.saveNote')->middleware('role:company');
});
