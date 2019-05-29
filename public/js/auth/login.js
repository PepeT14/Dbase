$(document).ready(function() {

    const loginFormPanel = $('#login-form-panel');
    const registerFormPanel = $('#registerClub-form-panel');
    const initialSection = $('.seccion-inicial');

    /*--- ANIMACIONES CAMBIO SECCIONES ---*/
    setTimeout(function () {$('.seccion-inicial').addClass('animate')}, 200);

    $('.btn-login').on('click',function(){
        initialSection.removeClass('animate');
        loginFormPanel.show(10,function(){
           loginFormPanel.fadeTo(300,1);
        });
    });

    $('.back').on('click',function(){
        $('.invalid').remove();
        loginFormPanel.fadeTo(300,0,function(){
            initialSection.addClass('animate');
            loginFormPanel.hide();
        });
    });

    $('.btn-register').on('click',function(){
        $('.invalid').remove();
        initialSection.removeClass('animate');
        registerFormPanel.show(10,function(){
           registerFormPanel.fadeTo(300,1);
        });
    });

    registerFormPanel.find('.cancel').on('click',function(){
        event.preventDefault();
        registerFormPanel.fadeTo(300,0,function(){
            $('.seccion-inicial').addClass('animate');
            registerFormPanel.hide();
        });
        return false;
    });

    $('.follow_icons img').on('click',function(){
        window.open($(this).data('href'),'_blank');
    });

    /*--- LOGIN FORMULARIO ---*/
    $('#login_form').validate({
        rules:{
           'username':'required',
           'password':'required'
        },
        messages:{
           'username':{'required':'Introduce un usuario.'},
           'password':{'required':'Introduce una contraseña válida.'}
        },
        submitHandler:function(form){
            let data = $(form).serializeFormJSON();
            $.ajax({
                url:$('meta[name="app-url"]').attr('content') + 'login',
                method:'POST',
                data:data,
                success:function(response){
                    $('.invalid').remove();
                    if(response.password !== undefined){
                        $('#password').parent().append('<div id="password-error" class="invalid">'+response.password+'</div>');
                    }else if(response.usuario !== undefined){
                        $('#username').parent().append('<div id="username-error" class="invalid">'+response.usuario+'</div>');
                    }else if(response.url !== undefined){
                        window.location.href = $('meta[name="app-url"]').attr('content') + response.url;
                    }
                },
                error:function(err){
                    console.log(err)
                }
            })
        }
    });

    /*--- REGISTRAR CLUB ---*/
    $('#form-register-club').validate({
        rules:{
            'club-name':'required',
            'club-telephone':{digits:true,rangelength:[9,9]},
            'club-state':'required',
            'club-province':'required',
            'club-email':{required:true,email:true}
        },
        messages:{
            'club-name':{'required':'Introduce un nombre para el club'},
            'club-telephone':{
                rangelength:'El número debe tener 9 digitos.',
                digits:'Introduce un número válido'
            },
            'club-state':{'required':'Introduce la comunidad autónoma'},
            'club-province':{'required':'Introduce una provincia'},
            'club-email':{email:'Introduce un email válido.',required:'El email es necesario para enviar la invitación.'}
        },
        submitHandler:function(form){
            let data = $(form).serializeFormJSON();
            console.log(data);
            $('.loader').fadeIn();
            $.ajax({
                url:$('meta[name="app-url"]').attr('content') + 'clubRegister',
                method:'GET',
                data:data,
                success:function(response){
                    $('.loader').fadeOut('slow');
                    $('.login-container').html(response);
                },
                error:function(response){
                    $('.loader').fadeOut('slow');
                    console.log(response);
                }
            });
        }
    });
});