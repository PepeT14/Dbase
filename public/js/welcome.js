$(document).ready(function(){

    var loginErrors = $('#login-view').data('error')==1;

    if(loginErrors){
        $('.welc').removeClass("active");
        $('.log').addClass("active");
    }

    function ChangeUrl(page, url) {
        if (typeof (history.pushState) != "undefined") {
            var obj = {Page: page, Url: url};
            history.pushState(obj, obj.Page, obj.Url);
        } else {
            alert("Browser does not support HTML5.");
        }
    }

    $('.login').on("click", '.btn-l', function () {
        if ($('#welcome').hasClass("active")) {
            console.log("oleee");
            $('.welc').removeClass("active");
            $('.log').addClass("active");
            // ChangeUrl('login', '/login');
            return false;
        } else {
            console.log('ooooh');
            $('.log').removeClass("active");
            $('.welc').addClass("active");
            // ChangeUrl('welcome', '');
            return false;
        }

    });
});

