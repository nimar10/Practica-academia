@extends('plantillas.plantilla')
@section('titulo')
Edicion Modulos S.A.
@endsection
@section('cabecera')
Edicion Modulos S.A.
@endsection
@section('contenido')
@if($errors->any())
    <div class="alert alert-success">
        <ul>
            @foreach($errors->all() as $miError)
            <li>{{$miError}}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="card bg.secondary">
    <div class="card-header">Editar Modulos</div>
    <div class="card-body">
    <form name="m" action="{{route('modulos.update', $modulo)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-row">
        <div class="col">
            <label for="nom" class="col-form-label">Nombre</label>
            <input type="text" name="nombre" value="{{$modulo->nombre}}" id="nom" required>
        </div>
        
        <div class="col">
                <label for="hor" class="col-form-label">Horas</label>
                <input type="number" name="horas" value="{{$modulo->horas}}" id="hor" required>
        </div>
        </div>

        <div class="from-row">
            <div class="form-row mt-3" align="center">
                <div class="col">
                    <input type="submit" value="Editar" class="btn btn-success">   
                    <a href="{{route('modulos.index')}}" class="btn btn-secondary">Volver al Inicio!!</a>
                </div>
            </div>
        </div>        
</div>
@endsection