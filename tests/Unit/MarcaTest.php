<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema; // Para comprobar que las columnas del modelo y la BDD son correctas
use Tests\TestCase;
use App\Marca;
use App\Articulo;

class MarcaTest extends TestCase
{
    use RefreshDatabase, WithFaker; // Para evitar algunos conflictos entre tests.
    /** @test */
    public function marcas_database_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns(
                'marcas',
                ['id', 'nombre', 'empresa', 'logo']
            ),
        true);
    }

    /** @test para comprobar la relacion "una marca tiene muchos articulos" */
    public function una_marca_tiene_muchos_articulos()
    {
        // GIVEN
        $marca = factory(Marca::class)->create();
        // WHEN
        $articulos = factory(Articulo::class, 5)->create(['marca_id'=>$marca->id]);   // Creo 5 articulos para la marca
        // THEN
        // Method 1: Un articulo existe en la colección de articulos de una marca.
        $this->assertTrue($marca->articulos->contains($articulos[1]));
        // Method 2: Contar el numero de articulos de la colección de articulos de la marca.
        $this->assertEquals(5, $marca->articulos->count());
        // Method 3: Las marcas estan relacionadas con los articulos y su collección es una instancia de articulos
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $marca->articulos);
    }
}
