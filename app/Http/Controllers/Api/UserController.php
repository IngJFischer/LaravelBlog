<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;

class UserController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)){
            $token = Auth::user()->createToken('myapptoken')->plainTextToken;
            session()->put('token', $token);
            return response()->json($token);
        };
        return response()->json('Usuario o Contraseña Inválido', 422);
    }

    public function logout(LoginRequest $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)){
            Auth::user()->tokens()->delete();
            return response()->json('Loged Out');
        };
        return response()->json('Usuario o Contraseña Inválido');
    }
}
