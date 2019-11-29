<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    // lina = calle
    protected $fillable = [
        'id', 'linea1', 'linea2', 'cod_postal'
    ];
}
