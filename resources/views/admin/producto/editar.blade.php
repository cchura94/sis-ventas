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

        <form action="{{ route('producto.update', $producto->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <label for="">Nombre:</label>
            <input type="text" name="nombre" class="form-control" value="{{ $producto->nombre }}">

            <label for="">Precio:</label>
            <input type="number" step="0.01" class="form-control" name="precio" value="{{ $producto->precio }}">

            <label for="">Cantidad:</label>
            <input type="number" class="form-control" name="cantidad" value="{{ $producto->cantidad }}">

            <label for="">IMAGEN:</label>
            <input type="file" class="form-control" name="imagen">
            <img src="{{ asset('imagenes/') }}/{{$producto->imagen}}" width="300px" alt="">
<hr>
            <label for="">Categoria:</label>
            <select name="categoria_id" id=""  class="form-control">
                @foreach ($categorias as  $cat)

                    <option value="{{ $cat->id }}" {{ ($cat->id == $producto->categoria_id)?'selected':'' }}>{{$cat->nombre}}</option>
                    
                @endforeach
            </select>

            <label for="">Descripcion</label>
            <textarea name="descripcion" class="form-control">{{$producto->descripcion}}</textarea>

            <input type="submit" class="btn btn-success" value="Modificar Producto">
        </form>
    </div>
</div>



@endsection