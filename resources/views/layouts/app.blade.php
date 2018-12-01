<!doctype html>
<html lang="es">
<head>
    @include ('includes.meta')
    @include ('includes.styles')
    @if(Auth::guard('mister')->check())
        <link rel="stylesheet" href="{{asset('css/mister.css')}}" type="text/css">
    @endif
    @yield('css')
</head>
<body>
<div class="loader"><img class="icono-loader" src="{{asset('imagenes/carga.png')}}"></div>
@if(Auth::guard('mister')->check())
    @include('mister.mister-header')
    <div class="container-fluid d-flex justify-content-center align-items-center flex-column main-content">
        @yield('content')
    </div>
@else
    @yield('content')
@endif

@include('includes.scripts')
@if(Auth::guard('mister')->check())
    <script src="{{asset('js/mister/mister-main.js')}}" type="text/javascript"></script>
@endif
@yield('scripts')
</body>
</html>
