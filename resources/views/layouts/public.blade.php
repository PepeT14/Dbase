<!DOCTYPE html>
<html class="no-js">
<head>
@include ('includes.meta')
<!-- Styles -->
    @include ('includes.styles')
    <script src="{{asset('js/vendor/modernizr.js')}}"></script>
</head>
<body>
<div class="sidebar-menu">
    <ul class="menu-items">
        <li class="m-t-30"><a href="{{action('adminController@home')}}">Inicio
                <i class="fa fa-home"></i></a></li>
    </ul>
</div>
@yield('content')
<!-- Scripts -->
@include('includes.scripts')
@yield('scripts')
</body>
</html>