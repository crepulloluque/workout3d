<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->string('nombre');
            $table->string('apellidos')->nullable();
            $table->string('telefono')->nullable();
            $table->text('direccion_envio');
            $table->string('pais')->nullable();
            $table->string('provincia')->nullable();
            $table->string('codigo_postal')->nullable();
            $table->string('tipo_entrega')->nullable();
            $table->string('metodo_pago')->nullable();
            $table->decimal('total', 10, 2);
            $table->timestamp('fecha_compra')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
