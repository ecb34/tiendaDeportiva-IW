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


//por ahora cualquiera puede acceder a ellas
Route::apiResources([
    'articulos' => 'API\ArticuloController',
    'categorias'=> 'API\CategoriaController',
    'marcas' => 'API\MarcaController',
    'users' => 'API\UserController'
]);//excluye las rutas que devuelven html (create,edit...)


///// Ejemplo///////
Route::group(['prefix' => 'auth'], function () {
    //Authentication routes
    Route::post('login', 'API\AuthController@login');
    Route::post('signup', 'API\AuthController@signup');

    //rutas en las que debe estar autenticado para acceder
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'Api\AuthController@logout');
        Route::get('user', 'Api\AuthController@user');
    });
});


