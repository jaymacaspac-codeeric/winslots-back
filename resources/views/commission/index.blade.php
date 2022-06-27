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
    {{-- <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Pending Deposits</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Pending Deposits</li>
            </ol>
        </div>
    </div> --}}
@endsection

@section('content')
    <div class="row m-b-20">
        <div class="col-lg-6 col-sm-6">
            <h6 class="page-title">Commissions</h6>
        </div>
        <div class="col-lg-6 col-sm-6 text-right text-sm-right">
                {{-- <a class="btn btn-sm btn btn-info" href="{{ route('payment.create') }}">
                    <i class="fa fa-fw fa-plus"></i>Add New
                </a> --}}
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="gateway_table" class="gateway_table display table table-hover table-bordered" cellspacing="0" width="100%" style="font-size: 14px;">
                            <thead>
                                <tr>
                                    <th>Player</th>
                                    <th>Game ID</th>
                                    <th>Game Type</th>
                                    <th>Vendor</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Bet Summary</th>
                                    <th>Commision</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
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
        var table = $('#gateway_table').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'print'
            ],
            "bAutoWidth" : true,
            "ajax": {
                url: "{{ route('commission.bet') }}",
                type: 'GET',
                "dataSrc": function (json) {
                    return json;
                }
            },
            "columnDefs" : [
            {
                "targets": 0,
                'render': function(data, type, full, meta) {
                    console.log(full);
                    return full['username'];
                }
            }, {
                "targets": 6,
                'render': function(data, type, full, meta) {
                    
                    return '<div class="user-betting-details"><table class=table-bet><tbody>' +
                                '<tr>' +
                                '<td>Bet Amount</td>' +
                                '<td class="text-right">' + Math.abs(full['amount']) + '<code> Pot</code></td>' +
                                '</tr>' +
                                '<tr>' +
                                '<td>Winning Amount</td>' +
                                '<td class="text-right">' + full['win_amount'] + ' Pot</td>' +
                                '</tr>' +
                                '<tr>' +
                                '<td>Result</td>' +
                                '<td class="text-right">' + (parseInt(full['amount']) + parseInt(full['win_amount'])) + '<code> Pot</code></td>' +
                                '</tr>' +
                                '</tbody</table></div>';
                }
            }, {
                "targets": 7,
                'render': function(data, type, full, meta) {
                    return full['username'];
                }
            },
        ],
            "initComplete": function(settings, json) {


            }
        });


    </script>
@endsection
