<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $fillable = [
        'cep',
        'logradouro',
        'numero',
        'bairro',
        'cidade',
        'uf',
        'complemento',
        'cliente_id'
    ];

    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }
}
