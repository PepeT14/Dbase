$('#admin-register-form').on('submit',function(){
    event.preventDefault();
    if($(this).valid()){
        let data = $(this).serializeFormJSON();
        data.club=$(this).data('club');
        $.ajax({
            url:$('meta[name="app-url"]').attr('content') + '/register/adminRegister',
            method:'POST',
            data:data,
            success:function(response){
                window.location.href = response.url;
            },
            error:function(response){
                for(let obj in response.responseJSON){
                    let errors={};
                    if(response.responseJSON.hasOwnProperty(obj)){
                        errors[obj] = response.responseJSON[obj][0];
                        adminValidator.showErrors(errors);
                    }
                }
                $('body')[0].innerHTML =response.responseText;
                console.log(response);
            }
        });
        console.log(data);
    }else{
        return false;
    }
});



