<div class="panel-fondo">
    <div class="menu-container d-flex align-items-center justify-content-center">
        <button type="button" class="close close-menu">
            <i class="fa fa-times"></i>
        </button>
        <div class="iconos-iniciales col-lg-4 col-md-8 col-sm-12" id="iconos-iniciales">
            <div class="iconoContent row justify-content-center">
                <div class="textoIcono icono-accion logout">
                    <i class="fa fa-user"></i><span>EDITAR PERFIL</span>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
            <div class="iconoContent row justify-content-center">
                <div class="textoIcono icono-accion logout">
                    <i class="fa fa-power-off"></i><span>SALIR</span>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
</div>