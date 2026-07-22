<?php

namespace App\Services\Implementations;

use App\Services\Interfaces\AuthServiceInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AuthService implements AuthServiceInterface
{
    // ================= REGISTER =================
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        $roleName = ucfirst(strtolower($request->role));

        $role = DB::table('roles')
            ->whereIn('name', ['Student', 'Teacher'])
            ->where('name', $roleName)
            ->first();

        if (!$role) {
            return [
                'status' => false,
                'message' => 'Role không hợp lệ'
            ];
        }

        try {
            DB::beginTransaction();

            $user = User::create([
                'id' => Str::uuid(),
                'name' => trim($request->name),
                'email' => strtolower(trim($request->email)),
                'password' => Hash::make($request->password),
            ]);

            DB::table('model_has_roles')->insert([
                'role_id' => $role->id,
                'model_type' => User::class,
                'model_id' => $user->id,
            ]);

            DB::commit();

            return [
                'status' => true,
                'message' => 'Register success',
                'data' => $user
            ];

        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    // ================= LOGIN =================
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (!$token = auth()->attempt($credentials)) {
            return [
                'status' => false,
                'message' => 'Sai email hoặc mật khẩu'
            ];
        }

        $user = auth()->user();

        $role = DB::table('model_has_roles as m')
            ->join('roles as r', 'r.id', '=', 'm.role_id')
            ->where('m.model_id', $user->id)
            ->value('r.name');

        return [
            'status' => true,
            'message' => 'Login success',
            'data' => [
                'user' => $user,
                'role' => strtolower($role)
            ],
            'access_token' => $token,
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }

    // ================= LOGOUT =================
    public function logout()
    {
        auth()->logout();

        return [
            'status' => true,
            'message' => 'Logout success'
        ];
    }

    // ================= REFRESH =================
    public function refresh()
    {
        try {
            $token = auth('api')->refresh();

            return [
                'status' => true,
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'Token không hợp lệ'
            ];
        }
    }

    // ================= PROFILE =================
    public function profile()
    {
        return response()->json([
            'status' => true,
            'data' => auth()->user()
        ]);
    }
    public function socialLogin(Request $request)
    {
        $user = auth()->user(); // lấy từ token

        $role = Role::where('name', ucfirst($request->role))->first();

        $user->roles()->syncWithoutDetaching([$role->id]);

        return response()->json([
            'status' => true
        ]);
    }
}
