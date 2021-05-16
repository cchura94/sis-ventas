<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\RolePermisosController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Auth;
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

Route::middleware(["auth"])->prefix("/admin")->group(function(){

    Route::get('/', function () {
        return view('admin.administrador');
    });

    Route::get('/producto/buscar', [ProductoController::class, "buscarProducto"]);
    Route::get('/cliente/buscar', [ClienteController::class, "buscarCliente"]);

    Route::resource("/categoria", CategoriaController::class);
    Route::resource("/producto", ProductoController::class);
    Route::resource("/cliente", ClienteController::class);
    Route::resource("/proveedor", ProveedorController::class);
    Route::resource("/pedido", PedidoController::class);

    Route::post("/usuario/{id_user}/asinar_role", [UsuarioController::class, "asignarRoleAUsuario"])->name("asignar_role_usuario");
    Route::post("/usuario/{id_user}/quitar_role", [UsuarioController::class, "quitarRoleAUsuario"])->name("eliminar_role_user");
    
    
    Route::resource("/usuario", UsuarioController::class);
    
    Route::get("/permisos", [RolePermisosController::class, "principal"])->name('permisos_index');
    
    Route::post("/permisos", [RolePermisosController::class, "guardarPermisos"])->name('guardar_permiso');
    Route::post("/permisos/roles", [RolePermisosController::class, "guardarRoles"])->name('guardar_roles');
    Route::post("/permisos/roles/muchos", [RolePermisosController::class, "sincronizarPermisosRole"])->name('sincronizar_permisos_role');
    Route::post("/permisos/roles/{id_rol}/eliminar", [RolePermisosController::class, "eliminarPermisodeRol"])->name('eliminar_permiso_rol');
    Route::post("/permisos/roles/{id_rol}", [RolePermisosController::class, "asignarPermisoARol"])->name('asignar_permiso_rol');
    

    
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
