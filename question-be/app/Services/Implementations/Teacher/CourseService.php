<?php

namespace App\Services\Implementations\Teacher;

use App\Services\Interfaces\Teacher\CourseServiceInterface;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseService implements CourseServiceInterface
{
    public function getList(Request $request)
    {
        return Course::query()
            ->where('created_by', auth()->id())
            ->get();
    }
}
