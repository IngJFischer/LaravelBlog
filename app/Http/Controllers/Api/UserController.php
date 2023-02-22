<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{

    public function checkToken() 
    {
        $token = request('token');

        [$id, $token] = explode('|', $token);

        $tokenHash = hash('sha256', $token);

        $tokenModel = PersonalAccessToken::where('token', $tokenHash)->first();

        dd($tokenModel->tokenable);
    }

    public function login(LoginRequest $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)){
            $token = Auth::user()->createToken('myapptoken')->plainTextToken;
            session()->put('token', $token);
            return response()->json([
                'isloggedin' => true,
                'user' => auth()->user(),
                'token' => $token,
            ]);
        };
        return response()->json('Usuario o Contraseña Inválido', 422);
    }

    public function logout()
    {
        session()->flush();

        return response()->json('Logged Out');
    }
}
