@extends('layouts.admin')
@section('content')
    <div class="content admin">
        <div class="toolbar row">
            <div class="col-sm-6">
                <div class="page-header">
                    <h1>
                        Equipos
                    </h1>
                    <small>Añade, invita, comunica...</small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb">

                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 r-full-width">
                    <form  action="{{route('team.create')}}">
                        <div class="teamForm">
                            <h2>Crea un Equipo</h2>
                            <div class="inputs">
                                <input name="name" placeholder="Nombre" type="text">
                                <select class="cs-select cs-skin-underline" name="league">
                                    <option value="" disabled selected>Liga</option>
                                    @foreach($leagues as $league)
                                        <option value="{{$league->name}}">{{$league->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input class="formButton" type="submit" value="CREAR EQUIPO">
                        </div>
                    </form>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 r-full-width">
                    <form action="{{route('mister.invite')}}">
                        <div class="teamForm">
                            <h2>Invita a un entrenador</h2>
                            <div class="inputs">
                                <input name="email" placeholder="Correo Electronico" type="text">
                                <select class="cs-select cs-skin-underline" name="team" id="teamSelect">
                                    <option value="" disabled selected>Equipo</option>
                                    @foreach($teams as $team)
                                        <option value="{{$team->name}}">{{$team->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input class="formButton" type="submit" value="INVITAR">
                        </div>
                    </form>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 r-full-width">
                    <table>
                        <thead>
                        <tr>
                            <th>Equipo</th>
                            <th>Entrenador</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($misters->isEmpty())
                        @foreach($misters as $mister)
                            <tr>
                                <td>{{$mister->team->name}}</td>
                                <td>{{$mister->name}}</td>
                            </tr>
                        @endforeach
                        @else
                            @foreach($teams as $team)
                                <tr>
                                    <td>{{$team->name}}</td>
                                    <td>INVITAR</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection