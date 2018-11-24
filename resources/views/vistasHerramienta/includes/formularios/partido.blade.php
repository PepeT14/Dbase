<div class="form-panel">
    <div class="row navegacion-menu" data-backsection="iconos-iniciales"><i class="fa fa-arrow-left"></i></div>
    <div class="row control-panel-icon d-flex justify-content-end">
        <i class="fab fa-whmcs" data-toggle="modal" data-target="#control-panel"></i>
    </div>
    <div class="form-title"><img src="{{asset($mister->team->club->escudo)}}"></div>
    <div class="col-12 formulario-contenido">
        <form class="formulario-partido">
            <div class="form-group">
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn flex-fill active">
                        <input  type="radio" name="local-visitante" id="local-btn" autocomplete="off" checked>
                        LOCAL
                    </label>
                    <label class="btn flex-fill">
                        <input class="form-check-input" type="radio" name="local-visitante" id="visitante-btn" autocomplete="off">
                        VISITANTE
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="fecha-partido">FECHA</label>
                <input class="form-control" type="date" name="fecha" id="fecha-partido">
            </div>
            <div class="form-group">
                <label for="hora-partido">HORA</label>
                <input class="form-control" type="time" name="hora" id="hora-partido">
            </div>
            <div class="form-group">
                <div class="btn-group">
                    <button type="button" class="btn btn-100 btn-clarito dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Etiquetas
                    </button>
                </div>
                <div class="dropdown-menu">
                    <input class="form-control" placeholder="Etiqueta">
                </div>
            </div>
            <div class="form-group">
                <div class="btn-group btn-group-toggle tipo-campo" data-toggle="buttons">
                    <label class="btn btn-clarito active flex-fill border-secundario">
                        <input  type="radio" name="tipo-partido" id="F-5-btn" autocomplete="off" checked>
                        F5
                    </label>
                    <label class="btn btn-clarito flex-fill border-secundario">
                        <input class="form-check-input" type="radio" name="tipo-partido" id="F-7-btn" autocomplete="off">
                        F7
                    </label>
                    <label class="btn btn-clarito flex-fill border-secundario">
                        <input  type="radio" name="tipo-partido" id="F-8-btn" autocomplete="off">
                        F8
                    </label>
                    <label class="btn btn-clarito flex-fill border-secundario">
                        <input class="form-check-input" type="radio" name="tipo-partido" id="F-11-btn" autocomplete="off">
                        F11
                    </label>
                </div>
            </div>
            <div class="form-row">
                <div class="col form-group">
                    <label for="liga-partido">LIGA</label>
                    <select class="form-control"  name="hora" id="liga-partido" data-options="{{$mister->team->league->name}}">

                    </select>
                </div>
                <div class="col form-group">
                    <label for="jornada-partido">JORNADA</label>
                    <input class="form-control" type="text" name="fecha" id="jornada-partido">
                </div>
            </div>
            <div class="form-row">
                <div class="col-sm-12 col-md-6 form-group">
                    <button class="btn-clarito edit-alineacion-btn btn-end" id="edit-alineacion-btn">
                        <span>EDITAR ALINEACIÓN</span>
                    </button>
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                    <button type="submit" id="start-partido-btn" class="btn-clarito start-partido-btn btn-end">
                        <span>EMPEZAR PARTIDO</span>
                    </button>
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