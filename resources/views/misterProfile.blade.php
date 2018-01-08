@extends('layouts.app')

@section('content')
    <div class="col-lg-3 col-md-3 col-sm-5">
        <div class="team-column without-hover">
            <img src="{{asset($m->file)}}">
        </div>

    </div>
<table>
    <thead>
    <tr>
        <th>Nombre</th>
        <td>{{$m->name}}</td>
    </tr>
    <tr>
        <th>Fecha Nacimiento</th>
        <td>--</td>
    </tr>
    <tr>
        <th>Equipo Actual</th>
        <td>{{$t}}</td>
    </tr>
    <tr>
        <th>Liga Actual</th>
        <td>{{$league}}</td>
    </tr>
    <tr>
        <th>Útlimo Equipo</th>
        <td>{{$lastTeam}}</td>
    </tr>
    <tr>
        <th>Estudios</th>
        <td>--</td>
    </tr>
    <tr>
        <th>Nivel Entrenador</th>
        <td>--</td>
    </tr>
    </thead>
</table>
@endsection