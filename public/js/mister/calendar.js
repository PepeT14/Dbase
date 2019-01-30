$('#calendar').fullCalendar({
    header:{
        center:'month,agendaDay'
    },
    views:{
        agendaDay:{
            type:'agenda',
            buttonText:'Dia'
        }
    },
    fixedWeekCount:false,
    displayEventTime:false,
    timeFormat: 'HH:mm',
});