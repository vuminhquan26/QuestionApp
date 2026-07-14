<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\CampusServiceInterface;
use OpenApi\Attributes as OA;

class CampusController extends Controller
{
    protected $service;

    public function __construct(CampusServiceInterface $service)
    {
        $this->service = $service;
    }
    #[OA\Get(
        path: "/api/campus",
        summary: "Get list campus",
        tags: ["Campus"]
    )]

    #[OA\Response(
        response: 200,
        description: "Success"
    )]
    public function index(Request $request)
    {
        return response()->json([
            'data' =>$this->service->getList($request),
            'message' => 'Success'
        ]);
    }
}
