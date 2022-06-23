@extends('template.template')

@section('custom-css')
    <style>
        .dashboard-w1:hover {
            transform: translateY(-3px);
            -webkit-transform: translateY(-3px);
            -moz-transform: translateY(-3px);
            -ms-transform: translateY(-3px);
            -o-transform: translateY(-3px);
        }
        .dashboard-w1 {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            min-height: 130px;
            justify-content: flex-end;
            overflow: hidden;
            transition: all 0.3s;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            -ms-transition: all 0.3s;
            -o-transition: all 0.3s;
            position: relative;
            align-items: center;
            padding: 30px 20px;
        }
        .dashboard-w1 .icon {
            position: absolute;
            bottom: 0;
            left: 0;
        }
        .dashboard-w1 .icon i {
            font-size: 72px;
            color: rgba(255, 255, 255, 0.15);
            margin-left: -15px;
            margin-bottom: -4px;
        }
        .dashboard-w1 .details {
            text-align: right;
        }
        .dashboard-w1 .details .status, .dashboard-w1 .details .amount, .dashboard-w1 .details .currency-sign {
            color: #ffffff;
            font-size: 24px;
            font-weight: 500;
            line-height: 1;
        }
        .dashboard-w1 .details .desciption span {
            color: #ffffff;
            font-weight: 300;
            display: inline-block;
            margin-top: 5px;
        }

        .widget-three {
            padding: 10px 30px;
            text-align: center;
            -webkit-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
        }
        
        .widget-three__icon {
            width: 80px;
            height: 80px;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            overflow: hidden;
        }

        .widget-three__icon i {
            font-size: 46px;
            color: #ffffff;
        }

        .widget-three__content {
            margin-top: 20px;
        }

        .widget-three__content .numbers {
            font-size: 24px;
            font-weight: 600;
        }

        .b-radius--rounded {
            border-radius: 50% !important;
            -webkit-border-radius: 50% !important;
            -moz-border-radius: 50% !important;
            -ms-border-radius: 50% !important;
            -o-border-radius: 50% !important;
        }

        .widget-three:hover {
            -webkit-transform: scale(1.05, 1.05);
            -ms-transform: scale(1.05, 1.05);
            transform: scale(1.05, 1.05);
        }

        .widget-card-three {
            -webkit-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
        }

        .widget-card-three:hover {
            -webkit-transform: scale(1.05, 1.05);
            -ms-transform: scale(1.05, 1.05);
            transform: scale(1.05, 1.05);
        }

        .b-radius--5 {
            border-radius: 5px !important;
            -webkit-border-radius: 5px !important;
            -moz-border-radius: 5px !important;
            -ms-border-radius: 5px !important;
            -o-border-radius: 5px !important;
        }

        .text--small {
            font-size: 0.75rem !important;
            margin-bottom: 0 !important;
        }

        .bg--white {
            background-color: #ffffff !important;
        }
        .bg--primary {
            background-color: #7367f0 !important;
        }
        .bg--warning {
            background-color: #ff9f43 !important;
        }
        .bg--cyan {
            background-color: #00BCD4 !important;
        }
        .bg--deep-purple {
            background-color: #673AB7 !important;
        }
        .bg--teal {
            background-color: #009688 !important;
        }
    </style>
@endsection

@section('breadcrumb')
    {{-- <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Dashboard</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
    </div> --}}
@endsection

@section('content')
<div class="row m-b-20">
    <div class="col-lg-6 col-sm-6">
        <h6 class="page-title">Dashboard</h6>
    </div>
