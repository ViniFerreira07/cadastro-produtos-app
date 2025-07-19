<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    protected $table = 'estoque';

    protected $fillable = [
        'produto_id',
        'quantidade',
        'qtd_minima',
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function getQuantidadeFormatadaAttribute()
    {
        return number_format($this->quantidade, 0, ',', '.');
    }

    public function getQtdMinimaFormatadaAttribute()
    {
        return number_format($this->qtd_minima, 0, ',', '.');
    }
}
