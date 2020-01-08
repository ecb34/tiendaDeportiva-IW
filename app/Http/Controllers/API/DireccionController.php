<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Direccion as DireccionResource;
use Illuminate\Http\Request;
use App\Direccion;
use Illuminate\Support\Facades\Validator;

class DireccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();

        return DireccionResource::collection($user->direcciones);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $this->validarDireccion($request);

        $direccion = new Direccion([
            'linea1' => $request->linea1,
            'linea2' => $request->linea2,
            'cod_postal' => $request->cod_postal,
        ]);
        $user->direcciones()->save($direccion);

        return response()->json($direccion,200);
    }

    private function validarDireccion(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'linea1' => 'required',
            'linea2' => 'nullable',
            'cod_postal' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['message', 'Error en el formulario', 'error' => $validator->getMessageBag()], 400);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $direccion = $request->user()->direcciones()->find($id);

        if(!$direccion){
            return response()->json(['message', 'direccion no encontrada'],404);
        }

        return $direccion;
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
        $this->validarDireccion($request);
        
        $direccion = $request->user()->direcciones()->find($id);

        if(!$direccion){
            return response()->json(['message', 'direccion no encontrada'],404);
        }

        $direccion->update($request->all());

        return response()->json($direccion,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $direccion = $request->user()->direcciones()->find($id);

        if(!$direccion){
            return response()->json(['message', 'direccion no encontrada'],404);
        }

        $request->user()->direcciones()->detach($id);

        return response()->json(null,201);
    }
}
