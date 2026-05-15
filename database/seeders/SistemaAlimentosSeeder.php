<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SistemaAlimentosSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Insertar Productos
        DB::table('productos')->insert([
            ['nombre' => 'Leche Entera 1L', 'categoria' => 'Lácteos', 'created_at' => now()],
            ['nombre' => 'Queso Fresco 500g', 'categoria' => 'Lácteos', 'created_at' => now()],
            ['nombre' => 'Yogurt Natural', 'categoria' => 'Lácteos', 'created_at' => now()],
        ]);

        // 2. Insertar Lotes de prueba
        DB::table('lotes')->insert([
            // Lote Óptimo (Vence en un año)
            [
                'producto_id' => 1,
                'codigo_lote' => 'LOT-2026-001',
                'cantidad' => 100,
                'fecha_produccion' => Carbon::now()->subDays(5),
                'fecha_vencimiento' => Carbon::now()->addYear(),
                'estado' => 'optimo',
                'created_at' => now()
            ],
            // Lote Próximo a Vencer (Vence en 3 días) - AMARILLO
            [
                'producto_id' => 2,
                'codigo_lote' => 'LOT-2026-045',
                'cantidad' => 50,
                'fecha_produccion' => Carbon::now()->subDays(20),
                'fecha_vencimiento' => Carbon::now()->addDays(3),
                'estado' => 'por_vencer',
                'created_at' => now()
            ],
            // Lote Vencido (Venció hace 2 días) - ROJO
            [
                'producto_id' => 1,
                'codigo_lote' => 'LOT-2026-009',
                'cantidad' => 20,
                'fecha_produccion' => Carbon::now()->subDays(30),
                'fecha_vencimiento' => Carbon::now()->subDays(2),
                'estado' => 'vencido',
                'created_at' => now()
            ],
        ]);
    }
}