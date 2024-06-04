<?php

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserController;
use App\Models\Question;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleAndPermissionController;
use App\Http\Controllers\VerificationController;

//Home
Route::get('/', function () {
    return view('home');
});
Route::get('/home', [HomeController::class,'index'])->name('home');
Route::get('/about', [HomeController::class,'about'])->name('about');
Route::get('/contact', [HomeController::class,'contact'])->name('contact');

// Auth
Route::get('/auth/verify', [AuthController::class, "showVerify"])->name("verify");
Route::get('/auth/login', [AuthController::class, "showLogin"])->name("login");
Route::post('/auth/login', [AuthController::class, "login"])->name("handle_login");
Route::get('/auth/register', [AuthController::class, "showRegister"])->name("register");
Route::post('/auth/register', [AuthController::class, "register"])->name("handle_register");
Route::post('/auth/logout', [AuthController::class, "logout"])->name("handle_logout");

// Dashboard
// Route::middleware(['auth'])->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');
// });


Route::prefix('admin')->middleware(['role_or_permission:super-admin|admin','auth'])->group(function () { 
    Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');
    Route::get('/quizzes', [QuizController::class, 'indexAdmin'])->name('quizzes.indexAdmin');

    Route::group(['middleware' => ['role:super-admin']], function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/roles', [RoleAndPermissionController::class, 'index'])->name('roles.index');
    });
 });


Route::get('/quiz-single', function () {
    return view('quiz-mode-single.index');
})->name('quiz.index');

Route::get('/quiz-single/show', function () {
    return view('quiz-mode-single.show');
})->name('quiz.show');

// Verify
Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');

Route::get('/quizzes/create/{id?}', [QuizController::class, 'create'])->name('quizzes.create');
Route::post('/quizzes/create-with-ai', [QuizController::class, 'storeQuizWithAI'])->name('quizzes.storeWithAI');
Route::post('/quizzes/update', [QuizController::class, 'update'])->name('quizzes.update');
Route::delete('/quizzes/question/destroy', [QuestionController::class, 'destroy'])->name('quizzes.question.destroy');
Route::put('/quizzes/question/update', [QuestionController::class, 'update'])->name('quizzes.question.update');
Route::post('/quizzes/question/store', [QuestionController::class, 'store'])->name('quizzes.question.store');
Route::post('/quizzes/published', [QuizController::class, 'published'])->name('quizzes.published');
Route::post('/quizzes/details', [QuizController::class, 'getDetailsQuiz'])->name('quizzes.details');
Route::post('/quizzes/accept', [QuizController::class, 'appectQuiz'])->name('quizzes.accept');
Route::post('/quizzes/destroy', [QuizController::class, 'destroy'])->name('quizzes.destroy');
Route::post('/quizzes/reject', [QuizController::class, 'rejectQuiz'])->name('quizzes.reject');
