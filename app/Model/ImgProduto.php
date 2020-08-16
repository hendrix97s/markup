<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ImgProduto extends Model
{
    //
    use Notifiable;

    protected $fillable =
    [
        'codigo',
        'url_img',
    ];
}

