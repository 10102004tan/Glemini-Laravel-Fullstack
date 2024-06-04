<?php

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserController;
use App\Models\Question;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\VerificationController;



// Auth
Route::get('/auth/login', [AuthController::class, "showLogin"])->name("login");
Route::post('/auth/login', [AuthController::class, "login"])->name("handle_login");
Route::get('/auth/register', [AuthController::class, "showRegister"])->name("register");
Route::post('/auth/register', [AuthController::class, "register"])->name("handle_register");
Route::post('/auth/logout', [AuthController::class, "logout"])->name("handle_logout");

// Require Auth
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');

    // Quizz Room Multiple
    Route::get('/quiz-multiple/{id}/join', [RoomController::class, 'wating'])->name('quiz.multiple.join');
    Route::get('/quiz-multiple/{id}', [RoomController::class, 'show']);
    Route::get('/quiz-multiple/{id}/left', [RoomController::class, 'left'])->name('quiz.multiple.left');
});

Route::prefix('admin')->middleware(['role_or_permission:super-admin|admin', 'auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');
    Route::get('/quizzes', [QuizController::class, 'indexAdmin'])->name('quizzes.indexAdmin');

    Route::group(['middleware' => ['role:super-admin']], function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
    });
});

// Quizz Room Single
Route::get('/quiz-single', function () {
    return view('quiz-mode-single.index');
})->name('quiz.index');

Route::get('/quiz-single/show', function () {
    return view('quiz-mode-single.show');
})->name('quiz.show');




// Verify
Route::get('email/verify/{id}', [VerificationController::class, 'show'])->name('verification.notice');
Route::post('email/verify/{id}', [VerificationController::class, 'reverify'])->name('handle_reverify');
Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');

// Quizz
Route::get('/quizzes/create/{id?}', [QuizController::class, 'create'])->name('quizzes.create');
Route::post('/quizzes/create-with-ai', [QuizController::class, 'storeQuizWithAI'])->name('quizzes.storeWithAI');
Route::post('/quizzes/update', [QuizController::class, 'update'])->name('quizzes.update');
Route::delete('/quizzes/question/destroy', [QuestionController::class, 'destroy'])->name('quizzes.question.destroy');
Route::put('/quizzes/question/update', [QuestionController::class, 'update'])->name('quizzes.question.update');
Route::post('/quizzes/question/store', [QuestionController::class, 'store'])->name('quizzes.question.store');
Route::post('/quizzes/published', [QuizController::class, 'published'])->name('quizzes.published');
