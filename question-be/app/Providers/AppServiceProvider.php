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
    }

    public function boot(): void
    {
        //
    }
}
