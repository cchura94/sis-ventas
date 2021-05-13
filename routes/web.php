<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// pagina (sitio)
// [ /, /productos , /galeria,  /contactos, /nosotros, /login ]
Route::get('/', function () {
    return view('inicio');
});


// admin
// [ /admin , /admin/producto , /admin/pedido ... ]

Route::prefix("/admin")->group(function(){

    Route::get('/', function () {
        return view('admin.administrador');
    });

    Route::resource("/categoria", CategoriaController::class);
    Route::resource("/producto", ProductoController::class);
    Route::resource("/cliente", ClienteController::class);
    Route::resource("/proveedor", ProveedorController::class);
    Route::resource("/pedido", PedidoController::class);   

});

