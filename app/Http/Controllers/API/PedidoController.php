<?php

namespace App\Http\Controllers\API;

use App\Pedido;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Pedido as PedidoResource;
use App\LineaPedido;
use DateTime;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $pedidos = $user->pedidos;
        $res = $pedidos->where('estado','!=','cesta')->map(function ($item) {
            return collect([
                'id' => $item->id,
                'fecha' => $item->fecha,
                'estado' => $item->estado,
                'articulos' => DB::table('lineas_pedidos')
                    ->join('articulos', 'lineas_pedidos.articulo_id', '=', 'articulos.id')
                    ->where('pedido_id', '=', $item->id)
                    ->select('lineas_pedidos.id', 'articulos.pvp', 'articulos.nombre', 'lineas_pedidos.importe', 'lineas_pedidos.importe', 'lineas_pedidos.cantidad', 'lineas_pedidos.pedido_id')
                    ->get()
            ]);
        });

        return response()->json($res);
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
    public function show(Pedido $pedido)
    {
        return new PedidoResource($pedido);
    }

    //FUNCIONA
    public function showCarritoUser(Request $request)
    {
        $user = $request->user();
        $carrito = $user->pedidos()->where('estado', 'cesta')->with('lineapedidos.articulo')->first();

        if (!$carrito) {
            $carrito = $this->crearCarrito($user);
        }
        //return $carrito;
        return new PedidoResource($carrito);
    }

    public function addArticuloCarrito(Request $request)
    {
        $user = $request->user();
        $carrito = $user->pedidos()->where('estado', 'cesta')->first();
        if (!$carrito) {
            $carrito = $this->crearCarrito($user);
        }

        //miramos si existe una linea de pedido con el articulo a añadir...
        $lineaPedido = $carrito->lineaPedidos()->where('articulo_id', $request->articulo_id)->first();
        //si existe la linea de pedido, actualizar el importe y cantidad, sino crear una nueva
        if ($lineaPedido) {
            $lineaPedido->update([
                'cantidad' => $lineaPedido->cantidad + 1,
                'importe' => $request->pvp * ($lineaPedido->cantidad + 1)
            ]);
        } else {
            $lineaPedido = new LineaPedido([
                'importe' => $request->cantidad * $request->pvp,
                'cantidad' => $request->cantidad,
                'articulo_id' => $request->articulo_id,
                'pedido_id' => $carrito->id
            ]);
            $lineaPedido->save();
        }
        return response()->json(['importe' => $lineaPedido->importe], 200);
    }

    public function restarArticuloCarrito(Request $request)
    {
        $user = $request->user();
        $carrito = $user->pedidos()->where('estado', 'cesta')->first();

        //no existe carrito...
        if (!$carrito) {
            return response()->json(['message', 'Carrito no existe'], 404);
        }

        $lineaPedido = $carrito->lineaPedidos()->where('articulo_id', $request->articulo_id)->first();
        //no existe linea de pedido con ese articulo...
        if (!$lineaPedido) {
            return response()->json(['message', 'Articulo no existe'], 404);
        }


        $cantidad = $lineaPedido->cantidad - 1;

        if ($cantidad < 1) {
            $lineaPedido->delete();
            return response()->json(null,201);
        } else {
            $lineaPedido->cantidad = $cantidad;
            $lineaPedido->importe = $lineaPedido->importe - $request->pvp;
            $lineaPedido->save();
            return response()->json(['importe' => $lineaPedido->importe], 200);
        }     
    }

    public function borrarArticuloCarrito(Request $request, $id)
    {
        $user = $request->user();
        $carrito = $user->pedidos()->where('estado', 'cesta')->first();

        //no existe carrito...
        if (!$carrito) {
            return response()->json(['message', 'Carrito no existe'], 404);
        }

        $lineaPedido = $carrito->lineaPedidos()->where('articulo_id', $id)->first();
        //no existe linea de pedido con ese articulo...
        if (!$lineaPedido) {
            return response()->json(['message', 'Articulo no existe'], 404);
        }

        $lineaPedido->delete();

        return response()->json(null, 201);
    }


    private function crearCarrito($user)
    {
        $carrito = new Pedido([
            'estado' => 'cesta',
            'fecha' => new DateTime()
        ]);

        $user->pedidos()->save($carrito);

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
