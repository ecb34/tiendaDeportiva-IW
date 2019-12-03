<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema; // Para comprobar que las columnas del modelo y la BDD son correctas
use Tests\TestCase;
use App\Direccion;
use App\User;

class DireccionTest extends TestCase
{
    use RefreshDatabase, WithFaker; // Para evitar algunos conflictos entre tests.
    /** @test */
    public function direcciones_database_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns(
                'direcciones',
                ['id', 'linea1', 'linea2', 'cod_postal']
            ),
        true);
    }
    
    /**** INICIO Relaciones Direcciones ****/
    /** @test para probar la relación "una dirección pertenece a muchos usuarios" */
    public function una_direccion_pertenece_a_muchos_usuarios()
    {
        // GIVEN
        $user = factory(User::class)->create();
        $direccion = factory(Direccion::class)->create();
        // WHEN
        // THEN
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $direccion->users);
    }
    /**** FIN Relaciones Direcciones ****/
}
