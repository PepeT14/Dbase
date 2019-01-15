<div class="panel-fondo">
    <div class="menu-container d-flex align-items-center justify-content-center">
        <button type="button" class="close close-menu">
            <i class="fa fa-times"></i>
        </button>
        <div class="iconos-iniciales col-lg-4 col-md-8 col-sm-12" id="iconos-iniciales">
            @if($mister->team)
                <div class="iconoContent equipoHerramientas row justify-content-center">
                    <div class="textoIcono icono-accion ruta" data-href="{{route('mister.equipo')}}">
                        <i class="fa fa-users-cog"></i><span>EQUIPO</span>
                    </div>
                </div>
                <div class="iconoContent estadisticasHerramienta row justify-content-center">
                    <div class="textoIcono icono-accion" data-href="">
                        <i class="fa fa-chart-bar"></i><span>ESTADISTICAS</span>
                    </div>
                </div>
                <div class="iconoContent partidosHerramienta row justify-content-center">
                    <div class="textoIcono icono-accion">
                        <i class="far fa-clipboard"></i><span>ENTRENAMIENTO</span>
                    </div>
                </div>
                <div class="iconoContent partidosHerramienta row justify-content-center">
                    <div class="textoIcono icono-accion seccion" data-section='partido-formulario'>
                        <i class="fa fa-futbol"></i><span>PARTIDO</span>
                    </div>
                </div>
                <div class="iconoContent partidosHerramienta row justify-content-center">
                    <div class="textoIcono icono-accion">
                        <i class="fa fa-cubes"></i><span>INVENTARIO</span>
                    </div>
                </div>
                <div class="iconoContent partidosHerramienta row justify-content-center">
                    <div class="textoIcono icono-accion">
                        <i class="far fa-calendar-alt"></i><span>CALENDARIO</span>
                    </div>
                </div>
                <div class="iconoContent row justify-content-center">
                    <div class="textoIcono icono-accion logout">
                        <i class="fa fa-power-off"></i><span>SALIR</span>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            @else
                <div class="iconoContent partidosHerramienta row justify-content-center">
                    <div class="textoIcono icono-accion seccion" data-section='new-team'>
                        <span>NUEVO EQUIPO</span>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>