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
    sectionActive = '#'+$(objActive).data('seccion');
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
        /*
        * Inicializamos variables en las que almacenaremos información repetitiva, como el objeto clickado, la seccion del objeto, la url del link, etc...
         */
        let obj = $(this);
        let sectionObj  = obj.data('seccion');
        let urlObj = obj.data('href');
            //Obeto ajax dónde almacenaremos la respuesta del servidor y el cuál procesaremos para realizar las acciones necesarias.
        let ajaxObj = {html:null,section:null,url:null};

        /*
        * Creamos un objeto Promise donde controlaremos los tiempos de ejecución y nos aseguraremos del orden de las acciones a realizar
         */
        new Promise(function(ok){
            //Desactivamos el link activo
            $('.header_link.active').removeClass('active');
            //Activamos el link clickado
            obj.addClass('active');
            /*
            * Ocultamos la seccion que tenemos activa
             */
            $(sectionActive + ' div.animated').addClass('fadeOut');
            $(sectionActive).removeClass('animate');
            //Activamos la seccion clickada
            sectionActive = '#'+sectionObj;
            //Doy por finalizado el promise dentro de 1s
            setTimeout(ok,1000);
        }).then(function(){
            /*-- Llamada ajax a la ruta que necesitamos, y si devuelve la vista con éxito la insertamos en el contenido.*/
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
                },
                error:function(response){
                    //En caso de error mostramos el error en el cuerpo HTML.
                    $('body').html(response.responseText);
                }
            }).done(function(){
                //Una vez ha finalizado el promise, esperamos 10 ms y mostramos la seccion.
                setTimeout(function(){
                    showIn(sectionActive);
                    links();
                    loadSectionScripts(sectionObj);
                },10);
            });
        });
    });

    function showIn(seccion){
        //Muestro el contenedor
        $(seccion).addClass('animate');
        //Creo un promise para mostrar una vez redimensionado.
        new Promise(function(fin){
            setTimeout(function(){
                $('#calendar').fullCalendar('option', 'height', 'parent');
                fin();
            },800)
        }).then(function(){
            $(seccion + ' div.animated').removeClass('fadeOut');
            $(seccion + ' div.animated').addClass('fadeIn');
        });
    }


    /*Función que cambia el historial, recibe un id y objeto con html y url.*/
    processAjaxData = function(response){
        //Si la peticion ajax se hace desde el objeto de home, no cargo en el contenido, sino que creo un nuevo documento.
        document.getElementById('admin_main_content').innerHTML = response.html;
        document.title = 'dBase';
        window.history.pushState({html:response.html},"dBase", response.url);
        if(response.title==='home'){
            initCalendar();
        }
    };
    /*Funcion personalizada en el popState, que se active cuando se hagan llamdas al historial, por ejemplo en back o en forward*/
    window.onpopstate = function(event){
        document.getElementById('admin_main_content').innerHTML = event.state.html;
        console.log("location: " + document.location + ", state: " + JSON.stringify(event.state));
    };


    /*--- FullCalendar ---*/
    function initCalendar(){
        $('#calendar').fullCalendar({
            height:'parent',
            fixedWeekCount:false,
            selectable:true,
            selectHelper:true,
            selectAllow:function(selectInfo){
                console.log(selectInfo);
            },
            header:{
                left:'month,basicWeek,agendaDay',
                center:'title',
                right:'prev,today,next',
            },
            views:{
                month:{
                    titleFormat:'MMMM YYYY',
                    columnFormat:'ddd'
                }
            }
        });
    }

    $('#link_equipos').on('click',function(){
        $('#adminTeams_link').click();
    });
    //tooltips and modals
    function links(){
        $('[data-toggle="tooltip"]').tooltip();
        $('[data-action="modal"]').on('click',function(){
            $($(this).data('modaltarget')).modal('show');
        });
        $('[data-action="link"]').on('click',function(){
            $($(this).data('target')).click();
        });
        document.querySelectorAll('select.cs-select').forEach(function(el){
           new SelectFx(el);
        });
    }

    /*JavaScript para la seccion de los equipos.*/
    function jsTeams(){
        let teamSelector = $('#team_select');
        logicaSelect();
        showTeam($('#team_name_selector').find('.option.selected').data('value'));
        /* Funcion para mostrar el equipo seleccionado */
        function showTeam(id){
            $.ajax({
                type:'POST',
                url:$('meta[name="app-url"]').attr('content') + 'admin/teams/ajaxUpdate',
                data:{team:id},
                success:function(response){
                    let contenido = $('#team_detail_content');
                    contenido.html(response.html);
                    contenido.find('div.animated').addClass('fadeIn');
                    console.log(response);
                },
                error:function(err){
                    $('body').html(err.responseText);
                }
            }).done(function(){
                let sectionActive = $('.team_header_tab.active').data('seccion');
                $(sectionActive).show();
                linkHeader();
            });
        }
        function linkHeader(){
            $('.team_header_tab').on('click',function(){
                //Obtenemos lo que está mostrandose actualmente
                let actualSeleccionado = $('.team_header_tab.active');
                let actualSeccion = actualSeleccionado.data('seccion');
                //Quitamos el link de la cabecera y ocultamos la seccion
                actualSeleccionado.removeClass('active');
                $(actualSeccion).hide();
                //Obtengo la nueva seccion a mostrar
                let nuevaSeccion = $(this).data('seccion');
                $(nuevaSeccion).show();
                $(this).addClass('active');
            });
        }
        function logicaSelect(){
            let options = $('.panel_select_overlay').data('options');
            let opcionCategoria = $('#team_category_selector').find('li.option');
            let nombreSelector = $('#team_name_selector');
            function rellenaNombres(obj){
                let opcionesNombres = nombreSelector.find('.selector_options ul');
                opcionesNombres.find('li').remove();
                options.forEach(function(opt){
                    if(opt.category===$(obj).data('value')) {
                        let html = '<li data-value="'+opt.id+'" class="option">'+opt.name+'</li>';
                        opcionesNombres.append(html);
                    }
                });
                nombreSelector.find('.selector_options li').on('click',function(){
                    $('#team_name_title').html($(this).text().trim());
                    opcionesNombres.find('.selected').removeClass('selected');
                    $(this).addClass('selected');
                    selectNombre($(this).data('value'));
                });
            }
            function selectNombre(id){
                $('.panel_select_overlay').removeClass('animate');
                showTeam(id);
            }
            opcionCategoria.on('click',function(){
               rellenaNombres(this);
               $('#team_category_title').html($(this).text().trim());
               $(this).parent().find('.selected').removeClass('selected');
               $(this).addClass('selected');
            });
            opcionCategoria.first().click();
            nombreSelector.find('li.option').first().click();
            $('#select_team_icon').on('click',function(){
                $('.panel_select_overlay').addClass('animate');
            });
            $('.panel_select_overlay .close-menu').on('click',function(){
               $(this).parent().removeClass('animate');
            });
        }
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