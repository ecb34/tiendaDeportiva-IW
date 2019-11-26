<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Articulo;
use Faker\Generator as Faker;

$factory->define(Articulo::class, function (Faker $faker) {
    return [
        'codigo' => $faker->unique()->ean8,//codigo de barras
        'nombre' => $faker->name,
        'pvp' => $faker->randomFloat(2,0,9999),//2 digitos, hasta 9999
        'descripcion' => $faker->text(150),
        'valoracion' => $faker->randomFloat(1,0,5),//hasta 5 estrellas
        'marca_id' => function () {//TODO revisar esto
            return factory(App\Marca::class)->create()->id;
        },
        'categoria_id' => function () {//TODO revisar esto, que sean solo las categorias sin padre? hacer factories diferentes para category?
            return factory(App\Categoria::class)->create()->id;
        }
    ];
});
