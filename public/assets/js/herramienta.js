/*--- LOGO CARGA ---*/
$(document).ready(function(){
    $(window).on('load',function(){
        $('.loader').fadeOut('slow');
    });
   $('img').each(function(){$(this).attr('src',$(this).data('src'))});
});



