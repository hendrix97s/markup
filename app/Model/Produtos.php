<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Produtos extends Model
{
    //

    use Notifiable;

    protected $fillable = 
    [
        'codigo',
        'descricao',
        'valor_compra',
        'valor_venda',
        'comprimento',
        'largura',
        'altura',
        'peso',
    ];
}
