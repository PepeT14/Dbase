@extends('layouts.app')
<div class="form-panel login-form">
    <button type="button" class="close" id="close-login">
        <i class="fa fa-times"></i>
    </button>
    <div class="form-title">Login</div>
    <div class="formulario-contenido">
        <form method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                <label for="username" class="control-label">Username</label>
                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>
                @if ($errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="ccontrol-label">Password</label>
                <input id="password" type="password" class="form-control" name="password" required>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    Login
                </button>
            </div>
        </form>
    </div>
</div>