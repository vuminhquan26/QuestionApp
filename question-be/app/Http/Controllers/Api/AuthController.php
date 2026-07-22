<?php

// studentAC2C@gmail.com | teachertest@gmail.com

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\AuthServiceInterface;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use App\Models\User;
class AuthController extends Controller
{
    protected $service;

    public function __construct(AuthServiceInterface $service)
    {
        $this->service = $service;

        $this->middleware('auth:api', [
            'except' => [
                'login',
                'register',
                'refresh',
                'redirect',
                'callback'
            ]
        ]);
    }

    // REGISTER: nhận request -> gọi service tạo user -> trả JSON response
    public function register(Request $request)
    {
        return response()->json($this->service->register($request)); // delegate toàn bộ logic cho service
    }

    // LOGIN: validate credentials -> generate JWT token -> trả về token + user info
    public function login(Request $request)
    {
        return response()->json($this->service->login($request)); // service sẽ handle attempt + token
    }

    // LOGOUT: invalidate token hiện tại (user không dùng lại được token cũ)
    public function logout()
    {
        return response()->json($this->service->logout()); // service gọi JWTAuth::invalidate()
    }

    // REFRESH TOKEN: tạo token mới từ token cũ (giữ session user)
    public function refresh()
    {
        $res = $this->service->refresh();

        if (!$res['status']) {
            return response()->json($res, 401);
        }

        return response()->json($res);
    }

    // PROFILE: lấy thông tin user hiện tại từ token (decode JWT)
    public function profile()
    {
        return [
            'status' => true,
            'data' => auth()->user()
        ];
    }

    public function redirect($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function callback($provider)
    {
        $socialUser = Socialite::driver($provider)->stateless()->user();

        $user = User::updateOrCreate(
            ['email' => $socialUser->getEmail()],
            [
                'name' => $socialUser->getName(),
                'password' => bcrypt(uniqid()),
            ]
        );

        $token = auth('api')->login($user);

        return redirect("http://localhost:5173/social-callback?token=$token&email=".$user->email."&name=".$user->name);
    }
    public function socialLogin(Request $request)
    {
        return $this->service->socialLogin($request);
    }
}
