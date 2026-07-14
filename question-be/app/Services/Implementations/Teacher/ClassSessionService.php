<?php

namespace App\Services\Implementations\Teacher;

use App\Services\Interfaces\Teacher\ClassSessionServiceInterface;
use App\Models\ClassDetail;

class ClassSessionService implements ClassSessionServiceInterface
{
    public function getList($classId)
    {
        return ClassDetail::where('class_id', $classId)->get();
    }

    public function create($classId, array $data)
    {
        return ClassDetail::create([
            ...$data,
            'class_id' => $classId,
            'created_by' => auth()->id()
        ]);
    }
}
