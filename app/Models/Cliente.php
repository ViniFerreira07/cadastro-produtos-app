<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'rua',
        'numero',
        'bairro',
        'cidade',
        'estado',
        'cep',
        'pais',
    ];
    
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
