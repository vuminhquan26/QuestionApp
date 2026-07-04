<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\CampusServiceInterface;

class CampusController extends Controller
{
    protected $service;

    public function __construct(CampusServiceInterface $service)
    {
        $this->service = $service;
    }
    public function index(Request $request)
    {
        return response()->json([
            'data' =>$this->service->getList($request),
            'message' => 'Success'
        ]);
    }
}
