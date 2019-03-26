<div class="panel categories_event_panel animated">
    <div class="row panel-title justify-content-center">
        <span class="title-text">Etiquetas</span>
        <button type="button" class="close close-menu">
            <i class="fa fa-times"></i>
        </button>
    </div>
    <div class="info-divider"></div>
    <div class="panel_body active" id="select_category">
        @foreach($admin->categories() as $categoria)
            <div class="row align-items-center ml-2 mr-4 categorie_row" data-id="{{$categoria->id}}" data-title="{{$categoria->title}}" data-color="{{$categoria->color}}">
                <div class="categorie selectable"  style="background-color:{{$categoria->color}}">
                    <span>{{$categoria->title}}</span>
                </div>
                <span class="material-icons edit_category">edit</span>
            </div>
        @endforeach
        <div class="row align-items-center ml-2 mr-4 categorie_row">
            <div class="categorie" id="add_new_categorie">
                <span class="material-icons">add</span>
                <span>Nueva etiqueta</span>
            </div>
            <span class="material-icons"></span>
        </div>
    </div>
    <div class="panel_body" id="create_category">
        <div class="form-group">
            <label class="title" for="category-name">Nombre</label>
            <input name="category-name" id="category-name">
        </div>
        <div class="form-group">
            <span class="title">Color</span>
            <div class="color_grid_selection"></div>
        </div>
        <div class="btn-shadow btn-save float-right" data-href="admin/categories">
            <span>Crear</span>
        </div>
    </div>
</div>