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

    public function getDescontoFormatadoAttribute()
    {
        return number_format($this->desconto, 2, ',', '.');
    }
}
