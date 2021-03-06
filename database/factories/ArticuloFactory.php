<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Articulo;
use Faker\Generator as Faker;

$factory->define(Articulo::class, function (Faker $faker) {
    $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));
    return [
        'codigo' => $faker->unique()->ean8,//codigo de barras
        'nombre' => $faker->productName,
        'pvp' => $faker->randomFloat(2,0,200),//2 digitos, hasta 9999
        'descripcion' => $faker->text(150),
        'valoracion' => 0.0,//hasta 5 estrellas
        'genero' => $faker->numberBetween(0,2)//0 = hombre, 1 =mujer, 2 = unisex
    ];
});
