moment.locale('es');

$.fn.dateTimePicker = function(options){
    console.log(this);
    if(!this.is('input')){
        return new DatePicker(this,options);
    }else{
        window.picker = new DatePicker(this,options);
    }
};

function getId(){
    let n = Math.floor(Math.random() * 10);
    while($('#'+n+ 'ppnsPicker').length>0){
        let i = Math.random();
        n = Math.floor(Math.random() * i * 100);
    }
    return n + 'ppnsPicker';
}

function DatePicker(starter,options){
    this.starter = starter;
    this.options = options ? options : {};
    this.isOpen = false;
    this.view = this.options.onlyTime ? 'calendar' : 'clock';
    this.moment = setMoment();
    this.id = getId();
    if(starter.is('input')){
        let that = this;
        this.render();
        this.options._parseHeaderInfo ? this.options._parseHeaderInfo() : parseHeaderInfo.call(this);
        starter.on('focus',function(){
            that.open();
            console.log(that);
        });
    }else{
        console.log('Error al introducir ppns-datePicker');
    }
}

function setMoment(){
    let m = moment();
    m.minutes() >= 30 ? m.minutes(30) : m.minutes(0);
    return m;
}

DatePicker.prototype.reset = function(){
    this.moment = setMoment();
    this.view = this.options.onlyTime ? 'calendar' : 'clock';
}

DatePicker.prototype.open = function(){
    if(!this.isOpen){
        let that = this;
        $('#'+this.id).show(10,function(){
           $(this).fadeTo(150,1,function(){
               $(document).on('mouseup',function(e){
                   let selector = $('#'+that.id);
                   if(!selector.is(e.target) && selector.has(e.target).length === 0){
                       that.close();
                   }
               });
           });
           that.isOpen = true;
        });
    }
}

DatePicker.prototype.close = function(){
    if(this.isOpen){
        let that = this;
        $('#'+this.id).fadeTo(150,0,function(){
            $(this).hide(function(){
                that.options.onEndClose ? that.options.onEndClose() : '';
            });
        });
        this.isOpen = false;
        $(document).off('mouseup');
    }
}

DatePicker.prototype.render = function(){
    if($('#'+this.id).length===0){
        let html = '<div class="ppns-datePicker z-depth-1" id="'+this.id+'"/>';
        html = $(html).append(getHeader.apply(this)).append(getBody()).append(getFooter());
        this.starter.parent().append(html[0].outerHTML);
        !this.options.onlyTime ? this.renderDatePicker() : this.renderTimePicker();
        linkButtons.apply(this);
    }else{
        this.view === 'calendar' ? this.renderDatePicker() :this.renderTimePicker();
    }
}


function getHeader(){
    let header = '<div class="ppns-dp__header"><div class="header-title"></div><div class="header-info"></div></div>';
    let views = '<div class="view-change">'+ (this.options.onlyTime ? '' : '<i class="material-icons" id="date_link">view_module</i>')
        + (this.options.onlyDate ? '' : '<i class="material-icons" id="clock_link">query_builder</i>') + '</div>';

    return $(header).append(views)[0].outerHTML;
}

function getBody(){
    return '<div class="ppns-dp__body"></div>';
}

function getFooter(){
    return '<div class="ppns-dp__footer">' +
        '<button class="btn waves-effect waves-light cancel red light red lighten-2">Cancelar</button>' +
        '<button class="btn waves-effect waves-light save teal">Ok</button></div>'
}



