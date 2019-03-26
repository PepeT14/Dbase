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
