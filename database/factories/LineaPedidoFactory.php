<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\LineaPedido;
use Faker\Generator as Faker;

$factory->define(LineaPedido::class, function (Faker $faker) {
    return [
        'importe' => $faker->randomFloat(2,0,9999),//max 2 decimales, max 9999 importe
        'cantidad' => $faker->numberBetween(0,10),//cantidad entre 0 y 10
    ];
});
