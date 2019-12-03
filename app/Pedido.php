<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    // estado => cesta, pendiente,en proceso, servido, pagado, cancelado
    protected $fillable = [
        'id', 'fecha','estado'
    ];

    /**** INICIO Relaciones Pedido ****/
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lineaPedidos()
    {
        return $this->hasMany(LineaPedido::class);
    }

}
