<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';

    protected $fillable = [
        'nome',
        'descricao',
        'preco',
    ];

    public function estoque()
    {
        return $this->belongsTo(Estoque::class);
    }

    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class)->withPivot('quantidade', 'valor_total');
    }

    public function getPrecoFormatadoAttribute()
    {
        return number_format($this->preco, 2, ',', '.');
    }
}
