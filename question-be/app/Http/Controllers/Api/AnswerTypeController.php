<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\AnswerTypeServiceInterface;

class AnswerTypeController extends Controller
{
    protected $service;

    public function __construct(AnswerTypeServiceInterface $service){
        $this->service = $service;
    }

    public function index(Request $request){
        return response()->json([
            'data' =>$this->service->getList($request),
            'message' => 'Success'
        ]);
    }
}
