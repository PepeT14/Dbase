$('.login').on("click",'.btn-l', function () {
    if($('#welcome').hasClass("active")){
        console.log("oleee");
        $('.welc').removeClass("active");
        $('.log').addClass("active");
        return false;
    }else{
        console.log('ooooh');
        $('.log').removeClass("active");
        $('.welc').addClass("active");
        return false;
    }

});