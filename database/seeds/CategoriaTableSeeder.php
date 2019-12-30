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
        $idFutbol = DB::table('categorias')->insertGetId([
            'name' => 'futbol'
        ]);
        
        $idTenis = DB::table('categorias')->insertGetId([
            'name' => 'tenis'
        ]);

        $idBaloncesto = DB::table('categorias')->insertGetId([
            'name' => 'baloncesto'
        ]);
        
        $idZapatos = DB::table('categorias')->insertGetId([
            'name' => 'zapatos',
            'categoria_id' => $idFutbol
        ]);

        $idEntrenamiento = DB::table('categorias')->insertGetId([
            'name' => 'materiales entrenamiento',
            'categoria_id' => $idFutbol
        ]);

        DB::table('categorias')->insert([
            'name' => 'porterias y redes',
            'categoria_id' => $idEntrenamiento
        ]);

        DB::table('categorias')->insert([
            'name' => 'mochilas y maletas',
            'categoria_id' => $idEntrenamiento
        ]);

        DB::table('categorias')->insert([
            'name' => 'accesorios entrenamiento',
            'categoria_id' => $idEntrenamiento
        ]);

        DB::table('categorias')->insert([
            'name' => 'botas',
            'categoria_id' => $idZapatos
        ]);

        DB::table('categorias')->insert([
            'name' => 'botas futbol sala',
            'categoria_id' => $idZapatos
        ]);

        $idAccesorios = DB::table('categorias')->insertGetId([
            'name' => 'accesorios',
            'categoria_id' => $idTenis
        ]);
        DB::table('categorias')->insert([
            'name' => 'raquetas',
            'categoria_id' => $idAccesorios
        ]);

        DB::table('categorias')->insert([
            'name' => 'pelotas',
            'categoria_id' => $idAccesorios
        ]);

        $idmaterial = DB::table('categorias')->insertGetId([
            'name' => 'material',
            'categoria_id' => $idBaloncesto
        ]);

        DB::table('categorias')->insert([
            'name' => 'mochilas',
            'categoria_id' => $idmaterial
        ]);

        DB::table('categorias')->insert([
            'name' => 'balones',
            'categoria_id' => $idBaloncesto
        ]);

        DB::table('categorias')->insert([
            'name' => 'canastas',
            'categoria_id' => $idBaloncesto
        ]);

        DB::table('categorias')->insert([
            'name' => 'zapatos',
            'categoria_id' => $idBaloncesto
        ]);
    }
}
