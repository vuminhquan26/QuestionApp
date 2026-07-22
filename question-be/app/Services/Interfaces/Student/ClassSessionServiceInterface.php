<?php

namespace App\Services\Interfaces\Teacher;

interface ClassSessionServiceInterface
{
    public function getList($classId);

    public function create($classId, array $data);
}