</div>
<div class="row m-b-20">
    <!-- Column -->
    <div class="col-lg-12">
        <!-- TradingView Widget BEGIN -->
        <div class="tradingview-widget-container">
            <div class="tradingview-widget-container__widget"></div>
            <div class="tradingview-widget-copyright"></div>
            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
                {
                    "symbols": [
                        {
                            "proName": "COINBASE:BTCUSD",
                            "title": "BTC/USD"
                        },
                        {
                            "proName": "COINBASE:ETHUSD",
                            "title": "ETH/USD"
                        },
                        {
                            "description": "USDT/USD",
                            "proName": "COINBASE:USDTUSD"
                        },
                        {
                            "description": "BCH/USD",
                            "proName": "COINBASE:BCHUSD"
                        },
                        {
                            "description": "USD/KRW",
                            "proName": "FX_IDC:USDKRW"
                        }
                    ],
                    "colorTheme": "light",
                    "showSymbolLogo": true,
                    "displayMode": "adaptive",
                    "locale": "en"
                }
            </script>
        </div>
        <!-- TradingView Widget END -->
    </div>
    <div class="col-lg-3 col-md-6 m-b-10">
        <div class="dashboard-w1 bg--primary b-radius--10 box-shadow rounded">
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="amount dashboard-card-data dashboard-user-count">
                        {{-- 0 --}}
                        {{ $total_players ?? 0 }}
                    </span>
                </div>
                <div class="desciption">
                    <span class="text--small">Total Players</span>
                </div>
                <a href="{{ route('user.list') }}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">View All</a>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="col-lg-3 col-md-6 m-b-10">
        <div class="dashboard-w1 bg--deep-purple b-radius--10 box-shadow rounded">
            <div class="icon">
                <i class="fa fa-money"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="amount dashboard-card-data dashboard-total-partners">
                        {{-- 0 --}}
                        {{ $total_agents ?? 0 }}
                    </span>
                </div>
                <div class="desciption">
                    <span class="text--small">Total Agents</span>
                </div>
                <a href="{{ route('agent.index') }}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">View All</a>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="col-lg-3 col-md-6 m-b-10">
        <div class="dashboard-w1 bg--cyan b-radius--10 box-shadow rounded">
            <div class="icon">
                <i class="fa fa-gamepad"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="amount dashboard-card-data dashboard-total-bets">
                        {{ $total_bets_today ?? 0 }}
                    </span>
                </div>
                <div class="desciption">
                    <span class="text--small">Number of Bets Today</span>
                </div>
                <a href="{{ route('bet.index') }}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">View All</a>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="col-lg-3 col-md-6 m-b-10">
        <div class="dashboard-w1 bg--teal b-radius--10 box-shadow rounded">
            <div class="icon">
                <i class="fa fa-user-o"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="amount dashboard-card-data dashboard-total-user-bets">
                        {{ $total_player_betting ?? 0 }}
                    </span>
                </div>
                <div class="desciption">
                    <span class="text--small">Number of Users Betting Today</span>
                </div>
                <a href="{{ route('bet.index') }}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">View All</a>
            </div>
        </div>
    </div>

    {{-- <div class="col-lg-3 col-md-6">
        <div class="dashboard-w1 bg--primary b-radius--10 box-shadow rounded">
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="amount">0</span>
                </div>
                <div class="desciption">
                    <span class="text--small">Total Users</span>
                </div>
                <a href="#" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">View All</a>
            </div>
        </div>
    </div> --}}
