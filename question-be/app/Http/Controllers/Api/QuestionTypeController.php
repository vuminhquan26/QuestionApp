<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\QuestionTypeServiceInterface;

class QuestionTypeController extends Controller
{
    protected $service;

    public function __construct(QuestionTypeServiceInterface $service){
        $this->service = $service;
    }

    public function index(Request $request)
    {
        return response()->json([
            'data' => $this->service->getList($request),
            'message' => 'Success'
        ]);
    }
}
