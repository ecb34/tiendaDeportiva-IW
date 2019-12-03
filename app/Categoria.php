<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = [
        'id', 'nombre'
    ];

    /**** INICIO Relaciones Categorias ****/
    public function articulos()
    {
        return $this->hasMany(Articulo::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_padre_id', 'id');
    }

    public function categorias()
    {
        return $this->hasMany(Categoria::class, 'categoria_padre_id', 'id');
    }
    /**** FIN Relaciones Categorias ****/
}
