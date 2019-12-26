<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Articulo as ArticuloResource;
use App\Articulo;
use Illuminate\Support\Facades\Validator;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ArticuloResource::collection(Articulo::all());
    }


    protected function validarArticulo(Request $request){
        $validator = Validator::make($request->all(), [
            'codigo' => 'required|unique',
            'pvp' => 'required',
            'nombre' => 'required',
            'descripcion' => 'nullable|max:150',
            'marca_id' => 'nullable',
            'categoria_id' => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Errores en el formulario', 'error' => $validator->getMessageBag()], 400);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validarArticulo($request);

        $articulo = new Articulo([
            'codigo'     => $request->codigo,
            'nombre' => $request->nombre,
            'pvp' => $request->pvp,
            'descripcion' => $request->descripcion,
            'marca_id' => $request->marca_id,
            'categoria_id' => $request->categoria_id,
        ]);

        $articulo->save();

        return response()->json(null, 201);//el 201 es no content
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Articulo $articulo)
    {
        return new ArticuloResource($articulo);
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
        $this->validarArticulo($request);
        Articulo::find($id)->update($request->all());

        return response()->json(null, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Articulo::find($id)->delete();
        return response()->json(null, 201);
    }
}
