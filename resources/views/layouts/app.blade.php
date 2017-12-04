<!DOCTYPE html>
<html class="no-js">
<head>
    @include ('includes.meta')
    <!-- Styles -->
    @include ('includes.styles')

    <script src="{{asset('js/vendor/modernizr.js')}}"></script>

</head>
<body>
@if(Request::route()->getPrefix()=='/register')
    <link rel="stylesheet" href="{{asset('css/register.css')}}" type="text/css">
    <div class="bg-pic">
        <div class="wrap-push">
            {{--@include('includes.header.registerHeader')--}}
            <main class="main-content">
                @yield('content')
            </main>
        </div>
    </div>
@elseif(Request::route()->getName() ==''  || Request::route()->getName()=='login')
<div class="wrap push">
    <!-- Banner slider -->
    @include('includes.header.welcomeHeader')
    <!-- Banner slider -->

    <!-- Main Content-->
    <main class="main-content">
            @yield('content')
    </main>
    <!-- Main Content-->

    <!--Footer-->
    @include('includes.footer')
    <!--Footer-->

</div>
@elseif(Request::route()->getName()=='superAdmin.home')
    <link rel="stylesheet" href="{{asset('css/superAdmin.css')}}" type="text/css">

    @yield('content')
@else

<div class="wrap push">

    @include('includes.header.header')

    <!-- Page Heading banner -->

        <div class="overlay-dark theme-padding parallax-window" data-appear-top-offset="500" data-parallax="scroll" data-image-src="images/cabecera1.png"></div>
        <!-- Banner slider -->
        <div id="animated-slider" class="carousel slide carousel-fade">
            <!-- News Slider -->
            <div class="news-slider style-2">
                <div class="container">
                    <div class="news-slider-holder">
                        <div class="alert-spinner">
                            <div class="double-bounce1"></div>
                            <div class="double-bounce2"></div>
                        </div>
                        <ul id="ticker" class="ticker">
                            <li><span>Top Headlines:</span>Source: Manziel 'hung over' at Browns' meeting Clippers suspend Griffin four games.</li>
                            <li><span>Top Headlines:</span>Source: Manziel 'hung over' at Browns' meeting Clippers suspend Griffin four games.</li>
                            <li><span>Top Headlines:</span>Source: Manziel 'hung over' at Browns' meeting Clippers suspend Griffin four games.</li>
                            <li><span>Top Headlines:</span>Source: Manziel 'hung over' at Browns' meeting Clippers suspend Griffin four games.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- News Slider -->
        </div>

    <!-- Page Heading banner -->

    <!-- Main Content -->
        <main class="main-content">
            <div class="container">
                @yield('content')
            </div>
        </main>
    <!-- Main Content -->

    <!--Footer-->
    @include('includes.footer')
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
