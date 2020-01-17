<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $fillable = [
        'id', 'nombre','url', 'documento'
    ];
    
    /**** INICIO Relaciones Documentos ****/
    public function articulo()
    {
        return $this->belongsTo(Articulo::class);
    }
    /**** FIN Relaciones Documentos ****/
}
