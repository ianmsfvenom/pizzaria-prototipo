<?php

namespace App\Models;

use App\Enums\StatusDespesa;
use App\Enums\TipoDespesa;
use Illuminate\Database\Eloquent\Model;

class Despesa extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'nome',
        'descricao',
        'valor',
        'data_pagamento',
        'tipo',
        'status'
    ];

    protected $casts = [
        'tipo' => TipoDespesa::class,
        'status' => StatusDespesa::class
    ];
}
