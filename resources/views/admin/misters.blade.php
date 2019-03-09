@extends('layouts.app')
@section('content')
<div class="admin_home row justify-content-center align-items-center">
    <div class="main_panel col-10 admin_panel" id="tecnicos">
        <div class="col-12 panel_header animated faster">
            <div class="panel_title row justify-content-center">
                Equipo Técnico
            </div>
            <div class="panel_description row justify-content-center">
                <div class="col-md-6 col-sm-12">
                    Aquí se muestra la información relativa al equipo técnico del club para gestionar los equipos
                    y asignar estos equipos a los técnicos dirigáse a la sección <a id="link_equipos">Equipos</a>
                </div>
            </div>
        </div>
        <div class="row panel_body animated faster">
            @foreach($teams as $team)
                @if($team->mister)
                    <div class="mister_info">
                        <div class="mister_image">
                            <img src="{{$team->mister->file}}">
                        </div>
                        <div class="mister_desc">
                            <div class="mister_name">{{$team->mister->name}}</div>
                            <div class="mister_team">{{$team->name}}</div>
                        </div>
                    </div>
                @endif
            @endforeach
            <div class="mister_info">
                <div class="mister_image"></div>
            </div>
        </div>
    </div>
</div>
@endsection