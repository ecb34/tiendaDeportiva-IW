<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema; // Para comprobar que las columnas del modelo y la BDD son correctas
use Tests\TestCase;
use App\Imagen;
use App\Articulo;

class ImagenTest extends TestCase
{
    use RefreshDatabase, WithFaker; // Para evitar algunos conflictos entre tests.
    /** @test */
    public function imagenes_database_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns(
                'imagenes',
                ['id', 'nombre', 'url', 'articulo_id']
            ),
        true);
    }

    /**** INICIO Relaciones Imagenes ****/
    /** @test para probar la relación "una imagen pertenece a un articulo" */
    public function articulo()
    {
        // GIVEN
        $articulo = factory(Articulo::class)->create();
        // WHEN
        $imagen = factory(Imagen::class)->create(['articulo_id'=>$articulo->id]);
        // THEN
        // Method 1: Un imagen tiene un articulo.
        $this->assertEquals($imagen->articulo->id, $articulo->id);
        // Method 2: Contar el numero de articulos.
        $this->assertEquals(1, $imagen->articulo->count());
        // Method 3: Los articulos estan relacionados con las imagens y su propiedad es una instancia de articulo
        $this->assertInstanceOf(Articulo::class, $imagen->articulo);
    }
    /**** FIN Relaciones Imagenes ****/
}
