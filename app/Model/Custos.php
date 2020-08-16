<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Custos extends Model
{
    //
    use Notifiable;

    protected $fillable = [
        'plataforma',
        'descricao',
        'taxa',
    ];
}
