<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Imagen as ImagenResource;

class Articulo extends JsonResource
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
            'codigo' => $this->codigo,
            'nombre' => $this->nombre,
            'pvp' => $this->pvp,
            'descripcion' => $this->descripcion,
            'valoracion' => $this->valoracion,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'imagenes' => ImagenResource::collection($this->imagenes)
        ];
    }
}
