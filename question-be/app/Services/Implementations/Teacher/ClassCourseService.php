<?php

namespace App\Services\Implementations\Teacher;

use App\Services\Interfaces\Teacher\ClassCourseServiceInterface;
use App\Models\ClassSystem;

class ClassCourseService implements ClassCourseServiceInterface
{
    public function attachCourse($classId, array $data)
    {
        return ClassSystem::create([
            'class_id' => $classId,
            'course_id' => $data['course_id'],
            'course_code' => $data['course_code'],
            'created_by' => auth()->id()
        ]);
    }
}
