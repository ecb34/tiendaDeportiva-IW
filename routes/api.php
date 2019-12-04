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

Route::get('/articulos', function () {
    return ArticuloResource::collection(Articulo::all());
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
