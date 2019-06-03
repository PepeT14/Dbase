@extends('layouts.app')
@section('content')
    <div class="main_section" id="teams">
        <div class="admin_teams">
            <div class="main_team_panel second_header z-depth-1" id="federados_link" data-section="#federados_section">
                <span class="material-icons back_icon">arrow_back</span>
                <span class="title">FEDERADOS</span>
            </div>
            <div class="main_team_panel second_header z-depth-1" id="escuela_link" data-section="#escuela_section">
                <span class="material-icons back_icon">arrow_back</span>
                <span class="title">ESCUELA</span>
            </div>

        </div>
        <div class="teams_section content_section" id="federados_section" data-teams="{{$teams}}" data-leagues="{{$leagues}}">

        </div>
        <div class="teams_section content_section" id="escuela_section" data-teams="{{$teamsNof}}"></div>
    </div>
    <div class="modal modal-panel fade teams" id="add_team_form" data-error={{$errors ? '1' : '0'}}>
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-title">
                    Nuevo Equipo
                </div>
                <form>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="text" id="team-name" name="team-name">
                            <label for="team-name">Nombre del equipo</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <select id="team-category" name="team-category">
                                <option value="" disabled selected>Eliga una categoria</option>
                                <option value="menores">Pitufines</option>
                                <option value="prebenjamin">Prebenjamín</option>
                                <option value="benjamin">Benjamín</option>
                                <option value="alevin">Alevín</option>
                                <option value="infantil">Infantil</option>
                                <option value="cadete">Cadete</option>
                                <option value="juvenil">Juvenil</option>
                            </select>
                            <label for="team-category">Categoria</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="buttons-form col s12">
                            <button class="waves-effect waves-light btn btn-small red lighten-2 modal-close cancel col s6 m2 offset-m8">Cancelar</button>
                            <button class="waves-effect waves-light btn teal btn-small col s6 m2" type="submit">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection