@extends('plantillas.plantilla')
@section('titulo')
Creacion Modulos S.A.
@endsection
@section('cabecera')
Creacion Modulos S.A.
@endsection
@section('contenido')
@if($errors->any())
    <div class="alert alert-warning">
        <ul>
            @foreach($errors->all() as $miError)
            <li>{{$miError}}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card bg.secondary">
    <div class="card-header">Crear Modulo</div>
    <div class="card-body">
        <form name="sto" action="{{route('modulos.store')}}" method="POST">
        @csrf
        @method('POST')
        <div class="form-row">
        <div class="col">
                <label for="hor" class="col-form-label">Horas</label>
                <input type="number" name="horas" placeholder="Horas" id="hor" required>
        </div>
        
        <div class="col">
                <label for="no" class="col-form-label">Nombre</label>
                <input type="text" name="nombre" placeholder="Nombre" id="nom" required>
        </div>
        
    </div>
</div>

    <div class="form-row mt-3" align="center">
        <div class="col">
            <input type="submit" value="Crear" class="btn btn-success">
            <input type="reset" value="Limpiar" class="btn btn-warning">
        <a href="{{route('modulos.index')}}" class="btn btn-danger">Volver</a>
        </div>
    </div>
</form>
</div>
</div>
@endsection