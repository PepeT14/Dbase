const daysCortos = ['Lun', 'Mar','Mie', 'Jue','Vie', 'Sáb', 'Dom' ];
const daysLargos = ['Lunes', 'Martes','Miércoles', 'Jueves','Viernes', 'Sábado', 'Domingo'];
moment.locale('es');
$.fn.Calendar = function(options){
    let calendar = $(this).data('calendar');
    switch(options){
        case 'destroy':
            Calendar.destroy(this);
            break;
        case 'getCalendar':
            return calendar;
        case 'copy':
           return new Calendar(this,calendar);
        default:
            window.cal = new Calendar(this,options);
            $(this).data('calendar',cal);
            cal.render();
    }
};

class Calendar{

    //Constructor del calendario
    constructor(contenedor,options){
        this.contenedor = contenedor;
        this.shortDays = options.shortDays;
        this.mainCalendar = options.mainCalendar;
        this.view = options.view;
        this.moment = options.moment ? options.moment : moment();
        this.events = $(contenedor).data('events');
        this.categories = $(contenedor).data('categories');
    }
    //funcion para eliminar un calendario
    static destroy(contenedor){
        $(contenedor).find('.ppns-main').remove();
        $(contenedor).find('.wrapper').remove();
    }

    //RENDERIZAR LA CABECERA DEL CALENDARIO EN FUNCION DE SI ES PRINCIPAL O NO.
    renderCabecera(){
        this.mainCalendar ?  this.cabeceraMain() : this.cabeceraSecondary();
    }
    //RENDERIZAR EL CONTENIDO DEL CALENDARIO EN FUNCION DE LA VISTA SELECCIONADA
    renderContenido(){
        switch(this.view){
            case 'yearView':
                this.renderYear();
                break;
            case 'monthView':
                this.renderMonth();
                break;
            case 'weekView':
                this.renderWeek();
                break;
            case 'dayView':
                this.renderDay();
                break;
        }
    }

    //Renderizar el calendario
    render(){
        this.renderCabecera();
        this.renderContenido();

        if(this.mainCalendar){
            let that = this;
            //Renderizamos y activamos la logica de añadir eventos
            this.dinamicEvents();
            try{
                this.renderEvents();
            }catch{
                console.log('error al renderizar los eventos');
            }
            //Activamos los cambios de vista
            $('#month_view').on('click',function(){
                Calendar.destroy(that.contenedor);
                that.view = 'monthView';
                let sideCalendar = $('.side_calendar').Calendar('getCalendar');
                if(sideCalendar !== undefined){
                    sideCalendar.view = 'yearView';
                    sideCalendar.year = that.year;
                    sideCalendar.month = that.month;
                    Calendar.destroy(sideCalendar.contenedor);
                    sideCalendar.render();
                }
                that.render();
            });
            $('#week_view').on('click',function(){
                Calendar.destroy(that.contenedor);
                that.view = 'weekView';
                let sideCalendar = $('.side_calendar').Calendar('getCalendar');
                if(sideCalendar !== undefined){
                    sideCalendar.view = 'monthView';
                    sideCalendar.month = that.month;
                    Calendar.destroy(sideCalendar.contenedor);
                    sideCalendar.render();
                }
                that.render();
            });
        }
    }

    /*---------------------------------------------------------------------------------
    * ----------------------------- CABECERA DEL CALENDARIO ---------------------------
    * --------------------------------------------------------------------------------- */

    cabeceraSecondary(){
        let month = this.moment.format('MMMM');
        let anyo = this.moment.format('YYYY');
        let monthView = this.view === 'monthView';
        let html = '<div class="wrapper ppns_header_calendar">\n' +
            '                            <div class="month_year">' +
            '                               <span class="material-icons prev" id="prev">keyboard_arrow_left</span>\n' +
            '                               <div class="ppns_month">\n' +
            '                                   <span class="month">'+(monthView ? month : '')+' '+anyo+'</span>\n' +
            '                               </div>\n'+
            '                               <span class="material-icons next" id="next">keyboard_arrow_right</span>\n';
        $(this.contenedor).append(html);
        let date = monthView ? 'months' : 'years';
        let that = this;
        $('#prev').on('click',function(){
            that.moment = that.moment.subtract(1,date);
            Calendar.destroy(that.contenedor);
            that.render();
        });
        $('#next').on('click',function(){
            that.moment = that.moment.add(1,date);
            Calendar.destroy(that.contenedor);
            that.render();
        });
    }

