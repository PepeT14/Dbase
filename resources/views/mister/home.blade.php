@extends('layouts.app')
@section('content')
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
    @if($mister->team)
        <div id="partido-formulario" class="section col-lg-6 col-md-8 col-sm-12">
            @include('mister.formularios.newPartidoForm')
        </div>
        <div id="editar-alineacion" class="section col-lg-6 col-md-8 col-sm-12">
            @include('mister.editarAlineacion')
        </div>
    @else
        <div id="new-team" class="section col-lg-4 col-md-8 col-sm-12" data-leagues="{{DB::table('leagues')->get()}}">
            @include('mister.formularios.newEquipoForm')
        </div>
    @endif
    <div class="panel-fondo"></div>
@endsection
@section('scripts')
    <script src="{{asset('js/mister/inicio.js')}}" type="text/javascript"></script>
@endsection
