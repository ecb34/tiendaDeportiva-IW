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
        'nombre', 'empresa', 'logo',
    ];
}
