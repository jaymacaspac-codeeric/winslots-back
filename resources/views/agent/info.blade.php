@extends('template.template')

@section('custom-css')
<link href="../assets/plugins/toast-master/css/jquery.toast.css" rel="stylesheet">
<link href="../assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
<style>
    .bet_history_table thead th {
        font-size: 14px;
        word-break: keep-all;
        /* white-space: nowrap; */
        border: 1px solid #e3e6f0;
        border-bottom: 2px solid #e3e6f0;
    }

    .bet_history_table td {
        font-size: 14px;
        word-break: keep-all;
        /* white-space: nowrap; */
        vertical-align: middle;
        padding: 0.25rem 0.45rem 0.25rem 0.45rem !important;
    }
    .user-betting-details table td {
        font-size: 14px;
        padding: 0.45rem !important;
        border-color: #b6d7f7;
    }
</style>
@endsection

@section('breadcrumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">User Info</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">User Info</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card">
                <div class="card-body">
                    <small class="text-muted">User Number </small>
                    <h6  class="user-number">
                        {{-- {{ $user_info['id'] }} --}}
                    </h6>
                    <small class="text-muted p-t-30 db">Username</small>
                    <h6 class="user-name">
                        {{-- {{ $user_info['username'] }} --}}
                    </h6>
                    <small class="text-muted p-t-30 db">Agent</small>
                    <h6 class="agent">
                        {{-- {{ $user_info['agent_id'] }} --}}
                    </h6>
                    <small class="text-muted p-t-30 db">Password</small>
                    <div class="input-group">
                        <input type="hidden" value="">
                        <input type="text" name="passw" class="form-control pw" placeholder="Password">
                        <a href="javascript:void(0)" class="input-group-addon btn btn-danger change-password"
                            style="color:#fff;"><i class="fa fa-refresh fa-spin password-loading"
                                style="display: none;"></i>&nbsp; <span class="check-label"> Change</span></a>
                    </div>
                    <small class="text-muted p-t-30 db">Last Login </small>
                    <h6 class="last-login">
                        {{-- {{ date("Y-m-d H:i", strtotime($user_info['last_access_at'])) }} --}}
                    </h6>
                    <small class="text-muted p-t-30 db">Created Date</small>
                    <h6 class="created-at">
                        {{-- {{ date("Y-m-d H:i", strtotime($user_info['created_at'])) }} --}}
                    </h6>
                    <small class="text-muted p-t-30 db">Holding Money</small>
                    <div>
                        <span class="font-weight-bold user-holding-money">
                            {{-- {{ number_format($user_info['balance'], 0) }} Pot --}}
                        </span>
                        <!-- <div class="btn-group" role="group" aria-label="Charge In / Out" style="color:#fff;">
                                    <a class="btn btn-info user-payment" data-toggle="modal" data-target="#userChargeIn">충전</a>
                                    <a class="btn btn-danger user-collect" data-toggle="modal" data-target="#userChargeOut">회수</a>
                                </div> -->
                    </div>

                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs profile-tab" role="tablist">
                    <!-- <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Timeline</a> </li> -->
                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#playerList" role="tab">Player List</a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#betHistory" role="tab">Bet History</a> </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="playerList" role="tabpanel">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table id="bet_history_table" class="bet_history_table display nowrap table table-hover table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Number</th>
                                                    <th>User</th>
                                                    <th>Balance</th>
                                                    <th>Points</th>
                                                    <th>Creation date</th>
                                                    <th>Last login</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--second tab-->
                    <div class="tab-pane" id="betHistory" role="tabpanel">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table id="bet_history_table" class="bet_history_table display nowrap table table-hover table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Number</th>
                                                    <th>User</th>
                                                    <th>Game</th>
                                                    <!-- <th>Amount Before</th> -->
                                                    <th>Betting Time</th>
                                                    <th>Processing Time</th>
                                                    <th>Bet Summary</th>
                                                    <th>Management</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>

    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">New User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form class="form p-t-20 create-user-form">
                        <div class="form-group">
                            <label for="exampleInputuname2">User Name*</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="ti-user"></i></div>
                                <input type="text" name="username" class="form-control username" placeholder="Username"
                                    required>
                                <a class="input-group-addon btn btn-warning check-user" style="color:#fff;"><i
                                        class="fa fa-refresh fa-spin username-loading" style="display: none;"></i>&nbsp;
                                    <span class="check-label"> Check</span></a>
                            </div>
                            <span class="help-block m-b-none text-danger text_user_chk" id="text_user_chk">중복된 사용자 이름 확인이
                                필요합니다.</span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputpwd2">Password*</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="ti-lock"></i></div>
                                <input type="password" name="password" autocomplete="off" class="form-control password"
                                    placeholder="Password" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputpwd2">Nickname*</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="ti-lock"></i></div>
                                <input type="text" name="nickname" class="form-control nickname" placeholder="Nickname"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail2">Email Address*</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="ti-email"></i></div>
                                <input type="email" name="email" class="form-control email" placeholder="Email Address" required>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary new_user">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="userChargeIn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">유저 머니 지급</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form class="form p-t-20">
                        <div class="form-group">
                            <label for="exampleInputuname2">지급 금액</label>
                            <div class="input-group">
                                <input type="text" name="amount" class="form-control payment-amount">
                                <div class="input-group-addon">Pot</div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary submit-recharge">지급</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="userChargeOut" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Collect Money</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form class="form p-t-20">
                        <div class="form-group">
                            <label for="exampleInputuname2">지급 금액</label>
                            <div class="input-group">
                                <input type="text" name="amount" class="form-control collect-amount">
                                <div class="input-group-addon">Pot</div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary submit-collect">지급</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="betDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Bet Details</h4>
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
@endsection

@section('custom-js')
    <script src="{{ URL::asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/toast-master/js/jquery.toast.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>

    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
    <script>

    </script>
@endsection
