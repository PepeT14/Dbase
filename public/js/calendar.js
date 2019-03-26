const daysCortos = ['Lun', 'Mar','Mie', 'Jue','Vie', 'Sáb', 'Dom' ];
const daysLargos = ['Lunes', 'Martes','Miércoles', 'Jueves','Viernes', 'Sábado', 'Domingo'];

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
            let cal = new Calendar(this,options);
            $(this).data('calendar',cal);
            cal.render();
    }
};

class Calendar{

    constructor(contenedor,options){
        this.contenedor = contenedor;
        this.shortDays = options.shortDays;
        this.mainCalendar = options.mainCalendar;
        this.view = options.view;
        this.week = options.week ? options.week : null;
        this.month = options.month ? options.month : null;
    }
    static destroy(contenedor){
        $(contenedor).find('.ppns-main').remove();
        $(contenedor).find('.wrapper').remove();
    }
    render(){
        let contenido = '';
        let cab = '';
        let mes = moment().month();
        let semana = moment().week();
        if(this.week !== null){
            Calendar.destroy(this.contenedor);
            cab = this.cabecera(moment().month(this.month).week(this.week));
            contenido = this.renderWeek(this.month,this.week);
        }
        else if(this.month !== null){
            Calendar.destroy(this.contenedor);
            cab = this.cabecera(moment().month(this.month));
            contenido = this.renderMonth(this.month);
        }else{
            cab= this.cabecera(moment());
            contenido = this.view === 'monthView' ? this.renderMonth(mes) : this.renderWeek(mes,semana);
        }
        $(this.contenedor).append(cab).append(contenido);
        if(this.view==='monthView'){
            Calendar.activatePrevMonth(this);
            Calendar.activateNextMonth(this);
            Calendar.activeDay('#week_calendar');
        }
        if(this.view ==='weekView'){
            $('.weekView_body').scrollTop($('.weekView.now').prev().prev()[0].offsetTop);
            setTimeout(Calendar.marcaDiaSemana,70);
            Calendar.dinamicEvents();
        }
    }

