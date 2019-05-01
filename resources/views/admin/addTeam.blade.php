<div class="modal modal-panel fade teams" id="add_team_form" data-error={{$errors ? '1' : '0'}}>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-title">
                    Nuevo Equipo
                </div>
                <form>
                    <div class="input-field">
                        <input type="text" id="team-name" name="team-name">
                        <label for="team-name">Nombre del equipo</label>
                    </div>
                    <div class="input-field">
                        <select id="team-category" name="team-category">
                            <option value="" disabled selected>Eliga una categoria</option>
                            <option value="menores">Pitufines</option>
                            <option value="prebenjamin">Prebenjamín</option>
                            <option value="benjamin">Benjamín</option>
                            <option value="alevin">Alevín</option>
                            <option value="infantil">Infantil</option>
                            <option value="cadete">Cadete</option>
                            <option value="juvenil">Juvenil</option>
                        </select>
                        <label for="team-category">Categoria</label>
                    </div>
                    <div class="float-right">
                        <button class="waves-effect waves-light btn red lighten-2 cancel">Cancelar</button>
                        <button class="waves-effect waves-light btn teal" type="submit">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>