<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    // Eloquent se encarga de almacenar los datos en el atributo
    protected $fillable = [
        'id', 'codigo', 'nombre', 'pvp', 'descripcion', 'valoracion'
    ];

    /**** INICIO Relaciones Articulos ****/
    public function imagenes()
    {
        return $this->hasMany(Imagene::class);
    }
    
    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }
    
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
    
    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }
    // Falta la relacion con ListaDeseo... y el modelo
    /**** INICIO Relaciones Articulos ****/
}
