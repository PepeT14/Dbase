<!DOCTYPE html>
<html>
<head>
    @include ('includes.meta')
    @include ('vistasHerramienta.includes.styles')
</head>
<body>
<div class="loader"><img class="icono-loader" src="{{asset('assets/img/carga.png')}}"></div>
<div class="header-first container-fluid">
    <div>
        <img class="logo-cabecera icono-accion" src="" data-src="{{asset('/assets/img/dbase.png')}}" data-href="{{route('home')}}">
    </div>
</div>
<div class="header-second container-fluid">
    @if(Request::route()->getName()!=='mister.herramienta')
    <div class="contenido-segunda-cabecera d-flex align-items-center">
        <i class="fa fa-arrow-left icono-navegacion-cabecera icono-accion" data-href="{{url()->previous()}}"></i>
    </div>
    @endif
</div>
<div class="container-fluid d-flex justify-content-center">
    @yield('content')
</div>
</body>
@include('vistasHerramienta/includes/scripts')
@yield('scripts')
</html>