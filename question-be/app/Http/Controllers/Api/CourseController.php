<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\CourseServiceInterface;

class CourseController extends Controller
{
    protected $service;

    public function __construct(CourseServiceInterface $service){
        $this->service = $service;
    }
    public function index(Request $request){
        return response()->json([
            'data' => $this->service->listCourses($request)->toArray(),
            'message' => 'Success'
        ]);
    }
}
