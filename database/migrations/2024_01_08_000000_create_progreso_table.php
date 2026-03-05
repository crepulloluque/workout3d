<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('progreso', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->date('fecha');
            $table->decimal('peso', 5, 2)->nullable();
            $table->decimal('grasa', 5, 2)->nullable();
            $table->decimal('musculo', 5, 2)->nullable();
            $table->decimal('imc', 5, 2)->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progreso');
    }
};
