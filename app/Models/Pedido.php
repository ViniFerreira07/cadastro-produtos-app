<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $fillable = [
        'data_pedido',
        'status',
        'total',
    ];

    public function produtos()
    {
        return $this->belongsToMany(Produto::class)->withPivot('quantidade', 'preco');
    }

    public function getTotalFormatadoAttribute()
    {
        return number_format($this->total, 2, ',', '.');
    }
}
