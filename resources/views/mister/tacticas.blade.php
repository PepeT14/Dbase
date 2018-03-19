@extends('layouts.mister')
@section('content')
    <div class="mister-content">
        <div class="tacticas col-md-6 col-sm-6 col-xs-6">
            <div class="field-content">
                <div class="field-header">
                    <ul class="plantillaBtn col-md-6 col-sm-6 header-item selected">
                        Plantilla
                    </ul>
                    <ul class="formacionesBtn col-md-6 col-sm-6 header-item">
                        Formaciones
                    </ul>
                </div>
                <div class="field">
                    <img src="{{asset('assets/img/campos/mediocampo.png')}}">
                </div>
            </div>
            <div class="columna-datos">
                <div id="formaciones" style="display:none;">
                    Lista de formaciones guardadas
                </div>
                <div id="plantilla">
                    Lista de jugadores
                </div>
            </div>
        </div>
    </div>
@endsection
