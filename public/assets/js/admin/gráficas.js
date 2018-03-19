$(document).ready(function(){

    var grafica = $('#container');
    var series= grafica.data('series');
    var categorias = grafica.data('categorias');
    var chartData = {
        chart:{type:'column'},
        title:{text:'Material'},
        xAxis:{categories:categorias},
        yAxis:{},
        series:series
    };
    chartData.series= series;
    grafica.highcharts(chartData);
});