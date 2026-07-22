<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\QuestionTypeController;
use App\Http\Controllers\Api\AnswerTypeController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\CampusController;

use App\Http\Controllers\Api\Student\StudentClassController;

use App\Http\Controllers\Api\Teacher\ClassController;
use App\Http\Controllers\Api\Teacher\ClassCourseController;
use App\Http\Controllers\Api\Teacher\ClassSessionController;
use App\Http\Controllers\Api\Teacher\DashboardController;



// Public API


Route::get('/question', [QuestionController::class,'index']); // danh sách câu hỏi
Route::get('/question/{id}', [QuestionController::class,'show']); // chi tiết câu hỏi

Route::get('/questiontype', [QuestionTypeController::class,'index']); // loại câu hỏi
Route::get('/answertype', [AnswerTypeController::class,'index']); // loại đáp án
Route::get('/subject', [SubjectController::class,'index']); // môn học
Route::get('/course', [CourseController::class,'index']); // khóa học
Route::get('/campus', [CampusController::class,'index']); // cơ sở



// Auth API
Route::prefix('auth')->group(function(){

    // SOCIAL (đặt riêng)
    Route::prefix('social')->group(function () {
        Route::get('/{provider}/redirect', [AuthController::class, 'redirect']);
        Route::get('/{provider}/callback', [AuthController::class, 'callback']);
    });

    // NORMAL AUTH
    Route::post('/register',[AuthController::class,'register']);
    Route::post('/login',[AuthController::class,'login']);
    Route::post('/refresh',[AuthController::class,'refresh']);
    Route::post('/social-login', [AuthController::class, 'socialLogin']);

});



// Question quản lý
Route::middleware(['auth:api','role:Teacher|Admin'])->group(function(){

    Route::post('/question',[QuestionController::class,'store']); // tạo câu hỏi
    Route::put('/question/{id}',[QuestionController::class,'update']); // sửa câu hỏi
    Route::delete('/question/{id}',[QuestionController::class,'destroy']); // xóa câu hỏi

});



// Student API
Route::prefix('student')
->middleware(['auth:api','role:Student'])
->group(function(){

    Route::post('/classes/join',[StudentClassController::class,'join']); // tham gia lớp

    Route::get('/classes',[StudentClassController::class,'myClasses']); // lớp của tôi

    Route::get('/classes/all',[StudentClassController::class,'all']); // xem lớp

    Route::get('/classes/{id}',[StudentClassController::class,'detail']); // chi tiết lớp

});



// Teacher API
Route::prefix('teacher')
->middleware(['auth:api','role:Teacher'])
->group(function(){

    Route::get('/dashboard',[DashboardController::class,'index']); // dashboard giáo viên


    Route::get('/classes',[ClassController::class,'index']); // danh sách lớp

    Route::post('/classes',[ClassController::class,'store']); // tạo lớp

    Route::get('/classes/{id}',[ClassController::class,'show']); // chi tiết lớp

    Route::put('/classes/{id}',[ClassController::class,'update']); // cập nhật lớp

    Route::delete('/classes/{id}',[ClassController::class,'destroy']); // xóa lớp

    Route::get('/classes/{id}/students',[ClassController::class,'getStudents']); // danh sách sinh viên


    Route::get('/classes/{classId}/courses',[ClassCourseController::class,'index']); // môn của lớp

    Route::post('/classes/{classId}/courses',[ClassCourseController::class,'store']); // thêm môn


    Route::get('/classes/{classId}/sessions',[ClassSessionController::class,'index']); // danh sách buổi học

    Route::post('/classes/{classId}/sessions',[ClassSessionController::class,'store']); // tạo buổi học

    Route::put('/sessions/{id}',[ClassSessionController::class,'update']); // sửa buổi học

    Route::delete('/sessions/{id}',[ClassSessionController::class,'destroy']); // xóa buổi học

});
