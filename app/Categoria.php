<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = [
        'id', 'name', 'categoria_id'
    ];

    /**** INICIO Relaciones Categorias ****/
    public function articulos()
    {
        return $this->hasMany(Articulo::class);
    }

    //categoria padre
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Categoria::class)->with('children');
    }

    public function imagen()
    {
        return $this->belongsTo(Imagen::class);
    }
    /**** FIN Relaciones Categorias ****/
}
