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
    'users' => 'API\UserController',
    'imagenes' => 'API\ImagenController',
    'documentos' => 'API\DocumentoController',
]);//excluye las rutas que devuelven html (create,edit...)
Route::get('categoriasrecomendadas', 'API\CategoriaController@categoriasRecomendadas');
Route::get('categoriassinhijos', 'API\CategoriaController@categoriassinhijos');

Route::group(['middleware' => 'auth:api'], function(){

    //lista deseos
    Route::get('user/listadeseos', 'API\ListaDeseosController@index');
    Route::post('user/listadeseos', 'API\ListaDeseosController@store');
    Route::delete('user/listadeseos/{id}', 'API\ListaDeseosController@destroy');
    
    Route::apiResources([
        'direcciones' => 'API\DireccionController',
        'user/pedidos' => 'API\PedidoController'
    ]);
    
    Route::get('user/carrito', 'API\PedidoController@showCarritoUser');
    Route::post('user/carrito', 'API\PedidoController@addArticuloCarrito');
    Route::post('user/carrito/restar', 'API\PedidoController@restarArticuloCarrito');
    Route::delete('user/carrito/{id}', 'API\PedidoController@borrarArticuloCarrito');
    
    //articulos
    Route::put('articulo/comentarios/{id}/bloquear', 'API\ArticuloController@bloquearComentarios');
    Route::get('articulo/{id}/comentarios', 'API\ArticuloController@mostrarComentarios');
    Route::post('articulo/comentar', 'API\ArticuloController@comentar');
    Route::delete('articulo/comentarios/{id}', 'API\ArticuloController@deleteComment');
});

///// Ejemplo///////
Route::group(['prefix' => 'auth'], function () {
    //Authentication routes
    Route::post('login', 'API\AuthController@login');
    Route::post('signup', 'API\AuthController@signup');

    //rutas en las que debe estar autenticado para acceder
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'Api\AuthController@logout');
        Route::get('user', 'Api\AuthController@user');
        Route::put('FormEditarPerfil', 'Api\AuthController@FormEditarPerfil');
    });
});


