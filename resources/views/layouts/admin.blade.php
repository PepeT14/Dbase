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
