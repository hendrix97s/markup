<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Empresa extends Model
{
    //
    use Notifiable;

    protected $fillable = [
        'nome_empresarial',
        'nome_fantasia',
        'cnpj',
        'ie',
        'cep',
        'endereco',
        'numero',
        'bairro',
        'municipio',
        'uf',
    ];

}
