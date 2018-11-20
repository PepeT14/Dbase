<div class="form-panel">
    <div class="form-title"><img src="{{asset($mister->team->club->escudo)}}"></div>
    <form class="formulario-contenido">
        <div class="form-group">
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-50 active">
                    <input  type="radio" name="local-visitante" id="local-btn" autocomplete="off" checked>
                    LOCAL
                </label>
                <label class="btn">
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
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-clarito active flex-fill border-secundario">
                    <input  type="radio" name="local-visitante" id="local-btn" autocomplete="off" checked>
                    F5
                </label>
                <label class="btn btn-clarito flex-fill border-secundario">
                    <input class="form-check-input" type="radio" name="local-visitante" id="visitante-btn" autocomplete="off">
                    F7
                </label>
                <label class="btn btn-clarito flex-fill border-secundario">
                    <input  type="radio" name="local-visitante" id="local-btn" autocomplete="off">
                    F8
                </label>
                <label class="btn btn-clarito flex-fill border-secundario">
                    <input class="form-check-input" type="radio" name="local-visitante" id="visitante-btn" autocomplete="off">
                    F11
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-clarito">EMPEZAR PARTIDO</button>
    </form>
</div>