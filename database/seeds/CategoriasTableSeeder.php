<?php

use App\Categoria;
use App\Helpers\SeederHelper;
use Illuminate\Database\Seeder;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $fileName = "CategoriasData";
        $JsonArray = SeederHelper::retrieveJsonData($fileName);

        foreach($JsonArray as $data) {
            $categoria = new Categoria();
            $categoria->id = $data['id'];
            $categoria->name = $data['name'];
            $categoria->categoria_id = $data['categoria_id'];
            $categoria->save();
        }
        
    }
}
