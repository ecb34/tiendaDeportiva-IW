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
        return $this->hasMany(Imagen::class);
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

    public function users()
    {
        return $this->belongsToMany(User::class, 'lista_deseos')
                    ->as('listaDeseo')
                    ->withTimestamps();
    }

    public function lineaPedidos()
    {
        return $this->hasMany(LineaPedido::class);
    }
}
