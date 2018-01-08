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
                    <table>
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
                                    <td>{{$team->name}}</td>
                                    <td>{{$team->category}}</td>
                                    <td>{{$team->league->name}}</td>
                                    @if($misters->count()>0)
                                        <td><a href="{{route('mister.profile',['mister'=>$misters->get(0)])}}">{{$misters->get(0)->name}}</a></td>
                                    @else
                                        <td><form action="{{route('mister.invite',['team' => $team->name])}}">
                                                <input name="email" placeholder="Correo Electrónico" type="email">
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection