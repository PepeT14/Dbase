<!doctype html>
<html lang="es">
<head>
    @include ('includes.meta')
    @include ('includes.styles')
    @if(Auth::guard('mister')->check())
        <link rel="stylesheet" href="{{asset('css/mister.css')}}" type="text/css">
    @elseif(Auth::guard('admin')->check())
        <link rel="stylesheet" href="{{asset('css/admin.css')}}" type="text/css">
    @elseif(Auth::guard('superAdmin')->check())
        <link rel="stylesheet" href="{{asset('css/superAdmin.css')}}" type="text/css">
    @endif
    @yield('css')
</head>
<body>
<div class="loader"><img class="icono-loader" src="{{asset('imagenes/carga.png')}}"></div>

@auth('superAdmin')
   @yield('content')
@endauth

@auth('admin')
    <header id="admin_header">
        @include('admin.adminHeader')
    </header>
    <div class="main_content" id="admin_main_content">
        @yield('content')
    </div>
@endauth

@auth('mister')
    <div class="content">
        @include('admin.menu')
        @yield('content')
    </div>
@endauth

@guest
    @yield('content')
@endguest

@include('includes.scripts')
@if(Auth::guard('mister')->check())
    <script src="{{asset('js/mister/mister-main.js')}}" type="text/javascript"></script>
@endif
@if(Auth::guard('admin')->check())
    <script src="{{asset('js/admin/admin.js')}}" type="text/javascript" id="admin_js"></script>
@endif

@yield('scripts')
<script>
    $(window).on('load',function(){
        $('.loader').fadeOut('slow');
    });
</script>
</body>
</html>
