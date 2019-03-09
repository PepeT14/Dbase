$(document).ready(function(){

/*--------------------------------------------------------
* ----------------- CLASE OBJETO PARTIDO -------------------
* --------------------------------------------------------*/
    let Partido = function(){
        this.alineacion = null;
        this.jugadoresEquipo = $('#edit-alineacion-btn').data('players');
    };
    Partido.prototype.getTipoPartido=function(){
        let tipoPartido = null;
        let seleccionada = function(){
            tipoPartido = $(document).find('#tipo-campo option').get().filter(function(option){return option.selected})[0].value;
        };
        seleccionada();

        return tipoPartido;
    };

    Partido.prototype.calculaJugadores = function(tipoPartido){
        switch(tipoPartido){
            case 'F5':
                this.titulares=5;
                this.suplentes=Math.min(this.jugadoresEquipo.length-5,5);
                this.reservas = this.jugadoresEquipo.length - 10;
                this.tacticasPosibles = ['2-2','1-2-1','1-3','De 5'];
                break;
            case 'F7':
                this.titulares=7;
                this.suplentes=Math.min(this.jugadoresEquipo.length-7,11);
                this.reservas = this.jugadoresEquipo.length - 18;
                this.tacticasPosibles = ['3-2-1','2-3-1','3-1-2'];
                break;
            case 'F8':
                this.titulares=8;
                this.suplentes=Math.min(this.jugadoresEquipo.length-8,11);
                this.reservas=this.jugadoresEquipo.length - 19;
                break;
            case 'F11':
                this.titulares=11;
                this.suplentes=Math.min(this.jugadoresEquipo.length-11,11);
                this.reservas = this.jugadoresEquipo.length - 22;
                this.tacticasPosibles = ['4-4-2','3-4-3','4-3-3','5-4-1','5-3-2','4-5-1'];
                break;
        }
    };

    partido = new Partido();

/*--------------------------------------------------------
* ----------------- FORMULARIO PARTIDO -------------------
* --------------------------------------------------------*/

const newMatchForm = $('#new-match-form');

    /*------------- PANEL DE CONTROL DE ACCIONES ---------*/
    $('#control-panel').on('show.bs.modal',function(){
        $('.btn-cancel').on('click',function(){$('#control-panel').modal('hide')});
        let clickWithEnter = function(){
            $('.cuadro-action input').on('focus',function(){
                let obj = $(this);
                let funcion = function(){
                    let acciones = obj.parent().parent()[0].children.length;
                    console.log(acciones);
                    let ultimaAccion = obj.parent().parent()[0].children[acciones-2];
                    console.log(ultimaAccion);
                    let accion = obj.parent()[0];
                    if(ultimaAccion === accion){
                        console.log(obj);
                        $('.add-more-action').trigger('click');
                    }
                    obj.parent().next().find('input').focus();
                };
                linkaEnter(obj,funcion);
            });
        };
        linkMoreActions(clickWithEnter);
    });

    /*------------ ENVIO DEL FORMULARIO ------------*/
    newMatchForm.validate({
        rules:{
            'fecha-partido':{
                required:true,
                date:true
            },
            'hora-partido':{
                required:true,
                time:true
            },
            'jornada-partido':{
                required:true
            },
            'player-birthday':{
                required:true,
                date:true
            }
        }
    });

    newMatchForm.on('submit',function(){
        event.preventDefault();
        if($(this).valid()){
            let data = $(this).serializeFormJSON();
            if(partido.alineacion){
                data.alineacion = partido.alineacion;
            }
            $.ajax({
                url:$('meta[name="app-url"]').attr('content') + '/mister/create/match',
                method:'POST',
                data:data,
                success:function(response){
                    console.log('Empieza el partido');
                    window.location.href=response;
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
/*------------------------------------------------
* ----------------- ALINEACION -------------------
* ------------------------------------------------*/
    $('#edit-alineacion-btn').on('click',function(){
        event.preventDefault();
        $(this).parents().find('#partido-formulario').hide('slow');
        $('#editar-alineacion').show('slow');
        if(partido.alineacion && partido.getTipoPartido() === partido.tipoPartido){

        }else{
            partido.tipoPartido = partido.getTipoPartido();
            partido.calculaJugadores(partido.tipoPartido);
            rellenaEditAlineacion(partido);
        }
    });

    /*----------- FUNCION PARA EDITAR LA ALINEACION ANTES DEL PARTIDO ------------*/
    $('#save-alineacion').on('click',function(){
        makeAlineacion();
    });

    let makeAlineacion = function(){
        let jugadores = $('#edit-alineacion-btn').data('players');
        partido.alineacion = {};
        let idTitulares = [];
        let idSuplentes = [];
        $('.titulares .cuadro-jugador .info-jugador').each(function(){idTitulares.push($(this).data('jugador'))});
        $('.suplentes .cuadro-jugador .info-jugador').each(function(){idSuplentes.push($(this).data('jugador'))});
        partido.alineacion.titulares = jugadores.filter(function(jugador){
            return idTitulares.includes(jugador.id);
        });
        partido.alineacion.suplentes = jugadores.filter(function(jugador){
            return idSuplentes.includes(jugador.id);
        });
    };

    let rellenaEditAlineacion = function(partido){
        let suplentesSelector = $('.suplentes');
        let titularesSelector = $('.titulares');
        let reservasSelector = $('.reservas');
        new Promise(function(ok){
            //ELimino los cuadros creados anteriormente
            $('.titulares div.cuadro-jugador').remove();
            $('.suplentes div.cuadro-jugador').remove();
            $('.tacticas button').remove();
            $('.reservas div').remove();


            try{
                partido.tacticasPosibles.forEach(function(tactica){
                    $('.tacticas').append('<button class="btn btn-primary-color outline tactica-btn">'+tactica+'</button>');
                });
                $('.tactica-btn').on('click',function(){
                    partido.tactica = $(this).text().trim();
                    if($(this).hasClass('selected')){
                        window.alert('ya tienes seleccionada esta tactica');
                    }else{
                        eliminaTactica($('.tactica-btn.selected'));
                        $(this).addClass('selected');
                        rellenaPosiciones(partido.tactica);
                    }
                });
            }catch(err){
                console.error(err);
            }
            //Texto que vamos a insertar por cada jugador
            let fila = '<div class="row cuadro-jugador"></div>';

            //Insertamos en los titulares y en los suplentes
            for(let i=0;i<partido.titulares;i++){
                titularesSelector.append(fila);
            }
            for(let i=0;i<partido.suplentes;i++){
                suplentesSelector.append(fila);
            }
            if(partido.reservas>0){
                reservasSelector.append('<div class="divider"></div>');
                reservasSelector.append('<div class="alineacion-title"><span>RESERVAS</span></div>');
                for(let i=0;i<partido.reservas;i++){
                    reservasSelector.append(fila);
                }
            }
            ok();
        }).then(function(){
            let cuadro = $('.cuadro-jugador');
            cuadro.each(function(i){
                $(this).append('<div class="info-cuadro"></div>')
                $(this).append('<div class="info-jugador">'+partido.jugadoresEquipo[i].name+'</div>');
                $(this).find('.info-jugador').data('jugador',partido.jugadoresEquipo[i].id).attr('data-jugador',partido.jugadoresEquipo[i].id);
            });
            cuadro.on('click',function(){
                let seleccionado = $('.cuadro-jugador.selected');
                if(seleccionado.length>0){
                    let a = $(this)[0].innerHTML;
                    $(this)[0].innerHTML = seleccionado[0].innerHTML;
                    seleccionado[0].innerHTML = a;
                    seleccionado.removeClass('selected');
                }else{
                    $(this).addClass('selected');
                }
            });
            $('.tacticas').children().first().click();
        });
    };


    /*----------------- LOGICA PANEL CONTROL ACCIONES DEL PARTIDO  -----------*/


    let linkMoreActions = function(funcion){
        let fila = '<div class="cuadro-action">'+
            '<input type="text" class="form-control">'+
            '<div class="delete-action">'+
            '<i class="fa fa-trash"></i>'+
            '</div>'+
            '</div>';
        console.log(funcion);
        linkBotonesAddFila(fila,'.add-more-action','.delete-action',funcion);
    };

    let linkBotonesAddFila = function(append,boton,botonEliminar,funcionCallback){
        new Promise(function(ok){
            $(boton).on('click',function(){
                $(this).parent().append(append);
                activaBotonEliminar(botonEliminar);
                let html = $(this)[0].outerHTML.trim();
                $(this).parent().append(html);
                $(this).remove();
                linkBotonesAddFila(append,boton,botonEliminar,funcionCallback);
                ok();
            });
        }).then(function(){try{funcionCallback.call()}catch(err){console.log(err)}});
    };

    let activaBotonEliminar = function(boton){
        $(boton).on('click',function(){
            $(this).parent().remove();
        });
    };

    let linkaEnter = function(elemento,action,arguments){
        arguments = arguments ? arguments : 'undefined';
        elemento.on("keyup", function(event) {
            // Number 13 is the "Enter" key on the keyboard
            if (event.keyCode === 13) {
                action.call(arguments);
            }
        });
    };
    let eliminaTactica = function(boton){
        boton.removeClass('selected');
        $('.titulares .cuadro-jugador .info-cuadro').removeClass('portero').removeClass('defensa').removeClass('medio').removeClass('delantero').text('');
    };
    let rellenaPosiciones = function(tactica){
        let defensas = tactica.split('-')[0];
        let medios = parseInt(tactica.split('-')[1]) + parseInt(defensas);
        $('.titulares .cuadro-jugador .info-cuadro').each(function(i){
            switch(true){
                case i===0:
                    $(this).addClass('portero').append('PT');
                    break;
                case i>0 && i<=defensas:
                    $(this).addClass('defensa').append('DF');
                    break;
                case i>defensas && i<=medios:
                    $(this).addClass('medio').append('MC');
                    break;
                case i>medios:
                    $(this).addClass('delantero').append('DL');
                    break;
            }
        });
    };
});