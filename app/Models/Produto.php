<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
        'nome',
        'tamanho',
        'descricao',
        'preco_unitario'
    ];

    public function pedidos() {
        return $this->hasMany(PedidoProduto::class, 'produto_id');
    }
}
