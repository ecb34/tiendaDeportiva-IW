<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $fillable = [
        'id', 'texto','valoracion'
    ];

    /**** INICIO Relaciones Comentarios ****/
    public function articulo()
    {
        return $this->belongsTo(Articulo::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**** FIN Relaciones Comentarios ****/
    
}
