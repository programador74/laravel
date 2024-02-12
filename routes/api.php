<?php

use App\Http\Controllers\RegistroController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;





Route::post("/create", [RegistroController::class, 'crearUsuario']);
Route::post("/login", [RegistroController::class, 'loginUsuario']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});