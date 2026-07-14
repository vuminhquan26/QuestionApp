<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\CourseServiceInterface;
use OpenApi\Attributes as OA;

class CourseController extends Controller
{
    protected $service;

    public function __construct(CourseServiceInterface $service){
        $this->service = $service;
    }

    #[OA\Get(
        path: "/api/courses",
        summary: "Get list courses",
        tags: ["Courses"]
    )]

    #[OA\Response(
        response: 200,
        description: "Success"
    )]
    public function index(Request $request){
        return response()->json([
            'data' => $this->service->listCourses($request)->toArray(),
            'message' => 'Success'
        ]);
    }
}
