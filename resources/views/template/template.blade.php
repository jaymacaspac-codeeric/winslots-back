<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="cache-control" content="private, max-age=0, no-cache">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('assets/images/logo/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('assets/images/logo/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('assets/images/logo/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ URL::asset('assets/images/logo/site.webmanifest') }}">
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/logo/favicon.ico') }}">
    <title>WINSLOTS</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ URL::asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- morris CSS -->
    <link href="{{ URL::asset('assets/plugins/morrisjs/morris.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('css/iziToast.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/iziModal.min.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/custom.css') }}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{ URL::asset('css/colors/blue.css') }}" id="theme" rel="stylesheet">

    <link href="{{ URL::asset('css/template.css') }}" id="theme" rel="stylesheet">

    @yield('custom-css')
</head>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> 
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header" style="background: none;">
                    <a class="navbar-brand" href="{{ url('/dashboard') }}">
                            <img src="{{ URL::asset('/assets/images/logo.png') }}" class="dark-logo" width="50px" />
                        <span >
                            <b class="admin-page">Admin Page</b>
                        </span></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        

                        @if(session('admin_type') == 2)
                            <li class="nav-item m-t-10">
                                <a href="javascript:void(0)" data-iziModal-open="#depositModal1" class="btn btn-outline-success waves-effect waves-light text-white m-l-20 request-deposit"><i class="fa fa-download"></i> Deposit</a>
                                {{-- <a href="javascript:void(0)" data-toggle="modal" data-target="#depositModal" class="btn btn-outline-success waves-effect waves-light text-white m-l-20 request-deposit"><i class="fa fa-download"></i> Deposit</a> --}}
                                <a href="javascript:void(0)" class="btn btn-outline-warning waves-effect waves-light text-white m-l-20 request-withdrawal"><i class="fa fa-upload"></i> Withdraw</a>
                            </li>
                        @endif
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-message"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <div class="dropdown-menu mailbox animated slideInUp">
                                <ul>
                                    <li>
                                        <div class="drop-title">Notifications</div>
                                    </li>
                                    <li>
                                        <div class="message-center">
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="btn btn-danger btn-circle"><i class="fa fa-link"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>Luanch Admin</h5> <span class="mail-desc">Just see the my new admin!</span> <span class="time">9:30 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="btn btn-success btn-circle"><i class="ti-calendar"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>Event today</h5> <span class="mail-desc">Just a reminder that you have event</span> <span class="time">9:10 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="btn btn-info btn-circle"><i class="ti-settings"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>Settings</h5> <span class="mail-desc">You can customize this template as you want</span> <span class="time">9:08 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="btn btn-primary btn-circle"><i class="ti-user"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li> --}}
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-email"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <div class="dropdown-menu mailbox animated slideInUp" aria-labelledby="2">
                                <ul>
                                    <li>
                                        <div class="drop-title">You have 4 new messages</div>
                                    </li>
                                    <li>
                                        <div class="message-center">
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="user-img"> <img src="../assets/images/users/1.jpg" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:30 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="user-img"> <img src="../assets/images/users/2.jpg" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5>Sonu Nigam</h5> <span class="mail-desc">I've sung a song! See you at</span> <span class="time">9:10 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="user-img"> <img src="../assets/images/users/3.jpg" alt="user" class="img-circle"> <span class="profile-status away pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5>Arijit Sinh</h5> <span class="mail-desc">I am a singer!</span> <span class="time">9:08 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="user-img"> <img src="../assets/images/users/4.jpg" alt="user" class="img-circle"> <span class="profile-status offline pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center" href="javascript:void(0);"> <strong>See all e-Mails</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li> --}}
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- Language -->
                        <!-- ============================================================== -->
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flag-icon flag-icon-us"></i></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up"> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-in"></i> India</a> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-fr"></i> French</a> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-cn"></i> China</a> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-de"></i> Dutch</a> </div>
                        </li> -->

                        {{-- @yield('agent-info') --}}
                        <li>
                            <div class="d-flex m-t-10 justify-content-end">
                                <div class="d-flex m-l-10 hidden-md-down">
                                    <div class="chart-text m-r-10">
                                        <span class="m-b-0 text-white" style="font-size: 12px;">현재 보유 금액</span>
                                        <h4 class="m-t-0 text-warning text-right"><span class="badge badge-success"><span class="total-holding-balance">
                                            {{-- {{ number_format($balance, 0) }}
                                        </span> Pot</span> --}}
                                        0 Pot
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
                                        <span class="m-b-0 text-white" style="font-size: 12px;">하부 에이전트 현재 총 보유 금액</span>
                                        <h4 class="m-t-0 text-warning text-right"><span class="badge badge-success"><span class="total-agent-holding-balance">
                                            0 Pot
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
                                        0 Pot
                                        </h4>
                                    </div>
                                    <div class="spark-chart">
                                        <div id="monthchart"></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <div class="topbar-divider d-none d-lg-block"></div>

                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ URL::asset('assets/images/users/1.jpg') }}" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img src="{{ URL::asset('assets/images/users/1.jpg') }}" alt="user"></div>
                                            <div class="u-text">
                                                <h4>{{ session('username') }}</h4>
                                                <p class="text-muted">varun@gmail.com</p><a href="pages-profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#"><i class="ti-user"></i> My Profile</a></li>
                                    <li><a href="#"><i class="ti-wallet"></i> My Balance</a></li>
                                    <li><a href="#"><i class="ti-email"></i> Inbox</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="{{ route('account.settings') }}"><i class="ti-settings"></i> Account Setting</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="{{ url('/logout') }}"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                            <li class="{{ (request()->is('dashboard')) ? 'active' : '' }}"> <a href="{{ url('/dashboard') }}" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard </span></a> </li>
                        <li class="nav-small-cap">Manage User</li>
                            <!-- <li class=""> <a href="deposit_request.php"><i class="mdi mdi-gamepad-variant"></i><span class="hide-menu">Deposit Request </span></a> </li>
                            <li class=""> <a href="#"><i class="mdi mdi-gamepad-variant"></i><span class="hide-menu">Withdrawal Request </span></a> </li> -->
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Players</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li class="{{ (request()->is('user*')) ? 'active' : '' }}"> <a href="{{ url('/user-list') }}">Active Players</a> </li>
                                <li class="{{ (request()->is('user*')) ? 'active' : '' }}"> <a href="{{ url('/') }}">For Approval</a> </li>
                                <li class="{{ (request()->is('user*')) ? 'active' : '' }}"> <a href="{{ url('/') }}">Deactivated</a> </li>
                            </ul>
                        </li>

                        @if($admin->admin_type == 1)
                        <li class="{{ (request()->is('payment*')) ? 'active' : '' }}"> <a href="{{ route('payment.index') }}"><i class="mdi mdi-credit-card-multiple"></i><span class="hide-menu">Payment Method </span></a> </li>
                        {{-- <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-credit-card-multiple"></i><span class="hide-menu">Payment Gateways </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li class="{{ (request()->is('payment*')) ? 'active' : '' }}"> <a href="#"><span class="hide-menu">Automatic Gateways </span></a> </li>
                                <li class="{{ (request()->is('payment*')) ? 'active' : '' }}"> <a href="{{ route('payment.index') }}"><span class="hide-menu">Payment Method </span></a> </li>
                            </ul>
                        </li> --}}
                        @endif
                            
                            {{-- <li class="{{ (request()->is('user*')) ? 'active' : '' }}"> <a href="{{ url('/user-list') }}"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Player List </span></a> </li> --}}
                            <li class="{{ (request()->is('bet*')) ? 'active' : '' }}"> <a href="{{ url('/bet-history') }}"><i class="mdi mdi-gamepad-variant"></i><span class="hide-menu">Betting History </span></a> </li>
                        {{-- <li class="nav-small-cap">Admin</li> --}}
                            <!-- <li class=""> <a href="admin.php"><i class="mdi mdi-account-box"></i><span class="hide-menu">Admin List </span></a> </li> -->
                            <li class="{{ (request()->is('transaction*')) ? 'active' : '' }}"> <a href="{{ url('/transaction') }}"><i class="mdi mdi-account-box"></i><span class="hide-menu">Transaction History </span></a> </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-network"></i><span class="hide-menu">Agents</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li class="{{ (request()->is('agent*')) ? 'active' : '' }}"> <a href="{{ url('/agent') }}">Agent List</a> </li>
                                <li class="{{ (request()->is('agent*')) ? 'active' : '' }}"> <a href="{{ url('/create-agent') }}">Create Agent</a> </li>
                            </ul>
                        </li>

                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                            <i class="mdi mdi-download"></i>
                            <span class="hide-menu">
                            Deposits
                            @if($pending_deposits_count > 0)
                                <span class="label label-danger">!</span>
                            @endif
                            </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li class="{{ (request()->is('deposit*')) ? 'active' : '' }}"> <a href="{{ route('deposit.pending') }}">Pending Deposits 
                                    @if($pending_deposits_count > 0)
                                        <span class="label label-danger">{{ $pending_deposits_count }}</span>
                                    @endif</a> </li>
                                <li class="{{ (request()->is('deposit*')) ? 'active' : '' }}"> <a href="#">Approved Deposits</a> </li>
                                <li class="{{ (request()->is('deposit*')) ? 'active' : '' }}"> <a href="#">Rejected Deposits</a> </li>
                                <li class="{{ (request()->is('deposit*')) ? 'active' : '' }}"> <a href="#">Deposits Log</a> </li>
                            </ul>
                        </li>

                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-upload"></i><span class="hide-menu">Withdrawals</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li class=""> <a href="#">Pending Withdrawals</a> </li>
                                <li class=""> <a href="#">Approved Withdrawals</a> </li>
                                <li class=""> <a href="#">Rejected Withdrawals</a> </li>
                                <li class=""> <a href="#">Withdrawals Log</a> </li>
                            </ul>
                        </li>

                        {{-- <li class="nav-small-cap">Reports</li>
                            <li class=""> <a href="#"><i class="mdi mdi-cash"></i><span class="hide-menu">Transaction History </span></a> </li>
                            <li class=""> <a href="#"><i class="mdi mdi-credit-card-multiple"></i><span class="hide-menu">Deposits </span></a> </li>
                            <li class=""> <a href="#"><i class="mdi mdi-credit-card-multiple"></i><span class="hide-menu">Withdrawals </span></a> </li>
                            <li class="{{ (request()->is('commission*')) ? 'active' : '' }}"> <a href="{{ route('commission.index') }}"><i class="mdi mdi-cash"></i><span class="hide-menu">Commissions </span></a> </li> --}}
                        
                        <li class="nav-small-cap">Settings</li>
                        @if($admin->admin_type == 1)
                            <li class="{{ (request()->is('settings*')) ? 'active' : '' }}"> <a href="{{ route('settings.general') }}"><i class="mdi mdi-settings"></i><span class="hide-menu">General Settings </span></a> </li>
                        @endif
                            <li class="{{ (request()->is('account*')) ? 'active' : '' }}"> <a href="{{ route('account.settings') }}"><i class="mdi mdi-account-settings-variant"></i><span class="hide-menu">Account Settings </span></a> </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            @yield('breadcrumb')
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid content-card">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                @yield('content')

                <!-- Row -->
                <div id="depositModal1" class="iziModal" data-izimodal-title="Deposit Request - Rate: <span class='badge badge-danger'>{{ $rate }}%</span>">
                    <div class="">

                        <form class="form-horizontal request-deposit-form" role="form">
                            {!! csrf_field() !!}
                            <input type="hidden" class="exchangeRate" value="{{ $rate }}">
                            
                            <span>STEP 1: Select a Deposit Method</span>

                            <div class="radio-tile-group text-center row m-b-20 m-t-20">
                                @foreach ($paymentMethod as $method)
                                    <div class="input-container col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <input id="{{ $method->code }}" class="radio-button" type="radio" name="method" data-id="{{ $method->id }}" data-name="{{ $method->name }}" data-img="{{ $method->image }}" data-params="{{ $method->parameter }}" value="{{ $method->name }}" />
                                        <div class="radio-tile">
                                            <img src="{{ URL::asset('assets/images/gateway') }}/{{ $method->image }}" class="method-logo">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            <span>STEP 2: Select a Deposit Amount</span>

                            <div class="radio-tile-group text-center row m-t-20">
                                <div class="input-container col-sm-3">
                                    <input id="100000" class="radio-button" type="radio" name="amount" value="100000" />
                                    <div class="radio-tile">
                                        <div class="icon walk-icon">

                                        </div>
                                        <label for="100000" class="radio-tile-label">100,000</label>
                                    </div>
                                </div>
                            
                                <div class="input-container col-sm-3">
                                    <input id="500000" class="radio-button" type="radio" name="amount" value="500000" />
                                    <div class="radio-tile">
                                        <div class="icon bike-icon">
                                            
                                        </div>
                                        <label for="500000" class="radio-tile-label">500,000</label>
                                    </div>
                                </div>

                                <div class="input-container col-sm-3">
                                    <input id="1000000" class="radio-button" type="radio" name="amount" value="1000000" />
                                    <div class="radio-tile">
                                        <div class="icon bike-icon">
                                            
                                        </div>
                                        <label for="1000000" class="radio-tile-label">1,000,000</label>
                                    </div>
                                </div>
                                <div class="input-container col-sm-3">
                                    <input id="10000000" class="radio-button" type="radio" name="amount" value="10000000" />
                                    <div class="radio-tile">
                                        <div class="icon bike-icon">
                                            
                                        </div>
                                        <label for="10000000" class="radio-tile-label">10,000,000</label>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-horizontal">
                                        <div class="form-group row m-t-20">
                                            <label for="chargeamount" class="col-sm-4 control-label text-left">Request POT</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" name="deposit_charge_amount" class="form-control deposit_charge_amount" id="chargeamount" required>
                                                    {{-- <input type="number" name="deposit_charge_amount" id="chargeamount" class="form-control deposit_charge_amount" required="" data-validation-required-message="This field is required" aria-invalid="false"> --}}

                                                    <div class="input-group-addon">POT</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="cashamount" class="col-sm-4 control-label text-left">Amount</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" name="deposit_amount" id="cashamount" class="form-control deposit_amount" required>

                                                    {{-- <div class="input-group-addon"><i class="fa fa-usd"></i></div> --}}
                                                    <div class="input-group-addon">KRW</div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        {{-- <div class="form-group row">
                                            <label for="exchangeRateForDisplay" class="col-sm-4 col-form-label text-left">Rate 
                                                <span class="label label-danger">{{ $rate }}%</span>
                                            </label>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="text-center" style="display: block !important">
                        <div class="text-white">
                            <a class="btn btn-info submit-request-deposit text-white">
                                <i class="fa fa-download"></i>
                                Deposit
                            </a>
                        </div>
                        {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
                    </div>
                </div>

                <div id="depositAddressModal1" class="iziModal1" data-izimodal-title="Deposit Request">
                    <div class="modal-body">
                        <div><span class="payment-amount text-primary"></span> </div>

                            <div class="payment-container row">
                                <div class="col-lg-6 col-xs-6">
                                    <div class="coint-img">
                                        <img src="" class="deposit-method-img">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-6">
                                    <div class="qrcode-container text-center">
                                        <div class="qrcode" id="qrcode" style="width:150px; height:150px; margin:15px auto;"></div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
									<div class="crypto-address-container text-center">
						                <span class="crypto-address" id="crypto-address"></span><br/>
                                        <button type="button" class="btn waves-effect waves-light btn-warning copy-clipboard">Copy Address</button>
						            </div>	
								</div>

                                <div class="col-lg-12 col-lg-12">
									<div class="payment-amount-container text-center">
                                            
						            </div>	
								</div>
                            </div>

                            <div class="address-container row text-center">

                            </div>
                    </div>
                </div>

                <div class="modal fade in" id="withdrawModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel1">Withdraw</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer"> WINSLOTS © 2022 </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ URL::asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ URL::asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{  URL::asset('js/jquery.slimscroll.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ URL::asset('js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ URL::asset('js/sidebarmenu.js') }}"></script>
    <!--stickey kit -->
    <script src="{{ URL::asset('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ URL::asset('js/custom.min.js') }}"></script>
    <script src="{{ URL::asset('js/iziToast.min.js') }}"></script>
    <script src="{{ URL::asset('js/iziModal.min.js') }}"></script>
    <!-- <script src="js/login.js"></script> -->
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->

    <!--morris JavaScript -->
    <script src="{{ URL::asset('assets/plugins/raphael/raphael-min.js') }}"></script>
    
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="{{ URL::asset('assets/plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>
    <script src="{{ URL::asset('js/qrcode.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/df-number-format/2.1.6/jquery.number.min.js"></script>

    <script>
    $.ajaxSetup({
        headers: {
            'Authorization': 'Bearer Wq6U9iv5WErdYetknhvQ4d2Ke4OB36LKaxeDY5yD'
        }
    });
       $.ajax({
            url: "https://api.honorlink.org/api/my-info",
            type: 'GET',
            success: function(data) {
                $('.total-holding-balance').text(parseInt(data['balance']).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + ' Pot');
            }
        });

        $.ajax({
            url: "https://api.honorlink.org/api/user-list",
            type: 'GET',
            success: function(data) {
                var total = data.reduce(function(sum, current) {
                    return sum + current.balance;
                }, 0);

                $('.total-user-holding-balance').text(total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + ' Pot');
            }
        });

        // function calcAmount() {
        //     var rate_amount = parseFloat(deposit_amount * (rate / 100)); 
        //     $('.deposit_amount').val(rate_amount);

        //     var test = parseFloat(deposit_amount / (rate / 100));
        //     $('.deposit_charge_amount').val(deposit_amount);
        // }

        var deposit_amount = $('input[name="amount"]:checked').val();
        var deposit_method = $('input[name="method"]:checked').val();
        var payment_amount = 0;

        var rate = $('.exchangeRate').val();

        $(document).on('change', 'input:radio[name="amount"]', function() {
            deposit_amount = parseFloat($('input[name="amount"]:checked').val());
            var rate_amount = parseFloat(deposit_amount * (rate / 100)); 
            $('.deposit_amount').val($.number(rate_amount));

            var test = parseFloat(deposit_amount / (rate / 100));
            payment_amount = rate_amount;
            $('.deposit_charge_amount').val($.number(deposit_amount));
        });

        $(document).number(true).on('input', '.deposit_charge_amount', function() {
            $('input:radio[name="amount"]').prop("checked", false);
            var charge_amount = $(this).val();
            //convert KRW to USD
            var toKRW = charge_amount * (rate / 100);
            payment_amount = toKRW;
            console.log(toKRW);
            // var toUSD = toKRW / 1257.15;
            // console.log($.number(toUSD, 2));
            $('.deposit_amount').val($.number(toKRW));
        });

        $(document).number(true).on("input", '.deposit_amount', function() {
            $('input:radio[name="amount"]').prop("checked", false);
            var res = $(this).val() / (rate / 100);
            // console.log(test);
            $('.deposit_charge_amount').val($.number(res));
            // console.log($.number(test, 2) * 1257.15);
        });

        $(document).on('change', 'input:radio[name="method"]', function() {
            deposit_method = $('input[name="method"]:checked').val();
            console.log(deposit_method);
        });

        $(document).on('click', '.submit-request-deposit',function() {
            var deposit_request_amount_val = $('.deposit_charge_amount');
            var deposit_amount_val = $('.deposit_amount');

            if(deposit_method == undefined || deposit_method == '') {
                iziToast.error({
                    message: 'Please select cryptocurrency.',
                    position: "topCenter",
                    timeout: 3000
                });
            }

            if(deposit_amount == undefined || deposit_amount == '' || deposit_request_amount_val == '' || deposit_amount_val == '') {
                iziToast.error({
                    message: 'Please input amount.',
                    position: "topCenter",
                    timeout: 3000
                });
            }

            if(deposit_method != '' && deposit_method != undefined && deposit_amount != '' && deposit_amount != undefined && deposit_request_amount_val != '' && deposit_amount_val != '') {
                $('#depositModal1').iziModal('close');
                $('#depositAddressModal1').iziModal('open');
            }
        });

        $('#depositModal').on('hidden.bs.modal', function() {
            $('input:radio[name="method"]').prop("checked", false);
            $('input:radio[name="amount"]').prop("checked", false);
            $('.deposit_amount').val('');
            $('.deposit_charge_amount').val('');
            deposit_amount = '';
            deposit_method = '';
        });

        $('#depositAddressModal').on('hidden.bs.modal', function() {
            $('.crypto-address').html("");
            qrcode.clear();
            payment_amount = 0;
        });

        $(document).on('click', '.copy-clipboard', function(){
            var r = document.createRange();
            r.selectNode(document.getElementById("crypto-address"));
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(r);
            try {
                document.execCommand('copy');
                window.getSelection().removeAllRanges();
            } catch (err) {
                console.log('Unable to copy');
            }
        });

        $(".iziModal").iziModal({
            width: 700,
            radius: 5,
            padding: 20,
            headerColor: '#238bf7',
            zindex: 999,
            onClosed: function(){
                $('input:radio[name="method"]').prop("checked", false);
                $('input:radio[name="amount"]').prop("checked", false);
                $('.deposit_amount').val('');
                $('.deposit_charge_amount').val('');
                deposit_amount = '';
                deposit_method = '';
            },
        });

        $(".iziModal1").iziModal({
            width: 700,
            radius: 5,
            padding: 20,
            headerColor: '#238bf7',
            zindex: 999,
            overlayClose: false,
            onOpening: function(modal) {
                modal.startLoading();
                $('.qrcode').html("");
                $.ajax({
                    url: "{{ route('deposit.request') }}",
                    type: 'POST',
                    data: $('.request-deposit-form').serialize(),
                    success: function(data) {
                        console.log(data);
                        // $('#depositModal').modal('toggle');
                        var params = $('input[name="method"]:checked').data('params');
                        var img = $('input[name="method"]:checked').data('img');

                        $(".deposit-method-img").attr("src", "{{ URL::asset('assets/images/gateway') }}" + '/'+img);
                        $('.crypto-address').html(params);
                        // 
                        // $('#depositAddressModal').modal('show');
                        $('.payment-amount').html(payment_amount + ' KRW');
                        var qrcode = new QRCode("qrcode", {
                                    width: 150,
                                    height: 150,
                                    colorDark : "#000000",
                                    colorLight : "#ffffff",
                                    correctLevel : QRCode.CorrectLevel.H
                                });
                        qrcode.makeCode(params); 

                        modal.stopLoading();
                    }
                });
            },
            onOpened: function() {
            },
            onClosed: function() {
                $('.crypto-address').html("");
                payment_amount = 0;
            },
            afterRender: function() {
   
            }
        });

    </script>
    @if(session()->has('notify'))
        @foreach(session('notify') as $msg)
            <script> 
                "use strict";
                iziToast.{{ $msg[0] }}({message:"{{ __($msg[1]) }}", position: "topRight"}); 
            </script>
        @endforeach
    @endif

    @if ($errors->any())
    @php
        $collection = collect($errors->all());
        $errors = $collection->unique();
    @endphp

    <script>
        "use strict";
        @foreach ($errors as $error)
            iziToast.error({
                message: '{{ __($error) }}',
                position: "topRight",
                timeout: 3000
            });
        @endforeach
    </script>
    @endif

    <script>
        "use strict";
        function notify(status,message) {
            iziToast[status]({
                message: message,
                position: "topRight"
            });
        }
    </script>

    @yield('custom-js')

</body>

</html>