DatePicker.prototype.renderTimePicker = function(){
    let obj =  $('#'+this.id);
    let cuerpo =obj.find('.ppns-dp__body');
    if(cuerpo.length > 0){
        let body = renderClock(this);
        cuerpo.append(body);
        let dl = obj.find('#date_link');
        if(dl.hasClass('active')){
            dl.removeClass('active');
        }
        obj.find('#clock_link').addClass('active');
        this.view  = 'clock';
        linkHours.apply(this);
    }

    function renderClock(picker){
        let am = picker.moment.hour() <= 12;
        let html = '<div class="ppns-dp__clock"><div class="format-select">' +
            '<div class="selector '+ (am ? 'selected' : '') +'" data-value="am">am</div><div class="selector '+ (am ? '' : 'selected') +'" data-value="pm">pm</div></div></div>';
        let hours = '<div class="clock-hours"/>';
        let hour = picker.moment.minutes() === 30 ? parseInt(picker.moment.format('h')) + 0.5 : parseInt(picker.moment.format('h'));
        for(let i=1;i<13;i = i+0.5){
            let v = Number.isInteger(i) ? i : '-';
            let n = '<div class="clock-number '+ (hour === i ? 'selected' : '') +'" data-hour="'+i+'">'+v+'</div>';
            hours = $(hours).append(n);
        }
        hours = $(hours).append('<div class="manecilla"></div>');
        return $(html).append(hours[0].outerHTML)[0].outerHTML;
    }
}

DatePicker.prototype.renderDatePicker = function(){
    let obj = $('#'+this.id+'.ppns-datePicker');
    let cuerpo = $('#'+this.id).find('.ppns-dp__body');
    if(cuerpo.length > 0){
        let body = renderCalendar(this);
        cuerpo.append(body);
        let cl = obj.find('#clock_link');
        cl.hasClass('active') ? cl.removeClass('active') :'';
        obj.find('#date_link').addClass('active');
        this.view = 'calendar';
        linkDates.apply(this);
    }
    function renderCalendar(picker){
        let html = '<div class="ppns-dp__calendar"/>';
        let fi = picker.moment;
        let header = '<div class="calendar-header"><i class="material-icons hover-effect" id="prev_month">keyboard_arrow_left</i><span class="month-title">' +
            fi.format('MMMM')+', ' +fi.format('YYYY')+
            '</span><i class="material-icons hover-effect" id="next_month">keyboard_arrow_right</i></div>';
        let body = '<table class="calendar-days"/>';
        body = $(body).append(getTableHead()).append(getTableBody(picker));

        return $(html).append(header).append(body[0].outerHTML)[0].outerHTML;
    }

    function getTableHead(){
        let html = '<thead class="days-header"><tr class="days-row">';
        for(let i=0;i<7;i++){
            html = html + '<th class="day-head">' +moment().weekday(i).format('ddd')+'</th>';
        }
        html = html + '</tr></thead>';
        return html;
    }
    function getTableBody(picker){
        let html = '<tbody class="days-body">';
        let ps = moment(picker.moment).startOf('month').week();
        let us = moment(picker.moment).endOf('month').week();
        for(let i = ps;i<us;i++){
            html = html + '<tr class="days-row">';
            for(let j=0;j<7;j++){
                let date = moment().week(i).weekday(j);
                let actual = picker.moment.month() === date.month();
                let today = moment(date).isSame(moment());
                let active = picker.moment.date() === date.date();
                html = html + '<td class="day '+( actual ? '' : 'not-month' ) +'"><span class="'+ (active ? 'active' : '') + (today ? ' today' : '') +'" data-fecha="'+date.format('DD-MM-YYYY')+'">'+date.date()+'</span></td>';
            }
            html = html + '</tr>';
        }
        html = html + '</tbody>';
        return html;
    }
}


parseHeaderInfo = function(){
    let title = this.options.title ? this.options.title : ' ';
    let id = $('#'+this.id);
    if(id.find('.ppns-dp__header').length > 0){
        id.find('.header-title').append(title);
        let c = this.view === 'clock'
        let date = this.options.onlyTime ? '' : '<div class="date-info '+ (c ? 'not-active' : '') +'">'+this.moment.format('DD MMMM YYYY')+'</div>';
        let time = this.options.onlyDate ? '' : '<div class="time-info '+ (c ? '' : 'not-active') +'">'+this.moment.format('HH:mm')+'</div>';
        id.find('.header-info').append(date).append(time);
    }
};

