@extends('layouts.herramienta')
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
            <div class="textoIcono icono-accion" data-href={{route('mister.herramienta.partido')}}>
                <span>ENTRENAMIENTO</span>
            </div>
        </div>
        <div class="iconoContent partidosHerramienta row justify-content-center">
            <div class="textoIcono icono-accion seccion" data-section='partido-formulario'>
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
        @else
            <div class="iconoContent partidosHerramienta row justify-content-center">
                <div class="textoIcono icono-accion seccion" data-section='new-team'>
                    <span>NUEVO EQUIPO</span>
                </div>
            </div>
        @endif
    </div>
    @if($mister->team)
    <div id="partido-formulario" class="section col-lg-4 col-md-8 col-sm-12">
        @include('vistasHerramienta.includes.formularios.partido')
    </div>
    <div id="editar-alineacion" class="section col-lg-6 col-md-8 col-sm-12">
        @include('vistasHerramienta.includes.formularios.editarAlineacion')
    </div>
    @else
    <div id="new-team" class="section col-lg-4 col-md-8 col-sm-12" data-leagues="{{DB::table('leagues')->get()}}">
        @include('vistasHerramienta.includes.formularios.nuevo-equipo')
    </div>
    @endif
    <div class="panel-fondo"></div>
@endsection
