<!-- Header -->
<header class="header style-2">

    <!-- Top bar Nd Logo Bar -->
    <div class="topbar-and-logobar">
        <div class="container">

            <!-- Top bar -->
            <div class="top-bar">
                <div class="row">
                    <!-- Login Option -->
                    <div class="col-sm-6 col-xs-12 pull-right">
                        <ul class="login active">
                            <li class="login">
                                <button class="btn-l btn-login">
                                    <i class="fa fa-user"></i>
                                    Login
                                </button>
                            </li>
                        </ul>
                    </div>
                    <!-- Login Option -->
                </div>
            </div>
            <!-- Top bar -->

        </div>
    </div>
    <!-- Top bar Nd Logo Bar -->
</header>
<!-- Header -->


<div id="animated-slider-2" class="carousel slide carousel-fade" data-interval="false">

    <!-- Wrapper for slides -->
    <div class="inner-banner-2">
        <div class="carousel-inner" role="listbox">
            <!-- Item -->
            <div class="item welc active f" id="welcome">
                <img class="fullscreen" src="{{asset('images/welcome/fondo1.png')}}" alt="">
                <div class="position-center-x full-width">
                    <div class="container">
                        <div class="banner-layer pull-left">
                            <img class="animated fadeIn delay-1s" src="{{asset('images/welcome/dbase2.png')}}" alt="">
                        </div>
                        <div class="banner-caption style-1 p-white h-white pull-right">
                            <h1 class="animated fadeInUp delay-3s">¿Aún no tienes<br> la app <span>indispensable</span> <br> para ti?</h1>
                            <p class="animated fadeInUp delay-4s">Conoce Dbase y conocerás un nuevo mundo <br>dónde tú eres la estrella!</p>
                            <a class="btn lg blue-btn animated fadeInRight delay-4s" href="#">Descargar</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Item -->


            <!-- Item -->
            <div class="item log" >
                <img class="fullscreen" src="{{asset('images/welcome/fondo1.png')}}" alt="">
                <div class="position-center-x full-width">
                    <div class="container">
                        {{--<div class="banner-layer pull-left">--}}
                            {{--<img class="animated fadeIn delay-1s" src="{{asset('images/welcome/dbase2.png')}}" alt="">--}}
                        {{--</div>--}}
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-transparent animated fadeInUp " id="login-view" data-error="{{$errors->has('username') ? '1' : '0'}}">
                                    <div class="panel-heading panel-title ">Login</div>
                                    <div class="panel-body">
                                        <form class="form-login"  role="form" method="POST" action="{{route('login.submit')}}" >
                                            {{ csrf_field() }}
                                            <div class="form-group-login">
                                                    <label for="username">username</label>
                                                @if ($errors->has('username'))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first('username') }}</strong>
                                                        </span>
                                                @endif
                                                    <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}"  required>



                                            </div>

                                            <div class="form-group-login">
                                                    <label for="password">Contraseña</label>
                                                <div class="controls">
                                                    <input id="password" type="password" class="form-control" name="password"  required>
                                                    @if ($errors->has('password'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-8 col-md-offset-4" id="login-button">
                                                    <button type="submit" class="btn-l btn-login btn-logger">
                                                        Login
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Item -->

            {{--<!-- Item -->--}}
            {{--<div class="item">--}}
            {{--<img class="fullscreen" src="images/banner-slider-2/img-01.jpg" alt="">--}}
            {{--<div class="position-center-x full-width">--}}
            {{--<div class="container">--}}
            {{--<div class="banner-layer pull-left">--}}
            {{--<img class="animated fadeIn delay-1s" src="images/banner-slider-2/banner-layer-1.png" alt="">--}}
            {{--</div>--}}
            {{--<div class="banner-caption style-1 p-white h-white pull-right">--}}
            {{--<h1 class="animated fadeInUp delay-3s">If you Don’t Practice<br> You <span>Don’t Derserve</span> <br> to win!</h1>--}}
            {{--<p class="animated fadeInUp delay-4s">You can make a case for several potential winners of <br>the expanded European Championships.</p>--}}
            {{--<a class="btn lg blue-btn animated fadeInRight delay-4s" href="#">Read More</a>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<!-- Item -->--}}

        </div>
    </div>
    <!-- Wrapper for slides -->
</div>
