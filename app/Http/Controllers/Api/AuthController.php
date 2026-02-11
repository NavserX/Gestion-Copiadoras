<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // 1. Valido que el usuario envíe email y password
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Busco al usuario por su email
        $user = User::where('email', $request->email)->first();

        // 3. Compruebo si el usuario existe y la contraseña es correcta
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Las credenciales son incorrectas.'
            ], 401);
        }

        // 4. Genero el token de seguridad
        $token = $user->createToken('token-del-taller')->plainTextToken;

        // 5. Devuelvo el token
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
}
