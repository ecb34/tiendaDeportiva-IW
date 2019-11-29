<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LineaPedido extends Model
{
    protected $table = 'lineas_pedidos';

    protected $fillable = [
        'id', 'importe','cantidad'
    ];

    /**** INICIO Relaciones LineaPedido ****/
    /**** FIN Relaciones LineaPedido ****/

}
