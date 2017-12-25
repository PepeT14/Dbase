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
                            <h2>Crea un Club</h2>
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
                {{$teams}}
            </div>
        </div>
    </div>
@endsection