<?php

namespace App\Http\Controllers\Api\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\Teacher\ClassServiceInterface;

class ClassController extends Controller
{
    protected $service;

    public function __construct(ClassServiceInterface $service)
    {
        $this->middleware('auth:api');
        $this->service = $service;
    }

    public function index(Request $request)
    {
        return response()->json([
            'data' => $this->service->getList($request->all()),
            'message' => 'Success'
        ]);
    }

    public function store(Request $request)
    {
        return response()->json([
            'data' => $this->service->create($request->all()),
            'message' => 'Created'
        ]);
    }

    public function show($id)
    {
        return response()->json([
            'data' => $this->service->detail($id),
            'message' => 'Success'
        ]);
    }

    public function update(Request $request, $id)
    {
        return response()->json([
            'data' => $this->service->update($id, $request->all()),
            'message' => 'Updated'
        ]);
    }

    public function destroy($id)
    {
        $this->service->delete($id);

        return response()->json([
            'message' => 'Deleted'
        ]);
    }
    public function getStudents($id)
    {
        $res = $this->service->getStudents($id);

        return response()->json([
            'status' => $res['status'],
            'data' => $res['data'],
            'total' => $res['total'] ?? null
        ]);
    }
}