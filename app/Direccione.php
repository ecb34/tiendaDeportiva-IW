<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direccione extends Model
{
    // lina = calle
    protected $fillable = [
        'id', 'linea1', 'linea2', 'cod_postal'
    ];
    
    /**** INICIO Relaciones Direcciones ****/
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    /**** FIN Relaciones Direcciones ****/
}
