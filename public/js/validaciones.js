jQuery.validator.addMethod('checkUsername',function(value,element){
     return this.optional(element) || validateEmail(value);
},'Usuario en uso.Elige otro usuario.');

function validateEmail(value){
     $.ajax({
        url:$('meta[name="app-url"]').attr('content') + '/register/checkEmail',
        method:'GET',
        async:false,
        data:{'username':value},
        success:function(response){
            respuesta = response;
        }
    });
     return !respuesta;
}


/*---- FORMULARIO DE REGISTRO DE UN CLUB ----*/
$('#form-register-club').validate({
    rules:{
        'club-name':'required',
        'club-telephone':{digits:true,rangelength:[9,9]},
        'club-country':'required',
        'club-state':'required',
        'club-province':'required',
        'club-email':{required:true,email:true}
    },
    messages:{
        'club-telephone':{
            rangelength:'El número debe tener 9 digitos.',
        }
    }
});

/*----- VALIDADOR DEL FORMULARIO DE REGISTRO DE ADMIN -----*/
let adminValidator = $('#admin-register-form').validate({
    errorPlacement:function(error,element){
        error.appendTo(element.parent());
        let checkElement = $(element).parent().find('div.input-group-append .check-container svg');
        refuseElement(checkElement,element);
    },
    errorClass:'error',
    onkeyup:function(element,event){
        let checkElement = $(element).parent().find('div.input-group-append .check-container svg');
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
    rules:{
        'admin-email':{required:true,email:true},
        'admin-password':{required:true,minlength:6},
        'admin-username':{required:true,checkUsername:true},
        'admin-password_confirm':{required:true,equalTo:'#admin-password'}
    },
    messages:{
        'admin-password':{minlength:'La contraseña debe tener un mínimo de 6 caracteres'}
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