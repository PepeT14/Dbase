<div class="panel-fondo">
    <div class="menu-container d-flex align-items-center justify-content-center">
        <button type="button" class="close close-menu">
            <i class="fa fa-times"></i>
        </button>
        <div class="iconos-iniciales col-lg-4 col-md-8 col-sm-12" id="iconos-iniciales">
            @if($mister->team)
                <div class="iconoContent equipoHerramientas row justify-content-center">
                    <div class="textoIcono icono-accion ruta" data-href="{{route('mister.equipo')}}">
                        <span>EQUIPO</span>
                    </div>
                </div>
                <div class="iconoContent estadisticasHerramienta row justify-content-center">
                    <div class="textoIcono icono-accion" data-href="">
                        <span>ESTADISTICAS</span>
                    </div>
                </div>
                <div class="iconoContent partidosHerramienta row justify-content-center">
                    <div class="textoIcono icono-accion">
                        <span>ENTRENAMIENTO</span>
                    </div>
                </div>
                <div class="iconoContent partidosHerramienta row justify-content-center">
                    <div class="textoIcono icono-accion seccion" data-section='partido-formulario'>
                        <span>PARTIDO</span>
                    </div>
                </div>
                <div class="iconoContent partidosHerramienta row justify-content-center">
                    <div class="textoIcono icono-accion">
                        <span>INVENTARIO</span>
                    </div>
                </div>
                <div class="iconoContent partidosHerramienta row justify-content-center">
                    <div class="textoIcono icono-accion">
                        <span>CALENDARIO</span>
                    </div>
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