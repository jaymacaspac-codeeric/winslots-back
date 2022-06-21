@extends('template.template')

@section('custom-css')
<link href="../assets/plugins/toast-master/css/jquery.toast.css" rel="stylesheet">
<link href="../assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />

<link href="{{ URL::asset('assets/plugins/jquery-treetable/jquery.treetable.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/jquery-treetable/jquery.treetable.theme.default.css') }}" rel="stylesheet">

<style>
    .agent-tree-table thead th {
        /* font-size: 12px; */
        word-break: keep-all;
        /* white-space: nowrap; */
        border: 1px solid #e3e6f0;
        border-bottom: 2px solid #e3e6f0;
        /* border: 1px solid #e9ecef !important; */
    }

    .agent-tree-table tbody td {
        font-size: 14px;
        word-break: keep-all;
        /* white-space: nowrap; */
        vertical-align: middle;
        padding: 0.25rem 0.45rem 0.25rem 0.45rem !important;
        border: 1px solid #e9ecef !important;
    }
</style>
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
                        {{-- <table id="agent_list_table" class="agent_history_table display table table-hover table-bordered" cellspacing="0" width="100%" style="font-size: 14px;">
                            <thead>
                                <tr>
                                    <th>번호</th>
                                    <th>Agent ID</th>
                                    <th>Rate</th>
                                    <th>Commision</th>
                                    <th>Balance</th>
                                    <th>Affiliated Agent</th>
                                    <th>Created at</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table> --}}
                        <table class="agent-tree-table table table-hover" id="treeTable">
                            <thead>
                                <tr>
                                    <th>Tier</th>
                                    <th>Agent ID</th>
                                    <th>Balance</th>
                                    <th>Rate</th>
                                    <th>Commision</th>
                                    <th>Player Count</th>
                                    <th>Player Balance</th>
                                    <th>Created at</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $agents as $agent )
                                    <tr data-tt-id="{{ $agent->agent_id }}" data-tt-parent-id="{{ $agent->parent }}">
                                        <td class="text-center">{{ $agent->level }}</td>
                                        <td><a href="{{ route('agent.info', $agent->agent_uname) }}">{{ $agent->agent_uname }}</a></td>
                                        <td>{{ $agent->balance }}</td>
                                        <td>{{ $agent->rate }}%</td>
                                        <td>{{ $agent->commission }}%</td>
                                        <td></td>
                                        <td></td>
                                        <td>{{ $agent->creation_date }}</td>
                                        <td>
                                            @if( $agent->status == 1 )
                                                <span class="badge badge-pill badge-info">Active</span>
                                            @else
                                                <span class="badge badge-pill badge-info">Blocked</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group" aria-label="Charge In / Out" style="color:#fff;">
                                                <a class="btn btn-info user-payment" data-toggle="modal" data-name="{{ $agent->agent_uname }}" data-target="#userChargeIn">충전</a>
                                                <a class="btn btn-danger user-collect" data-toggle="modal" data-name="{{ $agent->agent_uname }}" data-balance="{{ $agent->balance }}" data-target="#userChargeOut">회수</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
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
                            <label for="agent" class="col-sm-2 col-form-label">Affiliated Agent</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="agent">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="userid" class="col-sm-2 col-form-label">User ID</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="userid">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nickname" class="col-sm-2 col-form-label">Nickname</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nickname">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rate" class="col-sm-2 col-form-label">Rate</label>
                            <div class="col-sm-4 input-group">
                                <input type="text" class="form-control" id="rate">
                                <span class="input-group-addon">%</span>
                            </div>
                            <label for="commission" class="col-sm-2 col-form-label">Commision</label>
                            <div class="col-sm-4 input-group">
                                <input type="text" class="form-control" id="commission">
                                <span class="input-group-addon">%</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="memo" class="col-md-2 col-form-label">Memo</label>
                            <div class="col-md-10">
                                <textarea class="form-control" id="memo" rows="5"></textarea>
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
                        {!! csrf_field() !!}
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
@endsection

@section('custom-js')
    <script src="{{ URL::asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/toast-master/js/jquery.toast.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
    
    <script src="{{ URL::asset('assets/plugins/jquery-treetable/jquery.treetable.js') }}"></script>
    <script>
        var table = $('.agent-tree-table').DataTable({
                        "ordering": false,
                        "lengthChange": false
                    });
        
        // var table = $('#agent_list_table').DataTable({
        //     dom: 'Bfrtip',
        //     buttons: [
        //         'copy', 'excel', 'pdf', 'print'
        //     ],
        //     "bAutoWidth" : false,
        //     "ajax": {
        //         url: "{{ url('/agent-list') }}",
        //     },
        //     "columnDefs" : [ 
        //     {
        //         "targets": 1,
        //         'render': function(data, type, full, meta) {
        //             return full[1] + '<br><code>@' + full[2] + '</code>';
        //         }
        //     }, 
        //     {
        //         "targets": 2,
        //         'render': function(data, type, full, meta) {
        //             return full[3] + '%';
        //         }
        //     }, 
        //     {
        //         "targets": 3,
        //         'render': function(data, type, full, meta) {
        //             return full[4] + '%';
        //         }
        //     }, 
        //     {
        //         "targets": 4,
        //         'render': function(data, type, full, meta) {
        //             return full[5];
        //         }
        //     }, 
        //     {
        //         "targets": 5,
        //         'render': function(data, type, full, meta) {
        //             return full[7];
        //         }
        //     }, 
        //     {
        //         "targets": 6,
        //         'render': function(data, type, full, meta) {
        //             return full[8];
        //         }
        //     }, 
        //      {
        //         "targets": 7,
        //         'render': function(data, type, full, meta) {
        //         // return '<div style="width: 80px;color:#fff;"><a class="btn btn-info user-payment" data-toggle="modal" data-target="#userPayment" data-name="' + full[2] + '">충전</a></div>';
        //         return '<div class="btn-group" role="group" aria-label="Charge In / Out" style="color:#fff;">' +
        //                 '<a class="btn btn-info user-payment" data-toggle="modal" data-name=' + full['username'] + ' data-target="#userChargeIn">지급</a>' +
        //                 '<a class="btn btn-danger user-collect" data-toggle="modal" data-name=' + full['username'] + ' data-balance=' + full['balance'] + ' data-target="#userChargeOut">회수</a>' +
        //                 '</div>';
        //         }
        //     } 
        // ],
        //     "initComplete": function(settings, json) {

        //         }
        // });

        $("#treeTable").treetable({
            expandable: true,
            initialState: "collapsed",
            clickableNodeNames: true,
            indent: 20
        })
    </script>
@endsection
