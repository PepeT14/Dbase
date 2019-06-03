
/*----- VALIDADOR DEL FORMULARIO DE REGISTRO DE ADMIN -----*/
$('#admin-register-form').validate({
    ignore:[],
    onkeyup:function(element,event){
        let checkElement = $(element).parent().parent().find('svg');
        if(this.element(element)){
            if(!checkElement.hasClass('valid')) {
                validElement(checkElement,element);
            }
        }else{
            if(!checkElement.hasClass('error')){
                refuseElement(checkElement,element);
            }
        }
    },
    errorElement:'div',
    errorClass:'invalid',
    errorPlacement: function(error, element) {
        if(element[0].nodeName === 'SELECT'){
            error.appendTo( element.parent().parent() );
        }else{
            error.appendTo(element.parent());
        }
        let checkElement = $(element).parent().parent().find('svg');
        refuseElement(checkElement,element);
    },
    validClass:'success',
    rules:{
        'admin-email':{required:true,email:true},
        'admin-password':{required:true,minlength:6},
        'admin-username':{required:true,checkUsername:true},
        'admin-password_confirm':{required:true,equalTo:'#admin-password'}
    },
    messages:{
        'admin-email':{email:'Introduce un correo válido.'},
        'admin-password':{minlength:'Tamaño mínimo: 6 carácteres'}
    },
    submitHandler:function(form){
        let data = $(form).serializeFormJSON();
        data.club=$(form).data('club');
        console.log(data);
        $.ajax({
            url:$('meta[name="app-url"]').attr('content') + 'register/adminRegister',
            method:'POST',
            data:data,
            success:function(response){
                console.log(response);
                $.ajax({
                    url:$('meta[name="app-url"]').attr('content') + 'login',
                    method:'POST',
                    data:{username:response.username,password:data['admin-password']},
                    success:function(response){
                        console.log(response);
                        if(response.url !== undefined){
                            window.location.href = $('meta[name="app-url"]').attr('content') + response.url;
                        }
                    },
                    error:function(err){
                        console.log(err);
                    }
                })
            },
            error:function(response){
                for(let obj in response.responseJSON){
                    let errors={};
                    if(response.responseJSON.hasOwnProperty(obj)){
                        errors[obj] = response.responseJSON[obj][0];
                    }
                }
                $('body')[0].innerHTML =response.responseText;
                console.log(response);
            }
        });
    }
});

/*----- FUNCIONES AUXILIARES ----*/

/*----- Añadir el check verde o la cruz roja al validar -----*/
function validElement(element,validate){
    newone = element.clone(true);
    element.replaceWith(newone);
    $(validate).parent().find('div.input-group-prepend').addClass('valid').removeClass('error');
    newone.removeClass('error').addClass('valid');
    $(newone).children('circle, .check').removeClass('error').addClass('valid');
}

function refuseElement(element,validate){
    newone = element.clone(true);
    element.replaceWith(newone);
    newone.removeClass('valid').addClass('error');
    $(validate).parent().find('div.input-group-prepend').addClass('error').removeClass('valid');
    newone.children('circle, .cross').removeClass('valid').addClass('error');
}

