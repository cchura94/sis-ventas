<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pedido;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Pedido::All();
        return view("admin.pedido.lista", compact('pedidos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view("admin.pedido.nuevo");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        // array de productos con su cantidad
        //datos del cliente
        $cliente_id = $request->cliente_id;

        $ped = new Pedido;
        $ped->fecha_pedido = date('Y-m-d H:i:s');
        $ped->estado = 0;
        $ped->cliente_id = $cliente_id;
        $ped->save();

        // asignacion de producto a los pedidos
        foreach ($request->carrito as $prod ) {
            
            $ped->productos()->attach($prod["producto_id"], ["cantidad" =>$prod["cantidad"] ]);
        }

        $ped->estado = 1;
        
        return redirect("/admin/pedido");

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
