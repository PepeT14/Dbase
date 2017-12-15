var d = new Date();
var monthNames = [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ];

var date = document.getElementById("date");
var time = document.getElementById("time");

function getDate() {
    date.innerHTML = d.getDate() + " " + monthNames[d.getMonth()] + ", " + d.getFullYear();
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

    time.innerHTML = strTime;
    setTimeout(timer, 1000);
}

getDate();
timer();