<div class="sidebar-nav-admin">
    <div class="well">
        <ul class="nav nav-list2">
            <li><a href="{{action('adminController@home')}}">Inicio
                <i class="fa fa-home"></i></a></li>
            <li><a href="#">Mensajes
                    {{--<span class="badge badge-info">4</span>--}}
                    <i class="fa fa-envelope-o"></i> </a></li>
            <li><a href="{{action('adminController@teams')}}">Equipos  <i class="fa fa-futbol-o"></i></a></li>
            <li><a href="{{action('adminController@material')}}">Material <i class="fa fa-cogs"></i></a></li>
            <li class="divider"></li>
            <li><a href="#"> Reportes  <i class="fa fa-bar-chart"></i></a></li>
            <li><a href="{{action('adminController@leaguesNof')}}"> Ligas no Federativas  <i class="fa fa-trophy"></i></a></li>
            <li><a href="{{action('adminController@instalaciones')}}"> Instalaciones </a></li>
        </ul>
    </div>
</div>