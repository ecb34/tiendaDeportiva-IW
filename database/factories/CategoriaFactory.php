<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Categoria;
use Faker\Generator as Faker;

$factory->define(Categoria::class, function (Faker $faker) {
    return [
        'nombre' => $faker->unique()->name,
        'categoria_padre_id' => function () {//TODO revisar esto
            return factory(App\Categoria::class)->create()->id;
        }
    ];
});
