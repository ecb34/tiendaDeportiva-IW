<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'nombre' => $this->nombre,
            'email' => $this->email,
            'apellido' => $this->apellido,
            'telefono' => $this->telefono,
            'fecha_nacimiento' => $this->fecha_nacimiento
        ];
    }
}
