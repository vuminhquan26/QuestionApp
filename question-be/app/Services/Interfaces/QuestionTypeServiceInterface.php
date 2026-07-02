<?php
namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface QuestionTypeServiceInterface
{
    public function getList(Request $request);
}
