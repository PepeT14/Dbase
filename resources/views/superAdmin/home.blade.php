@extends('layouts.app')
@section('content')
    <div>
        <div class="inviteForm">
            <h2>Invita a un administrador</h2>
            <div class="inputs">
                <input name="username" placeholder="username" type="text">
                <select class="cs-select cs-skin-underline">
                    <option value="" disabled selected>Club</option>
                </select>
            </div>

            <input class="inviteButton" type="submit" value="invite">
        </div>
        <div class="leagueForm">
            <h2>Crea una Liga</h2>
            <input name="name" placeholder="Nombre" type="text">
            <input name="state" placeholder="Comunidad" type="text">
            <input name="province" placeholder="Provincia" type="text">
            <input name="category" placeholder="Categoría" type="text">
            <input class="leagueButton" type="submit" value="create">
        </div>
    </div>
@endsection
