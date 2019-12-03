<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Imagen as Imagen;
use Faker\Generator as Faker;

$factory->define(Imagen::class, function (Faker $faker) {
    $faker->addProvider(new \Bezhanov\Faker\Provider\Avatar($faker));
    return [
        'nombre' => $faker->name,
        'url' => $faker->avatar,
    ];
});
