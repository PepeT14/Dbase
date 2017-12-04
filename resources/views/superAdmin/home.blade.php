@extends('layouts.app')
@section('content')
        <div class="col-lg-4 col-md-4 col-sm-6 r-full-width">
            <form action="{{route('superAdmin.invite')}}">
                <div class="saForm">
                    <h2>Invita a un administrador</h2>
                    <div class="inputs">
                        <input name="email" placeholder="Correo Electronico" type="text">
                        <select class="cs-select cs-skin-underline" name="club" id="clubSelect">
                            <option value="" disabled selected>Club</option>
                        @foreach($clubs as $club)
                                <option value="{{$club->name}}">{{$club->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <input class="inviteButton" type="submit" value="INVITAR">
                </div>
            </form>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 r-full-width">
            <form  action="{{route('league.create')}}">
                <div class="saForm">
                    <h2>Crea una Liga</h2>
                    <input name="name" placeholder="Nombre" type="text">
                    <input name="state" placeholder="Comunidad" type="text">
                    <input name="province" placeholder="Provincia" type="text">
                    <input name="category" placeholder="Categoría" type="text">
                    <input class="leagueButton" type="submit" value="CREAR LIGA">
                </div>
            </form>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 r-full-width">
        <form  action="{{route('club.create')}}">
            <div class="saForm">
                <h2>Crea un Club</h2>
                <div class="inputs">
                    <input name="name" placeholder="Nombre" type="text">
                    <input name="telephone" placeholder="Teléfono" type="text">
                    <input name="country" placeholder="Provincia" type="text">
                    <input name="city" placeholder="Ciudad" type="text">
                    <input name="address" placeholder="Dirección" type="text">
                    <select class="cs-select cs-skin-underline" name="state" id="stateSelect">
                        <option value="" disabled selected>Comunidad</option>
                        @foreach($states as $state)
                            <option value="{{$state}}">{{$state}}</option>
                        @endforeach
                    </select>
                </div>
                <input class="leagueButton" type="submit" value="CREAR CLUB">
            </div>
        </form>
        </div>

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#clubs">Clubs</a></li>
        <li><a data-toggle="tab" href="#leagues">Ligas</a></li>
    </ul>
    <div class="tab-content">
        <div id="clubs" class="tab-pane fadeInLeft active">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Ciudad</th>
                            <th>Administrador</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($clubs as $club)
                        <tr>
                            <td>{{$club->name}}</td>
                            <td>{{$club->city}}</td>
                            <td>{{$club->admin->username}}</td>
                            <td>{{$club->admin->status()}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div id="leagues" class="tab-pane fadeInRight">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Provincia</th>
                        <th>Comunidad</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($leagues as $league)
                        <tr>
                            <td>{{$league->name}}</td>
                            <td>{{$league->category}}</td>
                            <td>{{$league->province}}</td>
                            <td>{{$league->state}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
