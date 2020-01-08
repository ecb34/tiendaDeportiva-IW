<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Articulo as ArticuloResource;

class LineaPedido extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'importe' => $this->importe,
            'cantidad' => $this->cantidad,
            'articulo_id' => $this->articulo_id,
            'pedido_id' => $this->pedido_id,
            'articulo' => new ArticuloResource($this->articulo)
        ];
    }
}
