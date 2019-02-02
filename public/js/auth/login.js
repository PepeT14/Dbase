$(document).ready(function() {
    setTimeout(function () {$('.seccion-inicial').addClass('animate')}, 200);

    $('.btn-login').on('click',function(){
        $('.seccion-inicial').removeClass('animate');
        setTimeout(function(){$('.login-form').fadeIn(1000)},400);
    });

    $('#close-login').on('click',function(){
        $('.login-form').fadeOut(700);
        $('.seccion-inicial').addClass('animate');
    });

    $('.welcome-btn').on('click',function(){
        $('.seccion-inicial').removeClass('animate');
        let section = $(this).data('section');
        setTimeout(function(){$(section).fadeIn(1000)},400);
    });

    $('#form-register-club').on('submit',function(){
       event.preventDefault();
       if($(this).valid()){
           let data = $(this).serializeFormJSON();
           console.log(data);
           $.ajax({
               url:$('meta[name="app-url"]').attr('content') + '/clubRegister',
               method:'GET',
               data:data,
               success:function(response){
                   $('.login-container').html(response);
                   return false;
               },
               error:function(response){
                   $('body')[0].innerHTML =response.responseText;
                   console.log(response);
               }
           });
       }else{
           return false;
       }
    });
    $('.btn-cancel').on('click',function(){
       event.preventDefault();
       $('.club-register-form').fadeOut(700);
       $('.seccion-inicial').addClass('animate');
    });
});