<?php

use Illuminate\Http\Request;
use App\Http\Resources\Articulo as ArticuloResource;
use App\Articulo;

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

//

Route::resource('articulos', 'ArticuloController');
/*
Route::get('/articulos', function () {
    
    return ArticuloResource::collection(Articulo::all());
});*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/* ///// Ejemplo///////
Route::group(['prefix' => 'auth'], function () {
    //Authentication routes
    Route::post('login', 'Api\AuthController@login');
    Route::group(['middleware' => 'auth:api'], function() {
        Route::post('signup', 'Api\AuthController@signup');
        Route::get('logout', 'Api\AuthController@logout');
        Route::get('user', 'Api\AuthController@user');
    });
});


Route::get('/emergencies/assists', 'Api\EmergencyController@assists');
    //Emergency resource routes
    Route::resource('emergencies', 'Api\EmergencyController')->only([
        'index', 'store', 'show', 'update', 'edit', 'destroy'
    ]);
    */
