<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Imagen as ImagenResource;
use App\Http\Resources\Comentario as ComentarioResource;
use App\Http\Resources\Marca as MarcaResource;

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
            'marca' => new MarcaResource($this->marca),
            'imagenes' => ImagenResource::collection($this->imagenes),
            'comentarios' => ComentarioResource::collection($this->comentarios)
        ];
    }
}
