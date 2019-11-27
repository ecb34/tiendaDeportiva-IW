<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    // estado => cesta, pendiente,en proceso, servido, pagado, cancelado
    protected $fillable = [
        'id', 'fecha','estado'
    ];
}
