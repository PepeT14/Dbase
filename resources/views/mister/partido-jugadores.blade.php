<div class="row fila-jugadores">
    <div class="col-4">
        <div class="icono-minutos">
            <i class="fa fa-clock"></i>
        </div>
        @foreach($match->players as $player)
            @if($player->pivot->playing)
                <div class="row fila-jugador align-items-center">
                    <div class="cuadro-jugador row jugador-titular col-10" data-toggle="modal"
                         data-target="#modal-acciones" data-jugador="{{$player->id}}" data-minuto='0'>
                        <div class="numero-jugador col-2 p-0">
                            <span>{{$player->number}}</span>
                        </div>
                        <div class="nombre-jugador col-10">
                            <span>{{$player->name}}</span>
                        </div>
                    </div>
                    <div class="minutes-jugador col-2">
                        {{$player->pivot->minutes}}
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
<div class="modal-panel modal fade" id="modal-acciones">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">ACCIONES</div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="partido-accion dropright" >
                    <button class="btn btn-primary outline" data-toggle="dropdown" >cambio</button>
                    <div class="dropdown-menu">
                        @foreach($match->players as $player)
                            @if(!$player->pivot->playing)
                                <div class="row fila-jugador align-items-center">
                                    <div class="cuadro-jugador row jugador-suplente col-10" data-jugador="{{$player->id}}" data-minuto='0'>
                                        <div class="numero-jugador col-2 p-0 d-flex align-items-center">
                                            {{$player->number}}
                                        </div>
                                        <div class="nombre-jugador col-10">
                                            <span>{{$player->name}}</span>
                                        </div>
                                    </div>
                                    <div class="minutes-jugador col-2">
                                        {{$player->pivot->minutes}}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <form id="cambio-jugador" style="display:none;"></form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-cancel btn-form">CANCELAR</button>
                <button class="btn btn-save btn-form">GUARDAR</button>
            </div>
        </div>
    </div>
</div>
