@extends('template.template')

@section('agent-info')
<li>
    <div class="d-flex m-t-10 justify-content-end">
        <div class="d-flex m-l-10 hidden-md-down">
            <div class="chart-text m-r-10">
                <span class="m-b-0 text-white" style="font-size: 12px;">현재 보유 금액</span>
                <h4 class="m-t-0 text-warning text-right"><span class="badge badge-success"><span class="total-holding-balance">
                    {{-- {{ number_format($balance, 0) }}
                </span> Pot</span> --}}
            </h4>
            </div>
            <div class="spark-chart">
                <div id="monthchart"></div>
            </div>
        </div>
    </div>
</li>
<div class="topbar-divider d-none d-lg-block"></div>
<li>
    <div class="d-flex m-t-10 justify-content-end">
        <div class="d-flex m-l-10 hidden-md-down">
            <div class="chart-text m-r-10">
                <span class="m-b-0 text-white" style="font-size: 12px;">하부 유저 현재 총 보유 금액</span>
                <h4 class="m-t-0 text-warning text-right"><span class="badge badge-success"><span class="total-user-holding-balance">
                    {{-- {{ number_format($totalBalance), 0 }}
                </span> Pot</span> --}}
            </h4>
            </div>
            <div class="spark-chart">
                <div id="monthchart"></div>
            </div>
        </div>
    </div>
</li>
<div class="topbar-divider d-none d-lg-block"></div>
@endsection

@section('breadcrumb')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Dashboard</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <!-- Row -->
                <div class="row">
                    <div class="col-8"><h6 class="dashboard-card-label">Total User</h6>
                        <span class="dashboard-card-data dashboard-user-count">
                            {{-- {{ $user_count }} --}}
                        </span>
                    </div>
                    <div class="col-4 align-self-center text-right  p-l-0 fa fa-users dashboard-icon"> </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <!-- Row -->
                <div class="row">
                    <div class="col-8"><h6 class="dashboard-card-label">현재 보유 금액</h6>
                        <span class="dashboard-card-data dashboard-total-balance">
                            {{-- {{ number_format($balance, 0) }} Pot --}}
                        </span>
                    </div>
                    <div class="col-4 align-self-center text-right  p-l-0 fa fa-money dashboard-icon"> </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <!-- Row -->
                <div class="row">
                    <div class="col-8"><h6 class="dashboard-card-label">Number of Bets Today</h6>
                        <span class="dashboard-card-data">
                            {{-- <?= $bet_data['total_bets_today'] ?> --}}
                            {{ $total_today_bets }}
                        </span>
                    </div>
                    <div class="col-4 align-self-center text-right  p-l-0 fa fa-gamepad dashboard-icon"> </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <!-- Row -->
                <div class="row">
                    <div class="col-8"><h6 class="dashboard-card-label">Number of Users Betting Today</h6>
                        <span class="dashboard-card-data">
                            {{-- <?= $bet_data['users_betting_today'] ?> --}}
                            {{ $total_today_betting }}
                        </span>
                    </div>
                    <div class="col-4 align-self-center text-right  p-l-0 fa fa-gamepad dashboard-icon"> </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-js')
<script>
       $.ajax({
            url: "https://api.honorlink.org/api/my-info",
            headers: {
                'Authorization': 'Bearer Wq6U9iv5WErdYetknhvQ4d2Ke4OB36LKaxeDY5yD',
            },
            type: 'GET',
            success: function(data) {
                $('.dashboard-total-balance').text(data['balance'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + ' Pot');
            }
        });
        $.ajax({
            url: "https://api.honorlink.org/api/user-list",
            headers: {
                'Authorization': 'Bearer Wq6U9iv5WErdYetknhvQ4d2Ke4OB36LKaxeDY5yD',
            },
            type: 'GET',
            success: function(data) {
                $('.dashboard-user-count').text(data.length);
            }
        });
</script>
@endsection