$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /*--- METODOS DE VALIDACIONES ----*/
    $.validator.addMethod('validMoment',function(value,element,param){
        return this.optional(element) || moment(value,param).isValid();
    },'Introduce una fecha válida.');

    $.validator.addMethod('timeBiggerThan',function(value,element,param){
        let otherDate = $(param).val();
        return moment(value,'HH:mm').isAfter(moment(otherDate,'HH:mm'));
    },'Lo sentimos, pero no se puede viajar en el tiempo.');

    $.validator.addMethod('dateBiggerThan',function(value,element,param){
        let otherDate = $(param).val();
        return moment(value,'DD/MM/YYYY').isAfter(moment(otherDate),'DD/MM/YYYY');
    },'No puede acabar antes de empezar.');

    $.validator.addMethod('dateTImeBiggerThan',function(value,element,param){
        let otherDate = $(param).val();
        return moment(value,'DD/MM/YYYY HH:mm').isAfter(moment(otherDate),'DD/MM/YYYY HH:mm');
    },'No puede ocurrir antes del inicio.');

    jQuery.validator.addMethod('checkUsername',function(value,element){
        return this.optional(element) || validateEmail(value);
    },'Usuario en uso.Elige otro usuario.');

    function validateEmail(value){
        $.ajax({
            url:$('meta[name="app-url"]').attr('content') + '/register/checkEmail',
            method:'GET',
            async:false,
            data:{'username':value},
            success:function(response){
                respuesta = response;
            }
        });
        return !respuesta;
    }

    $.validator.setDefaults({
        ignore:[],
        errorElement:'div',
        errorClass:'invalid',
        errorPlacement: function(error, element) {
            if(element[0].nodeName === 'SELECT'){
                error.appendTo( element.parent().parent() );
            }else{
                error.appendTo(element.parent());
            }
        },
        validClass:'success'
    });


    /*--- METODO PARA SERIALIZAR EN JSON UN FORMULARIO ---*/
    (function ($) {
        $.fn.serializeFormJSON = function () {

            let o = {};
            let a = this.serializeArray();
            $.each(a, function () {
                if (o[this.name]) {
                    if (!o[this.name].push) {
                        o[this.name] = [o[this.name]];
                    }
                    o[this.name].push(this.value || '');
                } else {
                    o[this.name] = this.value || '';
                }
            });
            return o;
        };
    })(jQuery);

    /*---- MENU ----*/
        /*
        * Controla cuando se muestra/oculta y que animación tiene.
        * */
    $('#config_icon').on('click',function(){
        $('.panel-fondo').show().animate({height:'100%',width:'100%',left:0},500,function(){
            $('.iconos-iniciales').show();
        });
    });
    $('.close-menu').on('click',function(){
        $('.iconos-iniciales').hide();
        $('.panel-fondo').animate({height:'20px',width:'20px',left:'100%'},600,function(){$(this).hide();});
    });

    /**
     * El logout se controla desde aquí al ser algo que siempre estará
     */
    $('.logout').on('click',function(){
        setTimeout(function(){$('#logout-form').submit()},10);
    });

    /*--- Metodo que al añadir la clase ruta a un icono del menú, redirecciona al pinchar a la ruta indicada en data-href*/
    $('.icono-accion.ruta').on('click',function(){
        window.location.href=$(this).data('href');
    });
});



