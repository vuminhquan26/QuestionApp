<?php
namespace App\Http\Controllers\Api\Teacher;
use App\Services\Interfaces\Teacher\ClassCourseServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class ClassCourseController extends Controller
{
    protected $service;

    public function __construct(ClassCourseServiceInterface $service)
    {
        $this->middleware('auth:api');
        $this->service = $service;
    }

    public function store(Request $request, $classId)
    {
        return response()->json([
            'data' => $this->service->attachCourse($classId, $request->all()),
            'message' => 'Course attached'
        ]);
    }
}
