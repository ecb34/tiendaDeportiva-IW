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
        'valoracion' => $faker->randomFloat(1,0,5),//hasta 5 estrellas
    ];
});
