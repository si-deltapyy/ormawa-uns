@extends('layouts.dashboard')

@section('content')

@role('admin')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Dashboard</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Xacton</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card bg-primary border-primary">
            <div class="card-body">
                <div class="mb-4">
                    <span class="badge badge-soft-light float-right">Daily</span>
                    <h5 class="card-title mb-0 text-white">Cost per Unit</h5>
                </div>
                <div class="row d-flex align-items-center mb-4">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center mb-0 text-white">
                            $17.21
                        </h2>
                    </div>
                    <div class="col-4 text-right">
                        <span class="text-white-50">12.5% <i class="mdi mdi-arrow-up"></i></span>
                    </div>
                </div>

                <div class="progress badge-soft-light shadow-sm" style="height: 5px;">
                    <div class="progress-bar bg-light" role="progressbar" style="width: 38%;"></div>
                </div>
            </div>
        </div>
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="card bg-success border-success">
            <div class="card-body">
                <div class="mb-4">
                    <span class="badge badge-soft-light float-right">Per Week</span>
                    <h5 class="card-title mb-0 text-white">Market Revenue</h5>
                </div>
                <div class="row d-flex align-items-center mb-4">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center text-white mb-0">
                            $1875.54
                        </h2>
                    </div>
                    <div class="col-4 text-right">
                        <span class="text-white-50">18.71% <i class="mdi mdi-arrow-down"></i></span>
                    </div>
                </div>

                <div class="progress badge-soft-light shadow-sm" style="height: 7px;">
                    <div class="progress-bar bg-light" role="progressbar" style="width: 38%;"></div>
                </div>
            </div>
        </div>
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="card bg-warning border-warning">
            <div class="card-body">
                <div class="mb-4">
                    <span class="badge badge-soft-light float-right">Per Month</span>
                    <h5 class="card-title mb-0 text-white">Expenses</h5>
                </div>
                <div class="row d-flex align-items-center mb-4">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center text-white mb-0">
                            $784.62
                        </h2>
                    </div>
                    <div class="col-4 text-right">
                        <span class="text-white-50">57% <i class="mdi mdi-arrow-up"></i></span>
                    </div>
                </div>

                <div class="progress badge-soft-light shadow-sm" style="height: 7px;">
                    <div class="progress-bar bg-light" role="progressbar" style="width: 68%;"></div>
                </div>
            </div>
        </div>
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="card bg-info border-info">
            <div class="card-body">
                <div class="mb-4">
                    <span class="badge badge-soft-light float-right">All Time</span>
                    <h5 class="card-title mb-0 text-white">Daily Visits</h5>
                </div>
                <div class="row d-flex align-items-center mb-4">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center text-white mb-0">
                            1,15,187
                        </h2>
                    </div>
                    <div class="col-4 text-right">
                        <span class="text-white-50">17.8% <i class="mdi mdi-arrow-down"></i></span>
                    </div>
                </div>

                <div class="progress badge-soft-light shadow-sm" style="height: 7px;">
                    <div class="progress-bar bg-light" role="progressbar" style="width: 57%;"></div>
                </div>
            </div>
        </div>
    </div> <!-- end col-->
</div>
<!-- end row -->

<div class="row">

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title d-inline-block">Total Revenue</h4>
                <p class="card-subtitle mb-4">Example of line pie chart js.</p>

                <canvas id="ormawa-pie"></canvas>

            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->

    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Line Chart</h4>
                <p class="card-subtitle mb-4">Example of line chart chart js.</p>

                <canvas id="ormawa-line"></canvas>

            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>
<!-- end row-->


