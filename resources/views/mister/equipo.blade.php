@extends('layouts.app')
@section('content')
    <div class="equipo-container container-fluid">
        <div class="row info-equipo">
            <div class="col-md-6 col-sm-12">
                <div class="row">
                    <div class="col-8 equipo-title">
                        <h1>{{$mister->team->name}}</h1>
                        <h5>{{$mister->team->category}} - {{$mister->team->league->name}}</h5>
                    </div>
                </div>
                <div class="row divider"></div>
                <div class="row justify-content-center">
                    <label for="selector-formaciones">Formacion:</label>
                    <select class="cs-skin-elastic cs-select ml-2" id="selector-formaciones">
                        <option value="1">4-3-3</option>
                        <option value="1">4-4-2</option>
                        <option value="1">3-4-3</option>
                        @foreach($mister->team->sistems as $sistem)
                            <option value="{{$sistem->id}}">{{$sistem->formation}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row equipo-content">
                    <div class="container-fluid campo-content">
                        <div class="row fila-campo justify-content-center portero"></div>
                        <div class="row fila-campo justify-content-center defensas"></div>
                        <div class="row fila-campo justify-content-center medios"></div>
                        <div class="row fila-campo justify-content-center delanteros"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="row jugadores-title">
                    <h2>Jugadores</h2>
                    <div class="add-player" data-toggle="modal" data-target="#add-player-form">
                        <i class="fa fa-plus-circle"></i>
                    </div>
                </div>
                <div class="row divider"></div>
                <div class="row jugadores-equipo">
                    <table class="table">
                        <tbody>
                        @foreach($players as $player)
                            <tr>
                                <td class="imagen-jugador-content">
                                    <div class="foto">
                                        <img class="img-fluid" src="{!! $player->photo ? asset($player->photo) : asset('imagenes/profile.png') !!}">
                                    </div>
                                </td>
                                <td>
                                    @if($player->position == 'Portero')
                                        <div class="posicion PT">
                                            <span>PT</span>
                                        </div>
                                        @elseif($player->position == 'Defensa')
                                        <div class="posicion DF">
                                            <span>DF</span>
                                        </div>
                                        @elseif($player->position == 'MedioCentro')
                                        <div class="posicion MC">
                                            <span>MC</span>
                                        </div>
                                    @elseif($player->position == 'Delantero')
                                        <div class="posicion DL">
                                            <span>DL</span>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="nombre">
                                        <span>{{$player->name}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="dorsal">
                                        <span>{{$player->number}}</span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('mister.formularios.newPlayerForm')
    @include('mister.modals.jugadores')
@endsection
@section('scripts')
    <script src="{{asset('js/mister/equipo.js')}}" type="text/javascript"></script>
@endsection