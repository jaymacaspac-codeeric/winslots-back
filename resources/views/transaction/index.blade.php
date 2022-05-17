@extends('template.template')

@section('custom-css')
<link href="../assets/plugins/toast-master/css/jquery.toast.css" rel="stylesheet">
<link href="../assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
<style>
    .bet_history_table thead th {
        /* font-size: 12px; */
        word-break: keep-all;
        /* white-space: nowrap; */
        border: 1px solid #e3e6f0;
        border-bottom: 2px solid #e3e6f0;
    }

    .bet_history_table tbody td {
        font-size: 14px;
        word-break: keep-all;
        /* white-space: nowrap; */
        vertical-align: middle;
        padding: 0.25rem 0.45rem 0.25rem 0.45rem !important;
    }
    .user-betting-details table tbody td {
        font-size: 14px;
        padding: 0.45rem !important;
        border-color: #b6d7f7;
    }
</style>
@endsection

@section('agent-info')
    <li>
        <div class="d-flex m-t-10 justify-content-end">
            <div class="d-flex m-l-10 hidden-md-down">
                <div class="chart-text m-r-10">
                    <span class="m-b-0 text-white" style="font-size: 12px;">현재 보유 금액</span>
                    <h4 class="m-t-0 text-warning text-right"><span class="badge badge-success"><span class="total-holding-balance"> {{ number_format($balance, 0) }} </span> Pot</span></h4>
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
                    <h4 class="m-t-0 text-warning text-right"><span class="badge badge-success"><span class="total-user-holding-balance"> {{ number_format($totalBalance), 0 }} </span> Pot</span></h4>
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
            <h3 class="text-themecolor">User List</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">User List</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Bet History
                    <div class="card-actions">
                        <button class="btn btn-outline-info waves-effect waves-light table-reload" type="button"> <i class="fa fa-refresh"></i> </button>
                        <!-- <a class="btn-minimize"><i class="fa fa-refresh"></i></a> -->
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="transaction_history_table" class="transaction_history_table display table table-hover table-bordered" cellspacing="0" width="100%" style="font-size: 14px;">
                            <thead>
                                <tr>
                                    <th>번호</th>
                                    <th>대상자 (에이전트/유저)</th>
                                    <th>타입</th>
                                    <th>변동 전 잔액</th>
                                    <th>변동 금액</th>
                                    <th>변동 후 잔액</th>
                                    <th>처리 시각</th>
                                    <th>상태</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
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
            // $.ajax({
            //     url: '{{ url('/transaction/list') }}',
            //     type: 'GET',
            //     data: {
            //         "cmd" : "get_transaction_history",
            //         "start":  "2022-05-01 11:18:52" // static date
            //     },
            //     beforeSend: function() {

            //     },
            //     success: function(data) {
            //         console.log(data);
            //     }
            // });

            var table =
                $('#transaction_history_table').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'excel', 'pdf', 'print'
                    ],
                    responsive: true,
                    "order": [[ 0, "desc" ]],
                    "ajax": {
                        "url": "{{ url('/transaction/list') }}",
                        // "type": "POST",
                        // "data" : {
                        //     "cmd" : "get_transaction_history",
                        //     "start":  "2022-05-05 11:18:52" // static date
                        // }
                    },
                    "columnDefs": [
                        {
                            "targets": 2,
                            "render": function(data, type, full, meta) {
                                var result = '';
                                if(data == 'User money recharge') {
                                    result = '<span class="text-primary font-light">'+ data + '</span>'
                                } else {
                                    result = '<span class="text-danger font-light">'+ data + '</span>'
                                }
                                return result;
                            }
                        },
                        {
                            "targets": 3,
                            "render": function(data, type, full, meta) {
                                return data + ' Pot';
                            }
                        },
                        {
                            "targets": 4,
                            'render': function(data, type, full, meta) {
                                var result = '';
                                if(data > 0) {
                                    result = '<span class="text-primary">'+ data + ' Pot</span>'
                                } else {
                                    result = '<span class="text-danger">'+ data + ' Pot</span>'
                                }
                                return result;
                            }
                        },
                        {
                            "targets": 5,
                            'render': function(data, type, full, meta) {
                                return data + ' Pot';
                            }
                        },
                        {
                            "targets": 6,
                            'render': function(data, type, full, meta) {
                                return moment(data).add(1, 'hour').format("YYYY-MM-DD hh:mm");
                            }
                        },
                        {
                            "targets": 7,
                            'render': function(data, type, full, meta) {
                                var result = '';
                                if(data == 'success') {
                                    result = '<span class="label label-success">done</span>';
                                } else {
                                    result = '<span class="label label-danger">'+data+'</span>';
                                }
                                return result;
                            }
                        }
                        
                    ]
                });
    </script>
@endsection
