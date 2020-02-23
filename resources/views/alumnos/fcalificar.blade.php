@extends('plantillas.plantilla')
@section('titulo')
Monstruos S.A.
@endsection
@section('cabecera')
Calificacion del bicho ->> {{$alumno->nombre.", ".$alumno->apellidos}}
@endsection
@section('contenido')
<form name="cal" method="POST" action="{{route('alumnos.calificar')}}">
    @csrf
    <div class="form-group row">
    <input type="hidden" name="alumno_id" value="{{$alumno->id}}" />
    @foreach($alumno->modulos as $modulo)
        <div class="col">
<label for="{{$modulo->id}}" class="col-sm-1 col-form-label text-primary text-weight-bold">{{$modulo->nombre}}</label>
        </div>

<div class="col">
<input type="number" id="{{$modulo->id}}" name="modulos[{{$modulo->id}}]" class="form-control"
value="{{$modulo->pivot->nota}}" max="10" min="0" step="0.01" maxlength="4">
</div>
@endforeach

<div class="col ">
<input type="submit" class="btn btn-success mt-3" value="Calificar">
<a href="{{route('alumnos.show', $alumno)}}" class="btn btn-dark mt-3 ml-3">Volver</a>
</div>
    </div>
</form>
@endsection