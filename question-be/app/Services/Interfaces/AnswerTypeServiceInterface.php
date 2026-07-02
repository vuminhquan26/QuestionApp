<?php
namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface AnswerTypeServiceInterface
{
    public function getList(Request $request);
}
