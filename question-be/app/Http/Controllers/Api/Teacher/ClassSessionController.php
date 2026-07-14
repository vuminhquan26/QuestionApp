<?php

namespace App\Http\Controllers\Api\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\Teacher\ClassSessionServiceInterface;


class ClassSessionController extends Controller
{

    protected $service;


    public function __construct(ClassSessionServiceInterface $service)
    {
        $this->service = $service;
    }



    public function index($classId)
    {
        return response()->json([
            'data'=>$this->service
                ->getList($classId),

            'message'=>'Success'
        ]);
    }



    public function store(Request $request,$classId)
    {
        return response()->json([
            'data'=>$this->service
                ->create(
                    $classId,
                    $request->all()
                ),

            'message'=>'Created'
        ],201);
    }


}