    cabeceraMain(){
        let month = this.moment.format('MMMM');
        let anyo = this.moment.format('YYYY');
        let html  = '<div class="wrapper ppns_header_calendar main">\n' +
            '                            <div class="month_year_info">' +
            '                               <div class="ppns_month">\n' +
            '                                   <span class="month">'+month+'</span>\n' +
            '                                   <span class="year">'+anyo+'</span>\n' +
            '                               </div>\n' +
            '                            </div>\n' +
            '                            <div class="left_info">' +
            '                               <div class="ppns_sel_view"> ' +
            '                                   <span class="sel_view" id="month_view">Mes</span>' +
            '                                   <span class="sel_view" id="week_view">Semana</span>' +
            '                                   <span class="sel_view" id="day_view">Dia</span>' +
            '                               </div>' +
            '                               <div class="ppns_today">' +
            '                                   <span class="today">Hoy</span>' +
            '                               </div>' +
            '                            </div>' +
            '     </div>' ;
        $(this.contenedor).append(html);
    }


    /*---------------------------------------------------------------------------------
    * ----------------------------- CONTENIDO DEL CALENDARIO ---------------------------
    * --------------------------------------------------------------------------------- */

        /*-------------- VISTA DEL MES --------------*/
    renderMonth(){
        //iniciamos las variable que se usarán proximamente
        let year = this.moment.year();
        let month = this.moment.month();
        let tabla = '<div class="ppns-main monthView" data-month="'+month+'"/>';
        let days = this.shortDays ? daysCortos : daysLargos;
        let main = this.mainCalendar;
        let htmlCab = '';
        //generamos la cabecera de los dias de la semana
        days.forEach(function(n,i){
            let today = i === moment().day()-1;
            htmlCab += '<div class="ppns-cal__col head'+ (today ? ' today' : '' )+ '"><span>'+n+'</span></div>';
        });
        let cabeceraTabla = $('<div class="ppns-cal__row '+(main ? ' main' : '')+'"/>').append(htmlCab);
        tabla = $(tabla).append(cabeceraTabla);
        let firstWeek = moment().month(month).startOf('month').week();
        let lastWeek = moment().month(month).endOf('month').week()+1;
        let calendar = [];
        if(lastWeek<firstWeek){
            lastWeek = moment().month(month).weeksInYear()+2;
        }
        for(let week = firstWeek;week<lastWeek;week++){
            calendar.push({
                week:week,
                days:new Array(7).fill(0).map((n,i)=>moment().year(year).month(month).week(week).startOf('week').clone().add(n+i,'day'))
            })
        }
        calendar.forEach(function(n,i){
            let fila = '<div class="ppns-cal__row '+(main ? ' main' : '')+'"/>';
            let hoy = false;
            let notActual = false;
            n.days.forEach(function(n,i){
                hoy = n.date() === moment().date() && n.month() === moment().month();
                notActual = n.month() !== month;
                fila = $(fila).append('<div class="ppns-cal__cell day'+ (hoy ? ' today' : '') +  (notActual ? ' old' : '')+ (main ? ' main' :'')+
                                '" data-fecha="'+n.format('DD-MM-YYYY')+
                                '" data-week="'+n.week()+'" ' +
                                'data-month="'+n.month()+'"><span>'+n.format('D')+'</span></div>');
            });
            tabla = $(tabla).append(fila[0].outerHTML);
        });
        $(this.contenedor).append(tabla[0].outerHTML);
        if(this.mainCalendar){
            $('#month_view').addClass('active');
        }else{
            //Si no es calendario principal y vista de mes al clikar en un dia, renderizamos un nuevo calendario principal de la semana
            $('.ppns-cal__cell.day').on('click',function(){
                //Eliminamos la clase activa del actual.
                $('.ppns-cal__cell.day.active').removeClass('active');
                //Añadimo la clase al que hemos clickado
                $(this).addClass('active');
                //Comporbamos que tenemos vista de la semana
                if($(document).find('.ppns-main.weekView')){
                    //Cogemos la nueva fecha, Año, Mes y Dia. y se lo asignamos al calendario en caso de que lo tengamos
                    let mainCalendar = $('.main_calendar').Calendar('getCalendar');
                    if(mainCalendar !== undefined){
                        let year = $(this).data('fecha').split('-')[2];
                        let month = $(this).data('month');
                        let date = $(this).data('fecha').split('-')[0];
                        mainCalendar.moment = moment().year(year).month(month).date(date);
                    }
                    Calendar.destroy(mainCalendar.contenedor);
                    mainCalendar.render();
                }
            });
        }
    }

