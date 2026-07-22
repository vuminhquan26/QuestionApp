<?php

namespace App\Services\Interfaces\Teacher;

interface ClassServiceInterface
{
    public function getList(array $filters);

    public function create(array $data);

    public function detail($id);

    public function update($id, array $data);

    public function delete($id);

    public function getStudents($classId);
}
