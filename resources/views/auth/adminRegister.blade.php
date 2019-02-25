@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{asset('css/SASS/register.css')}}" type="text/css">
@endsection
@section('content')
    <div class="row align-items-center justify-content-center register-form-container">
        <div class="col-md-6 register-form">
            <div class="row register-form-title justify-content-center">
                <div class="col-12">
                    <h3>Bienvenido!</h3>
                    <span>Formulario para el administrador de  {{$club}}</span>
                </div>
            </div>
            <form id="admin-register-form" class="register-form" data-club="{{$club}}">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-envelope"></i></div>
                    </div>
                    <input type="email" id="admin-email" name="admin-email" class="form-control" placeholder="Email">

                    <div class="input-group-append ">
                        <div class="input-group-text check-container">
                            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                                <circle id="admin-email-error" class="checkmark__circle" cx="25" cy="25" r="20" fill="none"></circle>
                                <path class="checkmark__icon check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"></path>
                                <path class="checkmark__icon cross" fill="none" d="M16 16 36 36 M36 16 16 36" ></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-user"></i></div>
                    </div>
                    <input type="text" id="admin-username" name="admin-username" class="form-control" placeholder="Usuario" autocomplete="username">
                    <div class="input-group-append ">
                        <div class="input-group-text check-container">
                            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                                <circle class="checkmark__circle" cx="25" cy="25" r="20" fill="none"></circle>
                                <path class="checkmark__icon check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"></path>
                                <path class="checkmark__icon cross" fill="none" d="M16 16 36 36 M36 16 16 36" ></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-lock"></i></div>
                    </div>
                    <input type="password" id="admin-password" name="admin-password" class="form-control" placeholder="Contraseña" autocomplete="new-password">
                    <div class="input-group-append ">
                        <div class="input-group-text check-container">
                            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                                <circle class="checkmark__circle" cx="25" cy="25" r="20" fill="none"></circle>
                                <path class="checkmark__icon check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"></path>
                                <path class="checkmark__icon cross" fill="none" d="M16 16 36 36 M36 16 16 36" ></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-lock"></i></div>
                    </div>
                    <input type="password" id="admin-password_confirm" name="admin-password_confirm" class="form-control" placeholder="Repite la contraseña"">
                    <div class="input-group-append ">
                        <div class="input-group-text check-container">
                            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                                <circle class="checkmark__circle" cx="25" cy="25" r="20" fill="none"></circle>
                                <path class="checkmark__icon check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"></path>
                                <path class="checkmark__icon cross" fill="none" d="M16 16 36 36 M36 16 16 36" ></path>
                            </svg>
                        </div>
                    </div>
                </div>
               <div class="row justify-content-center mt-2">
                   <button class="btn btn-submit" type="submit">REGISTRARME</button>
               </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/admin/register.js')}}" type="text/javascript"></script>
@endsection