<div class="modal fade home event_modal" id="add_event_modal">
    <div class="modal-dialog">
        <div class="modal-content add_event_content">
            <div class="modal-body">
                <form id="add_event_form">
                    <div class="row align-items-center mt-3">
                        <span class="material-icons col-2">add</span>
                        <input name="event-title" class="col-8" placeholder="Nombre del evento" type="text">
                    </div>
                    <div class="row align-items-center mt-2">
                        <div class="col-2"></div>
                        <div id="row_categorie_event" class="row">
                            <div id="add_categories_event" class="event_categorie">
                                <span class="material-icons">add</span>
                                <span>Etiqueta</span>
                            </div>
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
                <div class="row mt-3 justify-content-center align-items-center">
                    <div class="row align-items-center" id="add_rep_event">
                        <span>Evento con repetición</span>
                        <span class="material-icons">history</span>
                    </div>
                </div>
                {{--PANEL_BODY--}}
                <div class="row repeat_selection justify-content-center">
                    <div class="col-10 mt-4 align-items-center justify-content-between" id="picker_repeat">
                        <span class="row_title">Repetición</span>
                        <div class="d-flex align-items-center" id="repeat_button">
                            <span id="picker_repeat_input">Sin Repetición</span>
                            <span class="material-icons" id="picker_repeat_button">keyboard_arrow_right</span>
                        </div>
                    </div>
                    <div class="row mt-3" id="day_repeat">
                        <div class="col" data-value="1">Lun</div>
                        <div class="col" data-value="2">Mar</div>
                        <div class="col" data-value="3">Mie</div>
                        <div class="col" data-value="4">Jue</div>
                        <div class="col" data-value="5">Vie</div>
                        <div class="col" data-value="6">Sab</div>
                        <div class="col" data-value="7">Dom</div>
                    </div>
                    <div class="row mt-3" id="day_month_select">
                        <table class="month_table table table-bordered">
                            <tbody>
                            @for($row=1;$row<31/6;$row++)
                                <tr>
                                    @for($i=6;$i>=0;$i--)
                                        @if((7*$row) - $i <= 31)
                                            <td class="day_month_table" data-value="{{(7*$row) - $i}}">{{(7* $row) - $i}}</td>
                                        @endif
                                    @endfor
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-around">
                <div class="cancel_option row align-items-center foot-option" id="cancel_event">
                    <span class="material-icons ml-1">clear</span>
                    <span>CANCELAR</span>
                </div>
                <div class="save_option row align-items-center foot-option" id="save_event" data-href="admin/events">
                    <span class="material-icons mr-1">done</span>
                    <span>ACEPTAR</span>
                </div>
            </div>
            <div id="category_panel">
                @include('admin.includes.addCategoriePanel')
            </div>
            <div id="repeat_event_panel">
                @include('admin.includes.repeatEventPanel')
            </div>
        </div>
    </div>
</div>