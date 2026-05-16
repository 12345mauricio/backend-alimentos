<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. CREAR ADMINISTRADOR
        \App\Models\User::create([
            'name' => 'Carlos Administrador',
            'email' => 'admin@sistema.com',
            'username' => 'admin',
            'password' => bcrypt('admin123'),
            'rol' => 'administrador',
            'estado' => 'activo'
        ]);

        // 2. CREAR OPERADOR
        \App\Models\User::create([
            'name' => 'Juan Operador',
            'email' => 'operador@sistema.com',
            'username' => 'operador',
            'password' => bcrypt('operador123'),
            'rol' => 'operador',
            'estado' => 'activo'
        ]);

        // 3. CREAR USUARIO CONSULTA
        \App\Models\User::create([
            'name' => 'María Consulta',
            'email' => 'consulta@sistema.com',
            'username' => 'consulta',
            'password' => bcrypt('consulta123'),
            'rol' => 'consulta',
            'estado' => 'activo'
        ]);

        // 4. INSERTAR PRODUCTOS DE PRUEBA
        DB::table('productos')->insert([
            [
                'id' => 1,
                'nombre' => 'Yogurt de Frutilla 1L',
                'categoria' => 'Lácteos',
                'unidad_medida' => 'Unidades',
                'descripcion' => 'Yogurt entero pasteurizado sabor frutilla',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'nombre' => 'Leche Entera UHT',
                'categoria' => 'Lácteos',
                'unidad_medida' => 'Litros',
                'descripcion' => 'Leche ultra pasteurizada de larga vida',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'nombre' => 'Queso Cheddar Block',
                'categoria' => 'Lácteos',
                'unidad_medida' => 'Kg',
                'descripcion' => 'Queso madurado de consistencia semidura',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // 5. INSERTAR LOTES DE PRUEBA EN MINÚSCULAS (Compatibilidad ENUM total)
        DB::table('lotes')->insert([
            [
                'codigo_lote' => 'LOT-2026-001',
                'producto_id' => 1,
                'cantidad' => 150,
                'fecha_produccion' => '2026-05-01',
                'fecha_vencimiento' => '2026-05-20',
                'estado' => 'por_vencer', // Formato estándar seguro sin espacios ni tildes
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo_lote' => 'LOT-2026-002',
                'producto_id' => 2,
                'cantidad' => 500,
                'fecha_produccion' => '2026-04-10',
                'fecha_vencimiento' => '2026-07-10',
                'estado' => 'optimo', // Sin tilde para evitar rechazos de truncamiento de MySQL
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo_lote' => 'LOT-2026-003',
                'producto_id' => 3,
                'cantidad' => 80,
                'fecha_produccion' => '2026-03-01',
                'fecha_vencimiento' => '2026-05-10',
                'estado' => 'vencido',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}