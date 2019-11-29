<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nombre', 'empresa', 'logo'
    ];

    /**** INICIO Relaciones Marca ****/
    public function articulos()
    {
        return $this->hasMany(Articulo::class);
    }
    /**** FIN Relaciones Marca ****/
}
