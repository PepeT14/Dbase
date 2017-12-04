$(document).ready(function(){

    var loginErrors = $('#login-view').data('error')==1;

    if(loginErrors){
        $('.welc').removeClass("active");
        $('.log').addClass("active");
        document.getElementById('login').innerHTML=
            '<button class="btn-l btn-login">' +
            '<i class="fa fa-home"></i>' +
            'Inicio</button>'
    }

    var login = $('#login-view').data('login')==1;
    if(login){
        $('.welc').removeClass("active");
        $('.log').addClass("active");
        document.getElementById('login').innerHTML=
            '<button class="btn-l btn-login">' +
            '<i class="fa fa-home"></i>' +
            'Inicio</button>'
    }

    $('.login').on("click", '.btn-l', function () {
        if ($('#welcome').hasClass("active")) {
            $('.welc').removeClass("active");
            $('.log').addClass("active");
            document.getElementById('login').innerHTML=
                '<button class="btn-l btn-login">' +
                '<i class="fa fa-home"></i>' +
                'Inicio</button>'
            return false;
        } else {
            $('.log').removeClass("active");
            $('.welc').addClass("active");
            document.getElementById('login').innerHTML=
                '<button class="btn-l btn-login">' +
                '<i class="fa fa-sign-in"></i>' +
                'Login</button>'
            return false;
        }

    });
});

