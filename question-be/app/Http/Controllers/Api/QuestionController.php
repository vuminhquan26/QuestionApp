<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\QuestionServiceInterface;

class QuestionController extends Controller
{
    protected $service;
    public function __construct(QuestionServiceInterface $service)
    {
        $this->service = $service;
    }


    public function index(Request $request)
    {
        return response()->json($this->service->getList($request));
    }

    public function show(string $id)
    {
        $data = $this->service->getDetail($id);

        if (!$data) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json($data);
    }

    public function store(Request $request)
    {
        if (!auth()->user()->roles->contains('name', 'Teacher')) {
            return response()->json(['message' => 'Bạn không có quyền'], 403);
        }

        return response()->json(
            $this->service->create($request),
            201
        );
    }
    public function update(Request $request, string $id)
    {
        try {
            if (!auth()->user()->roles->contains('name', 'Teacher')) {
                return response()->json(['message' => 'Bạn không có quyền'], 403);
            }

            return response()->json(
                $this->service->update($id, $request)
            );

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
    public function destroy(string $id)
    {
        try {
            if (!auth()->user()->roles->contains('name', 'Teacher')) {
                return response()->json(['message' => 'Bạn không có quyền'], 403);
            }

            $this->service->delete($id);

            return response()->json(['message' => 'Deleted successfully']);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
