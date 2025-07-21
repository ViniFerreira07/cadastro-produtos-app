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
        return $this->belongsToMany(Produto::class)->withPivot('quantidade', 'valor_total');
    }

    public function clientes()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function getTotalFormatadoAttribute()
    {
        return number_format($this->total, 2, ',', '.');
    }
}
