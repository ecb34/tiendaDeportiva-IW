<?php

namespace App\Http\Controllers\API;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
            'nombre'     => 'required|string',
            'email'    => 'required|string|email|unique:users',
            'fecha_nacimiento' => 'date',
            'password' => 'required|string|confirmed',
        ]);
        $user = new User([
            'nombre'     => $request->nombre,
            'email'    => $request->email,
            'apellido' => $request->apellido,
            'fecha_nacimiento' => $request->fechaNacimiento,
            'telefono' => $request->telefono,
            'password' => bcrypt($request->password),
        ]);
        $user->save();
        return response()->json(['mensaje' => 'Usuario creado correctamente'], 201);
    }    
    
    public function login(Request $request)
    {
        $request->validate([
            'email'       => 'required|string|email',
            'password'    => 'required|string',
            'remember_me' => 'boolean',
        ]);

        $credentials = request(['email', 'password']);
        
        if (!Auth::attempt($credentials)) {
            return response()->json(['mensaje' => 'No Autorizado'], 401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type'   => 'Bearer',
            'expires_at'   => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['mensaje' =>'Cerrada sesión correctamente']);
    }

    public function FormEditarPerfil(Request $request) {
        $user = $request->user();
        $request->validate([
            'nombre'     => 'required|string',
            'email'    => 'required|string|email|unique:users,email,' . $user->id,
            'fecha_nacimiento' => 'date',
            'password' => 'required|string|confirmed',
        ]);
        $user->update([
            'nombre'     => $request->nombre,
            'email'    => $request->email,
            'apellido' => $request->apellido,
            'fecha_nacimiento' => $request->fechaNacimiento,
            'telefono' => $request->telefono,
            'password' => bcrypt($request->password),
        ]);
        return response()->json(['mensaje' => 'Usuario creado correctamente'], 201);
    }

    public function user(Request $request)
    {
        $user = $request->user();
        $pedidos = $user->pedidos;
        $totalPedidos = count($pedidos);
        $totalArticulos = 0;
        $totalGastado = 0;
        foreach($pedidos as $pedido){
            foreach($pedido->lineaPedidos as $lineaPedido) {
                $totalArticulos += ($lineaPedido->cantidad);
                $totalGastado += ($lineaPedido->importe);
            }
        }
        return response()->json([
            'totalPedidos' => $totalPedidos,
            'totalArticulos' => $totalArticulos,
            'totalGastado' => $totalGastado,
            'user' => $user,
        ]);
    }

}
