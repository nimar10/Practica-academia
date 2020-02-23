@extends('plantillas.plantilla')
@section('titulo')
Detalles AlumnosS S.A.
@endsection
@section('cabecera')
Detalles AlumnosS.A.
@endsection
@section('contenido')

@if($text=Session::get('mensaje'))
<p class="alert alert-danger my-3">{{$text}}</p>
@endif

<table align="center" class="text-center mt-3" cellspacing='6' cellspadding='5'  >
    <tr>
        <td>
            <p class="font-weight-bold ml-3">Apellidos, Nombre: {{$alumno->apellidos.", ".$alumno->nombre}}</p>
        </td>
        <td rowspan="2">
            <img src="{{asset($alumno->logo)}}" width="100vw" height="100vh" class="rounded-circle">
        </td>
    </tr>

    <tr>
        <td>   
            <p class="font-weight-bold ml-3">E-mail: {{$alumno->mail}}</p>
        </td>
    </tr>

    <tr>
            <td>
                    <p class="font-weight-bold ml-3">Modulos: </p>
                        <ul>
                            @foreach ($alumno->modulos as $modulo)
                            <ol>{{$modulo->nombre. "(".$modulo->pivot->nota.")"}}</ol>
                                
                            @endforeach

                        <p class="font-weight-bold ml-3">Nota Media:  </p>
                        
                        </ul>
                </td>
                <td>
                </td>
    </tr>
        <tr>
            <td>
            <a href="{{route('alumnos.fmatricula', $alumno)}}" class="btn btn-primary">Matricular Alumno</a>
            <a href="{{route('alumnos.index')}}" class="btn btn-success">Volver</a>
            <a href="{{route('alumnos.fcalificar', $alumno)}}" class="btn btn-success">Calificar Alumno</a>
            
            <img src="{{asset($alumno->logo)}}" width="30vw" height="30vh" class="  ml-5 mt-3 rounded-circle">
            
            </td>
    </table>
@endsection