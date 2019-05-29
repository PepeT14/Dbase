@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{asset('css/register.css')}}" type="text/css">
@endsection
@section('content')
    <div class="container register-form-container">
        <div class="main_panel">
            <div class="register-form-title">
                <div class="col-12">
                    <h3>Bienvenido!</h3>
                    <span>Formulario para el administrador de  {{$club}}</span>
                </div>
            </div>
            <form id="admin-register-form" data-club="{{$club}}">
                <div class="input-field">
                    <i class="material-icons prefix">email</i>
                    <input type="email" id="admin-email" name="admin-email">
                    <label for="admin-email">Email</label>

                    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                        <circle id="admin-email-error" class="checkmark__circle" cx="25" cy="25" r="20" fill="none"></circle>
                        <path class="checkmark__icon check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"></path>
                        <path class="checkmark__icon cross" fill="none" d="M16 16 36 36 M36 16 16 36" ></path>
                    </svg>
                </div>
                <div class="input-field">
                    <i class="material-icons prefix">account_circle</i>
                    <input type="text" id="admin-username" name="admin-username">
                    <label for="admin-username">Usuario</label>
                    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                        <circle class="checkmark__circle" cx="25" cy="25" r="20" fill="none"></circle>
                        <path class="checkmark__icon check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"></path>
                        <path class="checkmark__icon cross" fill="none" d="M16 16 36 36 M36 16 16 36" ></path>
                    </svg>
                </div>
                <div class="input-field">
                    <i class="material-icons prefix">lock</i>
                    <input id="admin-password" name="admin-password" type="password">
                    <label for="admin-password">Contraseña</label>
                    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                        <circle class="checkmark__circle" cx="25" cy="25" r="20" fill="none"></circle>
                        <path class="checkmark__icon check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"></path>
                        <path class="checkmark__icon cross" fill="none" d="M16 16 36 36 M36 16 16 36" ></path>
                    </svg>
                </div>
                <div class="input-field">
                    <i class="material-icons prefix">lock</i>
                    <input id="admin-password_confirm" name="admin-password_confirm" type="password">
                    <label for="admin-password_confirm">Repite la contraseña</label>
                </div>
                <div class="buttons_form">
                    <button class="waves-effect waves-light teal btn btn">REGISTRARME</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/admin/register.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/validaciones.js')}}" type="text/javascript"></script>
@endsection