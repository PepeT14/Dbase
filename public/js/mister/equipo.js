$(document).ready(function(){

    let modal_id=$('.modal').attr('id');
    let modalPanel = $('#'+modal_id);

    const newPlayerForm = $('#new-player');


    $('.btn-cancel').on('click',function(){
        modalPanel.modal('hide');
        console.log('cancelado');
    });

    newPlayerForm.validate({
        rules:{
            'player-name':{
                required:true
            },
            'player-apellidos':{
              required:true
            },
            'player-position':{
                required:true
            },
            'player-birthday':{
                required:true,
                date:true
            }
        }
    });

    newPlayerForm.on('submit',function(){
        event.preventDefault();
        if($(this).valid()){
            let data = $(this).serialize();
            $.ajax({
                url:$('meta[name="app-url"]').attr('content') + '/mister/create/player',
                method:'POST',
                data:data,
                success:function(data){
                    window.location.href ='equipo';
                },
                error:function(response){
                    errors = JSON.parse(response);
                    console.log(errors);
                }
            })
        }else{
            return false;
        }
    });

    let modalErrors = modalPanel.data('error') === '1';

    if(modalErrors){
        modalPanel.modal('show');
    }

});