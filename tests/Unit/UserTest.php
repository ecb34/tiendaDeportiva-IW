<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema; // Para comprobar que las columnas del modelo y la BDD son correctas
use Tests\TestCase;
use App\User;
use App\Pedido;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker; // Para evitar algunos conflictos entre tests.
    /** @test */
    public function users_database_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns(
                'users',
                ['id', 'email', 'apellido', 'telefono', 'fecha_nacimiento','rol','password']
            ),
        true);
    }

    /** @test para comprobar la relacion "un usuario tiene muchos pedidos" */
    public function un_usuario_tiene_muchos_pedidos()
    {
        // GIVEN
        $user = factory(User::class)->create();
        // WHEN
        $pedidos = factory(Pedido::class, 5)->create(['user_id'=>$user->id]);   // Creo 5 pedidos para el usuario
        // THEN
         // Method 1: Un pedido existe en la colección de pedidos de un usuario.
         $this->assertTrue($user->pedidos->contains($pedidos[1]));
         // Method 2: Contar el numero de pedidos de la colección de pedidos del usuario.
         $this->assertEquals(5, $user->pedidos->count());
         // Method 3: Los pedidos estan relacionados con los usuarios y su collección es una instancia de pedidos
         $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->pedidos);
    }
}
