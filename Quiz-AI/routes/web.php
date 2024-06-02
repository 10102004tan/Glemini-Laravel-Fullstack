<?php

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Models\Question;
use Illuminate\Support\Facades\Route;


Route::get('/quizzes/create/{id?}', [QuizController::class, 'create'])->name('quizzes.create');
Route::post('/quizzes/create-with-ai', [QuizController::class, 'storeQuizWithAI'])->name('quizzes.storeWithAI');
Route::post('/quizzes/update', [QuizController::class, 'update'])->name('quizzes.update');
Route::delete('/quizzes/question/destroy', [QuestionController::class, 'destroy'])->name('quizzes.question.destroy');
Route::put('/quizzes/question/update', [QuestionController::class, 'update'])->name('quizzes.question.update');
Route::post('/quizzes/question/store', [QuestionController::class, 'store'])->name('quizzes.question.store');
