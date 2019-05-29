$(document).ready(function(){

    /*------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    * Aqui se ha cargado el documento. Este documento tiene la peculiaridad de que se carga sólo una vez, es decir, debemos controlar la seccion que se carga
    * para lanzar sus métodos, y tmabién controlar cuando se cambia de sección y cual se muestra para hace lo mismo. Estas secciones se separan en métodos propios de cada
    * una. Además también se definen métodos generales que nos valdrán para cualquiera, como es el caso de clickar en un link de la cabecera para el cambio de seccion
    * ------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

    /**----------------------------------------------------------------
    * Primero vemos que seccion se ha cargado y la mostramos.
     ------------------------------------------------------------------*/

        //Obtenemos la url actual separada por / para saber cual es el final, y que seccion estamos cargando.
    let urlAct = window.location.href.split('/');

        //Inicializamos objetos para almacenar la seccion que vamos a mostrar y el objeto de la cabecera que está activo.
    let urlSection = null;
    let objActive = null;
    let sectionActive = null;
        //Comprobamos el caso de home y la url de admin sola para cargar el calendario, en cualquier otro caso obtenemos el último valor de la url.
    if(urlAct[urlAct.length-1]==='home' || urlAct.length<5){
        urlSection = 'home';
    }else{
        urlSection = urlAct[urlAct.length-1];
    }

        //Hemos obtenido el nombre de la seccion a mostrar, buscamos su link en la cabecera y lo activamos. Posteriormente almacenamos el objeto en la variable objActive.
    $('.header_link').each(function(n,obj){
        if($(obj).data('seccion')===urlSection){
            $(obj).addClass('active');
            objActive = obj;
        }
    });

        //Guardamos en la variable sectionActive la seccion activa actualmente.
    sectionActive = $(objActive).data('seccion');
        //Mostramos la seccion activa.
    showIn(sectionActive);
        //Activamos los modals, los tooltips, etc...
    links();
        //Guardamos una copia en el historial para mostrarlo posteriormente
    window.history.replaceState({html:document.getElementById('admin_main_content').innerHTML},'','');

    /**----------------------------------------------------------------
     * Ahora en función de la sección cargamos los métodos específicos.
     ------------------------------------------------------------------*/
    loadSectionScripts(urlSection);


    /*------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    * Lo siguiente que se va definir en la primera carga es que ocurre al clickar en un link de la cabecera, para que se realizen todas las acciones a tener en cuenta. A priori
    * estas acciones serán las siguientes y en el orden de aparición.
    *
    *   - Desactivar el link activo
    *   - Activar el link clickado
    *   - Ocultar la sección activa (Para ello se ha establecido una clase animate, que muestra la sección con la animación elegida.)
    *   - Activar seccion clickada
    *   - Llamada ajax al servidor
    *   - Mostrar la sección clickada
    *   - Cargar los scripts específicos de esta sección
    *   - Actualizar historial
     ------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
    $('.header_link.item').on('click',function(){
        if(!$(this).hasClass('active')){
            /*
       * Inicializamos variables en las que almacenaremos información repetitiva, como el objeto clickado, la seccion del objeto, la url del link, etc...
        */
            let obj = $(this);
            let sectionObj  = obj.data('seccion');
            let urlObj = obj.data('href');
            //Obeto ajax dónde almacenaremos la respuesta del servidor y el cuál procesaremos para realizar las acciones necesarias.
            let ajaxObj = {html:null,section:null,url:null};

            $.ajax({
                type:'GET',
                url: $('meta[name="app-url"]').attr('content') + urlObj,
                success:function(response){
                    ajaxObj = {
                        html:response.html,
                        title:response.title ? response.title : null,
                        section:sectionObj,
                        url:$('meta[name="app-url"]').attr('content')+ urlObj
                    };
                    //Procesamos la respuesta ajax, aquí vamos a insertar en el nodo html '#admin_main_content' lo que nos lleha en response.html
                    processAjaxData(ajaxObj);

                    //Desactivamos el link activo
                    $('.header_link.active').removeClass('active');
                    //Activamos el link clickado
                    obj.addClass('active');

                },
                error:function(response){
                    //En caso de error mostramos el error en el cuerpo HTML.
                    $('body').html(response.responseText);
                }
            }).done(function(){
                //Una vez ha finalizado el promise, esperamos 10 ms y mostramos la seccion.
                setTimeout(function() {
                    showIn(sectionObj, sectionActive);
                    links();
                    loadSectionScripts(sectionObj);
                    sectionActive = sectionObj;
                },10);
            });
        }
    });

    function showIn(seccionObj,seccionOld){
        //Muestro el contenedor
        $('#'+seccionObj).addClass('active');
        if(seccionObj === seccionOld){
            $('#teams').siblings().not('.modal').not('.active').remove();
            //$('.modal.'+seccionOld).eq(0).remove();
        }else{
            $('#'+seccionOld).remove();
            $('.modal.'+seccionOld).remove();
        }
    }


    /*Función que cambia el historial, recibe un id y objeto con html y url.*/
    processAjaxData = function(response){
        //Si la peticion ajax se hace desde el objeto de home, no cargo en el contenido, sino que creo un nuevo documento.
        $('#admin_main_content').append(response.html);
        document.title = 'dBase';
        window.history.pushState({html:response.html},"dBase", response.url);
    };

    /*Funcion personalizada en el popState, que se active cuando se hagan llamdas al historial, por ejemplo en back o en forward*/
    window.onpopstate = function(event){
        if(event.state !== null){document.getElementById('admin_main_content').innerHTML = event.state.html};
        console.log("location: " + document.location + ", state: " + JSON.stringify(event.state));
    };



    //tooltips and modals
    function links(){
        $('.modal').modal();
        //$('[data-toggle="tooltip"]').tooltip();
        //$('[data-toggle="popover"]').popover();
        /*$('[data-action="modal"]').on('click',function(){
            $($(this).data('modaltarget')).modal('show');
        });*/
        $('.cancel').on('click',function(){
           event.preventDefault();
        });
        $('.header_link.icon').on('click',function(){
            $(this).addClass('active');
        });
        $('[data-action="link"]').on('click',function(){
            $($(this).data('target')).click();
        });

        document.querySelectorAll('select.cs-select').forEach(function(el){
           new SelectFx(el);
        });
    }


    function loadSectionScripts(section){
        switch(section){
            case 'home':
                homeJS();
                break;
            case 'teams':
                jsTeams();
                break;
            case 'instalaciones':
                instalacionesSection();
                break;
            case 'material':
                materialSection();
                break;
        }
    }

    /*------------------------------------------------------------------
    * ----------------- SECCION DEL CALENDARIO -------------------
    * ------------------------------------------------------------------*/
    function homeJS(){
        //Miro la pantalla para el tipo de nombres en el calendario.
        let pantallaResponsive = window.innerWidth < 1000;


        //Inicio los calendarios con vistas por defecto del mes en el lado y semanal de principal.
        $('#month_calendar').Calendar({
            shortDays:true,
            mainCalendar:false,
            view:'monthView'
        });
        $('#week_calendar').Calendar({
            shortDays: pantallaResponsive,
            mainCalendar:true,
            view:'weekView',
            views:{month:true,week:true,day:true}
        });
        events();
        //Aqui dentro va toda la lógica de guardar un evento y  lo relacionado con el.
        function events(){
            //Guardo en la variable modal el modal para añadir un evento.
            let modal = M.Modal.getInstance($('#add_event_modal'));

            //Cuando abro el modal me creo un evento.
            modal.options.onOpenEnd = function(){
              window.evento = new Event({
                  start:moment(),
                  end:moment().add(1,'hour')
              });
            };

            //Inicio los timePickers para el evento.
            $('#time_event_start').dateTimePicker();
            $('#time_event_end').dateTimePicker();

            /*---------------------------------------------------------------
            * --------------------- CATEGORIA DEL EVENTO --------------------
            * ---------------------------------------------------------------*/

            //Logica para mostrar el panel de categorias al clickar sobre su boton.
            $('#add_categories_event').on('click',function(){
                selectCategoryPanel();
            });
            $('.categories_event_panel .close').on('click',function(){
               hideCategoryPanel();
            });
            linkCategories();

            //Accion al clickar en nueva categoria
            $('.add_categorie_button').on('click',function(){
                if($(this).data('target') === 'form'){
                    createCategoryPanel(0);
                    $('#category-name').val('').parent().find('label.active').removeClass('active');
                }else if($(this).data('target') === 'save'){
                    event.preventDefault();
                    let update = $(this).data('action');
                    let color = $('.color_selection.selected').css('background-color');
                    let title = $('#category-name').val();
                    let id = $(this).data('id');
                    if(title === ''){
                        $('#create_category').find('.form-group').eq(0).children().addClass('error');
                    }else if(color === undefined){
                        $('#create_category').find('.form-group').eq(1).find('.title').addClass('error');
                    } else{
                        $.ajax({
                            type:update,
                            url:$('meta[name="app-url"]').attr('content') + 'admin/categories',
                            data:{color:color,title:title,update:update,id:id},
                            success:function(response){
                                $('#select_category').children().remove();
                                response.forEach(function(cat){
                                    $('#select_category').append('<div class="categorie selectable" data-id="'+cat.id+'" data-title="'+cat.title+'" data-color="'+cat.color+'" style="background-color:'+cat.color+'">\n' +
                                        '                            <span>'+cat.title+'</span>\n' +
                                        '                            <span class="material-icons edit_category">edit</span>\n' +
                                        '                        </div>');
                                });
                                selectCategoryPanel();
                                linkCategories();
                            },
                            error:function(err){
                                $('body').html(err.responseText);
                            }
                        });
                    }
                }
            });

            function linkCategories(){
                //Accion al clickar en editar categoria
                $('.edit_category').on('click',function(){
                    event.preventDefault();
                    let title = $(this).parent().data('title');
                    let color = $(this).parent().data('color');
                    let id = $(this).parent().data('id');
                    createCategoryPanel(id);
                    $('#category-name').val(title).parent().find('label').addClass('active');
                    $('.color_selection').each(function(i,el){
                        if($(el).css('background-color') === color){
                            $(el).addClass('selected');
                        }
                    });
                    return false;
                });

                //Accion para añadir etiqueta al evento.
                $('.categorie.selectable').on('click',function(){
                    evento.category = $(this).data('id');
                    hideCategoryPanel();
                });

            }



            /*--- PANEL PARA CREAR UNA CATEGORIA ---*/
            function createCategoryPanel(id){
                let that = this;
                //Añado al panel la flecha para volver atrás
                $('.panel-title').prepend('<span class="material-icons back hover-effect" id="back_section">arrow_back</span>');
                //Logica al clickar en la fecha para atrás
                $('#back_section').on('click',function(){
                    selectCategoryPanel();
                });
                //Cambio el titulo del panel
                $('.panel-title .title-text').html('Nueva etiqueta');
                //Relleno los colores para seleccionar
                seleccionColores();
                //Funcion que rellena con colores el panel
                function seleccionColores($color){
                    let colors = ['#884a4a','#425F6D','#51e898','#0079bf','#c377e0','#ff9f1a','#f2d600','#ff78cb','#355263'];
                    let html = '';
                    for(let i=0;i<colors.length;i++){
                        html = '<div class="color_selection '+ (colors[i] === $color ? selected : '') +'" style="background-color:'+colors[i]+';opacity:0;" id="'+i+'">' +
                            '<span class="material-icons">done</span></div>';
                        $('.color_grid_selection').append(html);
                    }
                    $('.color_selection').on('click',function(){
                        $('.color_selection.selected').removeClass('selected');
                        $(this).addClass('selected');
                    });
                }

                //Muestro el panel y oculto el contenido de seleccionar
                let btn = $('.add_categorie_button');
                let action = id === 0 ? 'post' : 'put';
                let tag = id === 0 ? 'Crear etiqueta' : 'editar etiqueta';
                $('#select_category').fadeTo(300,0,function(){
                    btn.css('top',$('#create_category').height() + btn.height() + 20).html('<i class="material-icons left">create</i>'+tag).data('action',action).data('target','save').data('id',id);
                   $(this).hide(1,function(){
                       $('#create_category').show(1,function(){
                           $(this).fadeTo(300,1);
                       });
                   });
                });
                for(let i=0;i<$('.color_selection').length;i++){
                    setTimeout(function(){$('.color_selection#'+i+'').fadeTo(300,1);},i*50);
                }

            }

            /*--- PANEL PARA SELECCIONAR UNA CATEGORIA ---*/
            function  selectCategoryPanel(){
                let btn = $('.add_categorie_button');
                if(btn.data('target')==='save'){
                    //Elimino si hubiera elementos que no son de este panel.
                    $('.back').remove();
                    //Oculto el panel de creacion y limpio el contenido de colores.
                    btn.css('top',$('#select_category').height() + btn.height() + 20).html('<i class="material-icons left">add</i>Nueva etiqueta').data('target','form');
                    $('#create_category').fadeTo(300,0,function(){
                       $(this).hide(1,function(){
                           $('#select_category').show(1,function(){
                               $(this).fadeTo(300,1);
                           })
                       })
                    });
                    //Elimino el grid de los colores
                    $('.color_grid_selection .color_selection').remove();
                    //Reseteo el texto del titulo
                    $('.panel-title .title-text').html('Etiquetas');
                }else{
                    let topBtn = document.querySelector('.add_categorie_button').offsetTop;
                    btn.css('top',topBtn - btn.height() + 20);
                    $('.categories_event_panel').addClass('active');
                }
            }

            /*--- FUNCION PARA OCULTAR EL PANEL DE CATEGORIAS---*/
            function hideCategoryPanel(){
                //Pongo de nuevo la vista principal
                selectCategoryPanel();
                //Oculto el panel de las categorias
                $('.categories_event_panel').removeClass('active');
                //Añado si el evento tiene categoria
                if(evento.category !== null){
                    let color=null;
                    let title = null;
                    $('.categorie').each(function(i,el){
                        if($(el).data('id') === evento.category){
                            color = $(el).data('color');
                            title = $(el).data('title');
                        }
                    });
                    //Elimino otra categoria
                    $('.event_categorie.selected').remove();
                    //Añado la nueva
                    $('#row_categorie_event').append('<div class="event_categorie selected" style="background-color:'+color+'">' +
                        '<span>'+title+'</span>' +
                        '<span class="material-icons clear_category">clear</span></div>');

                    //Opcion para eliminar la categoria del evento.
                    $('.clear_category').on('click',function(){
                        $('.event_categorie.selected').remove();
                        evento.category = null;
                    });
                }else{
                    //limpio las categorias si no tiene evento
                    $('.event_categorie.selected').remove();
                }
            }

            /* ---- GUARDAR EVENTO ---*/
            function saveEvent(){
                let that = this;
                let frecuencia = null;
                let veces = null;
                $('#add_event_form').validate({
                    rules:{

                    },
                    messages:{},
                    submitHandler:function(){}
                })
                $('#save_event').on('click',function(){
                    $('#add_event_fomr').submit();
                    evento.title = $('input[name="event-title"]').val();
                    if(evento.title === '' || evento.start === '' || evento.end === ''){
                        console.log('Formulario incompleto')
                    }else{
                        frecuencia = evento.repetition.frecuencia;
                        veces = evento.repetition.veces;
                        if(frecuencia === '-' || veces === '-'){
                            evento.repetition = {};
                        }
                        $.ajax({
                            type:'POST',
                            url: $('meta[name="app-url"]').attr('content') + $(this).data('href'),
                            data:{title:evento.title,start:evento.start,category:evento.category,end:evento.end,repetition:evento.repetition},
                            success:function(response){
                                that.events = response;
                                that.renderEvents(response);
                                $('#add_event_modal').modal('hide');
                            },
                            error:function(err){
                                console.log(err);
                            }
                        });
                    }
                });
            }
        }

    }

    /*------------------------------------------------------------------
    * ----------------- SECCION DE LOS EQUIPOS -------------------
    * ------------------------------------------------------------------*/

    function jsTeams(){
        /*Inicio el modal para añadir un nuevo equipo*/
        let modalForm = M.Modal.init(document.querySelector('.modal.teams'));
        /*--- Paneles de seleccion de tipo de equipos y vuelta atrás ---*/
        $('.main_team_panel').on('click',function(){
            //Si esta seccion no está activa ya.
            if(!$(this).hasClass('active')){
                $(this).animate({
                    top:0,
                });
                //Mostramos el icono para volver hacia atras.
                $(this).find('.back_icon').show(function(){
                    $(this).fadeTo(100,1);
                });
                //Ocultamos la otra seccion
                $(this).addClass('active');
                let section = $(this).data('section');
                $('.main_team_panel').not('.active').fadeTo(100,0,function(){
                    $(this).hide();
                    //mostramos la nueva seccion
                    $(section).show(function(){
                        $(this).addClass('active');
                        loadSection(this);
                    });
                });
            }
        });

        /* Logica al pulsar en el boton de atras*/
        $('.back_icon').on('click',function(){
            //Obtengo el padre que seria el link de la seccion que se esta mostrando
            let par = $(this).parent();
            //Elimino la clase activo del link.
            $('.teams_section.active').removeClass('active');

            $('.teams_section').hide();
            //Vuelve la seccion a su sitio y oculto el link de hacia atras
            $(par).removeClass('active');
            //oculto el link para volver hacia atras
            $(this).fadeTo(100,0,function(){
                $(this).hide();
            });
            //Muestro el panel principal, es decir todos los links.
            $('.main_team_panel').show(10,function(){
                let that = this;
                setTimeout(function(){$(that).fadeTo(100,1);},300)
            });
            return false;
        });

        /*--- Formulario añadir equipo ---*/
        let newTeamForm = $('#add_team_form').find('form');


        //Actualizar ligas al cambiar de categoria
        $('#team-category').on('change',function(){
            let category = $(this).children('option:selected').val();
            let leagueSelector = $('#team-league');
            if( leagueSelector.length){
                let leagues = $('#federados_section').data('leagues');
                leagues = leagues.filter(league => league.category === category);
                leagueSelector.find('option').remove();
                if(leagues.length > 0){
                    leagueSelector.append(' <option value="" disabled selected>Elige una liga de federados</option>');
                    leagues.forEach(function(el){
                        leagueSelector.append('<option value="'+el.id+'" data-category="'+el.id+'">'+el.name+'</option>')
                    });
                }else{
                    leagueSelector.append(' <option value="" disabled selected>No hay ligas para esa categoria</option>');
                }

                $('select#team-league').formSelect();
            }
        });

        newTeamForm.validate({
            errorElement:"div",
            errorClass:'invalid',
            rules:{
                'team-name':'required',
                'team-category':'required'
            },
            messages:{
                'team-name':{
                    required:'Introduce un nombre identificativo para el equipo.'
                },
                'team-category':{
                    required:'Es necesario la categoria en la que juega el equipo.'
                }
            },
            submitHandler:function(form){
                let data = $(form).serializeFormJSON();
                console.log(data);
                $.ajax({
                    url:$('meta[name="app-url"]').attr('content') + 'admin/teams',
                    method:'POST',
                    data:data,
                    success:function(response){
                        console.log(response);
                        if(response.error){
                            let form = $('#add_team_form');
                            if(form.find('.alert').length){
                                form.find('.alert').remove();
                            }
                            form.find('.modal-content').prepend('<div class="alert alert-danger" role="alert">'+response.error+'</div>');
                        }else{
                            $('#add_team_form').modal('hide');
                            let s = $('.teams_section.active');
                            let f = s.attr('id') === 'federados_section';
                            let t = f ? response.teams : response.teamsNof;
                            loadSection(s, t);
                            $(s).data('teams',t);
                        }
                    },
                    error:function(response){
                        $('body')[0].innerHTML =response.responseText;
                        console.log(response);
                    }
                });
            }
        });

        //Script para cargar una seccion
        function loadSection(section,t){
            //Cargamos los equipos y la liga
            let teams = t ? t : $(section).data('teams');

            //Muestro el boton para añadir equipos de una manera u otra en funcion del tamaño de los equipos.
            loadButton(teams);

            //Cargo los equipos
            loadTeams(teams);

            //Cargo las ligas y las categorias en el formulario en funcion de la seccion
            loadLeagues(section);
        }

        function loadButton(teams){
            //Elimino las secciones que hemos mostrado anteriormente
            let active =  $('.teams_section.active');
            $('.teams_section').children().remove();
            //mostramos la nueva seccion y añadimos el boton condicionado por el tamaño de pantalla
            active.append('<div class="waves-effect waves-light teal darken-2 main_add_button modal-trigger" data-target="add_team_form" id="add_team_button">' +
                '                        <i class="material-icons left">add</i><span>\n' +
                '                        AÑADIR EQUIPO\n' +
                '                    </span></div>');
            let button = $('#add_team_button');
            if(teams.length<1){
                button.addClass('btn-large');
            }else{
                if(window.innerWidth<720){
                    button.addClass('btn-floating responsive');
                    button.find('span').remove();
                }
                button.addClass('btn right');
                active.append(' <div class="teams_info" ></div>');
            }
        }

        function loadLeagues(section){
            let categorySelector = $('#team-category');
            let leagueSelector = $('#team-league');
            //Si es la seccion de federados
            if($(section).attr('id') === 'federados_section'){
                let leagues = $(section).data('leagues');
                //Elimino la categoria menores en caso de que este en el selector.
                if(categorySelector.find('option[value="menores"]').length){
                    categorySelector.find('[value="menores"]').remove();
                    $('select#team-category').formSelect();
                }
                //Añado el selector de ligas federadas en caso de que no esten.
                if(!leagueSelector.length){
                    let html = '<div class="input-field col s12 m6"><select id="team-league" name="team-league">'
                        + ' <option value="" disabled selected>Elige una liga de federados</option>'
                        +'</select><label>Liga</label></div>';
                    $('#add_team_form').find('form').find('#team-category').parent().parent().after(html);
                    if(leagues !== undefined){
                        leagues.forEach(function(l){
                            $('#team-league').append('<option value="'+l.id+'" data-category="'+l.category+'">'+l.name+' - '+l.category+' ('+l.province+')</option>');
                        });
                    }
                    $('select#team-league').formSelect();

                    $('#team-league').on('change',function(){
                        let c = $(this).children('option:selected').data('category');
                        let s = $('select#team-category');
                        s.find('option[value="'+c+'"]').prop('selected',true);
                        s.formSelect();
                    });
                };
            }else{
                //Sino eliminamos este select en caso de existir y añado la categoria si la he eliminado anteriormente.
                if(!categorySelector.find('[value="menores"]').length){
                    categorySelector.find('option:disabled').after('<option value="menores">Pitufines</option>');
                    $('select#team-category').formSelect();
                }
                if(leagueSelector.length){
                    M.FormSelect.getInstance($('select#team-league')).destroy();
                    leagueSelector.parent().remove();
                }
            }
        }

        function loadTeams(teams){
            if(teams.length>0){
                let html = '<div class="tabs_container"/>';
                let tabs = '<ul class="tabs teams"/>';
                let ti = $('.teams_section.active').find('.teams_info');
                let grouped = teams.reduce(function(vA,x){
                   (vA[x['category']] = vA[x['category']] || []).push(x);
                   return vA;
                },{});
                console.log(grouped);
                let table = '';
                for(cat in grouped){
                    tabs = $(tabs).append('<li class="tab"><a href="#'+cat+'">'+cat+'</a></li>');
                    table = '<div id="'+cat+'"><table class="teams_table highlight"><thead><th>Nombre</th><th>Liga</th></thead><tbody>';
                    if(grouped.hasOwnProperty(cat)){
                        grouped[cat].forEach(function(team){
                            let league = $('#federados_section').data('leagues').filter(league => league.id === team.league_id);
                            if(league.length>0){
                                league = league[0].name;
                            }else{
                                league = '-';
                            }
                            table = table + '<tr><td>'+team.name+'</td><td>'+league+'</td></tr></tbody></table></div>';
                        });
                        ti.append($(html).append(tabs)[0].outerHTML);
                        ti.append($(table)[0].outerHTML);
                    }
                }
                let instance = M.Tabs.init($('.tabs'),{
                   swipeable:true
                });
            }
        }
    }

    /*------------------------------------------------------------------
    * ----------------- SECCION DE LAS INSTALACIONES -------------------
    * ------------------------------------------------------------------*/
    function instalacionesSection(){
        let url = $('meta[name="app-url"]').attr('content') + 'admin/instalaciones';
        let addModal = $('#add_instalacion_form');
        let addInstalacionForm = addModal.find('form');
        $('select').formSelect();
        $('.modal').modal();
        $('.content_section').addClass('active');
        addInstalacionForm.validate({
            rules:{
                'instalacion-name':'required',
                'instalacion-tipo':'required',
                'instalacion-terreno':'required'
            },
            messages:{
                'instalacion-name':{required:'Introduce un nombre identificativo de la instalacion'},
                'instalacion-tipo':{required:'Seleccione el tipo de pista que se va añadir'},
                'instalacion-terreno':{required:'Seleccione un terreno para la instalacion'}
            },
            submitHandler:function(form){
                let data = $(form).serializeFormJSON();
                console.log(data);
                $('#admin_main_content').load(url,data,function(response){
                    setTimeout(function() {
                        showIn('instalaciones', 'instalaciones');
                        links();
                        instalacionesSection();
                        console.log(response);
                    },10);
                });
            }
        });


        /*--- EDITAR UNA INSTALACION ---*/
        $('.edit_instalacion_button').on('click',function(){
            let editBtn = this;
            $(this).css({'z-index':'-1'});
            $(this).siblings().css('z-index','-1');
            //activo el boton
            let icon = $(this).find('.material-icons');
            icon.addClass('active');
            //Obtengo la tarjeta con la informacion
            let card = $(this).parent().parent();
            let left = card[0].offsetLeft - 20;
            let top =  card[0].offsetTop - 50;
            //levanto la tarjeta.
            card.removeClass('z-depth-1').addClass('z-depth-3 active');
            setTimeout(function(){
                card.removeClass('z-depth-3 active').addClass('z-depth-1');
                icon.removeClass('active').addClass('disabled');
                icon.parent().siblings().find('.material-icons').addClass('disabled');
                },300);
            //Oculta las demas tarjetas.
            $('.i_card').not('.active').fadeTo(300,0,'easeInQuad',function(){
                //Quito la sombra y desactivo el boton.
                $(this).css({'z-index':'-1'});
            });

            //Activo el icono para volver atras
            $('.content_section').prepend('<i class="back_section_icon material-icons hover-effect">arrow_back</i>');

            //AL pulsar atrás en la seccion de instalaciones
            $('.back_section_icon').on('click',function(){
                let that = this;
                //Oculto los calendarios
               $('.month_calendar_side, .week_calendar_instalaciones').fadeTo(150,0,function(){
                   $(this).remove();
               });
                $(editBtn).css('z-index','');
                $(editBtn).siblings().css('z-index','');

                hideReservas();

               //Cambio el boton de nuevo para añadir una instalacion y no gestionar las reservas.

                card.css('transform','');
                //levanto la tarjeta.
                card.removeClass('z-depth-1').addClass('z-depth-3 active');
                setTimeout(function(){
                    //tras 300 ms qeu ya se ha ocultado los calendarios, muevo la tarjeta y la bajo.
                    card.removeClass('z-depth-3 active').addClass('z-depth-1');
                    $(that).remove();
                    //Muestro las demas tarjetas.
                    $('.i_card').not('.active').fadeTo(300,1,'easeInQuad',function(){
                        $(this).css({'z-index':''});
                    });
                    icon.removeClass('disabled');
                    icon.parent().siblings().find('.material-icons').removeClass('disabled');
                },300);
            });


            //muevo la tarjeta de sitio que tiene un retardo de 100ms y tarda 300ms.
            card.css({'transform':'translate(-'+left+'px,-'+top+'px)'});
            left = card.width();
            let right = $('.main_add_button').width() + 10;
            top = card.height() + 50;
            let height = window.innerHeight - 300;
            if(window.innerWidth>720){
                //una vez ya la tarjeta está en su sitio, esto pasará transcurridos unos 400ms, muestro el contenido del calendario y la leyenda.
                $('.instalaciones_section .instalaciones_content').append('<div class="main_panel month_calendar_side z-depth-1 "><div class="side_calendar" id="month_calendar"></div></div> <div class="main_panel week_calendar_instalaciones z-depth-1"><div class="main_calendar" id="week_calendar"></div></div>');
                let side_calendar = $('.month_calendar_side');
                let main_calendar = $('.week_calendar_instalaciones');
                side_calendar.css({top:top+'px', width:left+'px'});
                main_calendar.css({left:(left+20)+'px', height:height+'px','margin-top':'50px',right:right});

                $('#month_calendar').Calendar({
                    view:'monthView',
                    mainCalendar:false,
                    shortDays:true
                });
                $('#week_calendar').Calendar({
                    view:'weekView',
                    mainCalendar:true,
                    views:{week:true,day:true}
                });

                side_calendar.fadeTo(200,1);
                main_calendar.fadeTo(200,1);
            }

            window.instalacion = $(this).parent().data('instalacion');

            showReservas();


           /*----  GESTION DE LAS RESERVAS Y DE LOS SECTORES*/
           function showReservas(){
               let resp = window.innerWidth < 720;
               let addBtn = $('.main_add_button');
               let width = resp ? '100%' : addBtn.width();
               let reservaBtn = $('#add_reserva_button');
               let reservaContent = $('#reservas_content');
               let reservas = [];
               reservaBtn.css('width',width);
               reservaContent.css('max-width',width);
               addBtn.css({'opacity':0,'z-index':'-1'});

               //Cargo las reservas y muestro el contenido.
               reservaContent.fadeTo(300,1,function(){
                   let cal = $('.main_calendar');
                   let m = cal.length > 0 ? cal.Calendar('getCalendar').moment : moment();
                   let pd = moment(m).startOf('week').format('YYYY-MM-DD HH:mm');
                   let ud = moment(m).endOf('week').format('YYYY-MM-DD HH:mm');
                   $.ajax({
                       url: $('meta[name="app-url"]').attr('content') + 'admin/reservas',
                       type:'GET',
                       data:{'primerDia':pd,'ultimoDia':ud,'instalacion':window.instalacion.id},
                       success:function(response){
                           console.log(response);
                           let grouped = response.reduce(function(vA,x){
                               (vA[x['team_id']] = vA[x['team_id']] || []).push(x);
                               return vA;
                           },{});
                           let rc =  $('#reservas_content');
                           rc.find('li').remove();
                           for(let t in grouped){
                               if(grouped.hasOwnProperty(t)){
                                   addReservaCollection(rc,grouped,t);
                               }
                           }
                       },
                       error:function(err){
                           console.log(err);
                       }
                   }).done(function(){
                       //Voy mostrando las diferentes reservas.
                       let el = document.querySelector('.collapsible.expandable');
                       M.Collapsible.init(el,{accordion:false});
                   });
               });
           }

        });

        /*--- ELIMINAR UNA INSTALACION ---*/
        $('#delete_instalacion_button').on('click',function(){
            let modal = M.Modal.getInstance($('#confirm_delete'));
            let parent = $(modal._openingTrigger.parentElement);
            if(modal.isOpen){
                let id = parent.data('instalacion').id;
                $.ajax({
                    url:url,
                    type:'DELETE',
                    data:{id:id},
                    success:function(response){
                        modal.close();
                        parent.parent().remove();
                        console.log(response);
                    },
                    error:function(err){
                        console.log(err);
                    }
                });
            }
        });


        /*---- AÑADIR RESERVA ----*/
        $('#dia-reserva').dateTimePicker({onlyDate:true});

        $('#horaInicio-reserva').dateTimePicker({onlyTime:true});

        $('#horaFin-reserva').dateTimePicker({onlyTime:true});
        //Contar palabras para el uso de la reserva
        $('textarea#uso-reserva').characterCounter();

        $('#team_check').on('change',function(){
           if($(this).prop('checked')){
               $('#team-reserva').parent().parent().show(10,function(){
                   $(this).fadeTo(150,1);
               });
           }else{
               $('#team-reserva').parent().parent().fadeTo(150,0,function(){
                   $(this).hide(10);
               });
           }
        });

        let addReservaForm = $('#add_reserva_form').find('form');

        addReservaForm.validate({
           rules:{
               'dia-reserva':{required:true,validMoment:'DD/MM/YYYY'},
               'horaInicio-reserva':{required:true,validMoment:'HH:mm'},
               'horaFin-reserva':{required:true,validMoment:'HH:mm',timeBiggerThan:'#horaInicio-reserva'},
               'uso-reserva':{required:true,maxlength:120},
               'team-reserva':{required:function(){return $('#team_check').prop('checked')}}
           },
            messages:{
               'uso-reserva':{maxlength:'Introduce una breve descripción. Menos de 120 letras.'}
            },
            submitHandler:function(form){
                let data = $(form).serializeFormJSON();
                console.log(data);
                data.instalacion = window.instalacion.id;
                $.ajax({
                    url: $('meta[name="app-url"]').attr('content') + 'admin/reservas',
                    type:'POST',
                    data:data,
                    success:function(response){
                        if(typeof response === 'object' && response.hasOwnProperty('team_id')){
                            let id = response.team_id !== null ? 'team-'+response.team_id : 'team-0';
                            let sel = $('#'+id);
                            let team = $('#reservas_content').data('teams').find(function(team){return parseInt(response.team_id) === team.id});
                            if(sel.length>0){
                                addReservatoCollection(sel,response);
                            }else{
                                let collection = {0:response};
                                addReservaCollection($('#reserva_content'),collection,0);
                            }
                            renderReserva(response,team);
                            M.Modal.getInstance($('#add_reserva_form')).close();
                            console.log(response);
                        }else{
                            console.log('Problema al renderizar la nueva reserva');
                        }
                    },
                    error:function(err){
                        console.log(err);
                    }
                });
            }
        });

        function addReservaCollection(rc,grouped,t){
            let html = '<li/>';
            let team = rc.data('teams').find(function(team){return parseInt(t) === team.id});
            let id = team !== undefined ? team.id : 0;
            let header = '<div class="collapsible-header" id="team-'+id+'">' + (team === undefined ? 'Particulares' : team.name+' - '+team.category) + '</div>';
            let teams = '<div class="collapsible-body"><ul class="collection">';
            grouped[t].forEach(function(el){
                teams = teams + '<li class="collection-item">'+
                    '<span>fecha: '+moment(el.fecha,'YYYY-MM-DD HH:mm').format('DD-MM-YYYY HH:mm')+ '</span><span>uso: '+ el.uso + '</span><span>tiempo: '+ el.tiempo / 60 + ' horas</span>'
                    +'</li>';
                renderReserva(el,team);
            });
            teams = teams + '</ul></div>';
            html = $(html).append(header).append(teams);
            rc.find('.collapsible').append(html[0].outerHTML);
        }

        function addReservatoCollection(sel,response){
            sel.find('.collection').append('<li class="collection-item">'+
                '<span>fecha: '+moment(response.fecha.date,'YYYY-MM-DD HH:mm').format('DD-MM-YYYY HH:mm')+ '</span><span>uso: '+ response.uso + '</span><span>tiempo: '+ response.tiempo / 60 + ' horas</span>'
                +'</li>');
        }
        function hideReservas(){
            $('#reservas_content').fadeTo(150,0,function(){
                $('.main_add_button').css({'opacity':'1','z-index':''});
                $(this).css('z-index','-1');
            });
        }

        function renderReserva(reserva,team,instalacion){
            let h = moment(reserva.fecha).minutes() > 0;
            let celda = null;
            $('.hour_info_cell').each(function(i,el){
                let fc = moment($(el).data('fecha'),'DD-MM-YYYY HH:mm').format('DD-MM-YYYY HH');
                let fr = moment(reserva.fecha,'YYYY-MM-DD HH:mm').format('DD-MM-YYYY HH');
                if(fc === fr){
                    celda = el;
                    return false;
                }
            });
            let horaInicio = moment(reserva.fecha).format('HH:mm');
            let horaFin = moment(reserva.fecha).add(reserva.tiempo,'minutes').format('HH:mm');
            let width = 100 / window.instalacion.sectores;
            $(celda).append('<div class="reserva" id="reserva'+reserva.id+'" style="height:'+(reserva.tiempo)+'px;width:'+width+'%"> <p class="reserva-info"></p><p class="reserva-time">'+horaInicio +'-'+ horaFin+'</p></div>');
            let info = team !== undefined ? team.name : reserva.uso;
            $('#reserva'+reserva.id).find('.reserva-info').append(info);
        }
    }

    /*------------------------------------------------------------------
    * ----------------- SECCION DEL MATERIAL ----------------------------
    * ------------------------------------------------------------------*/
    function materialSection(){
        $('.add-card').on('click',function(){
           $('#add_material_icon').toggleClass('active');
        });
        if(!$('.tabbs li').hasClass('active') && !$('.tab-content div').hasClass('active')) {
            $('.tabbs li:first').addClass('active');
            $('.tab-content div:first').addClass('active');
        }

        $('.deleteMaterial').on('click',function(){
            $('.confirmDelete').show();
            $('.fondoDelete').show();
            id=$(this).parent().parent().data('id');
        });

        $('.fondoDelete').click(function(){
            $('.confirmDelete').hide();
            $('.fondoDelete').hide();
        });

        $('.noConfirm').click(function(){
            $('.fondoDelete').click();
        });

        $('.yesConfirm').click(function(){
            $.ajax({
                url:APP_URL +'/admin/material/remove/'+id,
                type:'get',
                success:function(){
                    $('.fondoDelete').click();
                    window.location.href=APP_URL+'/admin/material/';
                },
                error:function(response){
                    errors = JSON.parse(response);
                    console.log(errors);
                }
            });
        });

        $('.addMaterial').click(function(){
            id=$(this).parent().parent().data('id');
            $.ajax({
                url:APP_URL + '/admin/material/add/'+id,
                type:'get',
                success:function(){
                    window.location.href=APP_URL+'/admin/material/';
                },
                error:function(response){
                    errors = JSON.parse(response);
                    console.log(errors);
                }
            });
        });
    }





    /*---------------------------------------------------------------------------
    * --------------------------------- EVENTO  ---------------------------------
    * ---------------------------------------------------------------------------*/


    class Event{

        //Constructor del evento
        constructor(options){
            this.category = options.category ? options.category : null;
            this.title = options.title ? options.title : '';
            this.start = options.start ? options.start : '';
            this.end = options.end ? options.end : '';
            this.repetition = {};
            this.startPick = null;
            this.endPick = null;
            //this.initSelectDates();
            //this.repeatPanel();
        }

        destroy(){
            this.start = '';
            this.end = '';
            this.category = null;
            this.hideCategoryPanel();
            this.hideRepeatPanel();
            $('#time_event_end').AnyPicker('destroy');
            $('#time_event_start').AnyPicker('destroy');
            //Reinicio los botones de categorias
            $('#add_categories_event, #add_new_categorie, .edit_category, .categorie.selectable , .btn-save').off('click');

            //Reinicio los botones de la repeticion
            $('#add_rep_event, #repeat_button,.repeat_event_panel .close, .repeat_option, .month_table td.day_month_table, #day_repeat .col').off('click');
        }

        /*---------------------------------------------------------------
        * --------------------- RENDERIZAR EL EVENTO --------------------
        * ---------------------------------------------------------------*/
        static isRender(event){
            return $('.event[data-id='+event.id+']').length > 0;
        }
        static monthRender(id,event){
            let width = 100;
            let alt = 20;
            $('.ppns-cal__cell.day').each(function(i,el){
                if(moment($(el).data('fecha'),'DD-MM-YYYY').isSame(moment(event.start),'day')){
                    width = width * (moment(event.end).diff(moment(event.start),'days')+1);
                    if(($(el).find('.month_events').height() + alt) > $(el).height()/100*50){
                        console.log('Hay mas eventos');
                    }else{
                        $(el).find('.month_events').append('<div class="event c-'+id+'" style="width:'+width+'%">'+event.title+'</div>');
                    }
                    return false;
                }
            });
        }
        static weekRender(categories,event,style){
            style = style !== undefined ? style : '';
            let top = 0;
            let start = moment(event.start);
            let end = moment(event.end);
            let duration = end.diff(start,'hours');
            let id = 0;
            categories.forEach(function(ca){
                if(ca.id === event.category_id){
                    id = event.category_id;
                    return false;
                }
            });
            for(let i=0;i<7;i++){
                for(let j=0;j<24;j++){
                    //Por cada celda que voy a controlar.
                    let el = $('.ppns-cal__row.hour').eq(j).find('.date_cell').eq(i);
                    let fC = moment($(el).data('fecha'), 'DD-MM-YYYY HH:mm');
                    if(start.isSame(fC,'hour')){
                        top = (start.diff(fC,'minutes') / 60) * 100;
                        if((start.hour() + duration) >= 25){
                            $(el).append('<div class="event top-'+top+' c-'+id+' h-'+(24 - start.hour())+'" data-duration="'+duration+'" data-title="'+event.title+'" data-id="'+event.id+'" style="'+style+'"></div>');
                            start.add(1,'day');
                            duration = duration - (24 - start.hour());
                            start.hour(0);
                        }else{
                            $(el).append('<div class="event top-'+top+' c-'+id+' h-'+duration+'" data-duration="'+duration+'" data-title="'+event.title+'" data-id="'+event.id+'" style="'+style+'"></div>');
                        }
                    }
                }
            }
        }
        /*---------------------------------------------------------------
        * --------------------- FECHAS DEL EVENTO --------------------
        * ---------------------------------------------------------------*/

        //Cuando se crea un evento y se abre el modal inicializo los selectores de las fechas con las fechas que me llegan.
        initSelectDates(){
            //Variables de selectores y para acceder al evento
            let start = $('#time_event_start');
            let end = $('#time_event_end');
            let that = this;
            //Selector de la fecha de inicio. Esta función se llama al crearse el evento, fecha de inicio = '' || fecha.
            start.AnyPicker(objectPicker(that.start,'start',function(output){
                that.start = output;
                if(output > end.val()){
                    that.endPick.setSelectedDate(output);
                    that.endPick.setting.headerTitle.markup = '<span class="ap-header__title">'+output+'</span>';
                    end.val(output);
                }
                that.endPick.setMinimumDate(output);
            }));

            //Selector de la fecha de fin. Esta función se llama al crearse el evento, fecha de fin = '' || fecha.
            end.AnyPicker(objectPicker(that.end,'end',function(output){
                that.end = output;
            }));

            //Funcion auziliar para crear un objeto AnyPicker para los selectores de fechas.
            function objectPicker(d,string,callback){
                let date = d;
                let sUserAgent = navigator.userAgent;
                let mobile = {
                    Android:sUserAgent.match(/Android|Silk/i),
                    iOS:sUserAgent.match(/iPhone|iPad|iPod/i),
                    Windows:sUserAgent.match(/IEMobile/i)
                };
                let theme = 'default';
                if(mobile.Android){theme='Android'}else if(mobile.iOS){theme='iOS'}else if(mobile.Windows){theme = 'Windows'}
                return {
                    onInit:function(){string === 'end' ? that.endPick = this : that.startPick = this},
                    mode:'datetime',
                    theme:theme,
                    inputChangeEvent:'onChange',
                    onChange:function(cI,rI,sV){
                        let title = $('.ap-header__title');
                        let change = this.compareDates(sV.date,new Date(title.text()));
                        if(change !== 0){
                            date = moment(sV.date).format('DD-MM-YYYY HH:mm');
                            $(title).text(date);
                            this.setting.headerTitle.markup = '<span class="ap-header__title">'+date+'</span>'
                        }
                    },
                    headerTitle:{markup:'<span class="ap-header__title">'+date+'</span>',type:'Text',contentBehaviour:'Dynamic',format:'dd-MM-yyyy HH:mm'},
                    onShowPicker:function(){
                        $('.ap-content-switch-date').text('Fecha');
                        $('.ap-content-switch-time').text('Hora');
                    },
                    i18n:{headerTitle:'Fecha',setButton:'ACEPTAR', cancelButton:'CANCELAR'},
                    dateTimeFormat:'dd-MM-YYYY HH:mm',
                    rowsNavigation:'scroller+buttons',
                    selectedDate:date,
                    onSetOutput:callback
                };
            }

            //Además pongo las fechas como valor de los input
            start.val(that.start);
            end.val(that.end);
        }







        /*---------------------------------------------------------------
        * --------------------- REPETICION DEL EVENTO --------------------
        * ---------------------------------------------------------------*/
        hideRepeatPanel(){
            $('.repeat_selection').removeClass('active');
            $('#picker_repeat, #day_month_select').css('display','none').addClass('active');
            $('#day_repeat').removeClass('active').hide();
            $('.month_table td.day_month_table, #day_repeat .col').removeClass('selected');
            $('#picker_repeat_input').html('Sin Repetición');
            $('#info_repeat_event').remove();
            $('.repeat_option.selected').removeClass('selected');
            $('.repeat_option').each(function(i,el){
                if($(el).data('value') === 'nunca'){$(this).addClass('selected');}
            });
        }

        //Inicio del panel de repeticion
        repeatPanel(){

            let that = this;
            let anpi = this, sOut;

            //Cuando clickamos en el boton de evento con repeticion
            $('#add_rep_event').on('click',function(){
                $('.repeat_selection').addClass('active');
                $('#picker_repeat').css('display','flex').addClass('active');
            });

            //Al clickar en repeticion muestro el panel con las opciones
            $('#repeat_button').on('click',function(){
                $('.repeat_event_panel').show(function(){
                    $(this).addClass('active');
                });
            });
            //Accion al clickar para cerrar el panel
            $('.repeat_event_panel .close').on('click',function(){
                let panel = $('.repeat_event_panel');
                panel.removeClass('active');
                setTimeout(function(){panel.hide()},500);
            });

            //Accion al clickar en una opcion del panel
            $('.repeat_option').on('click',function(){
                $('.repeat_event_panel .close').click();
                if(!$(this).hasClass('selected')){
                    $('.repeat_option.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
                if($(this).hasClass('custom_btn')){
                    anpi.showOrHidePicker(sOut);
                }else{
                    let day_repeat = $('#day_repeat');
                    let day_month = $('#day_month_select');
                    that.repetition.frecuencia = $(this).data('value');
                    that.repetition.veces=1;
                    $('#picker_repeat_input').text($(this).text());
                    $('#repeat_frec_info').text($(this).text());
                    //Si el calendario del mes esta activo, lo oculto
                    if(day_month.hasClass('active')){
                        day_month.removeClass('active').hide();
                    }
                    //Si la seleccion de dias esta activa, la oculto
                    if(day_repeat.hasClass('active')){
                        day_repeat.removeClass('active').hide();
                    }
                    //Le quito el texto a la repeticion personalizada.
                    $('#repeat_day_info').text('');
                }
            });

            //AnyPicker para la repeticion del evento
            $(".repeat_option.custom_btn").AnyPicker({
                onInit:function(){
                    anpi = this;
                },
                inputChangeEvent:'onChange',
                onSetOutput:cfSetOutPut,
                mode:'select',
                i18n:{
                    headerTitle:"FECHA",
                    setButton:'ACEPTAR',
                    clearButton:'LIMPIAR',
                    closeButton:'CERRAR',
                    cancelButton:'CANCELAR'
                },
                layout:'fixed',
                vAlign:'bottom',
                showComponentLabel:true,
                rowsNavigation:'scroller+buttons',
                parseInput:cfParseInput,
                formatOutput:cfFormatOutPut,
                components:[
                    {
                        component:0,
                        name:'number_repetition',
                        label:'Cada',
                    },
                    {
                        component:1,
                        name:'frequency_repetition',
                        label:'Frecuencia',
                    }
                ],
                dataSource:[
                    {
                        component:0,
                        data:createDataComponents(0)
                    },
                    {
                        component:1,
                        data:createDataComponents(1)
                    }
                ]
            });


            //Accion al elegir un dia de repeticion
            $('#day_repeat').find('.col').on('click',function(){
                selectRepeatDays('#day_repeat .col',that,this,'day');
            });

            //Accion al elegir un dia del mes de repeticion
            $('.month_table td.day_month_table').on('click',function(){
                selectRepeatDays('.month_table td.day_month_table',that,this,'month');
            });

            //Funcion auxiliar para seleccionar los dias de repeticion
            function selectRepeatDays(s,e,el,f){
                let days = [];
                let info_day = $('#repeat_day_info');
                if($(el).hasClass('selected')){
                    $(el).removeClass('selected');
                    e.repetition.dias = e.repetition.dias.filter(val => val!==$(el).data('value').toString());
                }else{
                    $(el).addClass('selected');
                    e.repetition.dias.push($(el).data('value').toString());
                }
                let seleccionados = $(s+'.selected');
                if(seleccionados.length>0){
                    seleccionados.each(function(i,el){
                        if(f === 'month'){
                            days.push($(el).data('value'))
                        }else{
                            days.push(moment().day($(el).data('value')).format('dddd'));
                        }
                    });
                    info_day.text('. Los '+days.join(', '));
                }else{
                    info_day.text('');
                }
            }
            //Funcion auxiliar cuando cambie la salida de la repeticion
            function cfSetOutPut(outPut,selectedValues){
                sOut = outPut;
                let day_repeat = $('#day_repeat');
                let day_month = $('#day_month_select');
                let info_day = $('#repeat_day_info');
                let day = '';
                $('#picker_repeat_input').html(outPut);
                if($('#info_repeat_event').length>0){
                    $('#repeat_frec_info').html(outPut);
                }else if(!outPut.includes('Sin')){
                    $('.repeat_selection').append('<div id="info_repeat_event">El evento se repetirá <span id="repeat_frec_info">'+outPut+'</span><span id="repeat_day_info"></span></div>');
                }
                that.repetition.veces = selectedValues.values[0].val;
                that.repetition.frecuencia = selectedValues.values[1].val;

                //En caso de que se haya escogido frecuencia semanal
                if(outPut.includes('Semanas')){
                    //Si el calendario del mes esta activo, lo oculto
                    if(day_month.hasClass('active')){
                        day_month.removeClass('active').hide();
                    }
                    //Muestro el selector de los dias de la semana
                    day_repeat.css('display','flex').addClass('active');
                    //Añado la clase main del dia que se ha seleccionado.
                    day_repeat.find('.col').each(function(i,el){
                        if($(el).data('value') === moment().date(that.start.split('-')[0]).day()){
                            $(this).addClass('selected');
                            that.repetition.dias = [$(this).data('value').toString()];
                            day = moment().day($(this).data('value')).format('dddd');
                        }
                    });
                    //Caso de que se escoja frecuencia mensual
                }else if(outPut.includes('Meses')){
                    //Si está la repeticion semanal, se oculta
                    if(day_repeat.hasClass('active')){
                        day_repeat.removeClass('active').hide();
                        info_day.text('');
                    }
                    //Se muestra el selector de dias mensual
                    day_month.show().addClass('active');
                    $('.month_table td.day_month_table').each(function(i,el){
                        if($(el).data('value').toString() === that.start.split('-')[0]){
                            $(this).addClass('selected');
                            that.repetition.dias = [$(this).data('value').toString()];
                        }
                    });
                }else{
                    if(day_repeat.hasClass('active')){
                        day_repeat.removeClass('active').hide();
                    }else if(day_month.hasClass('active')){
                        day_month.removeClass('active').hide();
                    }
                }
            }
            //Funcion auxiliar para generar el valor de los selectores
            function createDataComponents(i){
                let arr=[{val:'-',label:'-'}];
                if(i===0){
                    for(let i=1;i<21;i++){
                        arr.push({val:i,label:i.toString()});
                    }
                }else if(i===1){
                    let frecuencia=[{val:'Diario',label:'Dias'},{val:'Semanal',label:'Semanas'},{val:'Mensual',label:'Meses'},{val:'Anual',label:'Años'}];
                    frecuencia.forEach(function(el,){
                        arr.push({val:el.val,label:el.label});
                    });
                }
                return arr;
            }

            //Funcion para seleccionar el valor correcto al abrir el selector de nuevo
            function cfParseInput(elemValue){
                let inArray = [];
                let obj = this;
                if(elemValue !== undefined && elemValue !== null && elemValue !== ''){
                    inArray.push(elemValue.split(' ')[1]);
                    inArray.push(elemValue.split(' ')[2]);
                }else{
                    inArray = ['-','-'];
                }
                return inArray;
            }
            //Funcion para formatear el texto que vemos
            function cfFormatOutPut(elemValues){
                let outStr = 'Sin Repetición';
                let valArray = [];
                for(let i=0;i<this.tmp.numOfComp;i++){
                    if(elemValues.values[i].label !== undefined){
                        valArray.push(elemValues.values[i].label.toString());
                    }else{
                        valArray.push('-');
                    }
                }
                if(valArray[0] !== '-'){
                    if(valArray[1] !== '-'){
                        outStr = 'cada '+ valArray[0] + ' ' + valArray[1];
                    }
                }
                return outStr;
            }
        }

    }

});