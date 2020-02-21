@extends('plantillas.plantilla')
@section('titulo')
Creacion Alumnos
@endsection
@section('cabecera')
Creacion Alumnos
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
    <div class="card-header">Crear Monstruo</div>
    <div class="card-body">
    <form name="g" action="{{route('alumnos.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="form-row">
        <div class="col">
            <label for="nom" class="col-form-label">Nombre</label>
            <input type="text" name="nombre" placeholder="Nombre" id="nom" required>
        </div>
        
        <div class="col">
                <label for="ape" class="col-form-label">Apellidos</label>
                <input type="text" name="apellidos" placeholder="Apellidos" id="ape" required>
        </div>
        </div>

        <div class="form-row mt-3">
        <div class="col">
                <label for="mail" class="col-form-label">E-Mail</label>
                <input type="mail" class="form-control" name="mail" placeholder="e-mail" id="mail" required>
        </div>

        <div class="col">
                <label for="nom" class="col-form-label">Logo</label>
                <input type="file" name="logo" placeholder="Logo" id="logo" class="form-control p-lg-1" accept="image/*">
        </div>
    </div>
    <div class="form-row mt-3" align="center">
        <div class="col">
            <input type="submit" value="Crear" class="btn btn-success">
            <input type="reset" value="Limpiar" class="btn btn-warning">
        <a href="{{route('alumnos.index')}}" class="btn btn-danger">Volver al Inicio</a>
@endsection

