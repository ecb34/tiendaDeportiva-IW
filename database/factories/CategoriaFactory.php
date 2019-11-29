<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Categoria;
use Faker\Generator as Faker;

$factory->define(Categoria::class,function (Faker $faker) {
    $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));
    return [
        'nombre' => $faker->unique()->department,
        'categoria_padre_id' => function () {//TODO revisar esto
            if(rand(0,2) != 2){
                return;
            }else{
                return factory(App\Categoria::class)->create()->id;
            }
        }
    ];
});
