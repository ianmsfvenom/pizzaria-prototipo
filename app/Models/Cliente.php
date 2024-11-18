<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
   protected $fillable = [
       'nome',
       'tel',
       'cpf',
       'whatsapp'
    ];

    public function enderecos() {
        return $this->hasMany(Endereco::class);
    }
}
