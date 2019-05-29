
{{-- CABECERA ESCRITORIO --}}
<div class="d-sm-none header row">
    <img class="header_link logo" src="{{asset('imagenes/logos/logo.png')}}">
    <div class="header_menu mr-auto row h-100">
        <div class="header_link col item" id="home_link" data-seccion="home"  data-href="admin/home" >
            <span>INICIO</span>
        </div>
        <div class="header_link col item" id="teams_link" data-seccion="teams" data-href="admin/teams">
            <span>EQUIPOS</span>
        </div>
        <div class="header_link col item" id="instalaciones_link" data-seccion="instalaciones" data-href="admin/instalaciones">
            <span>INSTALACIONES</span>
        </div>
        <div class="header_link col item" id="inventario_link" data-seccion="material" data-href="admin/material">
            <span>INVENTARIO</span>
        </div>
        <div class="header_link col item" id="tecnicos_link" data-seccion="tecnicos" data-href="admin/tecnicos">
            <span>TÉCNICOS DEPORTIVOS</span>
        </div>
    </div>

    <div class="header_icons" id="logout_icon">
        <div class="header_link icon logout">
            <i class="material-icons">power_settings_new</i>
        </div>
        <div class="js-tooltip">
            Salir
        </div>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
</div>

{{-- CABECERA RESPONSIVE --}}
<div class="d-sm-flex header row">
    <div class="header_link col item waves-effect waves-teal" id="teams_link" data-seccion="teams" data-href="admin/teams">
        <img class="header_icon_sm d-md-none" src="{{asset('imagenes/iconos/escudo.png')}}">
    </div>
    <div class="header_link col item waves-effect waves-teal" id="inventario_link" data-seccion="material" data-href="admin/material">
        <img class="header_icon_sm d-md-none" src="{{asset('imagenes/iconos/cone.png')}}">
    </div>
    <div class="header_link col item waves-effect waves-teal" id="home_link" data-seccion="home"  data-href="admin/home" >
        <img class="header_icon_sm d-md-none" src="{{asset('imagenes/logos/logo.png')}}">
    </div>
    <div class="header_link col item waves-effect waves-teal" id="instalaciones_link" data-seccion="instalaciones" data-href="admin/instalaciones">
        <img class="header_icon_sm d-md-none" src="{{asset('imagenes/iconos/campov.png')}}">
    </div>
    <div class="header_link col item waves-effect waves-teal" id="tecnicos_link" data-href="admin/tecnicos" data-seccion="tecnicos">
        <img class="header_icon_sm d-md-none" src="{{asset('imagenes/iconos/cuerpotecnico.png')}}">
    </div>
</div>