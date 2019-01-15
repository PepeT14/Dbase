<div class="header-first container-fluid">
    <div class="row content">
        <img class="logo-cabecera icono-accion ruta" src="{{asset('imagenes/dbase.png')}}" data-href="{{route('home')}}">

        {{--<div class="icono-profile" data-toggle="dropdown" id="dropdownMisterProfileBtn">
            <img class="img-fluid user-icon" src="{!! $mister->file ? asset($mister->file) : asset('imagenes/profile.png') !!}">
        </div>--}}
        <div class="icon-menu fa fa-bars">

        </div>
        <div class="dropdown-menu mister-profile" aria-labelledby="dropdownMisterProfileBtn">
            <div class="logout">
                <i class="fa fa-power-off logout"></i>
                <span>Salir</span>
            </div>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
</div>
{{-- <div class="header-second container-fluid">
   <div class="content d-flex align-items-center">
            <i class="fa fa-arrow-left icono-navegacion-cabecera icono-accion ruta" data-href="{{url()->previous()}}"></i>
        </div>
</div>
--}}