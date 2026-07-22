<?php

namespace App\Http\Controllers\Api\Teacher;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\Teacher\DashboardServiceInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $service;

    public function __construct(DashboardServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {
            $teacherId = auth()->id();

            $data = $this->service->getDashboard($teacherId);

            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
