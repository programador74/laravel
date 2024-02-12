<?php

namespace App\Http\Controllers;

use App\Http\Requests\CrearUsuarioRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class RegistroController extends Controller
{
    public function crearUsuario(CrearUsuarioRequest $request)
    {
        $usuario = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        return response()->json([
            "status" => true,
            "message" => "Usuario registrado",
            "token" => $usuario->createToken("API TOKEN")->plainTextToken
        ], 200);
    }

    public function loginUsuario(LoginRequest $request)
    {
        if(!Auth::attempt($request->only(['email','password'])))
        {
            return response()->json([
                "status" => "false",
                "message" => "Email && Password incorrectos",

            ], 401);
        }

        $user = User::where('email', $request->email)->first();

        return response()->json([
            "status" => true,
            "message" => "ingreso permitido",
            "token" =>  $user->createToken("token de autenticacion")->plainTextToken
        ], 200);
    }




}


