<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('imagen_id')->nullable()->unsigned();
            $table->foreign('imagen_id')->references('id')->on('imagenes')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
        Schema::table('categorias', function (Blueprint $table) 
        {
            $table->integer('categoria_id')->nullable()->unsigned();
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorias');
    }
}
