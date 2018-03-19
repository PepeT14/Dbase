@if(Auth::guard('admin')->check())
    @include('layouts.admin')
@elseif(Auth::guard('mister')->check())
    @include('layouts.mister')
@else
<!DOCTYPE html>
<html class="no-js">
<head>
@include ('includes.meta')
<!-- Styles -->
    @include ('includes.styles')

    <script src="{{asset('js/vendor/modernizr.js')}}"></script>

</head>
<body>

{{--REGISTRO--}}

@if(Request::route()->getPrefix()=='/register')
    <link rel="stylesheet" href="{{asset('css/register.css')}}" type="text/css">
    <div class="bg-pic">
        <img class="bg-pic" src="{{asset('images/camino.jpg')}}" alt="">
        {{--@include('includes.header.registerHeader')--}}
    </div>
    <main class="main-content">
        @yield('content')
    </main>

    {{--WELCOME--}}

@elseif(Request::route()->getName() ==''  || Request::route()->getName()=='login')
    <div class="wrap push">
        <!-- Banner slider -->
    @include('includes.header.welcomeHeader')
    <!-- Banner slider -->

        <!-- Main Content-->
        <main class="main-content">
            @yield('content')
        </main>
    </div>

    {{--SUPER ADMINISTRADOR--}}

@elseif(Request::route()->getName()=='superAdmin.home')
    <link rel="stylesheet" href="{{asset('css/superAdmin.css')}}" type="text/css">

    @yield('content')

    {{--LOS DEMAS--}}

@else

    <div class="wrap push">

    @include('includes.header.header')


    <!-- Main Content -->
        <main class="main-content">
            <div class="container">
                @yield('content')
            </div>
        </main>
        <!-- Main Content -->

        <!--Footer-->
    {{--@include('includes.footer')--}}
    <!--Footer-->

    </div>
    <!--Menu Responsive-->
    @include('includes.slider-menu')
    <!--Menu Responsive-->
@endif
<!-- Scripts -->
@include('includes.scripts')
@yield('scripts')
</body>
</html>

@endif