<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    protected $table = 'imagenes';

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
