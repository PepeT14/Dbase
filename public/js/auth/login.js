$(document).ready(function() {
    setTimeout(function () {$('.seccion-inicial').addClass('animate')}, 200);

    $('.btn-login').on('click',function(){
        new Promise(function(ok,nok){
            try{
                $('.seccion-inicial').removeClass('animate');
                ok();
            }catch(err){nok(err)}
        }).then(function(){
            $('#login-form').addClass('animate').css('z-index','0');
        }).catch(function(err){console.error(err)});
    });

});