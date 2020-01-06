<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Pedido;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $pedidos = $user->pedidos;
        $res = $pedidos->map(function ($item){
            return collect([
                'id' => $item->id,
                'fecha' => $item->fecha,
                'estado' => $item->estado,
                'articulos' => DB::table('lineas_pedidos')
                                ->join('articulos', 'lineas_pedidos.articulo_id' , '=', 'articulos.id')
                                ->where('pedido_id', '=', $item->id)
                                ->select('lineas_pedidos.id', 'articulos.pvp', 'articulos.nombre', 'lineas_pedidos.importe', 'lineas_pedidos.importe', 'lineas_pedidos.cantidad', 'lineas_pedidos.pedido_id')
                                ->get()
            ]);
        });
       
        return response()->json($res);
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

        $carrito = $user->pedidos()->where('estado', 'cesta')->first();

        //cambio el carrito a pedido...
        $carrito->update([
            'estado' => $request->estado
        ]);

        //crear nuevo carrito?
        return response()->json(null,201);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
