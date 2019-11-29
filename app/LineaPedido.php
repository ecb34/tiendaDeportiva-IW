<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LineaPedido extends Model
{
    protected $fillable = [
        'id', 'importe','cantidad'
    ];

    /**** INICIO Relaciones LineaPedido ****/
    /**** FIN Relaciones LineaPedido ****/

}
