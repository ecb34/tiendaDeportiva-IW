<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema; // Para comprobar que las columnas del modelo y la BDD son correctas
use Tests\TestCase;

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
}
