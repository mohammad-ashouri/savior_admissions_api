<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'mobile' => 'required|string|exists:users,mobile',
            'password' => 'required|string'
        ]);

        $credentials = $request->only('mobile', 'password');

        $token = Auth::attempt(credentials: $credentials);

        if (!$token) {
            return response()->json(data: [
                'status' => 'error',
                'message' => 'Unauthorized'
            ], status: 401);
        }

        $user = Auth::user();

        return response()->json(data: [
            'status' => 'success',
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }
}
