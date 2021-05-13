@extends("layouts.admin")

@section("contenedor")

@if (session('mensaje'))
    <div class="alert alert-success">
        {{ session('mensaje') }}
    </div>
@endif

<h1>Lista Productos</h1>

<a href="{{ route('producto.create') }}" class="btn btn-primary">Nueva Producto</a>

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
            <td>{{ $prod->categoria_id }}</td>
            <td>
                <a href="{{ route('producto.edit', $prod->id) }}" class="btn btn-warning">editar</a>
                <a href="{{ route('producto.show', $prod->id) }}" class="btn btn-success">mostrar</a>
            </td>
        </tr>
    @endforeach

</table>

@endsection