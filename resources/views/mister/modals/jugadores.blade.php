<div class="modal-panel modal fade" id="modal-jugadores">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">JUGADORES DISPONIBLES</div>
                <div class="col-2">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times"></i>
                    </button>
                </div>

            </div>
            <div class="modal-body jugadores-equipo" id="tacticas-modal-body">
                <table class="table">
                    <tbody>
                    @foreach($players as $player)
                        <tr>
                            <td class="imagen-jugador-content">
                                <div class="foto">
                                    <img class="img-fluid" src="{!! $player->photo ? asset($player->photo) : asset('imagenes/profile.png') !!}">
                                </div>
                            </td>
                            <td>
                                @if($player->position == 'Portero')
                                    <div class="posicion PT">
                                        <span>PT</span>
                                    </div>
                                @elseif($player->position == 'Defensa')
                                    <div class="posicion DF">
                                        <span>DF</span>
                                    </div>
                                @elseif($player->position == 'MedioCentro')
                                    <div class="posicion MC">
                                        <span>MC</span>
                                    </div>
                                @elseif($player->position == 'Delantero')
                                    <div class="posicion DL">
                                        <span>DL</span>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="nombre">
                                    <span>{{$player->name}}</span>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
