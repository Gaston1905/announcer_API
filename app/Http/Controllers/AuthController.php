<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('Announcer_API')->accessToken;

        // Retorna solo el token en lugar de todo el objeto de token
        return response()->json(['token' => $token], 200);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
