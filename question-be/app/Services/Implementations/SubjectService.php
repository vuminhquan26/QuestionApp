<?php

namespace App\Services\Implementations;

use App\Services\Interfaces\SubjectServiceInterface;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectService implements SubjectServiceInterface{
    public function getList(Request $request){
        return Subject::query()->get();
    }
}
