<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Marca;
use Faker\Generator as Faker;



$factory->define(Marca::class, function (Faker $faker) {
    $faker->addProvider(new \Bezhanov\Faker\Provider\Team($faker));
    return [
        'nombre' => $faker->team,
        'empresa' => $faker->company,
        'logo' => $faker->imageUrl()
    ];
});
