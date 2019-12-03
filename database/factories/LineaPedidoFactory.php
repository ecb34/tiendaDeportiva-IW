<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\LineaPedido;
use Faker\Generator as Faker;

$factory->define(LineaPedido::class, function (Faker $faker) {
    return [
        //cambiar lo de importe a q lo calcule de cantidad * precio articulo
        'importe' => $faker->randomFloat(2,0,1000),//max 2 decimales, max 9999 importe
        'cantidad' => $faker->numberBetween(1,10),//cantidad entre 0 y 10
    ];
});
