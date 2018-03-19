@extends('layouts.admin')
@section('content')
    <div class="content admin">
        <div class="toolbar row">
            <div class="col-sm-6">
                <div class="page-header">
                    <h1>
                        Inicio
                    </h1>
                    <small>Perspectiva general</small>
                </div>
            </div>
        </div>
        <div class="row">
           <div class="col-md-12">
               <div class="breadcrumb">

               </div>
           </div>
        </div>
        <div class="row generalInformation">
            <div class="col-lg-8 col-md-7">
                <div class="panel panel-white">
                    <div class="panel-heading border-light">
                        <h4 class="panel-tittle">RESERVAS</h4>
                        <ul class="panel-heading-tabs border-light">
                            <li>
                                <select id="reservas" class="no-border-select">

                                </select>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-12 col-lg-12 no-padding partition-white">
                        <div class="partition">
                            <div class="partition-body padding-15">
                                <div class="height-300">
                                    <div id="container" style="min-width: 100px; height: 300px; min-height:100px; margin: 0 auto">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-5">
                <div class="panel panel-blue panel-calendar">
                    <div class="panel-heading border-light">
                        <h4 class="panel-title">Eventos</h4>
                    </div>
                    <div class="panel-body">
                        <div class="height-300">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="wrapper">
                                        <div class="clock-content">
                                            <h1 id="date" class="date"></h1>
                                            <h3 id="time" class="time"></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="row">
                                        <div class="events">
                                            EVENTOS
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 ">
                                    <div class="pull-right">
                                        <a href="#newEvent" class="btn-h btn-sm btn-transparent-white new-event"><i class="fa fa-plus"></i> Añadir Evento </a>
                                        <a href="#show-calendar" class="btn-h btn-sm btn-transparent-white show-calendar"><i class="fa fa-calendar-o"></i> Ver Calendario </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-white" id="calendar">
            {!!  $calendar->calendar() !!}

        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('assets/js/admin/home.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/calendario.js')}}" type="text/javascript"></script>
    {!!  $calendar->script() !!}
@endsection