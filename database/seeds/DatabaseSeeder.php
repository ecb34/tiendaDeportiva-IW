<?php

use App\Categoria;
use App\User;
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

        /******users y direcciones*******/
        $this->call(UserTableSeeder::class);
        $users = factory(App\User::class, 5)->create();
        $users->each(function ($user) {
            $user
                ->direcciones()
                ->saveMany(
                    factory(App\Direccion::class, 3)->make()
                );
        });

        /*************Marcas, categorias,articulos,imagenes, documentos y comentarios*****/
        $marcas = factory(App\Marca::class,2)->create();
        //$categorias = factory(App\Categoria::class,2)->create();
        $this->call(CategoriaTableSeeder::class);
        $categorias = Categoria::has('children','=',0)->get();
        $categoriasPadre = Categoria::whereNull('categoria_id')->get();
        for($i = 0; $i < count($categoriasPadre); ++$i){
            $categoriasPadre[$i]->imagen()->associate(factory(App\Imagen::class)->create()->id);
            $categoriasPadre[$i]->save();
        }
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

                //agregar comentarios
                $indexArticulo = rand(0, count($articulos) -1);
                $indexUser = rand(0,count($users) -1);
                $comentarios = factory(App\Comentario::class,2)->create([
                    'articulo_id'=>$articulos[$indexArticulo]->id,
                    'user_id'=>$users[$indexUser]->id 
                ]);
                $valoracion = 0.0;
                foreach($comentarios as $comentario){
                    $valoracion += $comentario->valoracion;
                }
                if($valoracion != 0.0){
                    $articulos[$indexArticulo]->update([
                        'valoracion' => $valoracion / count($comentarios)
                    ]);
                }
                
                //agregar lista deseos, a user aleatorio el articulo aleatorio
                $users[$indexUser]->articulos()->save($articulos[$indexArticulo]);
                
                //pedidos y lineas pedidos
                $pedidos = factory(App\Pedido::class,2)->create([
                    'user_id' => $users[$indexUser]->id
                ]);
                for($k = 0; $k < count($pedidos); ++$k){
                    factory(App\LineaPedido::class)->create([
                        'articulo_id' => $articulos[$indexArticulo]->id,
                        'pedido_id' => $pedidos[$k]->id
                    ]);
                }
            }      
        }
    }

}
