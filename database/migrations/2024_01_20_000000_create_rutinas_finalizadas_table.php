<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('rutinas_finalizadas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rutina_id')->constrained('rutinas')->onDelete('cascade');
            $table->string('dia_semana');
            $table->foreignId('ejercicio_id')->constrained('ejercicios')->onDelete('cascade');
            $table->integer('numero_serie');
            $table->integer('repeticiones')->default(10);
            $table->decimal('peso_kg', 6, 2)->nullable();
            $table->integer('orden')->default(0);
            $table->integer('duracion_minutos')->nullable();
            $table->date('fecha_finalizacion')->nullable();
            $table->timestamps();
            
            $table->index(['rutina_id', 'dia_semana', 'ejercicio_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rutinas_finalizadas');
    }
};
