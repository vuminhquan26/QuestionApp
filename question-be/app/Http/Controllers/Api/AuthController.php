<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\AuthServiceInterface;
class AuthController extends Controller
{
    protected $service;

    public function __construct(AuthServiceInterface $service){
        $this->service = $service;
    }

    public function register(Request $request)
    {
        return response()->json($this->service->register($request));
    }

    public function login(Request $request)
    {
        return response()->json($this->service->login($request));
    }
}
