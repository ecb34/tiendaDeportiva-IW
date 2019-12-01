<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema; // Para comprobar que las columnas del modelo y la BDD son correctas
use Tests\TestCase;
use App\Categoria;
use App\Articulo;

class CategoriaTest extends TestCase
{
    use RefreshDatabase, WithFaker; // Para evitar algunos conflictos entre tests.
    /** @test */
    public function categorias_database_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns(
                'categorias',
                ['id', 'nombre', 'categoria_padre_id']
            ),
        true);
    }

    /**** INICIO Relaciones Categorias ****/
    /** @test para comprobar la relación "una categoria tiene muchos articulos" */
    public function una_categoria_tiene_muchos_articulos()
    {
        // GIVEN
        $categoria = factory(Categoria::class)->create();
        // WHEN
        $articulos = factory(Articulo::class, 5)->create(['categoria_id'=>$categoria->id]);   // Creo 5 articulos para la categoria
        // THEN
        // Method 1: Un Articulo existe en la colección de articulos de una categoria.
        $this->assertTrue($categoria->articulos->contains($articulos[1]));
        // Method 2: Contar el numero de articulos de la colección de articulos de la categoria.
        $this->assertEquals(5, $categoria->articulos->count());
        // Method 3: Los articulos estan relacionados con las categorias y su collección es una instancia de articulos
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $categoria->articulos);
    }

    /** @test para comprobar la relación "una subcategoria pertenece a una categoria" */
    public function una_categoria_pertenece_a_una_categoria()
    {
        // GIVEN
        $categoria = factory(Categoria::class)->create();
        // WHEN
        $subcategoria = factory(Categoria::class)->create(['categoria_padre_id'=>$categoria->id]);
        // THEN
        // Method 1: Una subcategoria tiene una categoria.
        $this->assertEquals($subcategoria->categoria->id, $categoria->id);
        // Method 2: Contar el numero de categorias.
        $this->assertEquals(1, $subcategoria->categoria->count());
        // Method 3: Las categorias estan relacionados con las subcategoria y su propiedad es una instancia de categoria
        $this->assertInstanceOf(Categoria::class, $subcategoria->categoria);
    }

    /** @test para comprobar la relación "una categoria tiene muchos articulos" */
    public function una_categoria_tiene_muchas_subcategorias()
    {
        // GIVEN
        $categoria = factory(Categoria::class)->create();
        // WHEN
        $subcategorias = factory(Categoria::class, 5)->create(['categoria_padre_id'=>$categoria->id]);   // Creo 5 subcategorias para la categoria
        // THEN
        // Method 1: Una subcategoria existe en la colección de subcategorias de una categoria.
        $this->assertTrue($categoria->subcategorias->contains($subcategorias[1]));
        // Method 2: Contar el numero de subcategorias de la colección de subcategorias de la categoria.
        $this->assertEquals(5, $categoria->subcategorias->count());
        // Method 3: Los subcategorias estan relacionados con las categorias y su collección es una instancia de subcategorias
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $categoria->subcategorias);
    }
    /**** FIN Relaciones Categorias ****/
}
