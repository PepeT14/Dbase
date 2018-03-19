<!DOCTYPE html>
<html class="no-js">
<head>
@include ('includes.meta')
<!-- Styles -->
    @include ('includes.styles')
    {{--Admin--}}
    <link rel="stylesheet" href="{{asset('assets/css/mister.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/tacticas.css')}}" type="text/css">
    <script src="{{asset('js/vendor/modernizr.js')}}"></script>

</head>
<body>
<!-- Main Content -->
<main class="main-content">
    <div class="container">
        <div class="adminHeader">
            <div class="pull-left icon-menu">
                <i class="fa fa-list"></i>
            </div>
            <div class="pull-left ">
                <div class="header-inner">
                    <div class="brand inline">
                        <a href="{{action('HomeController@index')}}">
                            <img class="logo" src="{{asset('assets/img/dbase.png')}}" alt="logo">
                        </a>
                    </div>
                </div>

            </div>
            <div class="title">
            </div>
            <div class=" pull-right">
                @include('includes.user-info')
            </div>
        </div>
        <div class="sidebar-menu">
            <div class="sidebar-header">
                FootdBase
            </div>
            <ul class="menu-items">
                <li class="m-t-30"></li>
                <li><a href="{{action('misterController@home')}}">Inicio
                       </a>
                    <span class="icon-sidebar">
                            <i class="fa fa-lg fa-home"></i>
                        </span></li>
                <li><a href="{{action('misterController@tactica')}}">Tactica
                    </a>
                    <span class="icon-sidebar">
                        <i class="fa fa-lg fa-clipboard"></i></span></li>
            </ul>
        </div>
        @yield('content')
    </div>
</main>
<!-- Main Content -->

<!--Menu Responsive-->
@include('includes.slider-menu')
<!--Menu Responsive-->

<!-- Scripts -->
@include('includes.scripts')
@yield('scripts')
</body>
</html>