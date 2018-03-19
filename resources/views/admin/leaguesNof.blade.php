@extends('layouts.admin')
@section('content')
    <div class="content admin">
        @if($leaguesNof->isEmpty())
            No hay ligas
            @else
            @foreach($leaguesNof as $leagueNof)
            {{$leagueNof->name}}
            @endforeach
        @endif
            <button id="showLeagueForm">Crear Liga</button>
            <form action="{{route('leagueNof.create')}}" style="display:none;" id="addLeagueForm">
                <div class="leagueNofForm">
                    <h2>Crear Liga</h2>
                    <input name="name" placeholder="nombre">
                    <input name="category" placeholder="Categoria">
                    <button>Crear</button>
                </div>
            </form>
    </div>
@endsection