        /*-------------- VISTA DE LA SEMANA --------------*/
    renderWeek(){
        let month = this.moment.month();
        let week = this.moment.week();
        let tabla = '<div class="ppns-main weekView" data-month="'+month+'" data-week="'+week+'"/>';
        let days = this.shortDays ? daysCortos : daysLargos;
        let htmlCab = '<div class="ppns-cal__col weekView"></div>';
        let that = this;
        days.forEach(function(n,i){
            htmlCab += '<div class="ppns-cal__col head weekView" data-fecha="'+moment().month(month).week(week).isoWeekday(i+1).format('DD-MM-YYYY')+'"><span>'+n+' '+moment().month(month).week(week).isoWeekday(i+1).format('DD')+'</span></div>';
        });
        let cabeceraTabla = $('<div class="ppns-cal__row head weekView"/>').append(htmlCab);
        tabla = $(tabla).append(cabeceraTabla);
        let body = '<div class="weekView_body"/>';
        let ahora = moment().hour();
        for(let h=0;h<24;h++){
            let before = week < moment().week() || week === moment().week() && h < ahora;
            let fila = '<div class="ppns-cal__row hour weekView '+(h === ahora ? 'now' : '') + (before ? ' older' : '')+'" />';
            for(let d=0;d<8;d++){
                if(d===0){
                    fila = $(fila).append('<div class="ppns-cal__cell hour_info_cell weekView"><span>'+moment().week(week).startOf('day').add(h,'hour').format('HH:mm')+'</span></div>');
                }else{
                    fila = $(fila).append('<div class="ppns-cal__cell hour_info_cell weekView date_cell main" data-fecha="'+moment().week(week).startOf('week').add(d-1,'day').hour(h).format('DD-MM-YYYY HH:mm')+'"></div>');
                }
            }
            body = $(body).append(fila[0].outerHTML);
        }
        tabla = $(tabla).append(body[0].outerHTML);
        $(this.contenedor).append(tabla[0].outerHTML);
        $('#week_view').addClass('active');
        $('.main_calendar_panel').scrollTop($('.weekView.now').prev().prev()[0].offsetTop);
        //Marco el dia de la semana que estamos focalizando.
        $('.ppns-main.weekView .ppns-cal__col').each(function(){
            //Por cada columna de la cabacera
            if($(this).data('fecha')=== that.moment.format('DD-MM-YYYY')){
                //Si la fecha coincide con la fecha del dia del calendario auxiliar. Activamos el dia
                $(this).addClass('active');
                if($(this).data('fecha') > moment().format('DD-MM-YYYY')){
                    $('.ppns-cal__row.older').removeClass('older');
                }
            }
        });
    }


        /*------------------- VISTA DEL AÑO ----------------*/
    renderYear(){
        let year = this.moment.format('YYYY');
        let month = this.moment.month();
        let tabla = '<div class="ppns-main yearView" data-year="'+year+'"></div>';
        let body = '<div class="yearView_body"/>';
        let m = 0;
        for(let i=0;i<4;i++){
            let fila = '<div class="ppns-cal_row month row w-100"/>';
            for(let r=0;r<3;r++){
                fila = $(fila).append('<div class="col-4 ppns-cal_cell month' + (m === month ? ' active' : '')+'" data-month="'+m+'" data-year="'+year+'"><span>'+moment().month(m).format('MMMM')+'</span></div>');
                m++;
            }
            body = $(body).append(fila[0].outerHTML);
        }
        tabla = $(tabla).append(body[0].outerHTML);
        $(this.contenedor).append(tabla[0].outerHTML);

        $('.ppns-cal_cell.month span').on('click',function(){
            if(!$(this).hasClass('active')){
                $('.ppns-cal_cell.month.active').removeClass('active');
                $(this).parent().addClass('active');
                let mainCalendar = $('.main_calendar').Calendar('getCalendar');
                if(mainCalendar !== undefined){
                    Calendar.destroy(mainCalendar.contenedor);
                    mainCalendar.moment = moment().year($(this).parent().data('year')).month($(this).parent().data('month'));
                    mainCalendar.render();
                }
            }
        });
    }


