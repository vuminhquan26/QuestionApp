<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\QuestionTypeController;
use App\Http\Controllers\Api\AnswerTypeController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\DashboardController;

Route::get('/question', [QuestionController::class, 'index'])->name('question.index');

Route::get('/question/{id}', [QuestionController::class, 'show'])->name('question.show');

Route::post('/question', [QuestionController::class, 'store'])->name('question.store');

Route::put('/question/{id}', [QuestionController::class, 'update'])->name('question.update');

Route::delete('/question/{id}', [QuestionController::class, 'destroy'])->name('question.destroy');


Route::get('/questiontype', [QuestionTypeController::class, 'index'])->name('questiontype.index');

Route::get('/answertype', [AnswerTypeController::class, 'index'])->name('answertype.index');

Route::get('/subject', [SubjectController::class, 'index'])->name('subject.index');

