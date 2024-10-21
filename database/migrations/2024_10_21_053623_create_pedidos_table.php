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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained("users")->cascadeOnDelete();
            $table->decimal('total_pagar', 10, 2)->nullable();
            $table->string('metodo_pago')->nullable();
            $table->string('estado_pago')->nullable();
            $table->enum('estado', ['nuevo', 'en proceso', 'enviado', 'entregado', 'cancelado'])->default('nuevo');
            $table->string('moneda')->nullable();
            $table->decimal('monto_envio', 10, 2)->nullable();
            $table->string('metodo_envio')->nullable();
            $table->string('notas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
