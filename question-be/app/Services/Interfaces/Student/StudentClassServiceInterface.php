<?php
namespace App\Services\Interfaces\Student;

interface StudentClassServiceInterface
{
    public function joinByCode(string $code);
    public function myClasses(?string $keyword = null);
    public function detail($id);
    public function getAllClasses(?string $keyword = null);
}
