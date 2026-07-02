<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\SubjectServiceInterface;
class SubjectController extends Controller
{
    protected $service;

    public function __construct(SubjectServiceInterface $service){
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
