@extends('layouts.app')
@section('content')
    <div class="main_panel col-10 admin_panel" id="teams">
        <div class="col-12 panel_header animated faster">
            <div class="btn outline float-right" id="add_team_button" data-action="modal" data-modalTarget="#add_team_form">
                <i class="fas fa-plus"></i>
                <span>AÑADIR EQUIPO</span>
            </div>
            <div class="panel_title row justify-content-center" id="team_title">
                <span id="team_name_title"></span>-<span id="team_category_title"></span>
                <i class="fa fa-bars" id="select_team_icon" data-toggle="tooltip" data-placement="left" title="Cambiar equipo." ></i>
            </div>
        </div>
        <div class="container panel_body" id="team_detail_content">
        </div>
        <div class="panel_select_overlay w-100 h-100" data-options="{{$teams}}">
            <button type="button" class="close close-menu">
                <i class="fa fa-times"></i>
            </button>
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-around">
                    <div class="col-4 first-row" id="team_category_selector">
                        <div class="selector_title"><span>Categoria</span></div>
                        <div class="divider-info"></div>
                        <div class="selector_options">
                            @foreach($teams as $team)
                                <ul>
                                    <li data-value="{{$team->category}}" class="option">{{$team->category}}</li>
                                    <li data-value="{{$team->category}}" class="option">Alevin</li>
                                </ul>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-4" id="team_name_selector">
                        <div class="selector_title"><span>Equipo</span></div>
                        <div class="selector_options">
                            <ul></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.modals.addTeam')
@endsection