$(document).ready(function(){
    $('.icono-accion').on('click',function(){
        $('.iconos-iniciales').hide('slow');
        let section = $(this).data('section');
        $('#'+section).show('slow');
    });

    $('.navegacion-menu i').on('click',function(){
        $(this).parent().parent().parent().hide('slow');
        $('.iconos-iniciales').show('slow');
    });
});