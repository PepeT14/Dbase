<div class="modal fade home event_modal" id="add_event_modal">
    <div class="modal-dialog">
        <div class="modal-content add_event_content animated">
            <div class="modal-body">
                <form id="add_event_form">
                    <div class="row align-items-center mt-3">
                        <span class="material-icons col-2">add</span>
                        <input name="event-title" class="col-8" placeholder="Nombre del evento" type="text">
                    </div>
                    <div class="row align-items-center mt-2">
                        <div class="col-2"></div>
                        <div id="add_categories_event" class="row align-items-center event_categorie">
                            <span class="material-icons">add</span>
                            <span>Etiquetas</span>
                        </div>
                    </div>
                    <div class="row align-items-center mt-3">
                        <span class="material-icons col-2">query_builder</span>
                        <div class="row align-items-center">
                            <input class="col-5" id="time_event_start" name="event-time" placeholder="Fecha Inicio" type="text">
                            <span> - </span>
                            <input class="col-5" id="time_event_end" name="event-time" placeholder="Fecha Fin" type="text">
                        </div>
                    </div>
                </form>
                <div class="row mt-3 justify-content-center">
                    <div class="row align-items-center" id="add_rep_event">
                        <span>Evento con repetición</span>
                        <span class="material-icons">history</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-around">
                <div class="cancel_option row align-items-center foot-option" id="cancel_event">
                    <span class="material-icons ml-1">clear</span>
                    <span>CANCELAR</span>
                </div>
                <div class="save_option row align-items-center foot-option" id="save_event">
                    <span class="material-icons mr-1">done</span>
                    <span>ACEPTAR</span>
                </div>
            </div>
            <div id="category_panel">
                @include('admin.includes.addCategoriePanel')
            </div>
        </div>
    </div>
</div>