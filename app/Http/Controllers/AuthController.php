<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginIndex()
    {
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    public function login(Request $request)
    {
        $validated = $request->validate([
            'mobile' => 'required|exists:users,mobile',
            'password' => 'required|string'
        ]);

        if (count($request->all()) > count($validated)) {
            return response()->json([
                'error' => 'Only mobile and password fields are allowed'
            ], 422);
        }

        $credentials = $request->only('mobile', 'password');

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth('api')->user()
        ]);
    }
}
