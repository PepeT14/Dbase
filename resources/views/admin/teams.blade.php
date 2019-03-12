@extends('layouts.app')
@section('content')
    <div class="admin_home row justify-content-center align-items-center">
        <div class="main_panel col-10 row admin_panel" id="teams">
            <div class="col-12 panel_header animated faster">
                <div class="panel_title row justify-content-center">
                    <select id="team_select" title="Categoria">
                        <optgroup label="category">
                            @foreach($teams as $team)
                                <option value="{{$team->id}}">{{$team->category}}</option>
                            @endforeach
                        </optgroup>
                        <optgroup label="team">
                            @foreach($teams as $team)
                                <option value="{{$team->id}}">{{$team->name}}</option>
                            @endforeach
                            <option>Alevin</option>
                            <option>Infantik</option>
                            <option>Cadete</option>
                            <option>Juvenil</option>
                            <option>ececce</option>
                        </optgroup>
                    </select>
                </div>
            </div>
            <div class="container panel_body" id="team_detail_content">
            </div>
        </div>
    </div>
@endsection