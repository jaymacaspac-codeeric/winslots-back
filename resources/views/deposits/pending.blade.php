@extends('template.template')

@section('custom-css')
<link href="../assets/plugins/toast-master/css/jquery.toast.css" rel="stylesheet">
<link href="../assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">

<style>
    .bet_history_table thead th {
        /* font-size: 12px; */
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
            <h3 class="text-themecolor">Pending Deposits</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Pending Deposits</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Pending Deposits
                    <div class="card-actions">
                        <button class="btn btn-outline-info waves-effect waves-light table-reload" type="button"> <i class="fa fa-refresh"></i> </button>
                        <!-- <a class="btn-minimize"><i class="fa fa-refresh"></i></a> -->
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="input-group-text">기간</span>
                                    </div>
                                    <input type="text" class="form-control start-date" value="" placeholder="yyyy-mm-dd">
                                    <span class="input-group-addon bg-info b-0 text-white">to</span>
                                    <input type="text" class="form-control end-date" value="" placeholder="yyyy-mm-dd">
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <a class="btn btn-info m-b-10 text-white search-by-date">Search</a>
                            </div>
                        </div>
                        
                        <table id="pending_deposit" class="pending_deposit display table table-hover table-bordered" cellspacing="0" width="100%" style="font-size: 14px;">
                            <thead>
                                <tr>
                                    <th>Transaction No.</th>
                                    <th>User</th>
                                    <th>Request Amount</th>
                                    <th>Payable</th>
                                    <th>User Type</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="viewPendingDepositModal" class="viewPendingDepositModal" >
        <div class="modal-body">
            <ul class="list-group">

                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Status                                                            
                    <span class="badge badge-pill bg--success">Active</span>
                </li>

                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Rate                            
                    <span class="font-weight-bold">100.00 USD</span>
                </li>

                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Commission                         
                    <span class="font-weight-bold"><a href="https://localhost/Lottery/admin/user/tickets/1"> 0 Tickets</a></span>
                </li>

                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Total Buy Ticket in Amount                            
                    <span class="font-weight-bold"><a href="https://localhost/Lottery/admin/user/tickets/1"> 0 USD</a></span>
                </li>

                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Total Win Ticket                            
                    <span class="font-weight-bold"><a href="https://localhost/Lottery/admin/user/wins/1"> 0 Tickets</a></span>
                </li>

                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Total Win Bonus                            
                    <span class="font-weight-bold"><a href="https://localhost/Lottery/admin/user/wins/1"> 0 USD</a></span>
                </li>

                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Referred By                            
                    <span class="font-weight-bold"> none </span>
                </li>

                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Total Referral                            
                    <span class="font-weight-bold"><a href="https://localhost/Lottery/admin/user/referrals/1"> 0</a> </span>
                </li>

                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Total Referral Commissions                            
                    <span class="font-weight-bold"><a href="https://localhost/Lottery/admin/user/commissions/deposit/1"> 0 USD </a></span>
                </li>
            </ul>
        </div>
    </div>
@endsection

@section('custom-js')
    <script src="{{ URL::asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/toast-master/js/jquery.toast.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
    <script>
        var table = $('#pending_deposit').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'print'
            ],
            "bAutoWidth" : true,
            "ajax": {
                url: "{{ route('deposit.pending.list') }}",
                type: 'GET',
                "dataSrc": function (json) {
                    return json;
                }
            },
            "columnDefs" : [
            {
                "targets": 0,
                'render': function(data, type, full, meta) {
                    return full['transaction_id'];
                }
            },
            {
                "targets": 1,
                'render': function(data, type, full, meta) {
                    var user = '';
                    if(full['user_type'] == 2) {
                        user = full['agent_uname']
                    } else {
                        user = full['player_name']
                    }
                    return user;
                }
            },
            {
                "targets": 2,
                'render': function(data, type, full, meta) {
                    return full['request_amount'];
                }
            },
            {
                "targets": 3,
                'render': function(data, type, full, meta) {
                    return full['krw_amount'] + ' KRW';
                }
            },
            {
                "targets": 4,
                'render': function(data, type, full, meta) {
                    var user_type = '';
                    if(full['user_type'] == 2) {
                        user_type = '<span class="label label-info">Agent</span>';
                    } else {
                        user_type = '<span class="label label-success">Player</span>';
                    }
                    return user_type;
                }
            },
            {
                "targets": 5,
                'render': function(data, type, full, meta) {
                    return moment(full['created_at']).format("YYYY-MM-DD hh:mm");
                }
            },
            {
                "targets": 6,
                'render': function(data, type, full, meta) {
                    var datauser = '';
                    if(full['user_type'] == 2) {
                        datauser = full['agent_uname']
                    } else {
                        datauser = full['player_name']
                    }
                    return '<a href="javascript:void(0)" class="btn btn-info waves-effect waves-light btn-sm viewDeposit" data-user="'+ datauser +'" data-id="'+ full['id'] +'"> <i class="fa fa-desktop"></i> </a>';
                }
            }
        ],
            "initComplete": function(settings, json) {
                $(document).on('click', '.viewDeposit', function() {
                    console.log('click');
                    $('#viewPendingDepositModal').iziModal('open', {

                    });

                    $('#viewPendingDepositModal').iziModal('setTitle', 'asdasd');

                });
            }
        });

        $(".viewPendingDepositModal").iziModal({
            // title: 'asdasd',
            width: 700,
            radius: 5,
            padding: 20,
            headerColor: '#238bf7',
            zindex: 999,
            onOpening: function(){

            },
        });
    </script>
@endsection
