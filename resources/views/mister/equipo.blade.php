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
    <div class="modal modal-panel fade" id="add-player-form" data-error={{$errors ? '1' : '0'}}>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">AÑADIR JUGADOR</div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="new-player" action="">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="player-name">Nombre</label>
                                <input class="form-control" id="player-name" name="player-name" type="text">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="player-apellidos">Appellidos</label>
                                <input class="form-control" id="player-apellidos" name="player-apellidos" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="player-position">Posicion</label>
                            <input class="form-control" id="player-position" name="player-position" type="text">
                        </div>
                        <div class="form-group">
                            <label for="player-birthday">Fecha de nacimiento</label>
                            <input class="form-control" id="player-birthday" name="player-birthday" type="text" placeholder="yyyy-mm-dd">
                        </div>
                        <div class="form-row button-row">
                            <div class="col-md-6 col-sm-12">
                                <button type="submit" class="btn btn-save btn-save-player btn-form col-12">AÑADIR</button>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <button class="btn btn-cancel btn-form col-12">CANCELAR</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/mister/equipo.js')}}" type="text/javascript"></script>
@endsection