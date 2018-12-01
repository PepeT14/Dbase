$(document).ready(function(){
/*--------------------------------------------------------
* ----------------- CLASE OBJETO PARTIDO -------------------
* --------------------------------------------------------*/
    let Partido = function(){
        this.alineacion = null;
    };
    Partido.prototype.getTipoPartido=function(){
        let checkeado = false;
        let tipoPartido = null;
        let opciones = $(document).find('.form-group .tipo-campo input');
        let seleccionada = function(){
            opciones.map(function(){
                checkeado = $(this)[0].checked;
                if(checkeado){
                    tipoPartido = $(this).parent().text().trim();
                }
            });
        };
        seleccionada();

        return tipoPartido;
    };

    Partido.prototype.calculaJugadores = function(tipoPartido){
        switch(tipoPartido){
            case 'F5':
                this.titulares=5;
                this.suplentes=5;
                break;
            case 'F7':
                this.titulares=7;
                this.suplentes=11;
                break;
            case 'F8':
                this.titulares=8;
                this.suplentes=11;
                break;
            case 'F11':
                this.titulares=11;
                this.suplentes=$('#edit-alineacion-btn').data('players').length - 11;
                break;
        }
    };

    let partido = new Partido();

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
            let jugadores = $('#edit-alineacion-btn').data('players');
            partido.alineacion = {};
            let idTitulares = [];
            let idSuplentes = [];
            $('.titulares select option:selected').each(function(){idTitulares.push($(this)[0].value)});
            $('.suplentes select option:selected').each(function(){idSuplentes.push($(this)[0].value)});
            partido.alineacion.titulares = jugadores.filter(function(jugador){
                return idTitulares.includes(jugador.id.toString());
            });
            partido.alineacion.suplentes = jugadores.filter(function(jugador){
                return idSuplentes.includes(jugador.id.toString());
            });
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
        if(partido.alineacion){
            console.log(partido.alineacion);
        }else{
            partido.calculaJugadores(partido.getTipoPartido());
            rellenaEditAlineacion(partido);
        }
    });

    /*----------- FUNCIONES UTILES ------------*/

    let rellenaEditAlineacion = function(partido){
        let suplentesSelector = $('.suplentes');
        let titularesSelector = $('.titulares');
        new Promise(function(ok){
            //ELimino los cuadros creados anteriormente
            $('.titulares div.cuadro-jugador').remove();
            $('.suplentes div.cuadro-jugador').remove();

            //Texto que vamos a insertar por cada jugador
            let fila = '<div class="row cuadro-jugador">' +
                '<select class="selector-jugador-partido"></select>' +
                ' </div>';

            //Insertamos en los titulares y en los suplentes
            for(let i=0;i<partido.titulares;i++){
                titularesSelector.append(fila);
            }
            for(let i=0;i<partido.suplentes;i++){
                suplentesSelector.append(fila);
            }
            /*
            //BOTON PARA AÑADIR MAS JUGADORES
            suplentesSelector.append('<div class="cuadro-jugador add-suplentes btn-add-row">' +
                '<i class="fa fa-plus-circle"></i><span>AÑADIR MÁS</span></div>');

            //Linkear el boton para que cuando sea pulsado añada una fila mas de un jugador
            linkBotonesAddFila(fila,'.add-suplentes','.delete-suplentes');
            */

            //Fin del promise
            ok();
        }).then(function(){
            let jugadores = $('#edit-alineacion-btn').data('players');
            let cargaInicial = cargaSelectores(jugadores);

        });
    };

    /*----------------- LOGICA SELECTORES ALINEACION -----------*/

    let cargaSelectores = function(jugadores){
        let seleccionados = [];
        let end = false;
            $('.cuadro-jugador select').each(function(i){
                if(!end){
                    let obj = this;
                    jugadores = jugadores.filter(function(jugador){
                        return !seleccionados.includes(jugador.id.toString());
                    });
                    $('#edit-alineacion-btn').data('players').forEach(function(jugador){
                        $(obj).append('<option value="'+jugador.id+'">'+jugador.name+'</option>');
                    });
                    let optSeleccionada = $(this).find('option:selected')[0].value;
                    seleccionados.push(optSeleccionada);
                    if(i==$('#edit-alineacion-btn').data('players').length){
                        end=true;
                    }
                }
            });
        return [jugadores,seleccionados]
    };

    let refrescaSelectores = function(jugadores,seleccionados){
        let end = false;
        let jugadoresEquipo = $('#edit-alineacion-btn').data('players');
        $('.cuadro-jugador select').each(function(i){
            if(!end){
                let obj = this;
                jugadores = jugadores.filter(function(jugador){
                    return !seleccionados.includes(jugador.id.toString());
                });
                let optSeleccionada = $(this).find('option:selected')[0].value;
                let jugadorSeleccionado = null;
                jugadoresEquipo.forEach(function(jugador){if(jugador.id.toString()===optSeleccionada){jugadorSeleccionado = jugador}});
                $(this).find('option').remove();
                $(this).append('<option value="'+jugadorSeleccionado.id+'">'+jugadorSeleccionado.name+'</option>');
                jugadores.forEach(function(jugador){
                    $(obj).append('<option value="'+jugador.id+'">'+jugador.name+'</option>');
                });
                if(i==jugadoresEquipo.length){
                    end=true;
                }
            }
        });
    };




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
    }
});