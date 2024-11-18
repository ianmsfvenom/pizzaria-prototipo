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
            $table->timestamps();

            $table->string('tipo_entrega');
            $table->string('forma_pagamento');
            $table->string('status');
            
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('endereco_id')->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('endereco_id')->references('id')->on('enderecos');
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
