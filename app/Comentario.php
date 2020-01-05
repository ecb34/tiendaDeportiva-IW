<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $fillable = [
        'id', 'texto','valoracion', 'articulo_id', 'user_id'
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
