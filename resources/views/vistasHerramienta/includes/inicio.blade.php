@extends('layouts.herramienta')
@section('content')
    <div class="iconos-iniciales col-lg-4 col-md-8 col-sm-1" id="iconos-iniciales">
        <div class="iconoContent equipoHerramientas row justify-content-center">
            <div class="textoIcono icono-accion" data-href={{route('mister.herramienta.partido')}}>
                <span>EQUIPO</span>
            </div>
        </div>
        <div class="iconoContent estadisticasHerramienta row justify-content-center">
            <div class="textoIcono icono-accion" data-href="">
                <span>ESTADISTICAS</span>
            </div>
        </div>
        <div class="iconoContent partidosHerramienta row justify-content-center">
            <div class="textoIcono icono-accion" data-href={{route('mister.herramienta.partido')}}>
                <span>ENTRENAMIENTO</span>
            </div>
        </div>
        <div class="iconoContent partidosHerramienta row justify-content-center">
            <div class="textoIcono icono-accion" data-section='partido-formulario'>
                <span>PARTIDO</span>
            </div>
        </div>
        <div class="iconoContent partidosHerramienta row justify-content-center">
            <div class="textoIcono icono-accion" data-href={{route('mister.herramienta.partido')}}>
                <span>INVENTARIO</span>
            </div>
        </div>
        <div class="iconoContent partidosHerramienta row justify-content-center">
            <div class="textoIcono icono-accion" data-href={{route('mister.herramienta.partido')}}>
                <span>CALENDARIO</span>
            </div>
        </div>
    </div>
    <div id="partido-formulario" class="col-lg-4 col-md-8 col-sm-12">
        @include('vistasHerramienta.includes.formularios.partido')
    </div>
    <div id="editar-alineacion" class="col-lg-6 col-md-8 col-sm-12">
        @include('vistasHerramienta.includes.formularios.editarAlineacion')
    </div>
    <div class="panel-fondo"></div>
@endsection
