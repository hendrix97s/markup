<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cliente extends Model
{
    //
    use Notifiable;

    protected $fillable = 
    [
        'nome_comercial',
        'nome_contato',
        'cnpj',
        'cep',
        'endereco',
        'bairro',
        'numero',
        'municipio',
        'uf',
        'telefone',
        'celular',
        'email',
    ];
}
