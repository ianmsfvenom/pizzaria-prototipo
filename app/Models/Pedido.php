<?php

namespace App\Models;

use App\Enums\FormaPagamento;
use App\Enums\PedidoStatus;
use App\Enums\TipoEntrega;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'cliente_id',
        'endereco_id',
        'tipo_entrega',
        'forma_pagamento',
        'status',
    ];

    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }

    public function endereco() {
        return $this->belongsTo(Endereco::class);
    }

    public function produtos() {
        return $this->hasMany(PedidoProduto::class, 'pedido_id');
    }

    protected $casts = [
        'tipo_entrega' => TipoEntrega::class,
        'forma_pagamento' => FormaPagamento::class,
        'status' => PedidoStatus::class,
    ];
}
