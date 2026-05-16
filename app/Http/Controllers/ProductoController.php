<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    // LISTAR Y BUSCAR PRODUCTOS
    public function index(Request $request)
    {
        $buscar = $request->get('buscar');

        // Si el usuario escribe en el buscador, filtramos; si no, trae todo
        $productos = DB::table('productos')
            ->when($buscar, function ($query, $buscar) {
                return $query->where('nombre', 'LIKE', "%{$buscar}%")
                             ->orWhere('categoria', 'LIKE', "%{$buscar}%");
            })
            ->get();

        return view('productos.index', compact('productos', 'buscar'));
    }

    // REGISTRAR NUEVO PRODUCTO (Con Validaciones Críticas)
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:productos,nombre|max:255', // No vacío y no duplicado
            'categoria' => 'required', // Categoría obligatoria
            'unidad_medida' => 'required',
            'descripcion' => 'nullable'
        ], [
            // Mensajes personalizados en español para tu defensa
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'nombre.unique' => 'Este producto ya se encuentra registrado en el sistema.',
            'categoria.required' => 'Debe seleccionar una categoría válida.'
        ]);

        // Inserción limpia en MySQL
        DB::table('productos')->insert([
            'nombre' => $request->nombre,
            'categoria' => $request->categoria,
            'unidad_medida' => $request->unidad_medida,
            'descripcion' => $request->descripcion,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->back()->with('exito', 'Producto registrado correctamente.');
    }

    // EDITAR / ACTUALIZAR PRODUCTO
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|max:255|unique:productos,nombre,' . $id, // Evita duplicados menos consigo mismo
            'categoria' => 'required',
            'unidad_medida' => 'required',
            'descripcion' => 'nullable'
        ]);

        DB::table('productos')->where('id', $id)->update([
            'nombre' => $request->nombre,
            'categoria' => $request->categoria,
            'unidad_medida' => $request->unidad_medida,
            'descripcion' => $request->descripcion,
            'updated_at' => now()
        ]);

        return redirect()->back()->with('exito', 'Producto actualizado correctamente.');
    }

    // ELIMINAR PRODUCTO
    public function destroy($id)
    {
        // Nota técnica: En trazabilidad se puede validar si el producto tiene lotes antes de borrarlo
        DB::table('productos')->where('id', $id)->delete();
        return redirect()->back()->with('exito', 'Producto eliminado del sistema.');
    }
}