@extends('layouts.herramienta')
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
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">posicion</th>
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
                        <td>{{$player->edad()}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal modal-panel fade" id="add-player-form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">AÑADIR JUGADOR</div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nombre-jugador">Nombre</label>
                                <input class="form-control" id="nombre-jugador" name="player-name" type="text">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nombre-jugador">Appellidos</label>
                                <input class="form-control" id="nombre-jugador" name="player-name" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="posicion-jugador">Posicion</label>
                            <input class="form-control" id="posicion-jugador" name="player-position" type="text">
                        </div>
                        <div class="form-group">
                            <label for="fecha-jugador">Fecha de nacimiento</label>
                            <input class="form-control" id="fecha-jugador" name="player-birthday" type="text">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-cancel btn-form">CANCELAR</button>
                    <button class="btn btn-save btn-form">AÑADIR</button>
                </div>
            </div>
        </div>
    </div>
@endsection