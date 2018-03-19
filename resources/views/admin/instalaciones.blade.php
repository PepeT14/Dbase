@extends('layouts.admin')
@section('content')
    <div class="admin content">
        @if($instalaciones->isEmpty())
            No tiene aún instalaciones
        @else
            <table>
                @foreach($instalaciones as $instalacion)
                    <tr>
                        <td>{{$instalacion->name}}</td>
                        <td>{{$instalacion->tipo}}</td>
                    </tr>
                @endforeach
            </table>
        @endif
        <button id="showInstForm">Añadir instalacion</button>
        <form id="addInstForm" action="{{route('instalacion.create')}}" style="display:none;">
            <input name="name" placeholder="nombre">
            <input name="tipo" placeholder="tipo">
            <input name="terreno" placeholder="terreno">
            <button>Añadir Instalacion</button>
        </form>
    </div>
@endsection