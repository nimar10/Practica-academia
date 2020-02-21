@extends('plantillas.plantilla')
@section('titulo')
Monstruos S.A.
@endsection
@section('cabecera')
Alumnos S.A.
@endsection
@section('contenido')
@if($text=Session::get('mensaje'))
<p class="alert alert-danger my-3">{{$text}}</p>
@endif

<a href="{{route('alumnos.create')}}" class="btn btn-success mt-3 ml-2">Crear Alumno</a>
<table class="table mt-3" border="3">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Detalles</th>
        <th scope="col" class="align-middle">Apellidos, Nombre</th>
        <th scope="col" class="align-middle">Mail</th>
        <th scope="col" class="align-middle">Imagen</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody>
        @foreach($alumnos as $alumno)
      <tr>
        <th scope="row">
          <a href="{{route('alumnos.show', $alumno)}}" class="btn btn-warning">Detalles</a>
        </th>
      
        
      <th scope="row">{{$alumno->apellidos.", ".$alumno->nombre}}</th>
        <td class="align-middle">{{$alumno->mail}}</td>
        <td class="align-middle">
        <img src="{{asset($alumno->logo)}}" width="80px" height="80px" class="img-fluid rounded-circle">
        </td>
        <td class="align-center">
          <form class="form-inline" name="del" action="{{route('alumnos.destroy',$alumno)}}" method="POST">
            @method('DELETE')
            @csrf
            <input type="submit" onclick="return confirm('¿Borrar Alumno?')" class="btn btn-danger mt-2" value="Borrar " >
           
            <a href="{{route('alumnos.edit',$alumno)}}" class="btn btn-warning mt-2 ml-2">Editar </a>
            </form>
        </td>
      </tr>
        @endforeach
    </tbody>
  </table>
  {{$alumnos->links()}}
@endsection