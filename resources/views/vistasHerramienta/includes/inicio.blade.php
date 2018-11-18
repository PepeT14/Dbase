@extends('layouts.herramienta')
@section('content')
<div class="iconos-iniciales">
    <div class="iconoContent equipoHerramientas row justify-content-center">
        <div class="textoIcono icono-accion" data-href={{route('mister.herramienta.partido')}}>
            <span>EQUIPO</span>
        </div>
    </div>
    <div class="iconoContent estadisticasHerramienta row justify-content-center">
        <div class="textoIcono icono-accion" data-href={{route('mister.herramienta.partido')}}>
            <span>ESTADISTICAS</span>
        </div>
    </div>
    <div class="iconoContent partidosHerramienta row justify-content-center">
        <div class="textoIcono icono-accion" data-href={{route('mister.herramienta.partido')}}>
            <span>ENTRENAMIENTO</span>
        </div>
    </div>
    <div class="iconoContent partidosHerramienta row justify-content-center">
        <div class="textoIcono icono-accion" data-href={{route('mister.herramienta.partido')}}>
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
@endsection
