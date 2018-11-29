<div class="modal modal-panel fade" id="add-player-form" data-error={{$errors ? '1' : '0'}}>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">AÑADIR JUGADOR</div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="new-player">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="player-name">Nombre</label>
                            <input class="form-control" id="player-name" name="player-name" type="text">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="player-apellidos">Appellidos</label>
                            <input class="form-control" id="player-apellidos" name="player-apellidos" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="player-position">Posicion</label>
                        <input class="form-control" id="player-position" name="player-position" type="text">
                    </div>
                    <div class="form-group">
                        <label for="player-birthday">Fecha de nacimiento</label>
                        <input class="form-control" id="player-birthday" name="player-birthday" type="text" placeholder="yyyy-mm-dd">
                    </div>
                    <div class="form-row button-row">
                        <div class="col-md-6 col-sm-12">
                            <button type="submit" class="btn btn-save btn-save-player btn-form col-12">AÑADIR</button>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <button class="btn btn-cancel btn-form col-12">CANCELAR</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>