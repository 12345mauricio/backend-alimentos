<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlimentoController extends Controller
{
    public function index()
    {
        // 1. CONSULTA REAL: Traer los lotes enlazados con la información de sus productos correspondientes
        $lotes = DB::table('lotes')
            ->join('productos', 'lotes.producto_id', '=', 'productos.id')
            ->select('lotes.*', 'productos.nombre as producto_nombre', 'productos.categoria')
            ->orderBy('lotes.fecha_vencimiento', 'asc') // Prioriza mostrar lo más próximo a vencer
            ->get();

        // 2. MÉTRICAS TOTALMENTE REALES (Consultas directas a la base de datos)
        $totalProductos = DB::table('productos')->count();
        $stockTotal = DB::table('lotes')->sum('cantidad') ?? 0;
        $lotesVencidos = DB::table('lotes')->where('estado', 'vencido')->count();
        $lotesAlertas = DB::table('lotes')->where('estado', 'por_vencer')->count();

        // 3. CONSULTA DE CATEGORÍAS REAL: Suma el stock agrupándolo dinámicamente según MySQL
        $categorias = DB::table('lotes')
            ->join('productos', 'lotes.producto_id', '=', 'productos.id')
            ->select('productos.categoria', DB::raw('SUM(lotes.cantidad) as total_stock'))
            ->groupBy('productos.categoria')
            ->get();

        // Enviamos las variables exactas calculadas de la BD a la vista
        return view('dashboard', compact('lotes', 'totalProductos', 'stockTotal', 'lotesVencidos', 'lotesAlertas', 'categorias'));
    }
}