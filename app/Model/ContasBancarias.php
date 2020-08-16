<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ContasBancarias extends Model
{
    //
    use Notifiable;

    protected $fillable =
    [
        'nome_favorecido',
        'cnpj',
        'banco',
        'agencia',
        'conta',
    ];
}
