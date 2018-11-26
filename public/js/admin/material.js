const APP_URL = $('meta[name="app-url"]').attr('content');
const eliminarMaterial = $('.deleteMaterial');
let id = null;
let errors=null;

if(!$('.tabbs li').hasClass('active') && !$('.tab-content div').hasClass('active')) {
    $('.tabbs li:first').addClass('active');
    $('.tab-content div:first').addClass('active');
}

eliminarMaterial.click(function(){
    $('.confirmDelete').show();
    $('.fondoDelete').show();
    id=$(this).parent().parent().data('id');
});

$('.fondoDelete').click(function(){
   $('.confirmDelete').hide();
   $('.fondoDelete').hide();
});

$('.noConfirm').click(function(){
   $('.fondoDelete').click();
});

$('.yesConfirm').click(function(){
    $.ajax({
        url:APP_URL +'/admin/material/remove/'+id,
        type:'get',
        success:function(){
            $('.fondoDelete').click();
            window.location.href=APP_URL+'/admin/material/';
        },
        error:function(response){
            errors = JSON.parse(response);
            console.log(errors);
        }
    });
});

$('.addMaterial').click(function(){
    id=$(this).parent().parent().data('id');
    $.ajax({
        url:APP_URL + '/admin/material/add/'+id,
        type:'get',
        success:function(){
            window.location.href=APP_URL+'/admin/material/';
        },
        error:function(response){
            errors = JSON.parse(response);
            console.log(errors);
        }
    });
});