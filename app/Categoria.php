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

    //categoria padre
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_padre_id', 'id');
    }

    //categorias hijas
    public function categorias()
    {
        return $this->hasMany(Categoria::class, 'categoria_padre_id', 'id');
    }

    public function imagen()
    {
        return $this->hasOne(Imagen::class);
    }
    /**** FIN Relaciones Categorias ****/
}
