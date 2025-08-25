<?php

namespace App\Http\Controllers;

// Models
use App\Models\User;

// Request
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\GenerateTokenRequest;

//Libs
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function generate(GenerateTokenRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Remove tokens anteriores e cria um novo token e loga o usuário
            Auth::login($user);
            $user->tokens()->delete();
            $token = $user->createToken('api-token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token
            ], 201);

        } catch (\Exception $error) {
            return response()->json([
                'message' => 'Erro ao criar token.',
                'error' => $error->getMessage()
            ], 500);
        }
    }

    public function login(AuthLoginRequest $request)
    {

        try {
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return response()->json([
                    'message' => 'Usuário não existe.'
                ], 404);
            }

            if (!Hash::check($request->password, $user->password)) {
                return response()->json([
                    'message' => 'Senha incorreta.'
                ], 401);
            }

            $user->tokens()->delete();
            $token = $user->createToken('api-token')->plainTextToken;

            Auth::login($user);

            return response()->json([
                'message' => 'Login realizado com sucesso!',
                'user' => $user,
                'token' => $token
            ], 200);

        } catch (\Exception $error) {
            return response()->json([
                'message' => 'Erro interno ao tentar realizar login.',
                'error' => $error->getMessage()
            ], 500);
        }
    }
}
