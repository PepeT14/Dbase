<div class="header-first container-fluid">
    <div class="content">
        <img class="logo-cabecera icono-accion ruta" src="{{asset('imagenes/dbase.png')}}" data-href="{{route('home')}}">
        <div class="pull-right name">
            <a href="{{ route('logout') }}" class="clearfix" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            <span class="pull-semi-bold">
                <i class="fa fa-power-off logout"></i>
                Salir
            </span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
        <div class="icono-profile">
            <img class="img-fluid user-icon icono-accion ruta" src="{!! $mister->file ? asset($mister->file) : asset('imagenes/profile.png') !!}">
        </div>
    </div>
</div>
<div class="header-second container-fluid">
    @if(Request::route()->getName()!=='home')
        <div class="content d-flex align-items-center">
            <i class="fa fa-arrow-left icono-navegacion-cabecera icono-accion ruta" data-href="{{url()->previous()}}"></i>
        </div>
    @endif
</div>