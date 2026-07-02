<?php

namespace App\Services\Implementations;

use App\Services\Interfaces\QuestionTypeServiceInterface;
use App\Models\QuestionType;
use Illuminate\Http\Request;

class QuestionTypeService implements QuestionTypeServiceInterface
{
    public function getList(Request $request)
    {
        return QuestionType::query()->get();
    }
}
