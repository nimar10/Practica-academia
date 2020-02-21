@extends('plantillas.plantilla')
@section('titulo')
Monstruos S.A.
@endsection
@section('cabecera')
Monstruos S.A.
@endsection
@section('contenido')
<div class="text-center mt-3">
<a href="{{route('alumnos.index')}}" class="btn btn-primary mr-4">Gestionar Alumnos</a>
<a href="{{route('modulos.index')}}" class="btn btn-primary mr-4">Gestionar Modulos</a>
</div>

@endsection