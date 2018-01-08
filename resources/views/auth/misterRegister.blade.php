@extends('layouts.app')

@section('content')
    <div class="item log" >
        <div class="position-center-x full-width">
            <div class="container-register" id="formReg">
                <div class="banner-layer-register pull-left">
                    <a  href="/"><img class="animated fadeIn delay-1s" src="{{asset('images/welcome/dbase2.png')}}"></a>
                </div>
                <div class="panel panel-transparent animated fadeInUp " id="login-view" data-error="{{$errors->has('username') ? '1' : '0'}}">
                    <div class="panel-heading panel-title ">Registro</div>
                    <div class="panel-body">
                        <form class="form-register"  role="form" method="POST" action="{{route('mister.submit')}}" >
                            {{ csrf_field() }}
                            <div class="inputs">
                                <input id="name" type="text" placeholder="Nombre" name="name" value="{{ old('name') }}"  required>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                               <strong>{{ $errors->first('name') }}</strong>
                                           </span>
                                @endif
                                <input id="email" type="email" placeholder="Correo Electrónico" name="email" value="{{ old('email') }}"  required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                               <strong>{{ $errors->first('email') }}</strong>
                                           </span>
                                @endif
                                <input id="username" type="text" placeholder="Usuario" name="username" value="{{ old('username') }}"  required>
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                               <strong>{{ $errors->first('username') }}</strong>
                                           </span>
                                @endif
                                <input id="password" type="password" placeholder="Contraseña" name="password"  required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                               <strong>{{ $errors->first('password') }}</strong>
                                           </span>
                                @endif
                                <input id="team" type="text"  name="team" value="{{$team}}" readonly>
                            </div>
                            <button type="submit" class="btn-r btn-regist btn-register">
                                Registro
                            </button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
