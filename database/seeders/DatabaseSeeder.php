<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Creamos el usuario de prueba (opcional)
        User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
        ]);

        // 2. LLAMAMOS A TU NUEVO SEEDER DE ALIMENTOS
        $this->call([
            SistemaAlimentosSeeder::class,
        ]);
    }
}
