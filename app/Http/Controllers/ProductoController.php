<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;

class ProductoController extends Controller
{
    public function __construct() {
        $this->middleware(['role:gerente','permission:producto.index|producto.create']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->buscar){
            $productos = Producto::where('nombre', 'like', '%'.$request->buscar.'%')->get();
        }else{

            $productos = Producto::get();
        }
        return view("admin.producto.lista", compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::get();
        return view("admin.producto.nuevo", compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validacion
        $request->validate([
            "nombre" => "required|max:150",
            "categoria_id" => "required",
            "cantidad" => "required"           

        ]);

        // subir la imagen
        $nombre_imagen = "";
        if($file = $request->file("imagen")){
            $nombre_imagen = $file->getClientOriginalName();
            $file->move("imagenes", $nombre_imagen);
        }

        //guardar
        $prod = new Producto;
        $prod->nombre = $request->nombre;
        $prod->precio = $request->precio;
        $prod->cantidad = $request->cantidad;
        $prod->descripcion = $request->descripcion;
        $prod->categoria_id = $request->categoria_id;
        $prod->imagen = $nombre_imagen;
        $prod->save();

        // redireccionar
        return redirect("/admin/producto")->with('mensaje', "Producto registrado");
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
        $producto = Producto::find($id);
        $categorias = Categoria::get();
        return view("admin.producto.editar", compact('producto', 'categorias'));
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
        // validacion
        $request->validate([
            "nombre" => "required|max:150",
            "categoria_id" => "required",
            "cantidad" => "required"           

        ]);

       
        //guardar
        $prod = Producto::find($id);
        $prod->nombre = $request->nombre;
        $prod->precio = $request->precio;
        $prod->cantidad = $request->cantidad;
        $prod->descripcion = $request->descripcion;
        $prod->categoria_id = $request->categoria_id;

         // subir la imagen
         
         if($file = $request->file("imagen")){
             $nombre_imagen = $file->getClientOriginalName();
             $file->move("imagenes", $nombre_imagen);
             $prod->imagen = $nombre_imagen;
        }
        
        $prod->save();

        // redireccionar
        return redirect("/admin/producto")->with('mensaje', "Producto Modificado");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prod = Producto::find($id);
        $prod->delete();
        return redirect("/admin/producto")->with('mensaje', "Producto Eliminado");

    }
}
