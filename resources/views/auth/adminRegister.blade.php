@extends('layouts.app')

@section('content')
    <div class="item log" >
        <img src="{{asset('images/camino.jpg')}}" alt="">
        <div class="position-center-x full-width">
            <div class="container-register">
                <div class="banner-layer-register pull-left">
                    <img class="animated fadeIn delay-1s" src="{{asset('images/welcome/dbase2.png')}}">
                </div>
                <div class="panel panel-transparent animated fadeInUp " id="login-view" data-error="{{$errors->has('username') ? '1' : '0'}}">
                    <div class="panel-heading panel-title ">Registro</div>
                    <div class="panel-body">
                        <form class="form-register"  role="form" method="POST" action="{{route('login.submit')}}" >
                            {{ csrf_field() }}
                            <div class="inputs">
                                <input id="name" type="text" placeholder="Nombre" name="username" value="{{ old('name') }}"  required>
                                <input id="email" type="email" placeholder="Email" name="username" value="{{ old('email') }}"  required>
                                <input id="username" type="text" placeholder="Usuario" name="username" value="{{ old('username') }}"  required>
                                <input id="password" type="password" placeholder="Contraseña" name="password"  required>
                            </div>
                            <button type="submit" class="btn-r btn-regist btn-register">
                                Register
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
    </div>
@endsection
