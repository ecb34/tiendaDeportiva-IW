<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Pedido as PedidoResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'email' => $this->email,
            'apellido' => $this->apellido,
            'telefono' => $this->telefono,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'rol' => $this->rol
        ];
    }
}
