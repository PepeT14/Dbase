<!DOCTYPE html>
<html class="no-js">
<head>
@include ('includes.meta')
<!-- Styles -->
    @include ('includes.styles')
    {{--Admin--}}
    <link rel="stylesheet" href="{{asset('assets/css/admin.css')}}" type="text/css">
    <script src="{{asset('js/vendor/modernizr.js')}}"></script>

</head>
<body>
<!-- Main Content -->
<main class="main-content">
    <div class="fixed-header">
        @include('includes.sidebar')
    </div>
    <div class="container">
        <div class="adminHeader">
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
                <h2>Panel de Administración</h2>
            </div>
            <div class=" pull-right">
                @include('includes.user-info')
            </div>
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
<script src="{{asset('assets/js/admin/admin.js')}}" type="text/javascript"></script>
@yield('scripts')
</body>
</html>
