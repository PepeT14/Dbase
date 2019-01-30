$(document).ready(function(){
    $('.icono-accion.seccion').on('click',function(){
        $('.iconos-iniciales').hide('slow');
        let section = $(this).data('section');
        $('#'+section).show('slow');
    });


    $('.navegacion-menu i').on('click',function(){
        let backSection = $(this).parent().data('backsection');
        $(this).parent().parent().parent().hide('slow');
        $('#'+backSection).show('slow');
    });

    /*---- MENU ----*/
    $('.icon-menu').on('click',function(){
        $('.panel-fondo').show().animate({height:'100%',width:'100%',left:0},500,function(){
            $('.iconos-iniciales').show();
        });
    });
    $('.close-menu').on('click',function(){
        $('.iconos-iniciales').hide();
        $('.panel-fondo').animate({height:'20px',width:'20px',left:'100%'},600,function(){$(this).hide();});
    });
        /*---- ACCIONES DEL MENÚ ----*/
    $('.logout').on('click',function(){
        $('#logout-form').submit();
    });
        /*--- Metodo que al añadir la clase ruta a un icono del menú, redirecciona al pinchar a la ruta indicada en data-href*/
    $('.icono-accion.ruta').on('click',function(){
        window.location.href=$(this).data('href');
    });


});