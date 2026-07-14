<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\QuestionTypeController;
use App\Http\Controllers\Api\AnswerTypeController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\CampusController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Teacher\ClassController;
use App\Http\Controllers\Api\Teacher\ClassCourseController;
use App\Http\Controllers\Api\Teacher\ClassSessionController;


// ai cũng xem được
Route::get('/question', [QuestionController::class, 'index']);
Route::get('/question/{id}', [QuestionController::class, 'show']);

Route::get('/questiontype', [QuestionTypeController::class, 'index']);
Route::get('/answertype', [AnswerTypeController::class, 'index']);
Route::get('/subject', [SubjectController::class, 'index']);
Route::get('/course', [CourseController::class, 'index']);
Route::get('/campus', [CampusController::class, 'index']);

// dang nhap
Route::prefix('auth')->group(function () {

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:api')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
        Route::get('/profile', [AuthController::class, 'profile']);
    });
});


// PROTECTED
Route::middleware('auth:api')->group(function () {
    Route::post('/question', [QuestionController::class, 'store']);
    Route::put('/question/{id}', [QuestionController::class, 'update']);
    Route::delete('/question/{id}', [QuestionController::class, 'destroy']);
});

Route::prefix('teacher')->middleware(['auth:api','role:Teacher'])->group(function () {

    Route::get('classes', [ClassController::class, 'index']);
    Route::post('classes', [ClassController::class, 'store']);
    Route::get('classes/{id}', [ClassController::class, 'show']);
    Route::put('classes/{id}', [ClassController::class, 'update']);
    Route::delete('classes/{id}', [ClassController::class, 'destroy']);

    Route::get('classes/{classId}/courses', [ClassCourseController::class, 'index']);
    Route::post('classes/{classId}/courses', [ClassCourseController::class, 'store']);
    Route::delete('classes/{classId}/courses/{courseId}', [ClassCourseController::class, 'destroy']);

    Route::get('classes/{classId}/sessions', [ClassSessionController::class, 'index']);
    Route::post('classes/{classId}/sessions', [ClassSessionController::class, 'store']);
    Route::put('sessions/{id}', [ClassSessionController::class, 'update']);
    Route::delete('sessions/{id}', [ClassSessionController::class, 'destroy']);
});
