<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\QuestionServiceInterface;
class QuestionController extends Controller
{   
    protected $service;

    public function __construct(QuestionServiceInterface  $service)
    {
        $this->service = $service;
    }

    
    public function index(Request $request)
    {
        return response()->json($this->service->getList($request));
    }


    public function show(string $id)
    {
        return response()->json($this->service->getDetail($id));
    }

    public function store(Request $request)
    {
        return response()->json($this->service->create($request));
    }

    public function update(Request $request, string $id)
    {
        return response()->json($this->service->update($id, $request));
    }

    public function destroy(string $id)
    {
        return response()->json($this->service->delete($id));
    }
}
