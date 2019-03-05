<div class="row" id="app_header">
    <div class="col-1 header_section white">
        <img class="header_link logo" src="{{asset('imagenes/logo.svg')}}">
    </div>
    <div class="header_section col-10">
        @if(Auth::guard('admin')->check())
            @include('admin.adminHeader')
        @endif
    </div>
    <div class="header_section col-1 white" id="config_icon">
        <div class="header_link col icon"><i class="fab fa-whmcs"></i></div>
    </div>
</div>