    cabecera(momento){
        return this.view === 'monthView' ? this.cabeceraMonth(momento) : Calendar.cabeceraWeek(momento);
    }
    cabeceraMonth(ahora){
        let mesActual = ahora.format('MMMM');
        let anyoActual = ahora.format('YYYY');
        let today =  '<div class="ppns_today">\n' + '<span class="today">Hoy</span>\n' + '</div>\n';
        return '<div class="wrapper ppns_header_calendar">\n' +
            '                            <div class="month_year">' +
            '                               <span class="material-icons prev" id="prev">keyboard_arrow_left</span>\n' +
            '                               <div class="ppns_month">\n' +
            '                                   <span class="month">'+mesActual+' '+anyoActual+'</span>\n' +
            '                               </div>\n'+
            '                               <span class="material-icons next" id="next">keyboard_arrow_right</span>\n' +
            '                            </div>\n' + (this.mainCalendar ? today : '' )+ '</div>';
    }
    static cabeceraWeek(ahora){
        let mes = ahora.format('MMMM');
        let anyo = ahora.format('YYYY');
        return '<div class="wrapper ppns_header_calendar">\n' +
            '                            <div class="month_year_info">' +
            '                               <div class="ppns_month">\n' +
            '                                   <span class="month">'+mes+'</span>\n' +
            '                                   <span class="year">'+anyo+'</span>\n' +
            '                               </div>\n' +
            '                            </div>\n' +
            '                            <div class="left_info">' +
            '                               <div class="ppns_sel_view"> ' +
            '                                   <span class="sel_view active" id="week_view">Semana</span>' +
            '                                   <span class="sel_view" id="day_view">Dia</span>' +
            '                               </div>' +
            '                               <div class="ppns_today">' +
            '                                   <span class="today">Hoy</span>' +
            '                               </div>' +
            '                            </div>' +
            '     </div>' ;
    }
    renderMonth(month){
        let tabla = '<div class="ppns-main monthView" data-month="'+month+'"/>';
        let days = this.shortDays ? daysCortos : daysLargos;
        let cabeceraTabla = $('<div class="ppns-cal__row"/>').append(Calendar.renderWeekHeader(days));
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
                days:new Array(7).fill(0).map((n,i)=>moment().month(month).week(week).startOf('week').clone().add(n+i,'day'))
            })
        }
        calendar.forEach(function(n,i){
            let fila = '<div class="ppns-cal__row"/>';
            let hoy = false;
            let notActual = false;
            n.days.forEach(function(n,i){
                hoy = n.date() === moment().date() && n.month() === moment().month();
                notActual = n.month() !== month;
                fila = $(fila).append('<div class="ppns-cal__cell day'+ (hoy ? ' today' : '') +  (notActual ? ' old' : '')+
                                '" data-fecha="'+n.format('DD-MM-YYYY')+
                                '" data-week="'+n.week()+'" ' +
                                'data-month="'+n.month()+'"><span>'+n.format('D')+'</span></div>');
            });
            tabla = $(tabla).append(fila[0].outerHTML);
        });
        return tabla[0].outerHTML;
    }
    static renderWeekHeader(days){
        let html = '';
        days.forEach(function(n,i){
            let today = i === moment().day()-1;
            html += '<div class="ppns-cal__col'+ (today ? ' today' : '' )+ '"><span>'+n+'</span></div>';
        });
        return html;
    }

    renderWeek(month,week){
        let tabla = '<div class="ppns-main weekView" data-month="'+month+'" data-week="'+week+'"/>';
        let days = this.shortDays ? daysCortos : daysLargos;
        let htmlCab = '<div class="ppns-cal__col weekView"></div>';
        days.forEach(function(n,i){
            htmlCab += '<div class="ppns-cal__col weekView" data-fecha="'+moment().month(month).week(week).day(i+1).format('DD-MM-YYYY')+'"><span>'+n+' '+moment().month(month).week(week).day(i+1).format('DD')+'</span></div>';
        });
        let cabeceraTabla = $('<div class="ppns-cal__row weekView"/>').append(htmlCab);
        tabla = $(tabla).append(cabeceraTabla);
        let body = '<div class="weekView_body"/>';
        let ahora = moment().hour();
        for(let h=0;h<23;h++){
            let before = week < moment().week() || week === moment().week() && h < ahora;
            let fila = '<div class="ppns-cal__row hour weekView '+(h === ahora ? 'now' : '') + (before ? ' older' : '')+'" />';
            for(let d=0;d<8;d++){
                if(d===0){
                    fila = $(fila).append('<div class="ppns-cal__cell hour_info_cell weekView"><span>'+moment().startOf('day').add(h,'hour').format('HH:mm')+'</span></div>');
                }else{
                    fila = $(fila).append('<div class="ppns-cal__cell hour_info_cell weekView" data-fecha="'+moment().startOf('week').add(d-1,'day').hour(h).format('DD-MM-YYYY HH:mm')+'"></div>');
                }
            }
            body = $(body).append(fila[0].outerHTML);
        }
        tabla = $(tabla).append(body[0].outerHTML);
        return tabla[0].outerHTML;
    }
    static activatePrevMonth(calendar){
        let prevMonth = $(calendar.contenedor).find('.ppns-main.monthView').data('month')-1;
        $('#prev').on('click',function(){
            calendar.month = prevMonth;
            calendar.render();
        });
    }
    static activateNextMonth(calendar){
        let nextMonth = $(calendar.contenedor).find('.ppns-main.monthView').data('month')+1;
        $('#next').on('click',function(){
            calendar.month = nextMonth;
            calendar.render();
        });
    }
    static activeDay(semanaContainer){
        $('.ppns-cal__cell.day').on('click',function(){
            $('.ppns-cal__cell.day.active').removeClass('active');
            $(this).addClass('active');
            if($(document).find('.ppns-main.weekView')){
                let nuevo = $(semanaContainer).Calendar('copy');
                $(semanaContainer).Calendar('destroy');
                nuevo.week = $(this).data('week');
                nuevo.month = $(this).parent().parent().data('month').toString();
                $(semanaContainer).Calendar(nuevo);

            }
        });
    }

    static marcaDiaSemana(){
        $('.ppns-main.weekView .ppns-cal__col').each(function(){
            if($(this).data('fecha')===$('.ppns-main.monthView .ppns-cal__cell.active').data('fecha')){
                $(this).addClass('active');
                if($(this).data('fecha') > moment().format('DD-MM-YYYY')){
                    $('.ppns-cal__row.older').removeClass('older');
                }
            }
        });
    }

    /* LOGICA EVENTOS */
    static dinamicEvents(){
        let isMouseDown = false;
        let startDate = null;
        let endDate = null;
        window.evento = null;
        $('.weekView_body .ppns-cal__cell').on('mousedown',function(){
            startDate = $(this).data('fecha');
            $('.ppns-cal__cell.selected').removeClass('selected');
            isMouseDown = true;
            $(this).addClass('selected');
            return false;
        }).on('mouseover',function(){
            endDate = $(this).data('fecha');
            if(isMouseDown && startDate.split('-')[0] === endDate.split('-')[0]) {
                $(this).addClass('selected');
            }
        });
        $(document).on('mouseup',function(){
            isMouseDown = false;
            startDate = $('.ppns-cal__cell.selected:first').data('fecha');
            endDate = $('.ppns-cal__cell.selected:last').data('fecha');
            $('#time_event_start').val(startDate);
            $('#time_event_end').val(endDate);
            $('#add_event_modal').modal('show');
            $('.add_event_content').addClass('flipInX');
            evento = new Event({
                start:startDate,
                end:endDate
            });
        });
        $('#add_event_modal').on('hide.bs.modal',function(){
            $('.ppns-cal__cell.selected').removeClass('selected');
            startDate = null;
            endDate = null;
            isMouseDown = false;
            //Cierro el panel de categorias
            Calendar.hideCategoryPanel();
            //Limpio las categorias seleccionadas
            $('.event_categorie.selected').remove();
        });
        Calendar.categoriesPanel()
    };

    /* Funciones de las categorias y los eventos */
    static categoriesPanel(){
        //Accion cuando pulse en el boton de categorias
        $('#add_categories_event').on('click',function(){
            $('.categories_event_panel').addClass('active');
        });
        //Accion al clickar en la X del panel
        $('.categories_event_panel .close').on('click',function(){
            Calendar.hideCategoryPanel();
        });
        //Accion al clickar en nueva categoria
        $('#add_new_categorie').on('click',function(){
            Calendar.createCategoryPanel(0);
            $('#category-name').val('');
            $('.btn-save').find('span').html('Crear');
        });
        //Accion al clickar en editar categoria
        $('.edit_category').on('click',function(){
            let title = $(this).parent().data('title');
            let color = $(this).parent().data('color');
            let id = $(this).parent().data('id');
            Calendar.createCategoryPanel(id);
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
            evento.category = $(this).parent().data('id');
            $('.categories_event_panel .close-menu').click();
        });
    };
    static selectCategoryPanel(){
        //Elimino si hubiera elementos que no son del panel.
        $('.back_icon').remove();
        //Oculto el panel de creacion y limpio el contenido de colores.
        $('#create_category').hide().removeClass('active');
        $('.color_grid_selection .color_selection').remove();
        //Reseteo el texto
        $('.panel-title .title-text').html('Etiquetas');
        //Muestro el contenido correspondiente
        $('#select_category').show().addClass('active');
    }
    static createCategoryPanel(id){
        //añado elemenotos y textos correspondientes
        $('.panel-title').prepend('<span class="material-icons back_icon">arrow_back</span>');
        //Logica al clickar en la fecha para atrás
        $('.back_icon').on('click',function(){
            Calendar.selectCategoryPanel()
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
        Calendar.saveCategory(id);

    }
    static hideCategoryPanel(){
        //Pongo de nuevo la vista principal
        Calendar.selectCategoryPanel();
        //Oculto el panel de las categorias
        $('.categories_event_panel').removeClass('active');
        //Añado si el evento tiene categoria
        if(evento.category !== null){
            let color=null;
            let title = null;
            $('.categorie_row').each(function(i,el){
                if($(el).data('id') === evento.category){
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

            $('.clear_category').on('click',function(){
                $('.event_categorie.selected').remove();
                evento.category = null;
            });
        }
    }
     static saveCategory(id){
         $('#create_category').find('.btn-save').on('click',function(){
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
                     Calendar.categoriesPanel();
                     //Muestro el panel
                     $('.categories_event_panel').addClass('active');
                     //El panel con el texto correspondiente
                     Calendar.selectCategoryPanel();
                 });
             }
         });
     }
}

class Event{
    constructor(options){
        this.category = options.category ? options.category : null;
        this.title = options.title ? options.title : '';
        this.start = options.start ? options.start : '';
        this.end = options.end ? options.end : '';
    }
}
