@extends('layouts.app')
@section('content')
    <div class="home_content row justify-content-center align-items-center">
        <div class="main_panel col-10 row" id="admin_panel">
            <div class="col-lg-3 d-none d-lg-block resultados_content">
                <div class="resultado_title row justify-content-center">
                    <span>RESULTADOS</span>
                </div>
                <div class="resultados_list row justify-content-center">
                    <div class="category_link col-8 row justify-content-center">
                        <span>PRE-BENJAMIN</span>
                    </div>
                    <div class="category_link col-8 row justify-content-center">
                        <span>bemjamin</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-12 calendar_content">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/calendario.js')}}" type="text/javascript"></script>
@endsection