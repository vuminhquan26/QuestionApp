<?php

namespace App\Services\Interfaces;
use Illuminate\Http\Request;
interface CourseServiceInterface
{
    public function listCourses(Request $request);

}
