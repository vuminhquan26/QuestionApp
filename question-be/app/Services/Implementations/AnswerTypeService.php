<?php

namespace App\Services\Implementations;

use App\Services\Interfaces\AnswerTypeServiceInterface;
use App\Models\AnswerType;
use Illuminate\Http\Request;

class AnswerTypeService implements AnswerTypeServiceInterface{
    public function getList(Request $request){
        return AnswerType::query()->get();
    }
}
