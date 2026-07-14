<?php

namespace App\Http\Controllers\Api\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\Teacher\CourseServiceInterface;

class CourseController extends Controller
{
    protected $service;

    public function __construct(CourseServiceInterface $service)
    {
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
