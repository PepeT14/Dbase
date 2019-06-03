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
    constructor(contenedor,options) {
        this.contenedor = contenedor;
        this.shortDays = options.shortDays;
        this.mainCalendar = options.mainCalendar;
        this.view = options.view;
        this.moment = options.moment ? options.moment : moment();
        this.views = options.views ? options.views : {};
        //this.events = $(contenedor).data('events') !== undefined ? $(contenedor).data('events') : null;
        //this.categories = $(contenedor).data('categories');
    };

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
            //this.dinamicEvents();

            //Logica del boton de hoy
            $('.ppns_today').on('click',function(){
                that.moment = moment();
                Calendar.destroy(that.contenedor);
                that.render();
                let sideCalendar = $('.side_calendar').Calendar('getCalendar');
                if(sideCalendar !== undefined){
                    sideCalendar.moment = moment();
                    Calendar.destroy(sideCalendar.contenedor);
                    sideCalendar.render();
                }
            });
            /*try{
                this.renderEvents(this.events);
            }catch{
                console.log('error al renderizar los eventos');
            }*/

            //Activamos los cambios de vista
            $('#month_view').on('click',function(){
                Calendar.destroy(that.contenedor);
                that.view = 'monthView';
                let sideCalendar = $('.side_calendar').Calendar('getCalendar');
                if(sideCalendar !== undefined){
                    sideCalendar.view = 'yearView';
                    sideCalendar.moment = that.moment;
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
                    sideCalendar.moment = that.moment;
                    Calendar.destroy(sideCalendar.contenedor);
                    sideCalendar.render();
                }
                that.render();
            });
            $('#day_view').on('click',function(){
                Calendar.destroy(that.contenedor);
                that.view = 'dayView';
                let sideCalendar = $('.side_calendar').Calendar('getCalendar');
                if(sideCalendar !== undefined){
                    sideCalendar.view = 'monthView';
                    sideCalendar.moment = that.moment;
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
        let day = this.moment.format('dddd') + ', ' +this.moment.date() + ' · ';
        let html  = '<div class="wrapper ppns_header_calendar main"/>';
        let info = '<div class="header_info">' +
            (this.view === 'dayView' ? day : '') +month + ' ' + anyo + '</div>' +
            '<div class="ppns_sel_view">' +
            (this.views.month ? '<span class="sel_view" id="month_view">Mes</span>' :'') +
            (this.views.week ? '<span class="sel_view" id="week_view">Semana</span>' :'')  +
            (this.views.day ?  '<span class="sel_view" id="day_view">Dia</span>' :'') +
            '</div>' +
            '<div class="ppns_today"><span class="today">Hoy</span></div>';
        html = $(html).append(info);
        $(this.contenedor).append(html[0].outerHTML);
    }



    /*---------------------------------------------------------------------------------
    * --------------------------------- VISTA DEL MES ---------------------------------
    * ---------------------------------------------------------------------------------*/

    renderMonth(){
        //iniciamos las variable que se usarán proximamente
        let year = this.moment.year();
        let month = this.moment.month();
        let main = this.mainCalendar;
        let tabla = '<div class="ppns-main monthView" data-month="'+month+'"/>';
        let days = this.shortDays ? daysCortos : daysLargos;
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
                                'data-month="'+n.month()+'"><div class="month_cell_header"><span>'+n.format('D')+'</span></div><div class="month_events"></div></div>');
            });
            tabla = $(tabla).append(fila[0].outerHTML);
        });
        $(this.contenedor).append(tabla[0].outerHTML);
        if(this.mainCalendar){
            $('#month_view').addClass('active');
        }else{
            $('.ppns-main.monthView').find('.today').addClass('active');
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
                        Calendar.destroy(mainCalendar.contenedor);
                        mainCalendar.render();
                    }
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
            let fila = '<div class="ppns-cal__row hour weekView '+(h === ahora ? 'now' : '') + (before ? ' older' : '')+'" data-hour="'+h+'"/>';
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
        $('.main_panel').scrollTop($('.weekView.now')[0].offsetTop - 230);
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


    /*---------------------------------------------------------------------------------
    * --------------------------------- VISTA DEL DIA ---------------------------------
    * ---------------------------------------------------------------------------------*/
    renderDay(){
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
            let fila = '<div class="ppns-cal__row hour weekView '+(h === ahora ? 'now' : '') + (before ? ' older' : '')+'" data-hour="'+h+'"/>';
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
        $('#day_view').addClass('active');
        $('.main_calendar_panel').scrollTop($('.weekView.now').prev().prev()[0].offsetTop - 70);
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
    /*---------------------------------------------------------------------------------
    * --------------------------------- VISTA DEL AÑO ---------------------------------
    * ---------------------------------------------------------------------------------*/
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
    /*dinamicEvents(){
        //Inicio las variables
        let isMouseDown = false;
        let startDate = null;
        let endDate = null;
        let that = this;
        let act = false;
        window.evento = null;
        let celda = $('.ppns-cal__cell.main');
        //Hay dos formas de añadir eventos, una dinamicamente clickando doble sobre un dia, u hora, o arrastrando.
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
        });
        let modal = $('#add_event_modal');
        modal.on('show.bs.modal',function(){
            startDate = $(this).data('fecha');
            endDate = $(this).data('fecha');

            //Me creo un objeto evento con la fecha de inicio y de fin obtenidas anteriormente.
            evento = new Event({
                start:startDate,
                end:endDate
            });
            //Logica para guardar el evento cuando se pulse aceptar.
            that.saveEvent();
        });
        //Cuando el modal de creación de evento se cierra, se reinicia. Y se vuelve al inicio
        modal.on('hide.bs.modal',function(){
            //Limpio las celdas seleccionadas
            $('.ppns-cal__cell.selected').removeClass('selected');
            //Reinciio las variables
            startDate = null;
            endDate = null;
            isMouseDown = false;
            //Elimino el evento para que la siguiente vez salga como de inicio.
            evento.destroy();
            $('#save_event').off('click');
        });
    };*/

    renderEvents(e){
        //Renderizamos en el menú lateral los eventos del dia de hoy en caso de que existiera.
        function renderDayEvents(categories){
            let el = $('.side_calendar_panel .events_info');
            let esHoy = function(m){
                return moment(m).isBetween(moment().startOf('date'),moment().endOf('date'),null,'[]');
            }
            if(el !== undefined){
                let todayEvents = e.filter(ev => esHoy(ev.start) || esHoy(ev.end));
                let id=0;
                todayEvents.forEach(function(e){
                    categories.forEach(function(ca){
                        if(ca.id === e.category_id){
                            id = e.category_id;
                            return false;
                        }
                    });
                    let start = esHoy(e.start) ? moment(e.start).format('HH:mm') : '';
                    let end = esHoy(e.end) ? moment(e.end).format('HH:mm') : '';
                    $(el).append('<div class="today_event event c-'+id+'" data-start="'+e.start+'" data-end="'+e.end+'"><span>'+e.title+'</span><span>'+start+' - '+end+'</span></div>');
                })
            }
        }
        $('.event').remove();
        if(e !== null){
            let categories = $(this.contenedor).data('categories');
            renderDayEvents(categories);
            let f = this.view === 'monthView' ? 'month' : 'week';
            let events = e.filter(ev => moment(ev.start).isBetween(moment(this.moment).startOf(f),moment(this.moment).endOf(f),null,'[]')
                                        || moment(ev.end).isBetween(moment(this.moment).startOf(f),moment(this.moment).endOf(f),null,'[]'));
            categories.forEach(function(ca){
                document.styleSheets[0].insertRule('.c-'+ca.id+'.event:before{background-color:'+ca.color+'}');
                document.styleSheets[0].insertRule('.c-'+ca.id+'.event:after{border-left:solid 2px '+ca.color+'; padding:2px; overflow:hidden; text-overflow:ellipsis;}');
            });
            if(f === 'month'){
                let id = 0;
                let me = false;
                $('.ppns-cal__cell.day').each(function(i,el){
                    let fecha = moment($(el).data('fecha'),'DD-MM-YYYY');
                    let evs = events.filter(date => fecha.isBetween(moment(date.start),moment(date.end),'day','[]'));
                    evs.forEach(function(event,i){
                        categories.forEach(function(ca){
                            if(ca.id === event.category_id){
                                id = event.category_id;
                                return false;
                            }
                        });
                        if(i>1){
                            me = true;
                        }else{
                            $(el).find('.month_events').append('<div class="event c-'+id+'">'+event.title+'</div>');
                        }
                    });
                    if(me){$(el).find('.month_events').append('<div class="more_events">...</div>')}
                    me = false;
                });
            }else{
                events.forEach(function(date){
                    if(!Calendar.isRender(date)){
                        //CADA EVENTO
                        let start = moment(date.start);
                        let end = moment(date.end);
                        //En kn tengo guardado los eventos con los que comparte en algun momento una celda. Si, k = 0, renderizo este evento solo.
                        //Veo si este evento comparte fechas con otros eventos.
                        let kn = events.filter(e => (start.isBetween(moment(e.start),moment(e.end),null,'[)') || moment(e.start).isBetween(start,end,null,'[)')) && e.id!==date.id);
                        if(kn.length === 0 ){
                            Calendar.weekRender(categories,date);
                        }else{
                            let width = 100;
                            let c = 1;
                            let left = 0;
                            let er = 0;
                            kn.forEach(function(event,i){
                                if(!Calendar.isRender(event)){
                                    let eventosAlaVez = kn.filter(e => (moment(event.start).isBetween(moment(e.start),moment(e.end),null,'[)') || moment(e.start).isBetween(moment(event.start),moment(event.end),null,'[)')));
                                    c = eventosAlaVez.length > c ? eventosAlaVez.length : c;
                                    if(eventosAlaVez.length>1){
                                        width = 100 / (eventosAlaVez.length+1);
                                        eventosAlaVez.forEach(function(ev){if(Event.isRender(ev)){er++;}});
                                        left = i !== 0 ? left + width : er * width;
                                    }else{
                                        left = 0;
                                        width = 100 - (100 / (c+1));
                                    }
                                    Calendar.weekRender(categories,event,'width:'+width+'%; left:'+left+'%;');
                                }
                            });
                            width = 100 / (c+1);
                            left = 100 - width;
                            Calendar.weekRender(categories,date,'width:'+width+'%; left:'+left+'%;');
                            console.log(kn,date);
                        }
                    }

                });
            }
            console.log(events);
            console.log(categories);
        }else{
            //.format('DD-MM-YYYY HH:mm') === $(el).data('fecha')
            console.log('No hay eventos para renderizar');
        }
    }

    static isRender(event){
        return $('.event[data-id='+event.id+']').length > 0;
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

}