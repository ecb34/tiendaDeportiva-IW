<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema; // Para comprobar que las columnas del modelo y la BDD son correctas
use Tests\TestCase;
use App\Pedido;
use App\User;

class PedidoTest extends TestCase
{
    use RefreshDatabase, WithFaker; // Para evitar algunos conflictos entre tests.
    /** @test */
    public function pedidos_database_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns(
                'pedidos',
                ['id', 'fecha', 'estado', 'user_id']
            ),
        true);
    }

    /** @test para comprobar la relación "un pedido pertenece a un usuario" */
    public function un_pedido_pertenece_a_un_usuario()
    {
        // GIVEN
        $user = factory(User::class)->create();
        // WHEN
        $pedido = factory(Pedido::class)->create(['user_id'=>$user->id]);
        // THEN
        // Method 1: Un pedido tiene un usuario.
        $this->assertEquals($pedido->user->id, $user->id);
        // Method 2: Contar el numero de usuarios.
        $this->assertEquals(1, $pedido->user->count());
        // Method 3: Los usuarios estan relacionados con los pedidos y su propiedad es una instancia de pedidos
        $this->assertInstanceOf(User::class, $pedido->user);
    }
}