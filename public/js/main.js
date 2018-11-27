$(document).ready(function(){
    $(window).on('load',function(){
        $('.loader').fadeOut('slow');
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

});



