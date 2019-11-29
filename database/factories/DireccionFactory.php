<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Direccion as Direccion;
use Faker\Generator as Faker;

$factory->define(Direccion::class, function (Faker $faker) {
    return [
        'linea1' => $faker->streetAddress,
        'linea2' => $faker->secondaryAddress,
        'cod_postal' => $faker->postcode
    ];
});
