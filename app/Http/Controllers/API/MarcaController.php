<?php

namespace App\Http\Controllers\API;

use App\Marca;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Marca as MarcaResource;
use Illuminate\Support\Facades\Validator;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marcas = MarcaResource::collection(Marca::all());

        return response()->json($marcas,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validarMarca($request);

        $marca = new Marca([
            'nombre' => $request->nombre,
            'empresa' => $request->empresa,
            'logo' => $request->logo
        ]);
        
        $marca->save();

        return response()->json($marca,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $this->validarMarca($request);
        $marca = Marca::find($id);
        if(!$marca){
            return response()->json(['message', 'marca no encontrada'],404);
        }
        $marca->update($request->all());

        return response()->json($marca,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $marca = Marca::find($id);

        if(!$marca){
            return response()->json(['message', 'marca no encontrada'],404);
        }
        $marca->delete();

        return response()->json(null,201);
    }

    private function validarMarca(Request $request){
        $validator = Validator::make($request->all(),[
            'nombre' => 'required',
            'empresa' => 'required',
            'logo' => 'nullable'
        ]);

        if($validator->fails()){
            return response()->json(['message', 'Error en el formulario', 'error' => $validator->getMessageBag()], 400);
        }
    }
}
