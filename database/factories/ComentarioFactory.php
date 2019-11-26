<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comentario;
use Faker\Generator as Faker;

$factory->define(Comentario::class, function (Faker $faker) {
    return [
        'texto' => $faker->text(150),//max numero caracteres
        'valoracion' => $faker->randomFloat(1,0,5),//para que solo tenga un decimal
        'articulo_id' => function () {//TODO revisar esto
            return factory(App\Articulo::class)->create()->id;
        },
        'usuario_id' => function () {//TODO revisar esto
            return factory(App\User::class)->create()->id;
        }

    ];
});
