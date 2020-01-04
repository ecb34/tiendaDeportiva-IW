<?php

namespace App\Http\Controllers\API;

use App\Pedido;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Pedido as PedidoResource;
use App\LineaPedido;
use DateTime;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
        return new PedidoResource($pedido);
    }

    //FUNCIONA
    public function showCarritoUser(Request $request)
    {
        $user = $request->user();
        $carrito = $user->pedidos()->where('estado', 'cesta')->get();

        if (count($carrito) == 0) {
            $carrito = new Pedido([
                'estado' => 'cesta',
                'fecha' => new DateTime()
            ]);

            $user->pedidos()->save($carrito);
        }
        return $carrito;
    }

    public function addArticuloCarrito(Request $request)
    {
        $user = $request->user();
        $carrito = $user->pedidos()->where('estado', 'cesta')->first();
        $importe = $request->cantidad * $request->pvp;
        $linea = new LineaPedido([
            'importe' => $importe,
            'cantidad' => $request->cantidad,
            'articulo_id' => $request->articulo_id,
            'pedido_id' => $carrito->id
        ]);
        $linea->save();

        return $carrito;
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
