<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagene extends Model
{
    protected $fillable = [
        'id', 'nombre','url'
    ];
    
    /**** INICIO Relaciones Imagenes ****/
    public function articulo()
    {
        return $this->belongsTo(Articulo::class);
    }
    /**** FIN Relaciones Imagenes ****/
}
