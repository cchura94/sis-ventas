<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class RolePermisosController extends Controller
{
    public function principal()
    {
        $permisos = Permission::All();
        $roles = Role::All();
        return view("admin.permiso.principal", compact('permisos', 'roles'));
    }
    public function guardarPermisos(Request $request)
    {
        //$role = Role::create(['name' => 'writer']);
        $permission = Permission::create(['name' => $request->name]);
        return redirect()->back()->with("mensaje", "Permiso Registrado Correctamente");        
    }

    public function guardarRoles(Request $request)
    {
        $role = Role::create(['name' => $request->name]);
        return redirect()->back()->with("mensaje", "Rol Registrado Correctamente");        
    }

    public function asignarPermisoARol(Request $request, $id_rol)
    {
        $role = Role::find($id_rol);
        $permiso = Permission::find($request->id);

        $role->givePermissionTo($permiso);
        //$permiso->assignRole($role);
        return redirect()->back()->with("mensaje", "Permiso asignado al Role");  
    }

    public function sincronizarPermisosRole(Request $request)
    {
        $role = Role::find($request->role_id);
        $role->syncPermissions($request->permisos);
        //$permission->syncRoles($roles);
        return redirect()->back()->with("mensaje", "Permisos asignados al Role");  
   
    }

    public function eliminarPermisodeRol(Request $request, $id_rol)
    {
        $role = Role::find($id_rol);
        $role->revokePermissionTo($request->permiso_id);
    }
}
