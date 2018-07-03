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
                        <ul>
                            <li class="login" id="login">
                                <button class="btn-l btn-login" id="logear">
                                    <i class="fa fa-sign-in-alt"></i>
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
            <img class="fullscreen" id="fondo" src="{{asset('images/welcome/fondo1.jpg')}}" alt="">
            <img  id="logoWelcome" class="animated fadeIn delay-1s" src="{{asset('images/welcome/dbase2.png')}}" alt="">
            <div class="item active welc animated fadeInDown" id="welcomeText">
                <p>TEXTO</p>
            </div>

            <!-- Item -->
            <div class="item log" id="loginWelcome">
                <div class="container-login">
                    <div class="panel panel-transparent animated fadeInUp " id="login-view" data-error="{{$errors->has('username') ? '1' : '0'}}"
                         @if(Request::route()->getName()=='login') data-login='1' @endif>
                        <div class="panel-heading panel-title ">Login</div>
                        <div class="panel-body">
                            <form class="form-login"  role="form" method="POST" action="{{route('login.submit')}}" >
                                {{ csrf_field() }}
                                <div>
                                    <input id="username" type="text" placeholder="Usuario" name="username" value="{{ old('username') }}"  required>
                                </div>

                                <input id="password" type="password" placeholder="Contraseña" name="password"  required>
                                <button type="submit" class="btn-l btn-login btn-logger">
                                    Login
                                </button>
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                               <strong>{{ $errors->first('username') }}</strong>
                                           </span>
                                @endif
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                               <strong>{{ $errors->first('password') }}</strong>
                                           </span>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Item -->



        </div>
    </div>
    <!-- Wrapper for slides -->
</div>
