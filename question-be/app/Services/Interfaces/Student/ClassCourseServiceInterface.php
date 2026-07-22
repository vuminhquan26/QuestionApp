<?php

namespace App\Services\Interfaces\Teacher;

interface ClassCourseServiceInterface
{
    public function attachCourse($classId, array $data);
}
