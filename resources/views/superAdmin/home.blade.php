@extends('layouts.app')
@section('content')
    <div class="superAdmin_header second_header">
        <img src="{{asset('imagenes/logos/logo.png')}}">
        <div class="header_title">Administracion</div>
        <div class="logout">
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                {{ csrf_field() }}
                <button>SALIR</button>
            </form>
        </div>
    </div>
    <div class="container-fluid superAdmin_content">
        <ul class="tabs">
            <li class="tab"><a href="#createClub" class="active">Crear club</a></li>
            <li class="tab"><a href="#inviteAdmin">Invitar administrador</a></li>
            <li class="tab"><a href="#createLeague">Crear liga</a></li>
            <li class="tab"><a href="#getClubs">Clubs registrados</a></li>
            <li class="tab"><a href="#getLeagues">Ligas registradas</a></li>
        </ul>

        <div id="createClub">
            <div class="main_panel z-depth-1">
                <form  action="{{route('club.create')}}">
                    <div class="row">
                        <div class="input-field col m6">
                            <input name="name" type="text" id="name">
                            <label for="name">Nombre del club</label>
                        </div>
                        <div class="input-field col m6">
                            <input name="telephone" type="text" id="telephone">
                            <label for="telephone">Telefono</label>
                        </div>
                    </div>
                    <div class="row">
                       <div class="input-field col m6">
                           <input name="state" type="text" id="state">
                           <label for="state">Comunidad</label>
                       </div>
                       <div class="input-field col m6">
                           <input name="province" type="text" id="province">
                           <label for="province">Provincia</label>
                       </div>
                    </div>
                    <div class="row">
                        <div class="input-field col m6">
                            <input name="city" type="text" id="city">
                            <label for="city">Ciudad</label>
                        </div>
                        <div class="input-field col m6">
                            <input name="address" type="text" id="address">
                            <label for="address">Dirección</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="buttons-form col s12">
                            <button class="waves-effect teal btn btn-small" id="createClub_btn">GUARDAR CLUB</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div id="inviteAdmin">
            <div class="main_panel z-depth-1">
                <form action="{{route('superAdmin.invite')}}">
                    <div class="row">
                        <div class="input-field col m6">
                            <input type="text" name="email" id="email">
                            <label for="email">Email</label>
                        </div>
                        <div class="input-field col m6">
                            <select id="club" name="club">
                                <option value="" disabled selected>Elige un club</option>
                                @foreach($clubs as $club)
                                    <option value="{{$club->id}}">{{$club->name}}</option>
                                @endforeach
                            </select>
                            <label for="club">Club</label>
                        </div>
                    </div>
                    <div class="buttons-form">
                        <button class="inviteButton waves-effect btn btn-small" type="submit">Invitar</button>
                    </div>
                </form>
            </div>
        </div>


        <div id="createLeague">
            <div class="main_panel z-depth-1">
                <form  action="{{route('league.create')}}">
                    <div class="row">
                        <div class="input-field col m6">
                            <input name="name" id="name" type="text">
                            <label for="name">Nombre</label>
                        </div>
                        <div class="input-field col m6">
                            <input name="category" id="category" type="text">
                            <label for="category">Categoria</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col m6">
                            <input name="state" id="state" type="text">
                            <label for="state">Comunidad</label>
                        </div>
                        <div class="input-field col m6">
                            <input name="province" id="province" type="text">
                            <label for="province">Provincia</label>
                        </div>
                    </div>
                    <div class="buttons-form">
                        <button class="waves-effect btn btn-small" type="submit">Crear liga</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="getClubs">
            <div class='main_panel z-depth-1'>
                <table>
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Ciudad</th>
                        <th>Administrador</th>
                        <th>Email</th>
                        <th>Estado</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($clubs as $club)
                        <tr>
                            <td>{{$club->name}}</td>
                            <td>{{$club->city}}</td>
                            @if($club->admin)
                                <td>{{$club->admin->username}}</td>
                            @else
                                <td> </td>
                            @endif
                            <td class="club-email">{{$club->email()}}</td>
                            <td class="admin-status">{{$club->adminStatus()}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div id="getLeagues">
            <div class="main_panel z-depth-1">
                <table id="leagues_table" class="striped">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Provincia</th>
                        <th>Comunidad</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($leagues as $league)
                        <tr>
                            <td>{{$league->name}}</td>
                            <td>{{$league->category}}</td>
                            <td>{{$league->province}}</td>
                            <td>{{$league->state}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <span id="total_leagues"></span>
                <ul class="pagination pager" id="league_pager"></ul>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $('.tabs').tabs();
            $('select').formSelect();

            $('#getClubs').find('.admin-status').each(function(i,el){
                let val = $(el).html();
                switch(val){
                    case 'Pendiente':
                        $(this).parent().addClass('lime lighten-3');
                        break;
                    case 'Por invitar':
                        $(this).parent().addClass('red lighten-3');
                        break;
                    case 'Registrado':
                        $(this).parent().addClass('teal lighten-3');
                        break;
                }
            });

            $('#leagues_table').pageMe({
               pagerSelector:'#league_pager',
               activeColor:'teal',
               perPage:10,
                prevText:'Anterior',
                nextText:'Siguiente',
                showPrevNext:true,
                hidePageNumbers:false,
            });
        });
    </script>
@endsection
