<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{//TODO agregar/modificar para nuevos atributos
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','nombre', 'email', 'apellido', 'telefono', 'fecha_nacimiento','rol','password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**** INICIO Relaciones User ****/
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    public function direcciones()
    {
        return $this->belongsToMany(Direccion::class);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function articulos()
    {
        return $this->belongsToMany(Articulo::class, 'lista_deseos')
                    ->as('listaDeseo')
                    ->withTimestamps();
    }
}