linkButtons = function(){
    let that = this;
    let obj = $('#'+this.id);
    //Botones de cancelar y de guardar.
    obj.find('.ppns-dp__footer .cancel').on('click',function(){
        event.preventDefault();
        that.close();
        return false;
    });
    obj.find('.ppns-dp__footer .save').on('click',function(){
        event.preventDefault();
        let salida = that.options.onlyDate ? that.moment.format('DD/MM/YYYY') : (that.options.onlyTime ? that.moment.format('HH:mm') : that.moment.format('DD/MM/YYYY HH:mm'));
        that.starter.val(salida);
        that.starter.parent().find('label').addClass('active');
        that.starter.trigger('focusout');
        that.close();
        return false;
    });

    //Botones de cambiar de vista
    obj.find('#date_link').on('click',function(){
        let calendar =obj.find('.ppns-dp__calendar');
        if(calendar.length===0){
            that.view ='calendar';
            obj.find('.ppns-dp__clock').remove();
            that.render();
            let hi = obj.find('.time-info');
            let di = obj.find('.date-info');
            !hi.hasClass('not-active') ? hi.addClass('not-active') :'';
            di.hasClass('not-active') ? di.removeClass('not-active') : '';
        }
    });

    obj.find('#clock_link').on('click',function(){
        let reloj = obj.find('.ppns-dp__clock');
        if(reloj.length === 0){
            that.view = 'clock';
            obj.find('.ppns-dp__calendar').remove();
            that.render();
            let hi = obj.find('.time-info');
            let di = obj.find('.date-info');
            hi.hasClass('not-active') ? hi.removeClass('not-active') :'';
            !di.hasClass('not-active') ? di.addClass('not-active') : '';

        }
    });

}

linkDates = function(){
    let that = this;
    let obj = $('#'+this.id);
    //Cambiar de mes en el calendario
    obj.find('#prev_month').on('click',function(){
       that.moment.subtract('1','month');
       obj.find('.ppns-dp__calendar').remove();
       that.render();
    });
    obj.find('#next_month').on('click',function(){
       that.moment.add('1','month');
       obj.find('.ppns-dp__calendar').remove();
       that.render();
    });
    //Seleccionar una fecha.
    obj.find('.day span').on('click',function(){
       if(!$(this).hasClass('active')){
           obj.find('.day span.active').removeClass('active');
           $(this).addClass('active');
           that.moment = moment($(this).data('fecha') ,'DD-MM-YYYY').hour(that.moment.hour()).minutes(that.moment.minutes());
           obj.find('.date-info').html(that.moment.format('DD MMMM YYYY'));
       }
    });
}

linkHours = function(){
    let that = this;
    let obj = $('#'+this.id);
    //Seleccionar si es AM o PM
    obj.find('.selector').on('click',function(){
        if(!$(this).hasClass('selected')){
            obj.find('.selector.selected').removeClass('selected');
            $(this).addClass('selected');
            if($(this).data('value') === 'am'){
                that.moment.hour() > 12  ? that.moment.subtract(12,'hours') : (that.moment.hour() === 0 ? that.moment.add(12,'hours') : '');
                obj.find('.time-info').html(that.moment.format('HH:mm'));
            }else{
                that.moment.hour() < 12 ? that.moment.add(12,'hours') : (that.moment.hour() === 12 ? that.moment.subtract(12,'hours') : '');
                obj.find('.time-info').html(that.moment.format('HH:mm'));
            }
        }
    });
    //Seleccionar una hora.
    obj.find('.clock-number').on('click',function(){
        if(!$(this).hasClass('selected')){
            let h = $(this).data('hour');
            let m = h%1 === 0.5 ? 30 : 0;
            let hora = obj.find('.selector.selected').data('value') === 'pm' ? h + 12 : h;
            that.moment.hour(parseInt(hora)).minutes(m);
            obj.find('.time-info').html(that.moment.format('HH:mm'));
            obj.find('.clock-number.selected').removeClass('selected');
            $(this).addClass('selected');
       }
    });
}