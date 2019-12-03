<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema; // Para comprobar que las columnas del modelo y la BDD son correctas
use Tests\TestCase;
use App\Comentario;
use App\Articulo;
use App\User;

class ComentarioTest extends TestCase
{
    use RefreshDatabase, WithFaker; // Para evitar algunos conflictos entre tests.
    /** @test */
    public function comentarios_database_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns(
                'comentarios',
                ['id', 'texto', 'valoracion', 'articulo_id', 'user_id']
            ),
        true);
    }

    /**** INICIO Relaciones Comentarios ****/
    /** @test para comprobar la relación "un comentario pertenece a un articulo" */
    public function un_comentario_pertenece_a_un_articulo()
    {
        // GIVEN
        $articulo = factory(Articulo::class)->create();
        $user = factory(User::class)->create();
        // WHEN
        $comentario = factory(Comentario::class)->create(['articulo_id'=>$articulo->id, 'user_id'=>$user->id]);
        // THEN
        // Method 1: Un comentario tiene un articulo.
        $this->assertEquals($comentario->articulo->id, $articulo->id);
        // Method 2: Contar el numero de articulos.
        $this->assertEquals(1, $comentario->articulo->count());
        // Method 3: Los articulos estan relacionados con los comentarios y su propiedad es una instancia de articulo
        $this->assertInstanceOf(Articulo::class, $comentario->articulo);
    }
    
    /** @test para comprobar la relación "un comentario pertenece a un usuario" */
    public function un_comentario_pertenece_a_un_usuario()
    {
        // GIVEN
        $articulo = factory(Articulo::class)->create();
        $user = factory(User::class)->create();
        // WHEN
        $comentario = factory(Comentario::class)->create(['user_id'=>$user->id, 'articulo_id'=>$articulo->id]);
        // THEN
        // Method 1: Un comentario tiene un usuario.
        $this->assertEquals($comentario->user->id, $user->id);
        // Method 2: Contar el numero de usuarios.
        $this->assertEquals(1, $comentario->user->count());
        // Method 3: Los usuarios estan relacionados con los comentarios y su propiedad es una instancia de comentarios
        $this->assertInstanceOf(User::class, $comentario->user);
    }
    /**** FIN Relaciones Comentarios ****/
}