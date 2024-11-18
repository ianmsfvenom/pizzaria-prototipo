<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoProduto extends Model
{

    protected $table = 'pedido_produtos';
    
    protected $fillable = [
        'pedido_id',
        'produto_id',
        'quantidade',
        'preco_unitario',
    ];

    public function pedido() {
        return $this->belongsTo(Pedido::class);
    }

    public function produto() {
        return $this->belongsTo(Produto::class);
    }
}
