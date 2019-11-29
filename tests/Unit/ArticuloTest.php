<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema; // Para comprobar que las columnas del modelo y la BDD son correctas
use Tests\TestCase;

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
}