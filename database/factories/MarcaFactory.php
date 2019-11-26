<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Marca;
use Faker\Generator as Faker;



$factory->define(Marca::class, function (Faker $faker) {
    $faker = Faker::create('es_ES');
    return [
        'nombre' => $faker->name,
        'empresa' => $faker->company,
        'logo' => $faker->imageUrl()
    ];
});
