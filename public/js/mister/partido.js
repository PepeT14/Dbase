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
}

function reinicio () {
    clearInterval(control);
    centesimas = 0;
    segundos = 0;
    minutos = 0;
    horas = 0;
    Centesimas.innerHTML = ":00";
    Segundos.innerHTML = ":00";
    Minutos.innerHTML = ":00";
    Horas.innerHTML = "00";
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
    if (centesimas === 99) {
        centesimas = -1;
    }
    if (centesimas === 0) {
        segundos ++;
        if (segundos < 10) { segundos = "0"+segundos }
        Segundos.innerHTML = ":"+segundos;
    }
    if (segundos === 59) {
        segundos = -1;
    }
    if ( (centesimas === 0)&&(segundos === 0) ) {
        minutos++;
        if (minutos < 10) { minutos = "0"+minutos }
        Minutos.innerHTML = ":"+minutos;
    }
    if (minutos === 59) {
        minutos = -1;
    }
    if ( (centesimas === 0)&&(segundos === 0)&&(minutos === 0) ) {
        horas ++;
        if (horas < 10) { horas = "0"+horas }
        Horas.innerHTML = horas;
    }
}