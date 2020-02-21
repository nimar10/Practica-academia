@extends('plantillas.plantilla')
@section('titulo')
Edicion Monstruos S.A.
@endsection
@section('cabecera')
Edicion Monstruos S.A.
@endsection
@section('contenido')
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $miError)
            <li>{{$miError}}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="card bg.secondary">
    <div class="card-header">Editar Monstruos</div>
    <div class="card-body">
    <form name="g" action="{{route('alumnos.update', $alumno)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-row">
        <div class="col">
            <label for="nom" class="col-form-label">Nombre</label>
            <input type="text" name="nombre" value="{{$alumno->nombre}}" id="nom" required>
        </div>
        
        <div class="col">
                <label for="ape" class="col-form-label">Apellidos</label>
                <input type="text" name="apellidos" value="{{$alumno->apellidos}}" id="ape" required>
        </div>
        </div>

        <div class="form-row mt-3">
        <div class="col">
                <label for="mail" class="col-form-label">E-Mail</label>
                <input type="mail" class="form-control" name="mail" value="{{$alumno->mail}}" id="mail" required>
        </div>
        <div class="col">
        </div>
        </div>
        <div class="from-row">

        <div class="col">
                <label for="nom" class="col-form-label">Logo</label>
                <input type="file" name="logo" placeholder="Logo" id="logo" class="form-control p-lg-1" accept="image/*">
        </div>
        <div class="float-right" >
            <img src="{{asset($alumno->logo)}}" width="160px" height="160px" class="rounded-circle">
    </div>
    <div class="form-row mt-3" align="center">
        <div class="col">
            <input type="submit" value="Editar" class="btn btn-success">
            
        <a href="{{route('alumnos.index')}}" class="btn btn-secondary">Volver al bichario</a>
        </div>
    </div>
@endsection