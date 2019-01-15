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