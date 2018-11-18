/*--- LOGO CARGA ---*/
$(document).ready(function(){
    $(window).on('load',function(){
        $('.loader').fadeOut('slow');
    });
   $('img').each(function(){$(this).attr('src',$(this).data('src'))});
});
/*-------- FUNCIONES USADAS EN LA LOGICA DE LOS BOTONES   --------*/
let divIconos = $('.iconos-iniciales');

/* Función que mueve los iconos hacia arriba y los pone un poco mas pequeños*/
const mueveIconos = function(callback){
    divIconos.animate({top:0},300,'linear',callback);
    $('.iconoContent').css({transform:'scale(0.8)'})
};
/* Función que vuelve a los iconos a su apariencia inicial */
const muestraIconos = function(){
    let top = (window.innerHeight/2) - (divIconos.height()/2);
    let left = window.innerWidth/2 - divIconos.width()/2;
    divIconos.animate({top:top,left:left},300,'linear');
    $('.iconoContent').css({transform:'scale(1)'});
};

/*Función que añade la clase selected para que el boton se quede con el fondo del color indicado en el css*/
const pulsaBoton = function(boton){
    divIconos.find('.selected').eq(0).removeClass('selected');
    $(boton).addClass('selected');
};
/*Funcion que elimina la clase selected del boton y vuelve a tomar el color inicial*/
const desmarcaBoton = function(boton){
  $(boton).removeClass('selected');
};

/**Funcion que dado un boton realiza los pasos necesarios en cada caso*/
const ejecutaLogica = function(boton,seccion){
    let botonPulsado = $(boton);
    if(botonPulsado.hasClass('selected')){
        desmarcaBoton(boton);
        ocultaSeccion(seccion,function(){
            muestraIconos();
        });
    }else{
        mueveIconos(function(){
           pulsaBoton(boton);
           muestraSeccion(seccion);
           if(seccion==='calendario'){
               muestraCalendario();
           }
        });
    }
};


/*Funcion que muestra la seccion en cuestion*/
const muestraSeccion = function(seccion){
    $(seccion).css({'visibility':'visible'});
    $(seccion).animate({'opacity':'1'});
};
/*Funcion que oculta la seccion en cuestion*/
const ocultaSeccion = function(seccion,callback){
  $(seccion).animate({'opacity':'0'},function(){
      $(seccion).css('visibility','hidden');
      callback.call();
  });
};

/* -----------------  LOGICA DE LOS BOTONES --------------- */
$('.partidosHerramienta').click(function(){
    ejecutaLogica(this,'.calendar-content');
});

$('.equipoHerramientas').click(function(){
    ejecutaLogica(this,'.equipo-content');
});

$('.estadisticasHerramienta').click(function(){
   ejecutaLogica(this,'.estadisticas-content');
});