<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FornecedorEstoque extends Model
{
    protected $table = 'fornecedor_estoque';

    protected $fillable = [
        'fornecedor_id',
        'estoque_id'
    ];

    public function estoque() {
        return $this->belongsTo(Estoque::class);
    }

    public function fornecedor() {
        return $this->belongsTo(Fornecedor::class);
    }
}
