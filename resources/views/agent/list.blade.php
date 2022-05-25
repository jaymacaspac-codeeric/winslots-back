@extends('template.template')

@section('custom-css')
<link href="../assets/plugins/toast-master/css/jquery.toast.css" rel="stylesheet">
<link href="../assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
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
                {{-- <div class="card-header">
                    Agent 
                    <div class="card-actions">
                        <button class="btn btn-outline-info waves-effect waves-light table-reload" type="button"> <i class="fa fa-refresh"></i> </button>
                        <!-- <a class="btn-minimize"><i class="fa fa-refresh"></i></a> -->
                    </div>
                </div> --}}
                <div class="card-body">
                    <div class="text-left">
                        <a class="btn btn-info m-b-10" data-toggle="modal" data-target="#agentModal" style="color:#fff;">Create Agent</a>
                    </div>

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

    <div class="modal fade" id="agentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Create an Agent</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal create-agent-form" role="form">
                        <input type="hidden" class="agent-id" value="">
                        <div class="form-group row">
                            <label for="inputHorizontalSuccess" class="col-sm-2 col-form-label">Affiliated Agent</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputHorizontalSuccess">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputHorizontalSuccess" class="col-sm-2 col-form-label">User ID</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputHorizontalSuccess">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputHorizontalWarning" class="col-sm-2 col-form-label">Nickname</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputHorizontalWarning">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputHorizontalDnger" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="inputHorizontalDnger">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputHorizontalDnger" class="col-sm-2 col-form-label">Rate</label>
                            <div class="col-sm-4 input-group">
                                <input type="text" class="form-control" id="inputHorizontalDnger">
                                <span class="input-group-addon">%</span>
                            </div>
                            <label for="inputHorizontalDnger" class="col-sm-2 col-form-label">Commision</label>
                            <div class="col-sm-4 input-group">
                                <input type="text" class="form-control" id="inputHorizontalDnger">
                                <span class="input-group-addon">%</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-month-input" class="col-md-2 col-form-label">Agent Type</label>
                            <div class="col-md-10">
                                <select class="custom-select col-12" id="inlineFormCustomSelect">
                                    <option selected="">Agent Type Selection...</option>
                                    <option value="1">Distribution</option>
                                    <option value="2">Operator</option>
                                    <option value="3">Parallel</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-month-input" class="col-md-2 col-form-label">Memo</label>
                            <div class="col-md-10">
                                <textarea class="form-control" id="inputHorizontalDnger" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn waves-effect waves-light btn-info">Save</button>
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
@endsection

@section('custom-js')
    <script src="{{ URL::asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/toast-master/js/jquery.toast.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>

    <script src="{{ URL::asset('custom/js/agent.js') }}"></script>

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
