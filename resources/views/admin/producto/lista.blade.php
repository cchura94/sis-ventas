@extends("layouts.admin")

@section("contenedor")

@if (session('mensaje'))
    <div class="alert alert-success">
        {{ session('mensaje') }}
    </div>
@endif

<h1>Lista Productos</h1>

<a href="{{ route('producto.create') }}" class="btn btn-primary">Nueva Producto</a>

<form action="{{ route('producto.index') }}" method="get">
  <input type="text" name="buscar">
  <input type="submit" value="buscar" class="btn btn-primary">
</form>
<table class="table table-striped table-hover">
    <tr>
        <td>NOMBRE</td>
        <td>CANTIDAD</td>
        <td>PRECIO</td>
        <td>IMAGEN</td>
        <td>CATEGORIA</td>
        <td>ACCIONES</td>
    </tr>
    @foreach ($productos as $prod)
        <tr>
            <td>{{ $prod->nombre }}</td>
            <td>{{ $prod->cantidad }}</td>
            <td>{{ $prod->precio }}</td>
            <td>IMAGEN</td>
            <td>{{ $prod->categoria->nombre }}</td>
            <td>
                <a href="{{ route('producto.edit', $prod->id) }}" class="btn btn-warning">editar</a>
                <a href="{{ route('producto.show', $prod->id) }}" class="btn btn-success">mostrar</a>

                <!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal{{ $prod->id }}">
  Eliminar
</button>

<!-- Modal -->
<div class="modal fade" id="modal{{ $prod->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminación de Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Está seguro de eliminar {{ $prod->nombre }}?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <form action="{{ route('producto.destroy', $prod->id) }}" method="post">
            @csrf
            @method("DELETE")
            <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
      </div>
    </div>
  </div>
</div>

            </td>
        </tr>
    @endforeach

</table>

@endsection