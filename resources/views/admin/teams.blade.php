@extends('layouts.app')
@section('content')
    <div class="admin_teams main_section container-fluid" id="teams">
        <div class="main_team_panel" id="federados_link" data-section="#federados_section">
            <span class="material-icons back_icon">arrow_back</span>
            <span class="title">FEDERADOS</span>
        </div>
        <div class="main_team_panel" id="escuela_link" data-section="#escuela_section">
            <span class="material-icons back_icon">arrow_back</span>
            <span class="title">ESCUELA</span>
        </div>

        <div class="content_section container-fluid">
            <div class="teams_section" id="federados_section" data-teams="{{$teams}}" data-leagues="{{$leagues}}"></div>
            <div class="teams_section" id="escuela_section" data-teams="{{$teamsNof}}"></div>
        </div>
    </div>
    <div class="modal_content">
        @include('admin.addTeam')
    </div>
@endsection