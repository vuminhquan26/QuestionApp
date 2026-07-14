<?php

namespace App\Services\Interfaces\Teacher;

use Illuminate\Http\Request;

interface CourseServiceInterface
{
    public function getList(Request $request);
}
