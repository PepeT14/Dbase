var d = new Date();
var monthNames = [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ];
var days = ["Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado"];
var date = document.getElementById("date");
var time = document.getElementById("time");

function getDate() {
    if(date){date.innerHTML = d.getDate() + " " + monthNames[d.getMonth()] + ", " + d.getFullYear();}
}

function timer() {
    setTimeout(timer, 1000);
    var d = new Date();
    var hours = d.getHours();
    var minutes = d.getMinutes();
    // var ampm = hours < 12 ? 'am' : 'pm';
    var strTime = [hours ,
        (minutes < 10 ? "0" + minutes : minutes)
    ].join(':');

    if(time){time.innerHTML = strTime;}
    // setTimeout(timer, 1000);
}

getDate();
timer();

function getOptions(){
    for(i=0;i<30;i++){
        var d = new Date();
        d.setDate(d.getDate()+i);
        var day = days[d.getDay()];
        var month = monthNames[d.getMonth()];
        var year = d.getFullYear();
        $('#reservas').append( "<option value='"+d.getDate()+"-"+d.getMonth()+"-"+year+"'>"+day+", "+d.getDate()+" de "+month+" de "+year+
            "</option>");
    }
}
getOptions();

