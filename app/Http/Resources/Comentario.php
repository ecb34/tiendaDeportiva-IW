<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Comentario extends JsonResource
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
            'texto' => $this->texto,
            'valoracion' => $this->valoracion,
            'user' => $this->user->nombre,
            'user_id' => $this->user->id,
            'created_at' => $this->created_at
        ];
    }
}
