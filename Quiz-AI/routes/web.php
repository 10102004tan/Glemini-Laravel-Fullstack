<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/quiz-single', function () {
    return view('quiz-mode-single.index');
})->name('quiz.index');

Route::get('/quiz-single/show', function () {
    return view('quiz-mode-single.show');
})->name('quiz.show');
