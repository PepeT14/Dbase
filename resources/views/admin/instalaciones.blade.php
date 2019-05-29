@extends('layouts.app')
@section('content')
    <div class="main_section" id="instalaciones">
        <div class="second_header instalaciones_header z-depth-1">
            <div class="title">instalaciones</div>
        </div>
        <div class="content_section instalaciones_section">
            @if($instalaciones->isEmpty())
                <div class="main_add_button waves-effect waves-light teal darken-2 btn-large modal-trigger" id="add_instalacion_button" data-target="add_instalacion_form">
                    <i class="material-icons left">add</i>Añadir instalación
                </div>
            @else
                <div class="main_add_button waves-effect waves-light teal darken-2 btn btn-small right modal-trigger" id="add_instalacion_button" data-target="add_instalacion_form">
                    <i class="material-icons left">add</i>Añadir instalación
                </div>
                {{-- CONTENIDO PRINCIPAL --}}
                <div class="instalaciones_content row">
                    @foreach($instalaciones as $instalacion)
                        <div class="i_card z-depth-1">
                            <div class="instalacion_info">
                                <div class="title">{{$instalacion->name}} · Fútbol {{$instalacion->tipo}} · {{$instalacion->terreno}}</div>
                                <div class="instalacion_img">
                                    @switch($instalacion->terreno)
                                        @case('tierra')
                                        <img src="{{asset('imagenes/campos/campotierra.png')}}">
                                        @break
                                        @case('cesped')
                                        <img src="{{asset('imagenes/campos/campocesped.png')}}">
                                        @break
                                        @default
                                        <img src="{{asset('imagenes/campos/campofutsal.png')}}">
                                    @endswitch
                                </div>
                            </div>
                            <div class="instalacion_sectores">
                                <div class="title">Sectores</div>
                                @if(is_null($instalacion->sectores))
                                    <div class="sectores_info"><span class="sector" data-title="Sector único"></span></div>
                                @else
                                    <div class="sectores_info">
                                        @for($i=0;$i<$instalacion->sectores;$i++)
                                            <span class="sector s{{$i}}" data-title="Sector {{$i}}"></span>
                                        @endfor
                                    </div>
                                @endif
                            </div>
                            <div class="instalacion_menu" data-instalacion="{{$instalacion}}">
                                <div class="menu_link edit_instalacion_button">
                                    <i class="material-icons">visibility</i>
                                </div>
                                <div class="menu_link modal-trigger" data-target="confirm_delete">
                                    <i class="material-icons">delete</i>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- BANDA LATERAL DE LAS RESERVAS DE LA INSTALACION --}}
                <div id="reservas_content" data-teams="{{$admin->club->teams}}">
                    <button class="btn btn-small waves-effect waves-light teal modal-trigger" id="add_reserva_button" data-target="add_reserva_form"><i class="material-icons left">date_range</i>Reservas</button>
                    <ul class="collapsible expandable">

                    </ul>
                </div>
            @endif
        </div>
    </div>


    {{--  FORMULARIO AÑADIR INSTALACION --}}
    <div class="modal instalaciones" id="add_instalacion_form" data-error={{$errors ? '1' : '0'}}>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="form-title">
                    Nueva Instalacion
                </div>
                <form>
                    <div class="row">
                        <div class="input-field required col s12">
                            <input type="text" id="instalacion-name" name="instalacion-name">
                            <label for="instalacion-name">Nombre de la pista</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m6">
                            <div class="input-field required">
                                <select id="instalacion-tipo" name="instalacion-tipo">
                                    <option value="" disabled selected>Eliga un tipo de pista</option>
                                    <option value="7">Fútbol 7</option>
                                    <option value="11">Fútbol 11</option>
                                    <option value="sala">Fútbol sala</option>
                                </select>
                                <label for="instalacion-tipo">Tipo</label>
                            </div>
                        </div>
                        <div class="col s12 m6">
                            <div class="input-field required">
                                <select id="instalacion-terreno" name="instalacion-terreno">
                                    <option value="" disabled selected>Eliga un terreno</option>
                                    <option value="tierra">Tierra</option>
                                    <option value="cesped">Cesped</option>
                                    <option value="pabellon">Pabellon</option>
                                    <option value="exterior">Exterior</option>
                                </select>
                                <label for="instalacion-terreno">Terreno</label>
                            </div>
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

    {{-- CONFIRMACIONN PARA ELIMINAR UNA INSTALACION --}}
    <div class="modal bottom-sheet instalaciones" id="confirm_delete">
        <div class="modal-content">
            <h4 class="red-text">Eliminar instalación</h4>
            <p>Una vez eliminada no se podrá volver atrás. Confirme para continuar con la eliminación.</p>
        </div>
        <div class="row">
            <div class="buttons-form col s12">
                <button class="btn waves-effect waves-light grey darken-3 modal-close col m4 s6 offset-m4">Cancelar</button>
                <button class="btn waves-effect waves-light red lighten-2 col m4 s6"  id="delete_instalacion_button">Eliminar instalación</button>
            </div>
        </div>
    </div>

    {{-- FORMULARIO AÑADIR RESERVA --}}
    <div class="modal instalaciones" id="add_reserva_form">
        <div class="modal-content">
            <form>
                <div class="input-field required">
                    <i class="material-icons prefix">date_range</i>
                    <input type="text" class="timepicker" id="dia-reserva" name="dia-reserva">
                    <label for="dia-reserva">Día de la reserva</label>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="input-field required">
                            <i class="material-icons prefix">query_builder</i>
                            <input type="text" class="timepicker" id="horaInicio-reserva" name="horaInicio-reserva">
                            <label for="horaInicio-reserva">Hora inicio</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="input-field required">
                            <i class="material-icons prefix">query_builder</i>
                            <input type="text" class="timepicker" id="horaFin-reserva" name="horaFin-reserva">
                            <label for="horaFin-reserva">Hora fin</label>
                        </div>
                    </div>
                </div>
                <div class="input-field required">
                    <i class="material-icons prefix">create</i>
                    <textarea id="uso-reserva" class="materialize-textarea" data-length="120" name="uso-reserva"></textarea>
                    <label for="uso-reserva">Motivo de la reserva</label>
                </div>
                <div class="row">
                    <div class="col m6">
                        <label>
                            <input type="checkbox" class="filled-in" id="team_check"/>
                            <span>Reserva de un equipo</span>
                        </label>
                    </div>
                    <div class="col m6 s12">
                        <div class="input-field required" style="display:none;opacity:0;">
                            <select id="team-reserva" name="team-reserva">
                                <option value="" disabled selected>Eliga un equipo</option>
                                @foreach($ADMIN->club->teams as $team)
                                    <option value="{{$team->id}}">{{$team->name}} - {{$team->category}} </option>
                                @endforeach
                            </select>
                            <label for="team-reserva">Equipo para la reserva</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="buttons-form col s12 mr-2">
                        <button class="waves-effect waves-light btn-small red lighten-2 modal-close cancel col s6 m2 offset-m8">Cancelar</button>
                        <button class="waves-effect waves-light btn-small teal col s6 m2" type="submit">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection