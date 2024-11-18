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
        Schema::rename('pedido_produto', 'pedido_produtos');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('pedido_produtos', 'pedido_produto');
    }
};
