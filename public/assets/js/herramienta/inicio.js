$(document).ready(function(){
    $('.icono-accion').on('click',function(){
        $('.iconos-iniciales').hide('slideUp');
        let section = $(this).data('section');
        $('#'+section).show('slideUp');
    });
});