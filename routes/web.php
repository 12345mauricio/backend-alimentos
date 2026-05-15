<?php

use Illuminate\Support\Facades\Route;
// Importamos el controlador que creamos (Paso MUY importante)
use App\Http\Controllers\AlimentoController;

Route::get('/', function () {
    return view('welcome');
});

// Ruta del Dashboard: Ahora es manejada por el controlador para traer datos de la BD
Route::get('/dashboard', [AlimentoController::class, 'index']);

// Ruta para la vista de registro (el formulario que creamos antes)
Route::get('/registro-lote', function () {
    return view('registro-lote');

 Route::get('/dashboard', [App\Http\Controllers\AlimentoController::class, 'index']);
});