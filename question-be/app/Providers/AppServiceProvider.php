<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\Interfaces\QuestionServiceInterface;
use App\Services\Implementations\QuestionService;

use App\Services\Interfaces\QuestionTypeServiceInterface;
use App\Services\Implementations\QuestionTypeService;

use App\Services\Interfaces\AnswerTypeServiceInterface;
use App\Services\Implementations\AnswerTypeService;

use App\Services\Interfaces\SubjectServiceInterface;
use App\Services\Implementations\SubjectService;

use App\Services\Interfaces\CourseServiceInterface;
use App\Services\Implementations\CourseService;

use App\Services\Interfaces\CampusServiceInterface;
use App\Services\Implementations\CampusService;

use App\Services\Interfaces\AuthServiceInterface;
use App\Services\Implementations\AuthService;

use App\Services\Interfaces\Teacher\CourseServiceInterface as TeacherCourseServiceInterface;
use App\Services\Implementations\Teacher\CourseService as TeacherCourseService;

use App\Services\Interfaces\Teacher\ClassServiceInterface;
use App\Services\Implementations\Teacher\ClassService;

use App\Services\Interfaces\Teacher\ClassCourseServiceInterface;
use App\Services\Implementations\Teacher\ClassCourseService;

use App\Services\Interfaces\Teacher\ClassSessionServiceInterface;
use App\Services\Implementations\Teacher\ClassSessionService;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            QuestionServiceInterface::class,
            QuestionService::class
        );

        $this->app->bind(
            QuestionTypeServiceInterface::class,
            QuestionTypeService::class
        );

        $this->app->bind(
            AnswerTypeServiceInterface::class,
            AnswerTypeService::class
        );

        $this->app->bind(
            SubjectServiceInterface::class,
            SubjectService::class
        );

        $this->app->bind(
            CourseServiceInterface::class,
            CourseService::class
        );

        $this->app->bind(
            CampusServiceInterface::class,
            CampusService::class
        );

        $this->app->bind(
            AuthServiceInterface::class,
            AuthService::class
        );

        $this->app->bind(
            TeacherCourseServiceInterface::class,
            TeacherCourseService::class
        );
        $this->app->bind(ClassServiceInterface::class, ClassService::class);
        $this->app->bind(ClassCourseServiceInterface::class, ClassCourseService::class);
        $this->app->bind(ClassSessionServiceInterface::class, ClassSessionService::class);
    }

    public function boot(): void
    {
        //
    }
}
