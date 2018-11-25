<!DOCTYPE html>
<html>
<head>
    @include ('includes.meta')
    @include ('vistasHerramienta.includes.styles')
</head>
<body>
<div class="loader"><img class="icono-loader" src="{{asset('assets/img/carga.png')}}"></div>
<div class="header-first container-fluid">
    <div class="content">
        <img class="logo-cabecera icono-accion ruta" src="{{asset('/assets/img/dbase.png')}}" data-href="{{route('home')}}">
        <div class="icono-profile">
            <img class="img-fluid user-icon icono-accion ruta" src="{!! $mister->file ? asset($mister->file) : asset('assets/img/profile.png') !!}">
        </div>
    </div>
</div>
<div class="header-second container-fluid">
    @if(Request::route()->getName()!=='home')
    <div class="content d-flex align-items-center">
        <i class="fa fa-arrow-left icono-navegacion-cabecera icono-accion ruta" data-href="{{url()->previous()}}"></i>
    </div>
    @endif
</div>
<div class="container-fluid d-flex justify-content-center align-items-center flex-column">
    @yield('content')
</div>
</body>
@include('vistasHerramienta/includes/scripts')
@yield('scripts')
</html>