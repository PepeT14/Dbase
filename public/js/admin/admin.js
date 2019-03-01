$('#formAddTeam').on('click',function(){
   $('#formAddTeam').hide();
   $('.add-team').show();
});

$('#showLeagueForm').click(function(){
   $('#addLeagueForm').toggle();
});

$('#showInstForm').click(function(){
    $('#addInstForm').toggle();
});

$('.header_link.item').on('click',function(){
    $('.header_link.active').removeClass('active');
    $(this).addClass('active');
});