<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Recent Buyers</h4>
                <p class="card-subtitle mb-4 font-size-13">Transaction period from 21 July to 25 Aug
                </p>

                <div class="table-responsive">
                    <table class="table table-centered table-hover table-xl mb-0" id="recent-orders">
                        <thead>
                            <tr>
                                <th class="border-top-0">Product</th>
                                <th class="border-top-0">Customers</th>
                                <th class="border-top-0">Categories</th>
                                <th class="border-top-0">Popularity</th>
                                <th class="border-top-0">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-truncate">iPone X</td>
                                <td class="text-truncate">Tiffany W. Yang</td>
                                <td>
                                    <span class="badge badge-soft-secondary p-2">Mobile</span>
                                </td>
                                <td>
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar progress-bar-striped bg-secondary"
                                            role="progressbar" aria-valuenow="85"
                                            aria-valuemin="20" aria-valuemax="100"
                                            style="width:85%"></div>
                                    </div>
                                </td>
                                <td class="text-truncate">$ 1200.00</td>
                            </tr>
                            <tr>
                                <td class="text-truncate">iPad</td>
                                <td class="text-truncate">Dale P. Warman</td>
                                <td>
                                    <span class="badge badge-soft-secondary p-2">Tablet</span>
                                </td>
                                <td>
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar progress-bar-striped bg-secondary"
                                            role="progressbar" aria-valuenow="72"
                                            aria-valuemin="20" aria-valuemax="100"
                                            style="width:72%"></div>
                                    </div>
                                </td>
                                <td class="text-truncate">$ 1190.00</td>
                            </tr>
                            <tr>
                                <td class="text-truncate">OnePlus</td>
                                <td class="text-truncate">Garth J. Terry</td>
                                <td>
                                    <span class="badge badge-soft-secondary p-2">Electronics</span>
                                </td>
                                <td>
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar progress-bar-striped bg-secondary"
                                            role="progressbar" aria-valuenow="43"
                                            aria-valuemin="20" aria-valuemax="100"
                                            style="width:43%"></div>
                                    </div>
                                </td>
                                <td class="text-truncate">$ 999.00</td>
                            </tr>
                            <tr>
                                <td class="text-truncate">ZenPad</td>
                                <td class="text-truncate">Marilyn D. Bailey</td>
                                <td>
                                    <span class="badge badge-soft-secondary p-2">Cosmetics</span>
                                </td>
                                <td>
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar progress-bar-striped bg-secondary"
                                            role="progressbar" aria-valuenow="37"
                                            aria-valuemin="20" aria-valuemax="100"
                                            style="width:37%"></div>
                                    </div>
                                </td>
                                <td class="text-truncate">$ 1150.00</td>
                            </tr>
                            <tr>
                                <td class="text-truncate">Pixel 2</td>
                                <td class="text-truncate">Denise R. Vaughan</td>
                                <td>
                                    <span class="badge badge-soft-secondary p-2">Appliences</span>
                                </td>
                                <td>
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar progress-bar-striped bg-secondary"
                                            role="progressbar" aria-valuenow="82"
                                            aria-valuemin="20" aria-valuemax="100"
                                            style="width:82%"></div>
                                    </div>
                                </td>
                                <td class="text-truncate">$ 1180.00</td>
                            </tr>
                            <tr>
                                <td class="text-truncate">Pixel 2</td>
                                <td class="text-truncate">Jeffery R. Wilson</td>
                                <td>
                                    <span class="badge badge-soft-secondary p-2">Mobile</span>
                                </td>
                                <td>
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar progress-bar-striped bg-secondary"
                                            role="progressbar" aria-valuenow="36"
                                            aria-valuemin="20" aria-valuemax="100"
                                            style="width:36%"></div>
                                    </div>
                                </td>
                                <td class="text-truncate">$ 1180.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>
@endrole

@endsection

@section('scripts') 

    <script>
        (function($) {
        'use strict';
        $(function() {
            if ($("#ormawa-pie").length) {
            var pieChartCanvas = $("#ormawa-pie").get(0).getContext("2d");
            var pieChart = new Chart(pieChartCanvas, {
                type: 'pie',
                data: {
                datasets: [{
                    data: [21, 34, 48, 31],
                    backgroundColor: [
                    '#3F51B5', 
                    '#f8ac5a', 
                    '#00c2b2', 
                    '#f15050'
                    ],
                    borderColor: [
                    '#3F51B5', 
                    '#f8ac5a', 
                    '#00c2b2', 
                    '#f15050'
                    ],
                }],
            
                // These labels appear in the legend and in the tooltips when hovering different arcs
                labels: [
                    'Samsung',
                    'Apple',
                    'Vivo',
                    'Motorola'
                ]
                },
                options: {
                responsive: true,
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
                }
            });
            }
            if ($('#ormawa-line').length) {
                var lineChartCanvas = $("#ormawa-line").get(0).getContext("2d");
                var data = {
                    labels: ["2013", "2014", "2014", "2015", "2016", "2017", "2018", "2019"],
                    datasets: [
                    {
                        label: 'Apple',
                        data: [120, 180, 140, 210, 160, 240, 180, 210],
                        borderColor: [
                        '#1d84c6'
                        ],
                        borderWidth: 3,
                        fill: false,
                        pointBackgroundColor: "#ffffff",
                        pointBorderColor: "#1d84c6"
                    },
                    {
                        label: 'Samsung',
                        data: [80, 140, 100, 170, 120, 200, 140, 170],
                        borderColor: [
                        '#00c2b2'
                        ],
                        borderWidth: 3,
                        fill: false,
                        pointBackgroundColor: "#ffffff",
                        pointBorderColor: "#00c2b2"
                    }
                    ]
                };
                var options = {
                    scales: {
                    yAxes: [{
                        gridLines: {
                        drawBorder: false,
                        borderDash: [3, 3]
                        },
                        ticks: {
                        min: 0
                        },
                    }],
                    xAxes: [{
                        gridLines: {
                        display: false,
                        drawBorder: false,
                        color: "#ffffff"
                        }
                    }]
                    },
                    elements: {
                    line: {
                        tension: 0.2
                    },
                    point: {
                        radius: 4
                    }
                    },
                    stepsize: 1
                };
                var lineChart = new Chart(lineChartCanvas, {
                    type: 'line',
                    data: data,
                    options: options
                });
            }
        });
        })(jQuery);
    </script>
@endsection