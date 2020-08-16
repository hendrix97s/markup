<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Tokens extends Model
{
    //
    use Notifiable;

    protected $fillable = [
        'plataforma',
        'nome_token',
        'token',
    ];

    
}
