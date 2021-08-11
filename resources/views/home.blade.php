@extends('restrito.template')

@section('title', 'Início')

@section('content_header')
<h1>Início</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-info shadow-sm"><i class="fas fa-users"></i></span>
            
            <div class="info-box-content">
                <span class="info-box-text">Candidatos</span>
                <span class="info-box-number">{{$candidatos}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-success shadow-sm"><i class="far fa-flag"></i></span>
            
            <div class="info-box-content">
                <span class="info-box-text">Triados</span>
                <span class="info-box-number">{{$triados}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-warning shadow-sm"><i class="fas fa-bullhorn"></i></span>
            
            <div class="info-box-content">
                <span class="info-box-text">Vagas</span>
                <span class="info-box-number">{{$vagas}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-primary shadow-sm"><i class="far fa-plus-square"></i></span>
            
            <div class="info-box-content">
                <span class="info-box-text">Novos Currículos (Últimos 30 dias)</span>
                <span class="info-box-number">{{$novos}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
</div>
<div class="row mt-5">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Gráfico de Candidatos
            </div>
            <div class="card-body">
                <div id="grafico-candidatos"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Gráfico de Vagas
            </div>
            <div class="card-body">
                <div id="grafico-vagas"></div>
            </div>
        </div>
    </div>
</div>
@stop

@push('js')
<script>
    $( document ).ready(function() {
        Highcharts.chart('grafico-candidatos', {
        
        title: {
            text: 'Solar Employment Growth by Sector, 2010-2016'
        },
        
        subtitle: {
            text: 'Source: thesolarfoundation.com'
        },
        
        yAxis: {
            title: {
                text: 'Number of Employees'
            }
        },
        
        xAxis: {
            accessibility: {
                rangeDescription: 'Range: 2010 to 2017'
            }
        },
        
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        
        plotOptions: {
            series: {
                label: {
                    connectorAllowed: false
                },
                pointStart: 2010
            }
        },
        
        series: [{
            name: 'Installation',
            data: [43934, 52503, 57177, 69658, 97031, 119931, 137133, 154175]
        }, {
            name: 'Manufacturing',
            data: [24916, 24064, 29742, 29851, 32490, 30282, 38121, 40434]
        }, {
            name: 'Sales & Distribution',
            data: [11744, 17722, 16005, 19771, 20185, 24377, 32147, 39387]
        }, {
            name: 'Project Development',
            data: [null, null, 7988, 12169, 15112, 22452, 34400, 34227]
        }, {
            name: 'Other',
            data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
        }],
        
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
    Highcharts.chart('grafico-vagas', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Stacked column chart'
        },
        xAxis: {
            categories: ['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas']
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total fruit consumption'
            }
        },
        tooltip: {
            pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
            shared: true
        },
        plotOptions: {
            column: {
                stacking: 'percent'
            }
        },
        series: [{
            name: 'John',
            data: [5, 3, 4, 7, 2]
        }, {
            name: 'Jane',
            data: [2, 2, 3, 2, 1]
        }, {
            name: 'Joe',
            data: [3, 4, 4, 2, 5]
        }]
    });
    
});
    
    
</script>
@endpush