var formacionesBtn = $('.formacionesBtn');
var plantillaBtn = $('.plantillaBtn');

formacionesBtn.click(function(){
    $('#formaciones').show();
    $('#plantilla').hide();
    if (formacionesBtn.not('selected')){
        formacionesBtn.addClass('selected');
        plantillaBtn.removeClass('selected');
    }
});

plantillaBtn.click(function(){
   $('#formaciones').hide();
   $('#plantilla').show();

    if(plantillaBtn.not('.selected')){
        plantillaBtn.addClass('selected');
        formacionesBtn.removeClass('selected');
    }
});

$('.icon-menu').click().click(function(){
    if($('.sidebar-menu').is(":visible")){
        $('.sidebar-menu').hide();
    }else{
        $('.sidebar-menu').show();
    }
});
