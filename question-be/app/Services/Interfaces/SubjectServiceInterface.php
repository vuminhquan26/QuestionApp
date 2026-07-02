<?php
namespace App\Services\Interfaces;

use Illuminate\Http\Request;

use App\Services\Interfaces\SubjectServiceInterface;
interface SubjectServiceInterface
{
    public function getList(Request $request);
}
