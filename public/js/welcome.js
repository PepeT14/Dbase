let loginErrors = $('#login-view').data('error')==='1';

if(loginErrors){
    $('.welc').removeClass("active");
    $('.log').addClass("active");
    document.getElementById('login').innerHTML=
        '<button class="btn-l btn-login">' +
        '<i class="fa fa-home"></i>' +
        'Inicio</button>'
}

let login = $('#login-view').data('login')==='1';
if(login){
    $('.welc').removeClass("active");
    $('.log').addClass("active");
    document.getElementById('login').innerHTML=
        '<button class="btn-l btn-login">' +
        '<i class="fa fa-home"></i>' +
        'Inicio</button>'
}

$('#logear').click(function () {
        $('.welc').removeClass("active");
        $('.log').addClass("active");
        document.getElementById('login').innerHTML=
            '<button class="btn-l btn-login" id="welcomear">' +
            '<i class="fa fa-home"></i>' +
            'Inicio</button>';
});

$('#welcomear').click(function(){
    $('.log').removeClass("active");
    $('.welc').addClass("active");
    document.getElementById('login').innerHTML=
        '<button class="btn-l btn-login" id="logear">' +
        '<i class="fa fa-sign-in-alt"></i>' +
        'Login</button>';
});

