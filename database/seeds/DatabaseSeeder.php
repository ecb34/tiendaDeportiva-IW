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
        $users = factory(App\User::class, 5)->create();
        $users->each(function ($user) {
            $user
                ->pedidos()
                ->saveMany(
                    factory(App\Pedido::class, 3)->make()
                );
            $user
                ->direcciones()
                ->saveMany(
                    factory(App\Direccion::class, 3)->make()
                );
            
            /*$user//* GENERA MUCHOS ARTICULOS, TRATAR DE SOLUCIONAR
                ->comentarios()
                ->saveMany(
                    factory(App\Comentario::class, 3)->make()
                );*/
        });

        $marcas = factory(App\Marca::class,2)->create();
        $categorias = factory(App\Categoria::class,2)->create();
        for($i = 0; $i < count($marcas); ++$i) {
            for($j = 0; $j < count($categorias); ++$j) {    
                $articulos = factory(App\Articulo::class,2)->create();    
                $articulos->each(function ($articulo){
                    $articulo
                        ->imagenes()
                        ->saveMany(
                            factory(App\Imagen::class,3)->make()
                        );
                    $articulo
                        ->documentos()
                        ->saveMany(
                            factory(App\Documento::class,3)->make()
                        );
                });
                $categorias[$j]->articulos()->saveMany($articulos);
                $marcas[$i]->articulos()->saveMany($articulos);
            }      
        }

        /*
        lista deseos?
        comentarios
        factory(App\LineaPedido::class, 5)->create();
        */
    }
}
