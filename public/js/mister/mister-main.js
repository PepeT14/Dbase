$(document).ready(function(){
    $('.icono-accion.seccion').on('click',function(){
        $('.iconos-iniciales').hide('slow');
        let section = $(this).data('section');
        $('#'+section).show('slow');
    });

    $('.icono-accion.ruta').on('click',function(){
        window.location.href=$(this).data('href');
    });

    $('.navegacion-menu i').on('click',function(){
        let backSection = $(this).parent().data('backsection');
        $(this).parent().parent().parent().hide('slow');
        $('#'+backSection).show('slow');
    });


    $('.logout').on('click',function(){
        $('#logout-form').submit();
    })
});