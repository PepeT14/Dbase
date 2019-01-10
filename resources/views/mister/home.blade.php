@extends('layouts.app')
@section('content')
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
@endsection
@section('scripts')
    <script src="{{asset('js/mister/inicio.js')}}" type="text/javascript"></script>
@endsection
