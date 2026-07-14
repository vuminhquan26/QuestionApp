<?php

namespace App\Services\Implementations;

use App\Services\Interfaces\AuthServiceInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
class AuthService implements AuthServiceInterface
{
    //REGISTER
    public function register(Request $request)
    {
        DB::beginTransaction();
        try {
            // validate
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'role' => 'required'
            ]);

            // chuan hoa role
            $roleName = ucfirst(strtolower($request->role));

            $role = DB::table('roles')
                ->whereIn('name', ['Student', 'Teacher']) // giới hạn role hợp lệ
                ->where('name', $roleName)
                ->first();

            if (!$role) {
                return response()->json([
                    'status' => false,
                    'message' => 'Role không hợp lệ'
                ], 400);
            }
            //trim bo khoang trang 2 dau
            // create user
            $user = User::create([
                'id' => Str::uuid(),
                'name' => trim($request->name),
                'email' => strtolower(trim($request->email)),
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'gender' => $request->gender,
                'birth_date' => $request->birth_date,
                'school_name' => $request->school_name,
                'city' => $request->city,
                'area' => $request->area,
                'avatar' => $request->avatar,
            ]);

            // insert pivot
            DB::table('model_has_roles')->insert([
                'role_id' => $role->id,
                'model_type' => User::class,
                'model_id' => $user->id,
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Register success',
                'data' => $user
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * LOGIN (JWT)
     */
    public function login(Request $request)
    {
        try {
            // lay input va validate
            $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            // tim username va so sanh pass va sinh ra token
            $credentials = $request->only('email', 'password');
            $token = auth()->attempt($credentials);

            // neu token ko dc sinh ra thi tra ve loi
            if (!$token) {
                return [
                    'status' => false,
                    'message' => 'Sai email hoặc mật khẩu'
                ];
            }

            $user = auth()->user();

            // lấy role
            $role = DB::table('model_has_roles as m')
                ->join('roles as r', 'r.id', '=', 'm.role_id')
                ->where('m.model_id', $user->id)
                ->value('r.name');

            return [
                'status' => true,
                'message' => 'Login success',
                'data' => [
                    'user' => $user,
                    'role' => $role ? strtolower($role) : null
                ],
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
            ];

        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * LOGOUT
     */
    public function logout()
    {
        try {
            // lay token tu request hien tai va them vao blacklist
            auth()->logout();

            return [
                'status' => true,
                'message' => 'Logout success'
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * REFRESH TOKEN
     */
    public function refresh()
    {
        try {
            // lay token cua -> invalidate -> sinh token moi -> tra ve token moi
            $token = auth()->refresh();

            return [
                'status' => true,
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60 // config 60*60
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * PROFILE
     */
    public function profile()
    {
        return [
            'status' => true,
            'data' => auth()->user()
        ];
    }
}
