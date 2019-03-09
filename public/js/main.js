$(document).ready(function(){
    $(window).on('load',function(){
        $('.loader').fadeOut('slow');
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

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
        $('#logout-form').submit();
    });

    /*--- Metodo que al añadir la clase ruta a un icono del menú, redirecciona al pinchar a la ruta indicada en data-href*/
    $('.icono-accion.ruta').on('click',function(){
        window.location.href=$(this).data('href');
    });
});



