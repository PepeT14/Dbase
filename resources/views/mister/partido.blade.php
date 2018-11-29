@extends('layouts.app')
@section('content')
<div class="partido-content">
    <div class="row justify-content-center">
        <span id="Horas">00</span>
        <span id="Minutos">:00</span>
        <span id="Segundos">:00</span>
        <span id="Centesimas">:00</span>
    </div>
    <div class="row">
        <div class="col-3 d-flex justify-content-center align-items-center">
            <button class="btn btn-primary-color" id="inicio">INICIO</button>
        </div>
        <div class="col-3 d-flex justify-content-center align-items-center">
            <button class="btn btn-danger-color" id="parar">PARAR</button>
        </div>
        <div class="col-3 d-flex justify-content-center align-items-center">
            <button class="btn btn-dark" id="continuar">RESUME</button>
        </div>
        <div class="col-3 d-flex justify-content-center align-items-center">
            <button class="btn btn-outline-primary" id="reinicio">RESET</button>
        </div>
    </div>

    <div class="row">
        <div class="col-4 d-flex justify-content-center">
            <img src="{{asset($mister->team->club->escudo)}}" class="icono-equipo-partido">
        </div>

    </div>
    <div class="row fila-jugadores">
        <div class="col-4">
            @foreach($partido->players as $player)
                <div class="cuadro-jugador d-flex justify-content-center">
                    <span>{{$player->name}}</span>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/mister/partido.js')}}" type="text/javascript"></script>
@endsection