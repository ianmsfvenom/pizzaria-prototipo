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
        Schema::create('fornecedor_estoque', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('fornecedor_id');
            $table->unsignedBigInteger('estoque_id');

            $table->foreign('fornecedor_id')->references('id')->on('fornecedores');
            $table->foreign('estoque_id')->references('id')->on('estoques');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fornecedor_estoque');
    }
};
