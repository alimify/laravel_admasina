@extends('layouts.admin.app')

@section('title','Dashboard')

@push('css')


@endpush


@section('content')
    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-primary">
                <div class="card-body pb-0">

                    <div class="text-value">{{array_sum($postArr)}}</div>
                    <div>Articles</div>
                </div>
                <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart1" height="70"></canvas>
                </div>
            </div>
        </div>
        <!-- /.col-->
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-info">
                <div class="card-body pb-0">

                    <div class="text-value">{{array_sum($bookArr)}}</div>
                    <div>Books</div>
                </div>
                <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart2" height="70"></canvas>
                </div>
            </div>
        </div>
        <!-- /.col-->
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-warning">
                <div class="card-body pb-0">

                    <div class="text-value">{{array_sum($userArr)}}</div>
                    <div>Users</div>
                </div>
                <div class="chart-wrapper mt-3" style="height:70px;">
                    <canvas class="chart" id="card-chart3" height="70"></canvas>
                </div>
            </div>
        </div>
        <!-- /.col-->
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-danger">
                <div class="card-body pb-0">
                    <div class="btn-group float-right">

                    </div>
                    <div class="text-value">{{array_sum($commentArr)}}</div>
                    <div>Comments</div>
                </div>
                <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart4" height="70"></canvas>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
@endsection


@push('script')
    <!-- Plugins and scripts required by this view-->
    <script src="{{asset('assets/admin/node_modules/chart.js/dist/Chart.min.js')}}"></script>
    <script src="{{asset('assets/admin/node_modules/@coreui/coreui-plugin-chartjs-custom-tooltips/dist/js/custom-tooltips.min.js')}}"></script>
    <script>

        /* eslint-disable no-magic-numbers */
        // Disable the on-canvas tooltip
        Chart.defaults.global.pointHitDetectionRadius = 1;
        Chart.defaults.global.tooltips.enabled = false;
        Chart.defaults.global.tooltips.mode = 'index';
        Chart.defaults.global.tooltips.position = 'nearest';
        Chart.defaults.global.tooltips.custom = CustomTooltips; // eslint-disable-next-line no-unused-vars

        var d1 = <?php echo json_encode($postArr); ?>;
        var cardChart1 = new Chart($('#card-chart1'), {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [{
                    label: 'Articles',
                    backgroundColor: getStyle('--primary'),
                    borderColor: 'rgba(255,255,255,.55)',
                    data: [d1[1],d1[2] ,d1[3] ,d1[4] ,d1[5] ,d1[6] ,d1[7], d1[8], d1[9], d1[10], d1[11],d1[12]]
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            color: 'transparent',
                            zeroLineColor: 'transparent'
                        },
                        ticks: {
                            fontSize: 2,
                            fontColor: 'transparent'
                        }
                    }],
                    yAxes: [{
                        display: false,
                        ticks: {
                            display: true,
                            min: 0,
                            max: 84
                        }
                    }]
                },
                elements: {
                    line: {
                        borderWidth: 1
                    },
                    point: {
                        radius: 3,
                        hitRadius: 10,
                        hoverRadius: 4
                    }
                }
            }
        }); // eslint-disable-next-line no-unused-vars

        var d2 = <?php echo json_encode($bookArr); ?>;
        var cardChart2 = new Chart($('#card-chart2'), {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [{
                    label: 'Books',
                    backgroundColor: getStyle('--info'),
                    borderColor: 'rgba(255,255,255,.55)',
                    data: [d2[1],d2[2] ,d2[3] ,d2[4] ,d2[5] ,d2[6] ,d2[7] , d2[8], d2[9], d2[10], d2[11],d2[12]]
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            color: 'transparent',
                            zeroLineColor: 'transparent'
                        },
                        ticks: {
                            fontSize: 2,
                            fontColor: 'transparent'
                        }
                    }],
                    yAxes: [{
                        display: false,
                        ticks: {
                            display: false,
                            min: 0,
                            max: 84
                        }
                    }]
                },
                elements: {
                    line: {
                        tension: 0.00001,
                        borderWidth: 1
                    },
                    point: {
                        radius: 3,
                        hitRadius: 10,
                        hoverRadius: 4
                    }
                }
            }
        }); // eslint-disable-next-line no-unused-vars
        var d3 = <?php echo json_encode($userArr); ?>;
        var cardChart3 = new Chart($('#card-chart3'), {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [{
                    label: 'User Registered',
                    backgroundColor: 'rgba(255,255,255,.2)',
                    borderColor: 'rgba(255,255,255,.55)',
                    data: [d3[1],d3[2] ,d3[3] ,d3[4] ,d3[5] ,d3[6] ,d3[7] , d3[8], d3[9], d3[10], d3[11],d3[12]]
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        display: false
                    }],
                    yAxes: [{
                        display: false
                    }]
                },
                elements: {
                    line: {
                        borderWidth: 2
                    },
                    point: {
                        radius: 0,
                        hitRadius: 10,
                        hoverRadius: 4
                    }
                }
            }
        }); // eslint-disable-next-line no-unused-vars
       var d4 = <?php echo json_encode($commentArr); ?>;
        var cardChart4 = new Chart($('#card-chart4'), {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [{
                    label: 'Comments',
                    backgroundColor: 'rgba(255,255,255,.2)',
                    borderColor: 'rgba(255,255,255,.55)',
                    data: [d4[1],d4[2] ,d4[3] ,d4[4] ,d4[5] ,d4[6] ,d4[7] , d4[8], d4[9], d4[10], d4[11],d4[12]]
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        display: false,
                        barPercentage: 0.6
                    }],
                    yAxes: [{
                        display: false
                    }]
                }
            }
        }); // eslint-disable-next-line no-unused-vars


        //# sourceMappingURL=main.js.map
    </script>
@endpush
