$(document).ready(function(){
    $('.icono-accion').on('click',function(){
        window.location.href = $(this).data('href');
    });
});