<!DOCTYPE html>
<html class="no-js">
<head>
    @include ('includes.meta')
    @include ('includes.styles')
    @yield('css')
</head>
<body>
<div class="loader"><img class="icono-loader" src="{{asset('imagenes/carga.png')}}"></div>

@yield('content')

@include('includes.scripts')

@yield('scripts')
</body>
</html>
