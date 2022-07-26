<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email())->first();
        if (!$user || Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $user->tokens()->delete();
        $token = $user->createToken($request->device_name)->plainTextToken;
        return response()->json([
            'success' => true,
            'message' => 'Login Success',
            'data' => [
                'token' => $token,
                'user' => $user
            ]
        ], 200);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'Register Success',
                'data' => $user
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Register Failed'
            ], 500);
        }

        // return response()->json([
        //     'success' => true,
        //     'message' => 'User berhasil ditambahkan',
        //     'data' => $user
        // ], 200);
    }
}
