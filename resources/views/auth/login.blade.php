@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{asset('css/login.css')}}" type="text/css">
@endsection
@section('content')
    <div class="login-bck">
        <div class="container buttons-container login-container">
            {{-- BOTONES PRINCIPALES --}}
            <div class="seccion-inicial">
                <div class="login-button">
                    <button class="btn btn-login teal darken-2">LOGIN</button>
                </div>
                <div class="divider"></div>
                <div class="registra-club">
                    <button class="btn btn-register teal darken-2" data-section=".club-register-form">REGISTRA TU CLUB</button>
                </div>
            </div>

            {{-- FORMULARIO DE LOGIN --}}
            <div class="main_panel z-depth-1" id="login-form-panel">
                <i class="material-icons back hover-effect">arrow_back</i>
                <div class="form-title">Login</div>
                <div class="formulario-contenido">
                    <form id="login_form">
                        <div class="input-field required">
                            <i class="material-icons prefix">account_circle</i>
                            <input type="text" id="username" name="username" autocomplete="current-username">
                            <label for="username">Usuario</label>
                        </div>
                        <div class="input-field required">
                            <i class="material-icons prefix">lock</i>
                            <input type="password" id="password" name="password" autocomplete="current-password">
                            <label for="password">Contraseña</label>
                        </div>
                        <div class="buttons-form row">
                            <button class="waves-effect waves-light btn teal" type="submit">ENTRAR</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- FORMULARIO DE REGISTRO DE CLUB --}}
            <div class="main_panel z-depth-1" id="registerClub-form-panel">
                <div class="form-title">Registra tu club</div>
                <div class="form-info">
                    Tras solicitar el registro se enviará un email de invitación a la direccion de correo que se indique en este formulario.
                </div>
                <div class="formulario-contenido">
                    <form id="form-register-club">
                        <div class="row">
                            <div class="input-field required col s12 m6">
                                <input id="club-name" type="text" name="club-name">
                                <label for="club-name">Nombre del club</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input id="club-telephone" type="text" name="club-telephone">
                                <label for="club-telephone">Telefóno de contacto</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m6 required">
                                <label for="club-state">Comunidad</label>
                                <input id="club-state" name="club-state" type="text">
                            </div>
                            <div class="input-field col s12 m6 required">
                                <label for="club-province">Provincia</label>
                                <input id="club-province" name="club-province" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="club-address">Dirección</label>
                                <input id="club-address" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field required col s12">
                                <label for="club-email">Email de contacto</label>
                                <input id="club-email" name="club-email" type="email" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="buttons-form col s12">
                                <button class="waves-effect waves-light btn red lighten-2 modal-close cancel">Cancelar</button>
                                <button class="waves-effect waves-light btn teal" type="submit">Registrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/auth/login.js')}}" type="text/javascript"></script>
@endsection

