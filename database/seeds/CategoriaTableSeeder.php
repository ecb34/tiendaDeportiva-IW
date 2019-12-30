<?php

use Illuminate\Database\Seeder;

class CategoriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            'name' => 'futbol'
        ]);
        DB::table('categorias')->insert([
            'name' => 'tenis'
        ]);
        DB::table('categorias')->insert([
            'name' => 'baloncesto'
        ]);
        DB::table('categorias')->insert([
            'name' => 'zapatos',
            'categoria_id' => 1
        ]);

        DB::table('categorias')->insert([
            'name' => 'botas',
            'categoria_id' => 4
        ]);

        DB::table('categorias')->insert([
            'name' => 'futbol sala',
            'categoria_id' => 4
        ]);

        DB::table('categorias')->insert([
            'name' => 'accesorios',
            'categoria_id' => DB::table('categorias')->where('name','tenis')->value('id')
        ]);
        DB::table('categorias')->insert([
            'name' => 'raquetas',
            'categoria_id' => DB::table('categorias')->where('name','accesorios')->value('id')
        ]);
    }
}
