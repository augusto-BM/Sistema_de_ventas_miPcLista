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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categorias')->cascadeOnDelete();
            $table->foreignId('marcas_id')->constrained('marcas')->cascadeOnDelete();
            $table->string('nombre');
            $table->string('identificador_url')->unique();
            $table->json('imagen')->nullable();
            $table->text('descripcion')->nullable();
            $table->decimal('precio', 10, 2);
            $table->boolean('es_activo')->default(true);
            $table->boolean('es_destacado')->default(false);
            $table->boolean('en_stock')->default(true);
            $table->boolean('en_oferta')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
