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
      <form action="{{ route('cliente.store') }}" method="post">
      <div class="modal-body">

            @csrf
            <label for="">Nombres de Cliente</label>
            <input type="text" name="nombres" class="form-control">

            <label for="">Apellidos</label>
            <input type="text" name="apellidos" class="form-control">

            <label for="">CI / NIT</label>
            <input type="text" name="ci_nit" class="form-control">

            <label for="">Correo</label>
            <input type="email" name="correo" class="form-control" required>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar Cliente</button>
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
        <td>ACCIONES</td>
    </tr>
@foreach ($usuarios as $clie)
    <tr>
        <td>{{ $clie->id }}</td>
        <td>{{ $clie->name }}</td>
        <td>{{ $clie->email }}</td>
        <td>
        
  

        </td>
    </tr>
    @endforeach
</table>

@endsection