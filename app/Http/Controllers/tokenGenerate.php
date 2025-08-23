<?php

namespace App\Http\Controllers;

// Models
use App\Models\User;

// Request
use App\Http\Requests\GenerateTokenRequest;

//Libs
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TokenGenerate extends Controller
{

    public function generate(GenerateTokenRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Remove tokens anteriores e cria um novo token
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

}
