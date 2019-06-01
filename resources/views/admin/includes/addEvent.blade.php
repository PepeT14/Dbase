<div class="modal home event_modal" id="add_event_modal">
    <div class="modal-content add_event_content">
        <form id="add_event_form">
            <div class="input-field required">
                <i class="material-icons prefix">add</i>
                <input id="event-title" name="event-title" type="text">
                <label for="event-title">Nombre del evento</label>
            </div>
            <div id="row_categorie_event" class="row">
                <a class="btn btn-small waves-effect teal lighten-1 waves-light" id="add_categories_event"><i class="material-icons left">label</i>Etiquetas</a>
            </div>

            <div class="input-field required">
                <i class="material-icons prefix">date_range</i>
                <input id="time_event_start" name="event-time" type="text">
                <label for="time_event_start">Fecha de inicio</label>
            </div>
            <div class="input-field required">
                <i class="material-icons prefix">date_range</i>
                <input id="time_event_end" name="event-time" type="text">
                <label for="time_event_end">Fecha de fin</label>
            </div>
            <div class="switch">
                <label>
                    Sin rep.
                    <input type="checkbox" id="rep_event">
                    <span class="lever"></span>
                    Con rep.
                </label>
            </div>
        </form>


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
        <div id="category_panel">
            <div class="panel categories_event_panel">
                <div class="row panel-title justify-content-center">
                    <span class="title-text">Etiquetas</span>
                    <i class="material-icons close hover-effect">close</i>
                </div>
                <div class="info-divider"></div>
                {{-- PANEL VER CATEGORIAS--}}
                <div class="panel_body active" id="select_category">
                    @foreach($admin->categories() as $categoria)
                        <div class="categorie selectable" data-id="{{$categoria->id}}" data-title="{{$categoria->title}}" data-color="{{$categoria->color}}" style="background-color:{{$categoria->color}}">
                            <span>{{$categoria->title}}</span>
                            <span class="material-icons edit_category">edit</span>
                        </div>
                    @endforeach
                </div>
                {{-- PANEL CREAR/EDITAR CATEGORIAS --}}
                <div class="panel_body" id="create_category">
                    <form>
                        <div class="input-field">
                            <input type="text" id="category-name" name="category-name">
                            <label for="category-name">Nombre</label>
                        </div>
                        <div class="title">Color</div>
                        <div class="color_grid_selection"></div>
                    </form>
                </div>
                <button class="waves-effect waves-light teal btn add_categorie_button" data-target="form"><i class="material-icons left">add</i>Nueva etiqueta</button>
            </div>
        </div>
        <div id="repeat_event_panel">
            @include('admin.includes.repeatEventPanel')
        </div>
    </div>
    <div class="modal-footer">
        <button class="waves-effect waves-light btn red lighten-2 modal-close">Cancelar</button>
        <button class="waves-effect waves-light btn teal" id="save_event">Guardar</button>
    </div>
</div>