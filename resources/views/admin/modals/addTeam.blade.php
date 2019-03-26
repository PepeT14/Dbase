<div class="modal modal-panel fade teams" id="add_team_form" data-error={{$errors ? '1' : '0'}}>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">AÑADIR EQUIPO</div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-panel">
                    <div class="form-title">NUEVO EQUIPO</div>
                    <div class="formulario-contenido">
                        <form>
                            <div class="form-group row">
                                <label for="team-name" class="col-form-label col-md-2">Nombre</label>
                                <div class="col-md-10">
                                    <input class="form-control" id="team-name" name="team-name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="team-category" class="col-form-label col-md-2">Categoria</label>
                                <div class="col-md-10">
                                    <input class="form-control" id="team-category" name="team-category">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="team-league" class="col-form-label col-md-2">Liga</label>
                                <div class="col-md-10">
                                    <select class="form-control" id="team-league" name="team-league"></select>
                                </div>
                            </div>
                            <button class="btn btn-save">GUARDAR EQUIPO</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>