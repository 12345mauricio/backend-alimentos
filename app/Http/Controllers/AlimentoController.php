<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// CAMBIO AQUÍ: Debe ser 'extends Controller'
class AlimentoController extends Controller 
{
    public function index()
    {
        // Traemos los lotes uniendo la información con el nombre del producto
        $lotes = DB::table('lotes')
            ->join('productos', 'lotes.producto_id', '=', 'productos.id')
            ->select('lotes.*', 'productos.nombre as producto_nombre')
            ->get();

        // Enviamos los datos a la vista dashboard
        return view('dashboard', compact('lotes'));
    }
}