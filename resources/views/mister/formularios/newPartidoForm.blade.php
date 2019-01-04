<div class="form-panel partido">
    <div class="row navegacion-menu" data-backsection="iconos-iniciales"><i class="fa fa-arrow-left"></i></div>
    <div class="row control-panel-icon d-flex justify-content-end">
        <i class="fab fa-whmcs" data-toggle="modal" data-target="#control-panel"></i>
    </div>
    <div class="form-title"><img src="{{asset($mister->team->club->escudo)}}"></div>
    <div class="col-12 formulario-contenido">
        <form class="formulario-partido" id="new-match-form">
            <div class="form-group">
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn flex-fill active">
                        <input  type="radio" name="local" id="local-btn" autocomplete="off" checked>
                        LOCAL
                    </label>
                    <label class="btn flex-fill">
                        <input class="form-check-input" type="radio" name="visitante" id="visitante-btn" autocomplete="off">
                        VISITANTE
                    </label>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="fecha-partido">FECHA</label>
                    <input class="form-control" type="date" name="fecha-partido" id="fecha-partido">
                </div>
                <div class="form-group col-md-6">
                    <label for="hora-partido">HORA</label>
                    <input class="form-control" type="time" name="hora-partido" id="hora-partido">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="jornada-partido">JORNADA</label>
                    <input class="form-control" type="text" name="jornada-partido" id="jornada-partido">
                </div>
                <div class="form-group col-md-6">
                    <label for="tipo-campo">TIPO PARTIDO</label>
                    <select class="form-control" id="tipo-campo">
                        <option value="F5">Fútbol 5</option>
                        <option value="F7">Fútbol 7</option>
                        <option value="F8">Fútbol 8</option>
                        <option value="F11">Fútbol 11</option>
                    </select>
                </div>
            </div>
            <div class="form-row button-row">
                <div class="col-lg-6 col-sm-12">
                    <button id="edit-alineacion-btn" class="btn btn-principal outline btn-form col-12" data-players="{{$mister->team->players}}">EDITAR ALINEACION</button>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <button class="btn btn-primary-color btn-form col-12">EMPEZAR PARTIDO</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal-panel modal fade" id="control-panel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
               <div class="modal-title">ACCIONES</div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="cuadro-action">
                    <input type="text" class="form-control" value="FALTA">
                    <div class="delete-action">
                        <i class="fa fa-trash"></i>
                    </div>
                </div>
                <div class="cuadro-action">
                    <input type="text" class="form-control" value="PASE">
                    <div class="delete-action">
                        <i class="fa fa-trash"></i>
                    </div>
                </div>
                <div class="cuadro-action">
                    <input type="text" class="form-control" value="TIRO">
                    <div class="delete-action">
                        <i class="fa fa-trash"></i>
                    </div>
                </div>
                <div class="btn-add-row add-more-action">
                    <i class="fa fa-plus"></i>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-cancel btn-form">CANCELAR</button>
                <button class="btn btn-save btn-form">GUARDAR</button>
            </div>
        </div>
    </div>
</div>