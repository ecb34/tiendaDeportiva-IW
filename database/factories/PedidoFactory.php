<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Pedido;
use Faker\Generator as Faker;

$factory->define(Pedido::class, function (Faker $faker) {
    return [
        'fecha' => $faker->dateTimeThisDecade,
        'estado' => function(){
            $estados = array('cesta', 'pendiente', 'en proceso', 'servido', 'pagado', 'cancelado');
            $randIndex = array_rand($estados);
            return $estados[$randIndex];       
        },
        'user_id' => function(){//TODO revisar esto
            return factory(App\User::class)->create()->id;
        }
    ];
});
