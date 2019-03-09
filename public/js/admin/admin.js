$('#formAddTeam').on('click',function(){
   $('#formAddTeam').hide();
   $('.add-team').show();
});

$('#showLeagueForm').click(function(){
   $('#addLeagueForm').toggle();
});

$('#showInstForm').click(function(){
    $('#addInstForm').toggle();
});
$(document).ready(function(){
    /*
    ** --- Lo primero que vamos a hacer es cargar el contenido de la seccion que corresponda --- **
     */
        //Obtenemos la url actual separada por / para saber cual es el final, y que estamos cargando. Esto va ser la primera vez o cuando se recargue.
    let urlAct = window.location.href.split('/');
    let urlSection = null;
    let objActive = null;
        //Comprobamos el caso de home y la url de admin sola para cargar el calendario, en cualquier otro caso obtenemos el último valor de la url.
    if(urlAct[urlAct.length-1]==='home' || urlAct.length<4){
        initCalendar();
        urlSection = 'home';
    }else{
        urlSection = urlAct[urlAct.length-1];
    }
        // Tenemos en urlSection el valor de la seccion que vamos a mostar, buscamos su link en la cabecera y lo activamos.
    $('.header_link').each(function(n,obj){
        if($(obj).data('seccion')===urlSection){
            $(obj).addClass('active');
            objActive = obj;
        }
    });
       //Una vez tenemos la clase añadida, guardamos la referencia en sectionActive, para mostrarla con el método showIn. y linkeamos los botones con el métoodo links.
    let sectionActive = '#'+$(objActive).data('seccion');
    showIn(sectionActive);
    links();
        //Guardamos una copia en el historial para mostrarlo posteriormente
    window.history.replaceState({html:document.getElementById('admin_main_content').innerHTML},'','');

    /*
    * Controlador al pulsar sobre una opción de la cabecera
    * */
    $('.header_link.item').on('click',function(){
        //obtengo el objeto clickado, su seccion y su url objetivo.
        let obj = $(this);
        let sectionObj  = obj.data('seccion');
        let urlObj = obj.data('href');
        //Creo el objeto ajax que se pasará y de dónde recogeremos esta informacion de cada objeto.
        let ajaxObj = {html:null,section:null,url:null};
        //Promise para controlar que primero se oculte y luego se cambie el contenido
        new Promise(function(ok){
            /* Ocultamos la seccion que se ve */
            showOut();
            //Activamos la nueva seccion
            sectionActive = '#'+sectionObj;
            $('.header_link.active').removeClass('active');
            obj.addClass('active');
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
                    processAjaxData(ajaxObj);
                },
                error:function(response){
                    $('body').html(response);
                }
            }).done(function(){
                setTimeout(function(){
                    showIn(sectionActive);
                    links();
                },10);
            });
        });
    });

    function showOut(){
        $(sectionActive + ' div.animated').addClass('fadeOut');
        $(sectionActive).removeClass('animate');
    }

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
                    columnFormat:'dddd'
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
    }
});