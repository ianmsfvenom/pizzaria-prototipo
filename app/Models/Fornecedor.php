<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $table = 'fornecedores';

    protected $fillable = [
        'nome',
        'tel',
        'cpf_cnpj',
        'email',
        'whatsapp'
    ];

    public function estoques() {
        return $this->hasMany(FornecedorEstoque::class, 'fornecedor_id');
    }
}
