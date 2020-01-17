<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Articulo as ArticuloResource;
use App\Articulo;
use App\Comentario;
use App\Imagen;
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
        if($request->query('destacados') == 'home'){
            return Articulo::orderBy('valoracion', 'desc')->with('imagenes')->take(12)->get();
        }else if($request->query('destacados') == 'detalle'){
            return Articulo::where('marca_id', $request->query('marca'))->orderBy('valoracion','desc')->with('imagenes')->take(4)->get();
        }
        return Articulo::with('imagenes')->get();
    }

    protected function validarArticulo(Request $request){
        $validator = Validator::make($request->all(), [
            'codigo' => 'required|unique:articulos',
            'pvp' => 'required',
            'nombre' => 'required',
            'descripcion' => 'nullable|max:150',
            'marca_id' => 'nullable',
            'categoria_id' => 'nullable',
            'genero' => 'nullable',
            'valoracion'=> 'required',
            'imagenes' => 'nullable'
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
            'genero' => $request->genero,
            'valoracion'=> 0
        ]);
        
        if($request->imagenes[0]!=null)
            foreach($request->imagenes as $imagenes){
                $articulo->imagenes()->save(new Imagen([
                    'nombre' => $imagenes,
                    'url' => $imagenes
                ]));
            }
        
        $articulo->save();

        return response()->json($articulo, 201);//el 201 es no content
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $articulo = Articulo::find($id);

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

    protected function setValoracion($articulo){
        // SET VALORACION
        $comentarios = $articulo->comentarios;
        $valoracion = 0;

        if(count($comentarios) > 0){
            foreach($comentarios as $comentario) 
            {
                $valoracion += $comentario->valoracion;
            }
            $articulo->update([
                'valoracion' => $valoracion/count($comentarios)
            ]);
        } else {
            $articulo->update([
                'valoracion' => 0
            ]);
        }
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
        $this->setValoracion($articulo);
        
        return response()->json([$comentario,$articulo->valoracion],200);
    }

    public function mostrarComentarios($id){
        $comentarios = Articulo::find($id)->comentarios;

        return response()->json($comentarios, 200);
    }

    public function bloquearComentarios($id){
        $comentario = Comentario::find($id);

        if(!$comentario)
            return response()->json(['message' => 'Comentario no existe'], 404);
        
        $comentario->update([
            'bloqueado' => !$comentario->bloqueado
        ]);

        return response()->json($comentario, 200);
    }

    /**
     * Quitar un comentario.
     */
    public function deleteComment(Request $request, $id){
        $comentario = Comentario::find($id);
        
        if(!$comentario)
            return response()->json(['message' => 'Comentario no existe'], 404);
        
        $articulo = $comentario->articulo;
        $comentario->delete();
        
        $this->setValoracion($articulo);
        
        return response()->json($articulo->valoracion,201);
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
