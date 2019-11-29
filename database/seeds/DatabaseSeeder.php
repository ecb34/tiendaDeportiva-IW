<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(App\User::class, 5)->create();
        factory(App\Direccione::class, 5)->create();
        factory(App\Pedido::class, 5)->create();
        factory(App\Marca::class, 5)->create();
        /*
        factory(App\Categoria::class, 5)->create();
        factory(App\Articulo::class, 5)->create();
        factory(App\LineaPedido::class, 5)->create();
        factory(App\Documento::class, 5)->create();
        factory(App\Imagene::class, 5)->create();
        factory(App\Comentario::class, 5)->create();
        s*/
    }
}
