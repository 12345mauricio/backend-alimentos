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
    // Crear Administrador
    \App\Models\User::create([
        'name' => 'Carlos Administrador',
        'email' => 'admin@sistema.com',
        'username' => 'admin',
        'password' => bcrypt('admin123'), // Contraseña encriptada segura
        'rol' => 'administrador',
        'estado' => 'activo'
    ]);

    // Crear Operador
    \App\Models\User::create([
        'name' => 'Juan Operador',
        'email' => 'operador@sistema.com',
        'username' => 'operador',
        'password' => bcrypt('operador123'),
        'rol' => 'operador',
        'estado' => 'activo'
    ]);

    // Crear Usuario Consulta
    \App\Models\User::create([
        'name' => 'María Consulta',
        'email' => 'consulta@sistema.com',
        'username' => 'consulta',
        'password' => bcrypt('consulta123'),
        'rol' => 'consulta',
        'estado' => 'activo'
    ]);

    // Ejecutamos también el seeder de alimentos que ya teníamos
    $this->call([
        SistemaAlimentosSeeder::class,
    ]);
}
}
