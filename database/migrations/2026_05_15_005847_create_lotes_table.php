<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lotes', function (Blueprint $table) {
            $table->id();
            // Relación con productos (Si borras el producto, se borran sus lotes)
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            
            $table->string('codigo_lote')->unique(); // ID único para trazabilidad
            $table->integer('cantidad');
            $table->date('fecha_produccion');
            $table->date('fecha_vencimiento'); // Clave para tus alertas de semáforo
            
            // Estado para el control visual (optimo, por_vencer, vencido)
            $table->enum('estado', ['optimo', 'por_vencer', 'vencido'])->default('optimo');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lotes');
    }
};