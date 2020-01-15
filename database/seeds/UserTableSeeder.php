<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'user1@deporte.com',
            'nombre' => 'User1',
            'apellido' => 'User1 Apellido',
            'telefono' => '123456789',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'fecha_nacimiento' => now(),
            'rol' => 'usuario',
            'remember_token' => Str::random(10),

        ]);
        DB::table('users')->insert([
            'email' => 'user2@deporte.com',
            'nombre' => 'User2',
            'apellido' => 'User2 Apellido',
            'telefono' => '123456789',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'fecha_nacimiento' => now(),
            'rol' => 'usuario',
            'remember_token' => Str::random(10),
             
        ]);
        DB::table('users')->insert([
            'email' => 'admin@deporte.com',
            'nombre' => 'Admin',
            'apellido' => 'Admin Apellido',
            'telefono' => '123456789',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'fecha_nacimiento' => now(),
            'rol' => 'admin',
            'remember_token' => Str::random(10),
             
        ]);
    }
}
