@extends('layouts.app')
@section('content')
<div class="partido-content">
    <div class="row justify-content-center">
        <span id="cronometro">00:00</span>
    </div>
    <div class="row">
        <div class="col-4 d-flex justify-content-center">
            <img src="{{asset('assets/escudos/marianistas.jpg')}}" class="icono-equipo-partido">
        </div>
        <div class="col-4 d-flex justify-content-center align-items-center">
            <span class="inicio-botton">INICIO</span>
        </div>
        <div class="col-4 d-flex justify-content-center">
            <img src="{{asset('assets/escudos/paquete-ud.jpg')}}" class="icono-equipo-partido">
        </div>
    </div>
    <div class="row fila-jugadores">
        <div class="col-4 cuadro-jugador d-flex justify-content-center">
            JUGADOR
        </div>
        <div class="col-4 offset-4 cuadro-jugador d-flex justify-content-center">
            JUGADOR
        </div>
    </div>
</div>
@endsection