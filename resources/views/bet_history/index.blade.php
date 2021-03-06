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
            <h3 class="text-themecolor">Bet History</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Bet History</li>
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
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="input-group-text">??????</span>
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
        var start = moment().subtract(14, 'days').format('YYYY-MM-DD');
        var end = moment().format('YYYY-MM-DD');
        
        $('.start-date').val(start);
        $('.end-date').val(end);

        $('.start-date').datepicker({
            format: 'yyyy-mm-dd',
            // startDate: '-14d',
            toggleActive: true,
            // todayHighlight: true
        }).on('changeDate', function(e) {
            start = $(this).val();
        });

        $('.end-date').datepicker({
            format: 'yyyy-mm-dd',
            toggleActive: true,
        }).on('changeDate', function(e) {
            end = $(this).val();
        });

        $('.search-by-date').on('click', function() {
            console.log(table);
            table.ajax.reload();
        });

        var table =
            $('#bet_history_table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy',
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LEGAL'
                    },
                    'excel', 'print'
                ],
                responsive: true,
                "order": [
                    [4, 'desc']
                ],
                // "ordering": false,
                "ajax": {
                    // "url": "{{ url('/bet-history/list') }}",
                    url: "https://api.honorlink.org/api/transaction-list-simple",
                    headers: {
                        'Authorization': 'Bearer Wq6U9iv5WErdYetknhvQ4d2Ke4OB36LKaxeDY5yD',
                    },
                    type: 'GET',
                    "data"   : function( d ) {
                        d.start     = start + ' 00:00:00';
                        d.end       = end + ' 23:59:59';
                        d.page      = '1';
                        d.perPage   = '1000';
                    },
                    "dataSrc": function (json) {
                        const chunk = (arr, size) =>
                                        Array.from({ length: Math.ceil(arr.length / size) }, (v, i) =>
                                            arr.slice(i * size, i * size + size)
                                        );
                        return chunk(json['data'], 2);
                    }
                },
                "columnDefs": [{
                        "targets": [0, 1, 2, 5, 6],
                        "orderable": false
                    },
                    {
                        "targets": 0,
                        "render": function(data, type, full, meta) {
                            return full[0]['id'];
                        }
                    },
                    {
                        "targets": 1,
                        "render": function(data, type, full, meta) {
                            return full[0]['user']['username'];
                        }
                    },
                    {
                        "targets": 2,
                        "render": function(data, type, full, meta) {
                            return '<span class="badge badge-pill badge-success" title="Vendor">' + full[0]['details']['game']['vendor'] +
                                '</span> <span class="badge badge-pill badge-info" title="Game Type">' + full[0]['details']['game']['type'] + '</span></br><b>' + full[0]['details']['game']['title'] + '</b></br>' +
                                '<code title="Game ID" style="font-size: 80%">' + full[0]['details']['game']['id'] +
                                '</code></br><code title="Game Round" style="font-size: 80%">' + full[0]['details']['game']['round'] +
                                '</code>';
                        }
                    },
                    {
                        "targets": 3,
                        "render": function(data, type, full, meta) {
                            return moment(full[0]['processed_at']).add(1, 'hour').format("YYYY-MM-DD HH:mm:ss");
                        }
                    },
                    {
                        "targets": 4,
                        'render': function(data, type, full, meta) {
                            return moment(full[1]['processed_at']).add(1, 'hour').format("YYYY-MM-DD HH:mm:ss");
                        }
                    },
                    {
                        "targets": 5,
                        'render': function(data, type, full, meta) {
                            return '<div class="user-betting-details"><table class=table-bet><tbody>' +
                                '<tr>' +
                                '<td>Bet Amount</td>' +
                                '<td class="text-right">' + Math.abs(full[0]['amount']) + '<code> Pot</code></td>' +
                                '</tr>' +
                                '<tr>' +
                                '<td>Winning Amount</td>' +
                                '<td class="text-right">' + full[1]['amount'] + ' Pot</td>' +
                                '</tr>' +
                                '<tr>' +
                                '<td>Profit and Loss</td>' +
                                '<td class="text-right">' + (full[0]['amount'] - full[1]['amount']) + '<code> Pot</code></td>' +
                                '</tr>' +
                                '</tbody</table></div>';
                        }
                    },
                    {
                        "targets": 6,
                        "className": 'text-center',
                        'render': function(data, type, full, meta) {
                            if (full[10] != 'slot') {
                                return '<button type="button" data-id="' + full[0]['id'] + '" data-name="' + full[0]['user']['username'] +
                                    '" data-toggle="modal" data-target="#betDetails" class="btn waves-effect waves-light btn-sm btn-info">Details</button>';
                            } else {
                                return 'No details available.';
                            }
                        }
                    }
                ],
                "initComplete": function(settings, json) {
                    // var cnt = table.ajax.json()['aaData'].length;

                    // if (table.ajax.json()['aaData'].length == 0) {
                    //     $('.dataTables_empty').text('[Too Many Request] ????????? ?????? ?????? ???????????? API??? ?????? ?????? ??? ????????????.30??? ?????? ????????? ????????????.');
                    //     setTimeout(reload, 30000);
                    // }

                    function reload() {
                        table.ajax.reload();
                    }
                }
            });

            $('#betDetails').on('show.bs.modal', function(e) {
                var username = $(e.relatedTarget).data('name');
                var id = $(e.relatedTarget).data('id');

                $.ajax({
                    url: "https://api.honorlink.org/api/transaction-detail",
                    headers: {
                        'Authorization': 'Bearer Wq6U9iv5WErdYetknhvQ4d2Ke4OB36LKaxeDY5yD',
                    },
                    type: 'GET',
                    data: {
                        'id': id
                    },
                    beforeSend: function() {

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR.status);
                        $('#betDetails').modal('hide');
                        swal("Failed", "?????? ????????? ????????? ????????? ??????????????????.", "error");
                    },
                    success: function(data, textStatus, xhr) {
                        // var data = $.parseJSON(data);
                        var details = data;
                        var status_code = data['status_code'];
                        console.log(data);
                        if (jQuery.isEmptyObject(details) && status_code == 200) {
                            console.log('empty');
                            $('#betDetails').modal('hide');
                            swal("Failed", "??????????????? 4~6??? ?????? ??????????????? ???????????????. ????????? ?????? ?????? ???????????? ????????????", "error");
                        } else if (status_code == 400) {
                            $('#betDetails').modal('hide');
                            swal("Failed", "?????? ????????? ????????? ????????? ??????????????????.", "error");
                        } else if(("message" in details)) {
                            console.log('need to request per second');
                            $('#betDetails').modal('hide');
                            swal("Failed", "Need to request per second.", "error");
                        } else if (details != null && status_code == 200 && !("message" in details)) {
                            // console.log(details);
                            var stake = details['data']['participants'][0]['bets'][0]['stake'];
                            var payout = details['data']['participants'][0]['bets'][0]['payout'];
                            var allocation = (payout != 0) ? (payout / stake).toFixed(2) : '0.00';

                            var card_result = '';
                            if(details['data']['gameType'] == 'baccarat') {
                                var banker_cards = '';
                                var player_cards = '';
                                var banker_details = details['data']['result']['banker']['cards'];
                                var player_details = details['data']['result']['player']['cards'];
                                for(var i = 0; i < banker_details.length; i++) {
                                    banker_cards += '<img class="card-result" src="../assets/images/cards/'+banker_details[i]+'.png" style="width: 80px;margin: 10px;">';
                                };
                                for(var i = 0; i < player_details.length; i++) {
                                    player_cards += '<img class="card-result" src="../assets/images/cards/'+player_details[i]+'.png" style="width: 80px;margin: 10px;">';
                                };

                                card_result = '<div class="card card-outline-info">' +
                                '<div class="card-header">' +
                                '<h4 class="m-b-0 text-white">Game Result</h4>' +
                                '</div>' +
                                '<div class="ca*rd-body">' +
                                '<table class="table table-bordered">' +
                                '<tbody>' +
                                '<tr>' +
                                '<td>Banker (Score: '+details['data']['result']['banker']['score']+')</td>' +
                                '<td>Player (Score: '+details['data']['result']['player']['score']+')</td>' +
                                '</tr>' +
                                '<tr>' +
                                '<td>'+banker_cards+'</td>' +
                                '<td>'+player_cards+'</td>' +
                                '</tr>' +
                                '<tr>' +
                                '<td>Result</td>' +
                                '<td>'+details['data']['result']['outcome']+'</td>' +
                                '</tr>' +
                                '</tbody>' +
                                '</table>' +
                                '</div>' +
                                '</div>';
                            } else if(details['data']['gameType'] == 'dragontiger') {
                                card_result = '<div class="card card-outline-info">' +
                                '<div class="card-header">' +
                                '<h4 class="m-b-0 text-white">Game Result</h4>' +
                                '</div>' +
                                '<div class="ca*rd-body">' +
                                '<table class="table table-bordered">' +
                                '<tbody>' +
                                '<tr>' +
                                '<td>Dragon (Score: '+details['data']['result']['dragon']['score']+')</td>' +
                                '<td>Tiger (Score: '+details['data']['result']['tiger']['score']+')</td>' +
                                '</tr>' +
                                '<tr>' +
                                '<td><img class="card-result" src="../assets/images/cards/'+details['data']['result']['dragon']['card']+'.png" style="width: 80px;margin: 10px;"></td>' +
                                '<td><img class="card-result" src="../assets/images/cards/'+details['data']['result']['tiger']['card']+'.png" style="width: 80px;margin: 10px;"></td>' +
                                '</tr>' +
                                '<tr>' +
                                '<td>Result</td>' +
                                '<td>'+details['data']['result']['outcome']+'</td>' +
                                '</tr>' +
                                '</tbody>' +
                                '</table>' +
                                '</div>' +
                                '</div>';
                            }

                            var tbl_information = '<div class="card card-outline-info">' +
                                '<div class="card-header">' +
                                '<h4 class="m-b-0 text-white">Table Information</h4>' +
                                '</div>' +
                                '<div class="ca*rd-body">' +
                                '<table class="table table-bordered">' +
                                '<tr>' +
                                '<td>User</td><td>' + username + '</td>' +
                                '</tr>' +
                                '<tr>' +
                                '<td>Game Company</td><td>' + details['data']['gameProvider'] + '</td>' +
                                '</tr>' +
                                '<tr>' +
                                '<td>Dealer</td><td>' + details['data']['dealer']['name'] + '</td>' +
                                '</tr>' +
                                '<tr>' +
                                '<td>Table</td><td>' + details['data']['table']['name'] + '</td>' +
                                '</tr>' +
                                '<tr>' +
                                '<td>Start Time</td><td>' + moment(details['data']['startedAt']).format('YYYY-MM-DD hh:mm:ss') + '</td>' +
                                '</tr>' +
                                '<tr>' +
                                '<td>Status</td><td>' + details['data']['status'] + '</td>' +
                                '</tr>' +
                                '</table>' +
                                '</div>' +
                                '</div>' +
                                '<div class="card card-outline-info">' +
                                '<div class="card-header">' +
                                '<h4 class="m-b-0 text-white">User Betting</h4>' +
                                '</div>' +
                                '<div class="ca*rd-body">' +
                                '<table class="table table-bordered">' +
                                '<thead>' +
                                '<tr>' +
                                '<td>Betting Pick</td>' +
                                '<td>Allocation</td>' +
                                '<td>Bet Amount</td>' +
                                '<td>Winning Ammount</td>' +
                                '<td>Betting Time</td>' +
                                '</tr>' +
                                '</thead>' +
                                '<tbody>' +
                                '<tr>' +
                                '<td>' + details['data']['participants'][0]['bets'][0]['description'] + '</td>' +
                                '<td>x' + allocation + '</td>' +
                                '<td>' + stake + '</td>' +
                                '<td>' + payout + '</td>' +
                                '<td>' + moment(details['data']['participants'][0]['bets'][0]['placedOn']).format('YYYY-MM-DD hh:mm:ss') + '</td>' +
                                '</tr>' +
                                '</tbody>' +
                                '</table>' +
                                '</div>' +
                                '</div>'+
                                card_result;

                            $('#betDetails .modal-body').append(tbl_information);
                        }
                    }
                })
            });

            $('#betDetails').on('hidden.bs.modal', function() {
                $('#betDetails .modal-body').html("");
            });
    </script>
@endsection