</div>
<div class="row m-b-10">
    <div class="col-xl-6 col-lg-6 col-md-6">
        <div class="card text-center">
            {{-- <div class="card-header"> --}}
            {{-- </div> --}}
            <div class="card-body">
                <h4 class="card-title m-b-10">Hourly Profit and Loss</h4>
                {{-- <div class="profit-loss" id="profit-loss"></div> --}}
                <div>
                    <canvas id="todayProfitChart" height="135px"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6 col-lg-6 col-md-6 m-b-10">
        <div class="row m-b-10">
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="card card-inverse card-primary widget-card-three">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="m-r-20 align-self-center">
                                <h1 class="text-white"><i class="ti-pie-chart"></i></h1></div>
                            <div>
                                <h3 class="card-title">Total Deposit</h3>
                                <h6 class="card-subtitle">March 2017</h6> </div>
                        </div>
                        <div class="row">
                            <div class="col-12 p-t-10 p-b-20 align-self-center">
                                {{-- <h2 class="font-light text-white">{{ number_format($total_deposits['amount']) }} Pot</h2> --}}
                                <h2 class="font-light text-white">{{ number_format($total_deposits['krw_amount'], 2) }} KRW</h2>
                                {{-- <h2 class="font-light text-white">{{ number_format($total_deposits['usd_amount']) }} USD</h2> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="card card-inverse card-info widget-card-three">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="m-r-20 align-self-center">
                                <h1 class="text-white"><i class="ti-pie-chart"></i></h1></div>
                            <div>
                                <h3 class="card-title">Total Withdraw</h3>
                                <h6 class="card-subtitle">March 2017</h6> </div>
                        </div>
                        <div class="row">
                            <div class="col-12 p-t-10 p-b-20 align-self-center">
                                <h2 class="font-light text-white">$14,000</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row m-b-10">
            <div class="col-xl-6 col-lg-6 col-md-6 m-b-10">
                <div class="widget-three box--shadow2 b-radius--5 bg--white">
                    <div class="widget-three__icon b-radius--rounded bg--primary  box--shadow2">
                        <i class="fa fa-download"></i>
                    </div>
                    <div class="widget-three__content">
                        <h2 class="numbers">{{ $pending_deposits ?? 0 }}</h2>
                        <p class="text--small">Pending Deposit</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 m-b-10">
                <div class="widget-three box--shadow2 b-radius--5 bg--white">
                    <div class="widget-three__icon b-radius--rounded bg--warning  box--shadow2">
                        <i class="fa fa-upload"></i>
                    </div>
                    <div class="widget-three__content">
                        <h2 class="numbers">{{ $pending_withdrawals ?? 0 }}</h2>
                        <p class="text--small">Pending Withdrawals</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row m-b-20">
    <div class="col-lg-3 col-md-6 m-b-10">
        <div class="card text-center">
            {{-- <div class="card-header"> --}}
            {{-- </div> --}}
            <div class="card-body">
                <h4 class="card-title m-b-10">Top 5 Game Type preference by user (Monthly)</h4>
                <div class="top-game-type" id="top-game-type"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-js')
    <!--sparkline JavaScript -->
    <script src="{{ URL::asset('assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/morrisjs/morris.min.js') }}"></script>
    {{-- <script src="{{ URL::asset('assets/plugins/Chart.js/Chart.min.js') }}"></script> --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    //    $.ajax({
    //         url: "https://api.honorlink.org/api/my-info",
    //         headers: {
    //             'Authorization': 'Bearer Wq6U9iv5WErdYetknhvQ4d2Ke4OB36LKaxeDY5yD',
    //         },
    //         type: 'GET',
    //         success: function(data) {
    //             $('.dashboard-total-balance').text(parseInt(data['balance']).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + ' Pot');
    //         }
    //     });

        // $.ajax({
        //     url: "https://api.honorlink.org/api/user-list",
        //     headers: {
        //         'Authorization': 'Bearer Wq6U9iv5WErdYetknhvQ4d2Ke4OB36LKaxeDY5yD',
        //     },
        //     type: 'GET',
        //     success: function(data) {
        //         $('.dashboard-user-count').text(data.length);
        //     }
        // });

        $.ajax({
            url: "{{ route('profit.loss') }}",
            type: 'GET',
            success: function(d) {
                console.log(d);
                var progress = d,
                hash = Object.create(null),
                profitData = [];
                
                progress.forEach(function (a) {
                    var key = a.processed_at.slice(11, 13);
                    if (!hash[key]) {
                        hash[key] = { profit: 0, time: key + ':00' };
                        // grouped.push(hash[key]);
                        profitData[key + ':00'] = hash[key];
                    }
                    hash[key].profit += parseInt(Math.abs(a.amount)) - parseInt(a.win_amount);
                });

                profitData.sort(function (a, b) {
                    return a.time.localeCompare(b.time);
                });

                let chartData = {
                    "00:00": - (profitData['00:00']?.profit != undefined) ? profitData['00:00']?.profit : 0,
                    "01:00": - (profitData['01:00']?.profit != undefined) ? profitData['01:00']?.profit : 0,
                    "02:00": - (profitData['02:00']?.profit != undefined) ? profitData['02:00']?.profit : 0,
                    "03:00": - (profitData['03:00']?.profit != undefined) ? profitData['03:00']?.profit : 0,
                    "04:00": - (profitData['04:00']?.profit != undefined) ? profitData['04:00']?.profit : 0,
                    "05:00": - (profitData['05:00']?.profit != undefined) ? profitData['05:00']?.profit : 0,
                    "06:00": - (profitData['06:00']?.profit != undefined) ? profitData['06:00']?.profit : 0,
                    "07:00": - (profitData['07:00']?.profit != undefined) ? profitData['07:00']?.profit : 0,
                    "08:00": - (profitData['08:00']?.profit != undefined) ? profitData['08:00']?.profit : 0,
                    "09:00": - (profitData['09:00']?.profit != undefined) ? profitData['09:00']?.profit : 0,
                    "10:00": - (profitData['10:00']?.profit != undefined) ? profitData['10:00']?.profit : 0,
                    "11:00": - (profitData['11:00']?.profit != undefined) ? profitData['11:00']?.profit : 0,
                    "12:00": - (profitData['12:00']?.profit != undefined) ? profitData['12:00']?.profit : 0,
                    "13:00": - (profitData['13:00']?.profit != undefined) ? profitData['13:00']?.profit : 0,
                    "14:00": - (profitData['14:00']?.profit != undefined) ? profitData['14:00']?.profit : 0,
                    "15:00": - (profitData['15:00']?.profit != undefined) ? profitData['15:00']?.profit : 0,
                    "16:00": - (profitData['16:00']?.profit != undefined) ? profitData['16:00']?.profit : 0,
                    "17:00": - (profitData['17:00']?.profit != undefined) ? profitData['17:00']?.profit : 0,
                    "18:00": - (profitData['18:00']?.profit != undefined) ? profitData['18:00']?.profit : 0,
                    "19:00": - (profitData['19:00']?.profit != undefined) ? profitData['19:00']?.profit : 0,
                    "20:00": - (profitData['20:00']?.profit != undefined) ? profitData['20:00']?.profit : 0,
                    "21:00": - (profitData['21:00']?.profit != undefined) ? profitData['21:00']?.profit : 0,
                    "22:00": - (profitData['22:00']?.profit != undefined) ? profitData['22:00']?.profit : 0,
                    "23:00": - (profitData['23:00']?.profit != undefined) ? profitData['23:00']?.profit : 0,
                }

                // setup 
                const data = {
                    labels: Object.keys(chartData),
                    datasets: [{
                        label: "Profit and Loss",
                        data: Object.values(chartData),
                        backgroundColor: function(context) {
                            const chart = context.chart;
                            const { ctx, chartArea, scales } = chart;

                            if(!chartArea) {
                                return null;
                            }

                            return getGradient( ctx, chartArea, scales );
                        },
                        // borderColor: 'white',
                        borderColor: [
                            'rgba(54, 162, 235, 1)'
                        ],
                        tension: 0.1,
                        fill: true
                    }]
                };

                let width, height, gradient;
                function getGradient(ctx, chartArea, scales) {
                    const chartWidth = chartArea.right - chartArea.left;
                    const chartHeight = chartArea.bottom - chartArea.top;

                    if(gradient === null || width !== chartWidth || height !== chartHeight) {
                        const pointzero = scales.y.getPixelForValue(0);
                        const pointzeroheight = pointzero - chartArea.top;
                        const pointzeroPercentage = pointzeroheight / chartHeight;

                        width = chartWidth;
                        height = chartHeight;
                        gradient = ctx.createLinearGradient(0, chartArea.top, 0, chartHeight + chartArea.top);
                        gradient.addColorStop(pointzeroPercentage, 'rgba(0, 255, 90, 0.5)');
                        gradient.addColorStop(pointzeroPercentage, 'rgba(255, 0, 0, 0.5)');
                    }

                    return gradient;
                }

                // config 
                const config = {
                    type: 'line',
                    data,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                };

                var ctx1 = document.getElementById("todayProfitChart").getContext("2d");
                const myChart = new Chart(ctx1,config);
            }
        });

        Morris.Donut({
        element: 'top-game-type',
        data: [
                {
                    label: "Orders",
                    value: 8500,
                }, {
                    label: "Pending",
                    value: 3630,
                }, {
                    label: "Delivered",
                    value: 4870
                }, {
                    label: "Delivered",
                    value: 48
                }, {
                    label: "Delivered",
                    value: 470
                }
            ],
            resize: true,
            colors:['#26c6da', '#1976d2', '#ef5350']
        });
</script>
@endsection