    /*---------------------------------------------------------------------------------
    * ----------------------------- EVENTOS DEL CALENDARIO ---------------------------
    * --------------------------------------------------------------------------------- */

        /* LOGICA EVENTOS */
    dinamicEvents(){
        //Inicio las variables
        let isMouseDown = false;
        let startDate = null;
        let endDate = null;
        let that = this;
        let act = false;
        window.evento = null;
        let celda = $('.ppns-cal__cell.main');
        //Hay dos formas de añadir eventos, una dinamicamente clickando doble sobre un dia, u hora, o arrastrando.
            //DOBLE CLICK
        celda.on('dblclick',function(){
            startDate = $(this).data('fecha');
            endDate = $(this).data('fecha');
            //Muestro el modal para crear el evento
            $('#add_event_modal').modal('show');
            //Me creo un objeto evento con la fecha de inicio y de fin obtenidas anteriormente.
            evento = new Event({
                start:startDate,
                end:endDate
            });
        });
            //TODO ARRASTRANDO
        /*celda.on('mousedown',function() {
            startDate = this;
            isMouseDown = true;
            act = false;
        }).on('mouseover',function(){
            //Cuando pasamos el raton por encima, vemos si antes hemos pulsado o no en alguna otra celda.
            if(isMouseDown){
                if($(this).hasClass('selected')){
                    $(this).removeClass('selected');
                    return false;
                }
                endDate = this;
                //Si la vista es del mes dejamos por cualquier dia del calendario que no sea el mismo
                //Si la vista es del dia dejamos a cualquier hora que no sea la misma
                if(startDate !== endDate){
                    if(that.view === 'weekView'){
                        if($(startDate).data('fecha').split('-')[0] === $(endDate).data('fecha').split('-')[0]){
                            $(startDate).addClass('selected');
                            $(endDate).addClass('selected');
                            act = true;
                        }
                    }else{
                        $(startDate).addClass('selected');
                        $(endDate).addClass('selected');
                        act = true;
                    }
                }
            }
        }).on('mouseup',function(){
            //Cuando levanto el raton
            isMouseDown = false;
            if(act === true){
                //Marco como fecha de inicio la primera seleccionada.
                startDate = $('.ppns-cal__cell.selected:first').data('fecha');
                //Marco como fecha de fin la ultima seleccionada.
                endDate = $('.ppns-cal__cell.selected:last').data('fecha');
                //Muestro el modal para crear el evento
                $('#add_event_modal').modal('show');
                //Me creo un objeto evento con la fecha de inicio y de fin obtenidas anteriormente.
                evento = new Event({
                    start:startDate,
                    end:endDate
                });
            }
        });*/

        //Cuando el modal de creación de evento se cierra, se reinicia. Y se vuelve al inicio
        $('#add_event_modal').on('hide.bs.modal',function(){
            //Limpio las celdas seleccionadas
            $('.ppns-cal__cell.selected').removeClass('selected');
            //Reinciio las variables
            startDate = null;
            endDate = null;
            isMouseDown = false;
            //Elimino el evento para que la siguiente vez salga como de inicio.
            evento.destroy();
        });
        //Logica para guardar el evento cuando se pulse aceptar.
        this.saveEvent();
    };

    /*---------------------------------------------------------------
    * --------------------- GUARDAR  EVENTO --------------------
    * ---------------------------------------------------------------*/
    saveEvent(){
        let that = this;
        $('#save_event').on('click',function(){
            evento.title = $('input[name="event-title"]').val();
            if(evento.title === '' || evento.start === '' || evento.end === ''){

            }else{
                $.ajax({
                    type:'POST',
                    url: $('meta[name="app-url"]').attr('content') + $(this).data('href'),
                    data:{title:evento.title,start:evento.start,category:evento.category,end:evento.end,repetition:evento.repetition},
                    success:function(response){
                        that.events = response;
                        that.renderWeekEvents(response);
                    },
                    error:function(err){
                        console.log(err);
                    }
                });
            }
        });
    }

