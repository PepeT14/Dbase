$(document).ready(function(){
    $('#calendar').fullCalendar({
        timeFormat: 'H(:mm)',
        locale: 'es',
        header:{
            left:'',
            center:'prev title next ',
            right:'today'
        }

    });
    Highcharts.chart('container', {
        title: {
            text: 'Material'
        },
        xAxis: {
            categories: ['Balones', 'Conos', 'Petos', 'Porterias']
        },
        // labels: {
        //     items: [{
        //         html: 'Material total',
        //         style: {
        //             left: '50px',
        //             top: '30px',
        //             color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
        //         }
        //     }]
        // },
        series: [{
            type: 'column',
            name: 'Pre-Benjamines',
            data: [3, 2, 1, 3]
        }, {
            type: 'column',
            name: 'Benjamines',
            data: [2, 3, 5, 7]
        }, {
            type: 'column',
            name: 'Alevines',
            data: [4, 3, 3, 9]
        }, {
            type:'spline',
            name: 'Inicial',
            data: [3, 2.67, 3, 6.33],
            marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[3],
                fillColor: 'white'
            }
        }],
        credits:{
            enabled:false
        },
        // }, {
        //     type: 'pie',
        //     name: 'Total consumption',
        //     data: [{
        //         name: 'Jane',
        //         y: 13,
        //         color: Highcharts.getOptions().colors[0] // Jane's color
        //     }, {
        //         name: 'John',
        //         y: 23,
        //         color: Highcharts.getOptions().colors[1] // John's color
        //     }, {
        //         name: 'Joe',
        //         y: 19,
        //         color: Highcharts.getOptions().colors[2] // Joe's color
        //     }],
        //     center: [100, 30],
        //     size: 100,
        //     showInLegend: false,
        //     dataLabels: {
        //         enabled: false
        //     }
        // }
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }

    });

});