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
    public function register(Request $request)
    {
        try {
            // validate
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'role' => 'required'
            ]);

            // normalize role
            $roleName = ucfirst(strtolower($request->role));

            if (!in_array($roleName, ['Student', 'Teacher'])) {
                return [
                    'status' => false,
                    'message' => 'Role không hợp lệ'
                ];
            }

            // tạo user
            $user = User::create([
                'id' => Str::uuid(),
                'name' => trim($request->name),
                'email' => trim($request->email),
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'gender' => $request->gender,
                'birth_date' => $request->birth_date,
                'school_name' => $request->school_name,
                'city' => $request->city,
                'area' => $request->area,
                'avatar' => $request->avatar,
            ]);

            // lấy role
            $role = DB::table('roles')
                ->where('name', $roleName)
                ->first();

            if (!$role) {
                return [
                    'status' => false,
                    'message' => 'Role không tồn tại trong DB'
                ];
            }

            // insert pivot
            DB::table('model_has_roles')->insert([
                'role_id' => $role->id,
                'model_type' => User::class,
                'model_id' => $user->id,
            ]);

            return [
                'status' => true,
                'message' => 'Register success',
                'data' => $user
            ];

        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return [
                    'status' => false,
                    'message' => 'Email không tồn tại'
                ];
            }

            if (!Hash::check($request->password, $user->password)) {
                return [
                    'status' => false,
                    'message' => 'Sai mật khẩu'
                ];
            }

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
                'token' => Str::random(40)
            ];

        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }
}