    renderWeekEvents(e){
        if(e !== null){
            let color = 'grey';
            let top = 0;
            let events = e.filter(date => !moment(date.start).isBefore(moment().week(this.week).startOf('week')) &&  !moment(date.start).isAfter(moment().week(this.week).endOf('week')));
            let categories = $(this.contenedor).data('categories');
            events.forEach(function(date){
                $('.date_cell').each(function(i,el){
                    let fC = moment($(el).data('fecha'), 'DD-MM-YYYY HH:mm');
                    let start = moment(date.start);
                    let end = moment(date.end);
                    let h = end.diff(start,'hours')+1;
                    if(start.isSame(fC,'hour')){
                        top = (start.diff(fC,'minutes') / 60) * 100;
                        categories.forEach(function(ca){
                            if(ca.id === date.category_id){
                                color = ca.color;
                                return false;
                            }
                        });
                        $(el).append('<div class="event top-'+top+' h-'+h+'" style="background-color:'+color+'">'+date.title+'</div>');
                    }
                });
            });
            console.log(events);
            console.log(categories);
        }else{
            //.format('DD-MM-YYYY HH:mm') === $(el).data('fecha')
            console.log('No hay eventos para renderizar');
        }
    }

}

class Event{

    //Constructor del evento
    constructor(options){
        this.category = options.category ? options.category : null;
        this.title = options.title ? options.title : '';
        this.start = options.start ? options.start : '';
        this.end = options.end ? options.end : '';
        this.repetition = {dias:[]};
        this.startPick = null;
        this.endPick = null;
        this.initSelectDates();
        this.categoriesPanel();
        this.repeatPanel();
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
    * --------------------- CATEGORIA DEL EVENTO --------------------
    * ---------------------------------------------------------------*/

    //Cuando creo un evento activo la lógica para el panel de las categorias
    categoriesPanel(){
        let that = this;
        //Accion cuando pulse en el boton de categorias
        $('#add_categories_event').on('click',function(){
            $('.categories_event_panel').addClass('active');
        });

        //Accion al clickar en la X del panel
        $('.categories_event_panel .close').on('click',function(){
            that.hideCategoryPanel();
        });
        //Accion al clickar en nueva categoria
        $('#add_new_categorie').on('click',function(){
            that.createCategoryPanel(0);
            $('#category-name').val('');
            $('.btn-save').find('span').html('Crear');
        });
        //Accion al clickar en editar categoria
        $('.edit_category').on('click',function(){
            let title = $(this).parent().data('title');
            let color = $(this).parent().data('color');
            let id = $(this).parent().data('id');
            that.createCategoryPanel(id);
            $('#category-name').val(title);
            $('.color_selection').each(function(i,el){
                if($(el).css('background-color') === color){
                    $(el).addClass('selected');
                }
            });
            $('.btn-save').find('span').html('Editar');
        });

        //Accion para añadir etiqueta al evento.
        $('.categorie.selectable').on('click',function(){
            that.category = $(this).parent().data('id');
            $('.categories_event_panel .close-menu').click();
        });
    };

    /*----  PANEL PARA ELEGIR LA CATEGORIA DEL EVENTO ---*/
    static selectCategoryPanel(){
        //Elimino si hubiera elementos que no son de este panel.
        $('.back_icon').remove();
        //Oculto el panel de creacion y limpio el contenido de colores.
        $('#create_category').hide().removeClass('active');
        $('.color_grid_selection .color_selection').remove();
        //Reseteo el texto
        $('.panel-title .title-text').html('Etiquetas');
        //Muestro el contenido correspondiente
        $('#select_category').show().addClass('active');
    }


    /*--- PANEL PARA CREAR UNA CATEGORIA ---*/
    createCategoryPanel(id){
        let that = this;
        //Añado al panel la flecha para volver atrás
        $('.panel-title').prepend('<span class="material-icons back_icon">arrow_back</span>');
        //Logica al clickar en la fecha para atrás
        $('.back_icon').on('click',function(){
            Event.selectCategoryPanel()
        });
        $('.panel-title .title-text').html('Nueva etiqueta');
        //Muestro el panel y oculto el contenido de seleccionar
        $('#select_category').hide().removeClass('active');
        $('#create_category').show().addClass('active');
        //Relleno los colores para seleccionar
        seleccionColores();
        //Funcion que rellena con colores el panel
        function seleccionColores($color){
            let colors = ['#884a4a','#425F6D','#51e898','#0079bf','#c377e0','#ff9f1a','#f2d600','#ff78cb','#355263'];
            let html = '';
            for(let i=0;i<colors.length;i++){
                html = '<div class="color_selection '+ (colors[i] === $color ? selected : '') +'" style="background-color:'+colors[i]+'">' +
                    '<span class="material-icons">done</span></div>';
                $('.color_grid_selection').append(html);
            }
            $('.color_selection').on('click',function(){
                $('.color_selection.selected').removeClass('selected');
                $(this).addClass('selected');
            });
        }
        //Lógica para guardar una categoria
        $('.btn-save').on('click',function(){
            event.preventDefault();
            let color = $('.color_selection.selected').css('background-color');
            let title = $('#category-name').val();
            let update = $('.btn-save span').html() === 'Editar';
            if(title === ''){
                $('#create_category').find('.form-group').eq(0).children().addClass('error');
            }else if(color === undefined){
                $('#create_category').find('.form-group').eq(1).find('.title').addClass('error');
            } else{
                $.ajax({
                    type:update ? 'PUT' : 'POST',
                    url:$('meta[name="app-url"]').attr('content') + $(this).data('href'),
                    data:{color:color,title:title,update:update,id:id},
                    success:function(response){
                        $('#category_panel').html(response);
                    },
                    error:function(err){
                        $('body').html(err.responseText);
                    }
                }).done(function(){
                    //Links
                    that.categoriesPanel();
                    //Muestro el panel
                    $('.categories_event_panel').addClass('active');
                    //El panel con el texto correspondiente
                    Event.selectCategoryPanel();
                });
            }
        });

    }

    /*--- FUNCION PARA OCULTAR EL PANEL DE CATEGORIAS---*/
    hideCategoryPanel(){
        let that = this;
        //Pongo de nuevo la vista principal
        Event.selectCategoryPanel();
        //Oculto el panel de las categorias
        $('.categories_event_panel').removeClass('active');
        //Añado si el evento tiene categoria
        if(this.category !== null){
            let color=null;
            let title = null;
            $('.categorie_row').each(function(i,el){
                if($(el).data('id') === that.category){
                    color = $(el).data('color');
                    title = $(el).data('title');
                }
            });
            //Elimino otra categoria
            $('.event_categorie.selected').remove();
            //Añado la nueva
            $('#row_categorie_event').prepend('<div class="event_categorie selected" style="background-color:'+color+'">' +
                '<span>'+title+'</span>' +
                '<span class="material-icons clear_category">clear</span></div>');

            //Opcion para eliminar la categoria del evento.
            $('.clear_category').on('click',function(){
                $('.event_categorie.selected').remove();
                that.category = null;
            });
        }else{
            //limpio las categorias si no tiene evento
            $('.event_categorie.selected').remove();
        }
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
                that.repetition.veces=0;
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
            selectRepeatDays('#day_repeat .col',that,this);
        });

        //Accion al elegir un dia del mes de repeticion
        $('.month_table td.day_month_table').on('click',function(){
           selectRepeatDays('.month_table td.day_month_table',that,this);
        });

        //Funcion auxiliar para seleccionar los dias de repeticion
        function selectRepeatDays(s,e,el){
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
                    days.push(moment().day($(el).data('value')).format('dddd'));
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
                    if($(el).data('value') === moment().date(that.start.split('-')[0]).day() && !that.repetition.dias.includes($(this).data('value').toString())){
                        $(this).addClass('selected');
                        that.repetition.dias.push($(this).data('value').toString());
                        day = moment().day($(this).data('value')).format('dddd');
                    }
                });
            }else if(outPut.includes('Meses')){
                if(day_repeat.hasClass('active')){
                    day_repeat.removeClass('active').hide();
                    info_day.text('');
                }
                day_month.show().addClass('active');
                $('.month_table td.day_month_table').each(function(i,el){
                    if($(el).data('value') === that.start.split('-')[0].toString()){
                        $(this).addClass('selected');
                        that.repetition.dias.push($(this).data('value').toString());
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
