<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema; // Para comprobar que las columnas del modelo y la BDD son correctas
use Tests\TestCase;
use App\Documento;
use App\Articulo;

class DocumentoTest extends TestCase
{
    use RefreshDatabase, WithFaker; // Para evitar algunos conflictos entre tests.
    /** @test */
    public function documentos_database_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns(
                'documentos',
                ['id', 'nombre', 'url', 'articulo_id']
            ),
        true);
    }

    /**** INICIO Relaciones Documentos ****/
    /** @test para probar la relación "un documento pertenece a un articulo" */
    public function un_documento_pertenece_a_un_articulo()
    {
        // GIVEN
        $articulo = factory(Articulo::class)->create();
        // WHEN
        $documento = factory(Documento::class)->create(['articulo_id'=>$articulo->id]);
        // THEN
        // Method 1: Un documento tiene un articulo.
        $this->assertEquals($documento->articulo->id, $articulo->id);
        // Method 2: Contar el numero de articulos.
        $this->assertEquals(1, $documento->articulo->count());
        // Method 3: Los articulos estan relacionados con los documentos y su propiedad es una instancia de articulo
        $this->assertInstanceOf(Articulo::class, $documento->articulo);
    }
    /**** FIN Relaciones Documentos ****/
}
