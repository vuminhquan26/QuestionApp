<?php
namespace App\Services\Implementations;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Services\Interfaces\CourseServiceInterface;

class CourseService implements CourseServiceInterface
{
    public function listCourses(Request $request)
    {
        return Course::query()->get();
    }
}
