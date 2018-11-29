<div class="row fila-jugadores">
    <div class="col-4">
        @foreach($match->players as $player)
            @if($player->pivot->playing)
                <div class="cuadro-jugador d-flex justify-content-center jugador-titular" data-toggle="modal"
                     data-target="#modal-acciones" data-jugador="{{$player->id}}" data-minuto='0'>
                    <span>{{$player->name}}</span>
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
                                <div class="cuadro-jugador d-flex justify-content-center jugador-suplente" data-jugador="{{$player->id}}">
                                    <span>{{$player->name}}</span>
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