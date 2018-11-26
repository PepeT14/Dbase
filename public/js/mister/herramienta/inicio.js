$(document).ready(function(){
    //NUEVO EQUIPO
    $('#team-category').on('change',function(){
        let obj = $(this);
        let ligas = $(document).find('#new-team').data('leagues').filter(league => league.category=obj.val());
        console.log(ligas);
        ligas.forEach(function(liga){
            option = '<option name='+liga.name+'>'+liga.name+'</option>';
            $('#team-league').append(option);
        });
    });

    //Funciones generales
    $('.icono-accion.seccion').on('click',function(){
        $('.iconos-iniciales').hide('slow');
        let section = $(this).data('section');
        $('#'+section).show('slow');
    });

    $('.icono-accion.ruta').on('click',function(){
       window.location.href=$(this).data('href');
    });

    $('.navegacion-menu i').on('click',function(){
        let backSection = $(this).parent().data('backsection');
        console.log(backSection);
        $(this).parent().parent().parent().hide('slow');
        $('#'+backSection).show('slow');
    });

    $('.formulario-partido').submit(function(){return false;});

    $('#edit-alineacion-btn').on('click',function(){
        $(this).parents().find('#partido-formulario').hide('slow');
        $('#editar-alineacion').show('slow');
        rellenaEditAlineacion();
    });

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


    let Partido = function(){
        this.calculaJugadores(this.getTipoPartido());
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
                this.suplentes=11;
                break;
        }
    };

    let rellenaEditAlineacion = function(){
        $('.titulares div.cuadro-jugador').remove();
        $('.suplentes div.cuadro-jugador').remove();
        let partido = new Partido();
        let fila = '<div class="row cuadro-jugador"> </div>';
        let suplentesSelector = $('.suplentes');
        for(let i=0;i<partido.titulares;i++){
            $('.titulares').append(fila);
        }
        for(let i=0;i<partido.suplentes;i++){
            suplentesSelector.append(fila);
        }
        suplentesSelector.append('<div class="cuadro-jugador add-suplentes btn-add-row">' +
            '<i class="fa fa-plus-circle"></i><span>AÑADIR MÁS</span></div>');
        linkBotonesAddFila(fila,'.add-suplentes','.delete-suplentes');
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
        new Promise(function(){
            $(boton).on('click',function(){
                $(this).parent().append(append);
                activaBotonEliminar(botonEliminar);
                let html = $(this)[0].outerHTML.trim();
                $(this).parent().append(html);
                $(this).remove();
                linkBotonesAddFila(append,boton,botonEliminar,funcionCallback);
            });
        }).then(funcionCallback.call());
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