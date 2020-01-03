<?php

namespace App\Http\Controllers\API;

use App\Articulo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListaDeseosController extends Controller
{
    //api/user/listadeseos GET
    public function index(Request $request)
    {
        $user = $request->user();

        return response()->json($user->articulos,200);
    }

    //api/user/listadeseos POST
    public function store(Request $request)
    {
        $user = $request->user();
        $articulo = Articulo::find($request->articulo_id);

        if(!$articulo)
            return response()->json(['message' => 'Articulo no existe'], 404);
        if($user->articulos()->find($request->articulo_id))
            return response()->json(['message' => 'Articulo ya existe en lista de deseos'], 400);

        $user->articulos()->save($articulo);
        return response()->json(null,201);
    }

    //api/user/listadeseos/{id} DELETE
    public function destroy($id, Request $request)
    {
        $user = $request->user();

        $articulo = Articulo::find($id);

        if(!$articulo)
            return response()->json(['message' => 'Articulo no existe'], 404);
        if(!$user->articulos()->find($id))
            return response()->json(['message' => 'Articulo no existe en lista de deseos'], 400);
       
        $user->articulos()->detach($id);
        return response()->json(null, 201);
    }
}
