<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Articulo as ArticuloResource;
use App\Articulo;
use App\Comentario;
use Illuminate\Support\Facades\Validator;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->query('destacados')){
            return Articulo::orderBy('valoracion', 'desc')->with('imagenes')->take(12)->get();
        }
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

    public function comentar(Request $request)
    {
        $user = $request->user();
        $articulo = Articulo::find($request->articulo_id);
        
        if(!$articulo)
            return response()->json(['message' => 'Articulo no existe'], 404);
        $comentario = null;
        if($request->comentario_id!=-1) { // Es que se ha decidido editar el comentario
            $comentario = Comentario::find($request->comentario_id);
            $comentario->texto = $request->comentario;
            $comentario->valoracion = $request->valoracion;
        } else {    // Es un nuevo comentario
            $comentario = new Comentario([
                'texto' => $request->comentario,
                'valoracion' => $request->valoracion,
                'articulo_id' => $articulo->id,
                'user_id' => $user->id
            ]);
        }
        $comentario->save();
        /* SET VALORACION
        $comentarios = $articulo->comentarios();
        $valoracion = 0;
        foreach($comentarios as $comentario) 
        {
            $valoracion += $comentario->valoracion;
        }
        $numComentarios = count($comentarios);
        if($numComentarios>0){
            $articulo->valoracion = $valoracion/$numComentarios;
            $articulo->update();
        } else {
            $articulo->valoracion = 0;
            $articulo->update();
        }*/
        if($articulo->valoracion==0) {
            $articulo->valoracion = $request->valoracion;
        } else {
            $articulo->valoracion = ($articulo->valoracion+$request->valoracion)/2;
        }
        $articulo->update();

        return response()->json(null,201);
    }

    /**
     * Quitar un comentario.
     */
    public function deleteComment(Request $request){
        $comentario = Comentario::find($request->comentario_id);
        
        if(!$comentario)
            return response()->json(['message' => 'Comentario no existe'], 404);
        
        $comentario->delete();
        
        return response()->json(null,201);
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
