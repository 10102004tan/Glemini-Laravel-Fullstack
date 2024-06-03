<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', function () {
    return view('quizzes.create');
});

// Auth
Route::get('/auth/verify', [AuthController::class, "showVerify"])->name("verify");
Route::get('/auth/login', [AuthController::class, "showLogin"])->name("login");
Route::post('/auth/login', [AuthController::class, "login"])->name("handle_login");
Route::get('/auth/register', [AuthController::class, "showRegister"])->name("register");
Route::post('/auth/register', [AuthController::class, "register"])->name("handle_register");
Route::post('/auth/logout', [AuthController::class, "logout"])->name("handle_logout");

// Dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, "showDashboard"])->name("dashboard");
});

// Verify
Route::get('email/verify/{id}', [VerificationController::class, 'show'])->name('verification.notice');
Route::post('email/verify/{id}', [VerificationController::class, 'reverify'])->name('handle_reverify');
Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');

