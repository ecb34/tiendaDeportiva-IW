<?php

use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResources([
    'articulos' => 'API\ArticuloController',
    'categorias'=> 'API\CategoriaController',
    'marcas' => 'API\MarcaController',
    'users' => 'API\UserController'
    ]);//excluye las rutas que devuelven html (create,edit...)


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
