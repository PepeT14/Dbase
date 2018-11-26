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
                        <button class="btn btn-login">LOGIN</button>
                    </div>
                    <div class="divider"></div>
                    <div class="registra-club">
                        <button class="btn btn-register">REGISTRA TU CLUB</button>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-10" id="login-form">
                    @include('includes.auth.login-form')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/auth/login.js')}}" type="text/javascript"></script>
@endsection

