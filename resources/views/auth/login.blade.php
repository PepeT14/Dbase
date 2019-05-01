@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{asset('css/login.css')}}" type="text/css">
@endsection
@section('content')
    <div class="login-bck">
        <div class="login-container d-flex justify-content-center align-items-center">
            <div class="container d-flex justify-content-center align-items-center">
                <div class="seccion-inicial">
                    <div class="login-button">
                        <button class="btn btn-login teal darken-2">LOGIN</button>
                    </div>
                    <div class="divider"></div>
                    <div class="registra-club">
                        <button class="btn btn-register welcome-btn teal darken-2" data-section=".club-register-form">REGISTRA TU CLUB</button>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-10 welcome-form-container" id="login-form">
                    @include('includes.auth.login-form')
                </div>
                <div class="welcome-form-container col-md-6 col-sm-10" id="register-club-form">
                    @include('includes.auth.clubRegister')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/auth/login.js')}}" type="text/javascript"></script>
@endsection

