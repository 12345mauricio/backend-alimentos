<?php

use Illuminate\Support\Facades\Route;
// Importamos los controladores (Crucial para que las rutas sepan a dónde ir)
use App\Http\Controllers\AlimentoController;
use App\Http\Controllers\AuthController;

// 1. RUTAS DE AUTENTICACIÓN (PÚBLICAS)
// Si entran a la raíz '/', ahora los mandamos a ver el formulario de Login
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// 2. RUTAS PROTEGIDAS (Solo pueden entrar usuarios logueados)
Route::middleware(['auth'])->group(function () {
    
    // Tu ruta del Dashboard ahora está blindada aquí adentro
    Route::get('/dashboard', [AlimentoController::class, 'index']);

    // Tu ruta de registro de lotes también se protege aquí
    Route::get('/registro-lote', function () {
        return view('registro-lote');
    });

});