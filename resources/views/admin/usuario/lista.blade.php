@extends("layouts.admin")

@section("contenedor")
<h1>Lista Usuario</h1>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Nuevo Usuario
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('usuario.store') }}" method="post">
      <div class="modal-body">

            @csrf
            <label for="">Nombres de Usuario</label>
            <input type="text" name="name" class="form-control">            

            <label for="">Correo</label>
            <input type="email" name="email" class="form-control" required>

            <label for="">Contraseña</label>
            <input type="password" name="password" class="form-control">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar Usuario</button>
      </div>
      </form>
    </div>
  </div>
</div>

<table class="table table-striped table-hover">
    <tr>
        <td>ID</td>
        <td>NOMBRE</td>
        <td>CORREO</td>
        <td>ROLES</td>
        <td>ACCIONES</td>
    </tr>
@foreach ($usuarios as $user)
    <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
        <form action="{{ route('eliminar_role_user', $user->id) }}" method="post">
        @csrf
        @foreach ($user->roles as $rol)
          <input type="hidden" value="{{$rol->name}}" name="rol">
          <input type="submit" value="{{$rol->name}} x" class="btn btn-success btn-xs">
        @endforeach
        </form>
        </td>
        <td>
        
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal{{ $user->id }}">
  asignar Rol
</button>

<!-- Modal -->
<div class="modal fade" id="Modal{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Asignar roles a un usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('asignar_role_usuario', $user->id) }}" method="post">
      <div class="modal-body">

            @csrf
            @foreach ($roles as $rol)
              <input type="checkbox" value="{{ $rol->name }}" name="roles[]"> {{ $rol->name }}
            @endforeach
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Asignar Rol</button>
      </div>
      </form>
    </div>
  </div>
</div>

        </td>
    </tr>
    @endforeach
</table>

@endsection