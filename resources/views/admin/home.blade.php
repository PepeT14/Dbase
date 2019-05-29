@extends('layouts.app')
@section('content')
    <div class="main_section" id="home">
        <div class="second_header home_header z-depth-1">
            <div class="title">calendario</div>
        </div>
        <div class="admin_home">
            <div class="side_info">
                <div class="main_panel side_calendar_panel z-depth-1">
                    <div id="month_calendar" class="side_calendar calendar_content"></div>
                </div>
                <div class="main_panel side_calendar_panel z-depth-1">
                    <div class="info_panel">
                        <i class="material-icons">calendar_today</i>
                        <div class="panel_title">
                            <span>Eventos de hoy</span>
                        </div>
                        <i class="material-icons modal-trigger" id="add_event" data-target="add_event_modal">add</i>
                    </div>
                    <div class="info-divider"></div>
                    <div class="events_info"></div>
                </div>
            </div>
            <div class="main_panel main_calendar_panel z-depth-1">
                <div id="week_calendar" class="main_calendar calendar_content" data-events="{{$admin->events()}}" data-categories="{{$admin->categories()}}"></div>
            </div>
        </div>
    </div>
    @include('admin.includes.addEvent')
@endsection

