@extends('plantillas.plantilla')
@section('titulo')
Detalles Modulos S.A.
@endsection
@section('cabecera')
Detalles Modulos S.A.
@endsection
@section('contenido')

@if($text=Session::get('mensaje'))
<p class="alert alert-danger my-3">{{$text}}</p>
@endif

<table align="center" class="text-center mt-3" cellspacing='6' cellspadding='5'  >
    <tr>
        <td>
            <p class="font-weight-bold ml-3"> Nombre: {{$modulo->nombre}}</p>
        </td>
       
    </tr>

    <tr>
        <td>   
            <p class="font-weight-bold ml-3">Horas: {{$modulo->horas}}</p>
        </td>
    </tr>

    <tr>
        <td>  
        <a href="{{route('modulos.index')}}" class="btn btn-success">Volver</a>
        </td>
    </table>
@endsection