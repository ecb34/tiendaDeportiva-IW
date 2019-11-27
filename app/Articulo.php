<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    // Eloquent se encarga de almacenar los datos en el atributo
    protected $fillable = [
        'id', 'codigo', 'nombre', 'pvp', 'descripcion', 'valoracion'
    ];
}
