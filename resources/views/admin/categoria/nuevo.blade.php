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

        <form action="{{ route('categoria.store') }}" method="post">
            @csrf
            <label for="">Nombre:</label>
            <input type="text" name="nombre" class="form-control" value="{{old('nombre')}}">

            <label for="">Detalle:</label>
            <textarea name="detalle" class="form-control">{{old('detalle')}}</textarea>

            <input type="submit" class="btn btn-success" value="Guardar Categoria">
        </form>
    </div>
</div>



@endsection