<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema; // Para comprobar que las columnas del modelo y la BDD son correctas
use Tests\TestCase;
use App\Articulo;
use App\Categoria;
use App\Comentario;
use App\Documento;
use App\Imagen;
use App\Marca;
use App\User;

class ArticuloTest extends TestCase
{
    use RefreshDatabase, WithFaker; // Para evitar algunos conflictos entre tests.
    /** @test */
    public function articulos_database_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns(
                'articulos',
                ['id', 'nombre', 'pvp', 'descripcion', 'valoracion', 'marca_id', 'categoria_id']
            ),
        true);
    }

    /**** INICIO Relaciones Articulos ****/
    
    /** @test para comprobar la relacion "un articulo tiene muchas imagenes" */
    public function un_articulo_tiene_muchas_imagenes()
    {
        // GIVEN
        $articulo = factory(Articulo::class)->create();
        // WHEN
        $imagenes = factory(Imagen::class, 5)->create(['articulo_id'=>$articulo->id]);   // Creo 5 imagenes para la articulo
        // THEN
        // Method 1: Una imagen existe en la colección de imagenes de una articulo.
        $this->assertTrue($articulo->imagenes->contains($imagenes[1]));
        // Method 2: Contar el numero de imagenes de la colección de imagenes del articulo.
        $this->assertEquals(5, $articulo->imagenes->count());
        // Method 3: Las imagenes estan relacionadas con los articulos y su collección es una instancia de imagenes
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $articulo->imagenes);
    }
    
    /** @test para comprobar la relación "un articulo pertenece a una marca" */
    public function un_articulo_pertenece_a_una_marca()
    {
        // GIVEN
        $marca = factory(Marca::class)->create();
        // WHEN
        $articulo = factory(Articulo::class)->create(['marca_id'=>$marca->id]);
        // THEN
        // Method 1: Un articulo tiene una marca.
        $this->assertEquals($articulo->marca->id, $marca->id);
        // Method 2: Contar el numero de marcas.
        $this->assertEquals(1, $articulo->marca->count());
        // Method 3: Las marcas estan relacionados con los articulos y su propiedad es una instancia de marca
        $this->assertInstanceOf(Marca::class, $articulo->marca);
    }
    
    /** @test para comprobar la relación "un articulo pertenece a una categoria" */
    public function un_articulo_pertenece_a_una_categoria()
    {
        // GIVEN
        $categoria = factory(Categoria::class)->create();
        // WHEN
        $articulo = factory(Articulo::class)->create(['categoria_id'=>$categoria->id]);
        // THEN
        // Method 1: Un articulo tiene una categoria.
        $this->assertEquals($articulo->categoria->id, $categoria->id);
        // Method 2: Contar el numero de categorias.
        //$this->assertEquals(1, $articulo->categoria->count());
        // Method 3: Las categorias estan relacionados con los articulos y su propiedad es una instancia de categoria
        $this->assertInstanceOf(Categoria::class, $articulo->categoria);
    }

    /** @test para comprobar la relación "un articulo tiene muchos comentarios" */
    public function un_articulo_tiene_muchos_comentarios()
    {
        // GIVEN
        $articulo = factory(Articulo::class)->create();
        $user = factory(User::class)->create();
        // WHEN
        $comentarios = factory(Comentario::class, 5)->create(['articulo_id'=>$articulo->id, 'user_id'=>$user->id]);   // Creo 5 comentarios para la articulo
        // THEN
        // Method 1: Una Comentario existe en la colección de comentarios de una articulo.
        $this->assertTrue($articulo->comentarios->contains($comentarios[1]));
        // Method 2: Contar el numero de comentarios de la colección de comentarios del articulo.
        $this->assertEquals(5, $articulo->comentarios->count());
        // Method 3: Las comentarios estan relacionadas con los articulos y su collección es una instancia de comentarios
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $articulo->comentarios);
    }

    /** @test para comprobar la relación "un articulo tiene muchos documentos" */
    public function un_articulo_tiene_muchos_documentos()
    {
        // GIVEN
        $articulo = factory(Articulo::class)->create();
        // WHEN
        $documentos = factory(Documento::class, 5)->create(['articulo_id'=>$articulo->id]);   // Creo 5 documentos para la articulo
        // THEN
        // Method 1: Una Documento existe en la colección de documentos de una articulo.
        $this->assertTrue($articulo->documentos->contains($documentos[1]));
        // Method 2: Contar el numero de documentos de la colección de documentos del articulo.
        $this->assertEquals(5, $articulo->documentos->count());
        // Method 3: Las documentos estan relacionadas con los articulos y su collección es una instancia de documentos
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $articulo->documentos);
    }

    // Falta la relacion con ListaDeseo...
    /**** FIN Relaciones Articulos ****/

}