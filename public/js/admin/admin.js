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
    if(urlAct[urlAct.length-1]==='home' || urlAct.length<4){
        initCalendar();
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
        //$('#calendar').fullCalendar('option', 'height', 'parent');
        if(seccionObj === seccionOld){
            $('#teams').siblings().not('.modal').not('.active').remove();
            $('.modal.'+seccionOld).eq(0).remove();
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
        if(response.title==='home'){
            initCalendar();
        }
    };

    /*Funcion personalizada en el popState, que se active cuando se hagan llamdas al historial, por ejemplo en back o en forward*/
    window.onpopstate = function(event){
        if(event.state !== null){document.getElementById('admin_main_content').innerHTML = event.state.html};
        console.log("location: " + document.location + ", state: " + JSON.stringify(event.state));
    };


    /*--- ppns_Calendar ---*/
    function initCalendar(){
        let pantallaResponsive = window.innerWidth < 1000;
        $('#month_calendar').Calendar({
            shortDays:true,
            mainCalendar:false,
            view:'monthView'
        });
        $('#week_calendar').Calendar({
            shortDays: pantallaResponsive,
            mainCalendar:true,
            view:'weekView'
        });
        $('#cancel_event').on('click',function(){
           $('#add_event_modal').modal('hide');
        });
        $('#add_event').on('click',function(){
            $('#add_event_modal').modal('show');
        })
    }

    $('#link_equipos').on('click',function(){
        $('#adminTeams_link').click();
    });
    //tooltips and modals
    function links(){
        $('[data-toggle="tooltip"]').tooltip();
        $('[data-toggle="popover"]').popover();
        $('[data-action="modal"]').on('click',function(){
            $($(this).data('modaltarget')).modal('show');
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
    * ----------------- SECCION DE LOS EQUIPOS -------------------
    * ------------------------------------------------------------------*/

    function jsTeams(){
        /*--- Paneles de seleccion de tipo de equipos y vuelta atrás ---*/
        $('.main_team_panel').on('click',function(){
            //Si esta seccion no está activa ya.
            if(!$(this).hasClass('active')){
                //Activamos el link para que se mueva hacia arriba
                $(this).addClass('active');
                //Mostramos el icono para volver hacia atras.
                $(this).find('.back_icon').show(function(){
                    $(this).fadeTo(100,1);
                });
                //Ocultamos la otra seccion
                let section = $(this).data('section');
                $('.main_team_panel').not('.active').fadeTo(100,0,function(){
                    $(this).hide();
                });
                //mostramos la nueva seccion
                $(section).show(function(){
                    $(this).addClass('active');
                    loadSection(this);
                });
            }
        });

        /* Logica al pulsar en el boton de atras*/
        $('.back_icon').on('click',function(){
            //Obtengo el padre que seria el link de la seccion que se esta mostrando
            let par = $(this).parent();
            //Elimino la clase activo del link.
            $('.teams_section.active').removeClass('active');
            //Oculto la seccion.
            setTimeout(function(){$('.teams_section').hide()},200);
            //Vuelve la seccion a su sitio y oculto el link de hacia atras
            $(par).addClass('oculto');
            $(par).removeClass('active');
            //oculto el link para volver hacia atras
            $(this).fadeTo(100,0,function(){
                $(this).hide();
            });
            //Muestro el panel principal, es decir todos los links.
            $('.main_team_panel').show(10,function(){
                $(this).fadeTo(100,1);
            });
            return false;
        });

        /*--- Formulario añadir equipo ---*/
        let newTeamForm = $('#add_team_form').find('form');
        //Salir al pulsar cancelar
        newTeamForm.find('.btn.cancel').on('click',function(){
            event.preventDefault();
            $('#add_team_form').modal('hide');
        });
        //Inicializo el select de las categorias
        $('select#team-category').formSelect();

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
            }
        });
        newTeamForm.on('submit',function(){
            event.preventDefault();
            if($(this).valid()){
                let data = $(this).serializeFormJSON();
                console.log(data);
                $.ajax({
                    url:$('meta[name="app-url"]').attr('content') + '/admin/teams',
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
            }else{
                return false;
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
            //mostramos la nueva seccion y añadimos el boton
            active.append('<div class="waves-effect waves-light teal darken-2" id="add_team_button">' +
                '                        <i class="material-icons left">add</i>\n' +
                '                        AÑADIR EQUIPO\n' +
                '                    </div>');
            let button = $('#add_team_button');

            //linkeamos el boton para mostrar el formulario.
            button.on('click',function(){
                $('#add_team_form').modal('show');
            });
            if(teams.length<1){
                button.addClass('btn-large');
            }else{
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
                    let html = '<div class="input-field"><select id="team-league" name="team-league">'
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
                let tabs = '<ul class="tabs teams z-depth-1"/>';
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
        window.d = moment();
        d.set('date',1);
        function getSemana(){
            let primerDia = d.startOf('week').date() + '/' +d.startOf('week').format('MM');
            let ultimoDia = d.endOf('isoWeek').date() + '/' +d.startOf('week').format('MM');
            return 'Semana del '+primerDia +' al '+ ultimoDia
        }
        $('.panel_title').html(getSemana());
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
});