@extends('layouts.app')
@section('content')
    <div class="equipo-container container-fluid d-flex flex-wrap">
        <div class="col-md-6 col-sm-12 info-equipo">
            <div class="equipo-title">
                <h1>{{$mister->team->name}}</h1>
                <h5>{{$mister->team->category}} - {{$mister->team->league->name}}</h5>
            </div>
            <div class="equipo-content">

            </div>
        </div>
        <div class="col-md-6 col-sm-12 jugadores-equipo">
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Posicion</th>
                    <th scope="col">Numero</th>
                    <th scope="col">Edad</th>
                    <th scope="col" class="add-player"><i class="fa fa-plus-circle" data-toggle="modal" data-target="#add-player-form"></i></th>
                </tr>
                </thead>
                <tbody>
                @foreach($mister->team->players as $player)
                    <tr>
                        <td>{{$player->id}}</td>
                        <td>{{$player->name}}</td>
                        <td>{{$player->position}}</td>
                        <td>{{$player->number}}</td>
                        <td>{{$player->edad()}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('mister.formularios.newPlayerForm')
@endsection
@section('scripts')
    <script src="{{asset('js/mister/equipo.js')}}" type="text/javascript"></script>
@endsection