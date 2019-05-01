@extends('layouts.app')
@section('content')
    <div class="main_section" id="tecnicos">
        <div class="admin_home row justify-content-center align-items-center">
            <div class="main_panel col-10 admin_panel">
                <div class="col-12 panel_header animated faster">
                    <div class="fa fa-user-plus" id="add_tecnico_button" data-toggle="tooltip" data-placement="left" title="Añadir un técnico a la plantilla." data-action="modal" data-modalTarget="#add_tecnico_form"></div>
                    <div class="panel_title row justify-content-center">
                        Equipo Técnico
                    </div>
                    <div class="panel_description row justify-content-center">
                        <div class="col-lg-6 col-sm-12">
                            Aquí se muestra la información relativa al equipo técnico del club para gestionar los equipos
                            y asignar estos equipos a los técnicos dirigáse a la sección <a data-action="link" data-target="#teams_link">Equipos</a>
                        </div>
                    </div>
                </div>
                <div class="row panel_body animated faster align-items-center">
                    <div class="row w-100 h-100 justify-content-center" id="tecnicos_content">
                        @foreach($admin->club->misters as $mister)
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="mister_info">
                                    <div class="mister_image">
                                        <img src="{{asset($mister->file)}}">
                                    </div>
                                    <div class="mister_desc">
                                        <div class="mister_name">{{$mister->name}}</div>
                                        <div class="info-divider"></div>
                                        <div class="mister_team">{{$mister->team}} - {{$mister->rol}}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('admin.modals.addMister')
@endsection