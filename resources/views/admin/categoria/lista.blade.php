@extends("layouts.admin")

@section("contenedor")

@if (session('mensaje'))
    <div class="alert alert-success">
        {{ session('mensaje') }}
    </div>
@endif

<h1>Lista Categorias</h1>

<a href="{{ route('categoria.create') }}" class="btn btn-primary">Nueva Categoria</a>

<table class="table table-striped table-hover">
    <tr>
        <td>ID</td>
        <td>NOMBRE</td>
        <td>DETALLE</td>
        <td>ACCIONES</td>
    </tr>
    @foreach ($categorias as $cat)
        <tr>
            <td>{{ $cat->id }}</td>
            <td>{{ $cat->nombre }}</td>
            <td>{{ $cat->detalle }}</td>
            <td>
                <a href="{{ route('categoria.edit', $cat->id) }}" class="btn btn-warning">editar</a>
                <a href="{{ route('categoria.show', $cat->id) }}" class="btn btn-success">mostrar</a>
            </td>
        </tr>
    @endforeach

</table>

@endsection