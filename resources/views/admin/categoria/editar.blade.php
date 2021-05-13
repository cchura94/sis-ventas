@extends("layouts.admin")

@section("contenedor")


<div class="row">
    <div class="col-md-8">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <form action="{{ route('categoria.update', $cat->id) }}" method="post">
            @csrf
            @method("PUT")
            <label for="">Nombre:</label>
            <input type="text" name="nombre" class="form-control" value="{{ $cat->nombre }}">

            <label for="">Detalle:</label>
            <textarea name="detalle" class="form-control">{{ $cat->detalle }}</textarea>

            <input type="submit" class="btn btn-success" value="Modificar Categoria">
        </form>
    </div>
</div>



@endsection