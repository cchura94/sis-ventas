@extends("layouts.admin")

@section("contenedor")
<h1>Gestion Permisos</h1>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalRol">
  Nuevo Rol
</button>

<!-- Modal -->
<div class="modal fade" id="ModalRol" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Rol</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('guardar_roles') }}" method="post">
      <div class="modal-body">
      @csrf
      <label for="">Ingrese Nombre de Rol</label>
        <input type="text" name="name" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar Rol</button>
      </div>
      </form>
    </div>
  </div>
</div>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalPermiso">
  Nuevo Permiso
</button>

<!-- Modal -->
<div class="modal fade" id="ModalPermiso" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Permiso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('guardar_permiso') }}" method="post">
      <div class="modal-body">
      @csrf
      <label for="">Ingrese Nombre de Permiso</label>
        <input type="text" name="name" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar Permiso</button>
      </div>
      </form>
    </div>
  </div>
</div>

<form action="{{ route('sincronizar_permisos_role') }}" method="post">
@csrf
<select name="role_id" id="" class="form-control">
    @foreach ($roles as $rol)
    <option value="{{$rol->id}}">{{ $rol->name }}</option>
    
    @endforeach
</select>

<hr>
<table class="table table-hover table-striped">
    <tr>
        <td>NOMBRE</td>
        <td>ACCION</td>
    </tr>
    @foreach ($permisos as $per)
    <tr>
        <td>{{ $per->name }}</td>
        <td>
            <input type="checkbox" value="{{ $per->id }}" name="permisos[]">
        </td>
    </tr>
    @endforeach
</table>

<input type="submit" value="Asignar Permisos Por ROL" class="btn btn-success">
</form>

<hr>


@endsection