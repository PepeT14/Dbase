<div class="modal modal-panel fade" id="add_tecnico_form" data-error={{$errors ? '1' : '0'}}>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">AÑADIR TÉCNICO</div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="new_mister" data-action="form" data-href="">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="mister-name">Nombre</label>
                            <input class="form-control" id="mister-name" name="mister-name" type="text">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mister-apellidos">Apellidos</label>
                            <input class="form-control" id="mister-apellidos" name="mister-apellidos" type="text">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="mister-rol">Cargo</label>
                            <select class="form-control" id="mister-rol" name="mister-rol" type="text">
                                <option value="entrenador">Entrenador</option>
                                <option value="segundo_entrenador">Segundo Entrenador</option>
                                <option value="delegado">Delegado</option>
                                <option value="secretario">Secretario</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mister-email">Email</label>
                            <input class="form-control" id="mister-email" name="mister-email" type="email">
                        </div>
                    </div>
                    <div class="form-row button-row">
                        <div class="col-md-6 col-sm-12">
                            <button type="submit" class="btn btn-save btn-save-player btn-form col-12">AÑADIR</button>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <button class="btn btn-cancel btn-form col-12" data-dismiss="modal">CANCELAR</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>