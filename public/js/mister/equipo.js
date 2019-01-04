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

    function getPosiciones(){
        let formacion = $('select#selector-formaciones option:selected').text().split('-');
        let defensas = formacion[0];
        let medios = formacion[1];
        let delanteros = formacion[2] ? formacion[2] : 0;
        let fila = '<div class="contenido-jugador-campo"> ' +
                    '<div class="imagen-jugador-campo"><img class="img-fluid" src="http://dbase.com/imagenes/profile.png">' +
                    '</div><div class="nombre-jugador-campo"><span></span></div></div>';
        $('.campo-content .portero').append(fila);
        for(let i=0;i<defensas;i++){
            $('.campo-content .defensas').append(fila);
        }
        for(let i=0;i<medios;i++){
            $('.campo-content .medios').append(fila);
        }
        for(let i=0;i<delanteros;i++){
            $('.campo-content .delanteros').append(fila);
        }
        const linkJugadores = function(){
            $('.contenido-jugador-campo').on('click',function(){
               $('#modal-jugadores').modal('show');
            });
        };
        linkJugadores();
    }
    getPosiciones();
});