<?php
// studentAC2C@gmail.com
// teachertest@gmail.com
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\AuthServiceInterface;

class AuthController extends Controller
{
    protected $service;

    public function __construct(AuthServiceInterface $service)
    {
        $this->service = $service;

        // chỉ login/register không cần token
        $this->middleware('auth:api', [
            'except' => ['login', 'register']
        ]);
    }

    /**
     * REGISTER
     */
    public function register(Request $request)
    {
        $res = $this->service->register($request);

        if (!$res['status']) {
            return response()->json($res, 400);
        }

        return response()->json($res, 201);
    }

    /**
     * LOGIN
     */
    public function login(Request $request)
    {
        try {
            return response()->json($this->service->login($request));
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
            ], 500);
        }
    }
    // public function login(Request $request)
    // {
    //     $res = $this->service->login($request);

    //     if (!$res['status']) {
    //         return response()->json($res, 401);
    //     }

    //     return response()->json($res, 200);
    // }

    /**
     * LOGOUT
     */
    public function logout()
    {
        $res = $this->service->logout();

        return response()->json($res);
    }

    /**
     * REFRESH TOKEN
     */
    public function refresh()
    {
        $res = $this->service->refresh();

        if (!$res['status']) {
            return response()->json($res, 401);
        }

        return response()->json($res);
    }

    /**
     * PROFILE
     */
    public function profile()
    {
        $res = $this->service->profile();

        return response()->json($res);
    }
}
