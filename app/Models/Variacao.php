<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variacao extends Model
{
    protected $table = 'variacaos';

    protected $fillable = [
        'nome',
        'descricao'
    ];

    public function produtos()
    {
        return $this->belongsTo(Produto::class);
    }
}
