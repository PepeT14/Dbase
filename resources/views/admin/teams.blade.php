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
                <div class="col-lg-12 col-md-12 col-sm-12 r-full-width">

                    <table class="teamTable">
                        <thead>
                        <tr>
                            <th> Equipo </th>
                            <th> Categoría </th>
                            <th> Liga </th>
                            <th> Entrenador </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($teams as $team)
                            <tr>
                                <td><a href="{{route('team.home',$team->id)}}">{{$team->name}}</a></td>
                                <td>{{$team->category}}</td>
                                <td><a href="{{route('league.home',$team->league->id)}}">{{$team->league->name}}</a></td>
                                @if($team->mister)
                                    <td><a href="{{route('mister.profile',$team->mister)}}">{{$team->mister->name}}</a></td>
                                @elseif($team->misterstatus()=='Pendiente')
                                    <td>Invitado, pendiente de registro</td>
                                @else
                                    <td><form action="{{route('mister.invite',['team' => $team->name])}}">
                                            <input name="email" placeholder="Correo Electrónico" type="email">
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        <tr>
                            <td><button id="formAddTeam" type="button"><i class="fa fa-plus"></i>Añadir</button></td>
                        </tr>
                        <tr class="add-team" style="display:none;">
                            <form action="{{route('team.create')}}">
                                <td><input name="name" placeholder="Nombre del Equipo" type="text"></td>
                                <td><input name="category" placeholder="Categoría"></td>
                                <td><select name="league">
                                        @foreach($leagues as $league)
                                            <option value="{{$league->name}}">{{$league->name}}</option>
                                        @endforeach
                                    </select></td>
                                <td><button type="submit" id="addTeam">Añadir</button></td>
                            </form>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection