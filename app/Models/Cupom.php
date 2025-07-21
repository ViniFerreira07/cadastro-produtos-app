<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cupom extends Model
{
    protected $table = 'cupons';

    protected $fillable = [
        'codigo',
        'desconto',
    ];
    protected $casts = [
        'validade' => 'datetime',
        'ativo' => 'boolean',
    ];

    public function getDescontoFormatadoAttribute()
    {
        return number_format($this->desconto, 2, ',', '.');
    }
}
