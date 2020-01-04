<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LineaPedido extends Model
{
    protected $table = 'lineas_pedidos';

    protected $fillable = [
        'id', 'importe','cantidad', 'articulo_id', 'pedido_id'
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
    
    public function articulo()
    {
        return $this->belongsTo(Articulo::class);
    }

}
