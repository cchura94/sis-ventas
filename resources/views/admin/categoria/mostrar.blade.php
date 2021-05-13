@extends("layouts.admin")

@section("contenedor")


<div class="row">
    <div class="col-md-8">

            <label for="">Nombre:</label>
            <input type="text" name="nombre" class="form-control" value="{{ $cat->nombre }}" disabled>

            <label for="">Detalle:</label>
            <textarea name="detalle" class="form-control" disabled>{{ $cat->detalle }}</textarea>

          
    </div>
</div>



@endsection