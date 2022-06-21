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
                        
                        <table id="bet_history_table" class="bet_history_table display table table-hover table-bordered" cellspacing="0" width="100%" style="font-size: 14px;">
                            <thead>
                                <tr>
                                    <th>Number</th>
                                    <th>User</th>
                                    <th>Game</th>
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

    </script>
@endsection
