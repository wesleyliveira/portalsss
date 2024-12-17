<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;
class LoginController extends Controller
{
    public function login (Request $request): JsonResponse    
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $user = Auth::user();

            $token = $request->user()->createToken('token')->plainTextToken;

            return response()->json(['user' => $user, 'token' => $token, 'message' => 'Login efetuado com sucesso!'], 200);
        } else {
            return response()->json(['status' => false, 'message' => 'Login inválido!'], 401);
        }   
    }

    public function logout (User $user): JsonResponse
    {
        try{
        $user->tokens()->delete();
        return response()->json([
            'status' => true,
            'message' => 'Logout efetuado com sucesso!'
        ], 200);    
    }catch(Exception $e){
        return response()->json([
            'status' => false,
            'message' => 'Erro ao efetuar logout!'
        ], 404);    
    }
    }   
}
