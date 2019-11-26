<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Imagen;
use Faker\Generator as Faker;

$factory->define(Imagen::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
        'url' => $faker->unique()->url,
        'articulo_id' => function () {//TODO revisar esto
            return factory(App\Articulo::class)->create()->id;
        }
    ];
});
