<?php

namespace App\Http\Controllers\API;

use App\Categoria;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Categoria as CategoriaResource;
use Illuminate\Support\Facades\Validator;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $children = Categoria::whereNull('categoria_id')
            ->with('children')
            ->get();
        return response()->json($children);
    }

    public function categoriassinhijos()
    {
        $categorias = Categoria::has('children','=',0)->get();
        return response()->json($categorias);
    }

    public function categoriasRecomendadas()
    {
        //solo queremos las categorias padre
        return response()->json(Categoria::whereNull('categoria_id')->with('imagen')->take(4)->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // VALIDAR INSERT
        $existe = Categoria::where(
            ['categoria_id' => $request->padre_id,
             'name' => $request->categoria
            ])->first();
        
        if($existe) {
            $error = "Error, la categoria ya existe";
            return response()->json($error, 400);
        }
        
        $categoria = new Categoria([
            'name' => $request->categoria,
            'categoria_id' => $request->padre_id
        ]);

        $categoria->save();

        $tree = Categoria::whereNull('categoria_id')
        ->with('children')
        ->get();

        return response()->json($tree, 201);//el 201 es no content
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoria = Categoria::find($id);

        return new CategoriaResource($categoria);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // VALIDAR UPDATE
        $existe = Categoria::find($request->categoria->id);
        return response()->json($existe, 400);
        if(!$existe) {
            $error = "Error, la categoria NO existe";
            return response()->json($error, 400);
        }

        $existe->name = $request->categoria->name;
        $existe->update();

        $tree = Categoria::whereNull('categoria_id')
        ->with('children')
        ->get();

        return response()->json($tree, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // VALIDAR DELETE
        $categoria = Categoria::find($id);
        if(!$categoria){
            $error = "Error, la categoria NO existe";
            return response()->json($error, 400);
        }
        $categoria->delete();

        $tree = Categoria::whereNull('categoria_id')
        ->with('children')
        ->get();

        return response()->json($tree,201);
    }
}
