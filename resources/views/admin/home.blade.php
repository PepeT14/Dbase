@extends('layouts.app')
@section('content')
    <div class="main_section container-fluid" id="home">
        <div class="admin_home row">
            <div class="col-lg-3 col-md-4 col-sm-12">
                <div class="main_panel side_calendar_panel d-none d-md-block">
                    <div id="month_calendar" class="side_calendar calendar_content"></div>
                </div>
                <div class="main_panel side_calendar_panel d-none d-md-block">
                    <div class="row info_panel">
                        <div class="col-2">
                            <span class="material-icons">calendar_today</span>
                        </div>
                        <div class="col-8 panel_title">
                            <span>Eventos de hoy</span>
                        </div>
                        <div class="col-2">
                            <span class="material-icons">add</span>
                        </div>
                    </div>
                    <div class="info-divider"></div>
                    <div class="row events_info"></div>
                </div>
            </div>
            <div class="col-lg-9 col-md-8 col-sm-12">
                <div class="main_panel main_calendar_panel">
                    <div id="week_calendar" class="main_calendar calendar_content" data-events="{{$admin->events()}}" data-categories="{{$admin->categories()}}"></div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.modals.addEvent')
@endsection

