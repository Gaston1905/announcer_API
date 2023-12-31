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
    return response()->json([$token, $user], 200);
}


    public function logout(Request $request)
    {
        // Obtener el token del encabezado
         $token = $request->bearerToken();

        // Verificar si se proporcionó un token
        if ($token) {
            // Revocar el token
            $request->user()->token()->revoke();

            return response()->json(['message' => 'Successfully']);
        } else {
            return response()->json(['message' => 'Token not provided'], 401);
        }
    }
}
