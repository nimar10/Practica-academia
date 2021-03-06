@extends('plantillas.plantilla')
@section('titulo')
Modulos S.A.
@endsection
@section('cabecera')
Modulos S.A.
@endsection
@section('contenido')

@if($text=Session::get('mensaje'))
<p class="alert alert-danger my-3">{{$text}}</p>
@endif

<a href="{{route('modulos.create')}}" class="btn btn-success mb-3 ">Crear Modulos</a>
<form name="search" method="GET" action="{{route('modulos.index')}}" class="form-inline float-right">
 <label>Alumnos:</label>
  <select name="alumnos" class="form-control mx-2 float-left" onchange="this.form.submit()">
    <option value="%">Todos</option>
    <option value="-1">Sin Modulo</option>
    @foreach($alumnos as $alumno)
      @if($alumno->id==$request->alumno_id)
        <option value='{{$alumno->id}}' selected>{{$alumno->nombre}}</option>
      @else
      <option value="{{$alumno->id}}" >{{$alumno->nombre}}</option>
      @endif
    @endforeach
  </select>
  <input type="submit" value="Buscar" class="btn btn-info ml-2">
</form>
<table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Detalles</th>
        <th scope="col" class="align-middle">Nombre</th>
        <th scope="col" class="align-middle">Horas</th>
        <th scope="col" class="align-middle">Acciones</th>
      </tr>
    </thead>

    <tbody>
        @foreach ($modulos as $modulo)
        <tr>
            <th scope="row">
                <a href="{{route('modulos.show',$modulo)}}" class="btn btn-primary">Detalles</a>
            </th>

            <th scope="row">{{$modulo->nombre}}</th>
            <td class="align-middle">{{$modulo->horas}}</td>

            <td class="algin-center">
                <form class="form-inline" name="b" action="{{route('modulos.destroy', $modulo)}}" method="POST">
                    @csrf
                    @method('DELETE')

                    <input type="submit" value="Borrar Modulo" class="btn btn-danger ">
                    <a href="{{route('modulos.edit', $modulo)}}" class="btn btn-warning ml-2 ">Editar Modulo</a>
                </form>
            </td>
        </tr>    
        @endforeach
    </tbody>
  </table>
  {{$modulos->links()}}
@endsection