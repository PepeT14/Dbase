$(document).ready(function(){
    let modal_id=$('.modal').attr('id');

    $('.btn-cancel').on('click',function(){$('#'+modal_id).modal('hide');});
    $('.btn-save-player').on('click',function(){
       window.location.href='create/player';
    });
});