<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Direccion extends JsonResource
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
            'linea1' => $this->linea1,
            'linea2' => $this->linea2,
            'cod_postal' => $this->cod_postal
        ];
    }
}
