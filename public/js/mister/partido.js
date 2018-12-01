/*--------------------------------------------
* ---------------- CRONOMETRO ----------------
* --------------------------------------------*/
    /*------- LOGICA BOTONES ------*/
$('#inicio').on('click',function(){
   inicio();
});
$('#parar').on('click',function(){
    parar();
});
$('#continuar').on('click',function(){
    inicio();
});
$('#reinicio').on('click',function(){
    reinicio();
});

    /*------- LOGICA RELOJ -------*/
let centesimas = 0;
let segundos = 0;
let minutos = 0;
let horas = 0;

function inicio () {
    control = setInterval(cronometro,10);
    document.getElementById("inicio").disabled = true;
    document.getElementById("parar").disabled = false;
    document.getElementById("continuar").disabled = true;
    document.getElementById("reinicio").disabled = true;
}

function parar () {
    clearInterval(control);
    document.getElementById("parar").disabled = true;
    document.getElementById("continuar").disabled = false;
    document.getElementById("reinicio").disabled = false;
    $('.jugador-titular').each(function(i){
       let minutoJugador = $(this).data('minuto');
       let jugador = $(this).data('jugador');
       let data = {'jugador':jugador,'minuto':minutos,'minutoJugador':minutoJugador};
        $.ajax({
            url:$('meta[name="app-url"]').attr('content') + '/mister/match/'+$('.partido-content').data('partido')+'/updateMinutes',
            method:'POST',
            data:data,
            success:function(response){
                console.log('minutosActualizados'+response);
                $('.partido-contenido-jugadores')[0].innerHTML=response;
            },
            error:function(response){
                $('body')[0].innerHTML =response.responseText;
                console.log(response);
            }
        });
    });
}

function reinicio () {
    clearInterval(control);
    centesimas = 0;
    segundos = 0;
    minutos = 0;
    //horas = 0;
    Centesimas.innerHTML = ":00";
    Segundos.innerHTML = ":00";
    Minutos.innerHTML = "00";
    //Horas.innerHTML = "00";
    document.getElementById("inicio").disabled = false;
    document.getElementById("parar").disabled = true;
    document.getElementById("continuar").disabled = true;
    document.getElementById("reinicio").disabled = true;
}

function cronometro () {
    if (centesimas < 99) {
        centesimas++;
        if (centesimas < 10) { centesimas = "0"+centesimas }
        Centesimas.innerHTML = ":"+centesimas;
    }
    if (centesimas == 99) {
        centesimas = -1;
    }
    if (centesimas == 0) {
        segundos ++;
        if (segundos < 10) { segundos = "0"+segundos }
        Segundos.innerHTML = ":"+segundos;
    }
    if (segundos == 59) {
        segundos = -1;
    }
    if ( (centesimas == 0)&&(segundos == 0) ) {
        minutos++;
        if (minutos < 10) { minutos = "0"+minutos }
        Minutos.innerHTML = minutos;
    }
    if (minutos == 59) {
        minutos = -1;
    }
    /*if ( (centesimas == 0)&&(segundos == 0)&&(minutos == 0) ) {
        horas ++;
        if (horas < 10) { horas = "0"+horas }
        Horas.innerHTML = horas;
    }*/
}


/*--------------------------------------------
* ---------------- ACCIONES ------------------
* --------------------------------------------*/


$('.jugador-suplente').on('click',function(){
    $(this).addClass('seleccionado');
    $('#cambio-jugador').submit();
});

$('.jugador-titular').on('click',function(){
    $(this).addClass('seleccionado');
});


$('#cambio-jugador').on('submit',function(){
    event.preventDefault();
    let jugadorTitular = $('.jugador-titular.seleccionado');
    let jugadorSuplente = $('.jugador-suplente.seleccionado');
    let jugadorTitularId = jugadorTitular.data('jugador');
    let jugadorSuplenteId = jugadorSuplente.data('jugador');
    let minutosTitular = jugadorTitular.data('minuto');
    let data = {'titular':jugadorTitularId,'suplente':jugadorSuplenteId,'minuto':minutos,'minutosTitular':minutosTitular};
    $.ajax({
       url:$('meta[name="app-url"]').attr('content') + '/mister/match/'+$('.partido-content').data('partido')+'/changePlayer',
       method:'POST',
       data:data,
       success:function(response){
           console.log('Cambio de jugador realizado');
           console.log(response);
       },
       error:function(response){
           $('body')[0].innerHTML =response.responseText;
           console.log(response);
       }
    });
    $('#modal-acciones').modal('hide');
    jugadorSuplente.data('jugador',jugadorTitularId);
    jugadorSuplente.attr('data-jugador',jugadorTitularId);
    jugadorTitular.data('jugador',jugadorSuplenteId);
    jugadorTitular.attr('data-jugador',jugadorSuplenteId);
    jugadorSuplente.data('minuto',minutos);
    jugadorSuplente.attr('data-minuto',minutos);
    jugadorTitular.data('minuto',minutos);
    jugadorTitular.attr('data-minuto',minutos);
    let a = jugadorTitular[0].innerHTML;
    let b = jugadorSuplente[0].innerHTML;
    jugadorSuplente[0].innerHTML = a;
    jugadorTitular[0].innerHTML = b;
    $('.seleccionado').removeClass('seleccionado');
    return false;
});

$('.tactica-btn').on('click',function(){
    if($(this).hasClass('selected')){
        eliminaTactica($(this));
    }else{
        eliminaTactica($('.tactica-btn.selected'));
        $(this).addClass('selected');
        rellenaPosiciones($(this)[0].innerText.trim());
    }
});
let eliminaTactica = function(boton){
    boton.removeClass('selected');
    $('.fila-jugadores .jugador-titular').removeClass('portero').removeClass('defensa').removeClass('medio').removeClass('delantero');
};
let rellenaPosiciones = function(tactica){
    let defensas = tactica.split('-')[0];
    let medios = parseInt(tactica.split('-')[1]) + parseInt(defensas);
    $('.fila-jugadores .jugador-titular').each(function(i){
        switch(true){
            case i===0:
                $(this).addClass('portero');
                break;
            case i>0 && i<=defensas:
                $(this).addClass('defensa');
                break;
            case i>defensas && i<=medios:
                $(this).addClass('medio');
                break;
            case i>medios:
                $(this).addClass('delantero');
                break;
        }
    });
};