@extends('template.template')

@section('custom-css')
<link href="../assets/plugins/toast-master/css/jquery.toast.css" rel="stylesheet">
<link href="../assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
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
            <div class="text-left m-b-10">
                <a class="btn btn-warning" data-toggle="modal" data-target="#userModal" style="color:#fff;">Create User</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="user_list_table" class="display nowrap table table-hover table-striped table-bordered"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>번호</th>
                                    <th>소속 에이전트</th>
                                    <th>유저</th>
                                    <th>현재 보유금</th>
                                    <th>현재 보유포인트</th>
                                    <th>가입 시각</th>
                                    <th>최근 접속 시각</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">New User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form class="form p-t-20 create-user-form">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="exampleInputuname2">User Name*</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="ti-user"></i></div>
                                <input type="text" name="username" class="form-control username" placeholder="Username" required>
                                <a class="input-group-addon btn btn-warning check-user" style="color:#fff;">
                                    <i class="fa fa-refresh fa-spin username-loading" style="display: none;"></i>&nbsp;
                                    <span class="check-label"> Check</span>
                                </a>
                            </div>
                            <span class="help-block m-b-none text-danger text_user_chk" id="text_user_chk">중복된 사용자 이름 확인이필요합니다.</span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputpwd2">Password*</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="ti-lock"></i></div>
                                <input type="password" name="password" autocomplete="off" class="form-control password" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputpwd2">Nickname*</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="ti-lock"></i></div>
                                <input type="text" name="nickname" class="form-control nickname" placeholder="Nickname" required>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <label for="exampleInputEmail2">Email Address*</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="ti-email"></i></div>
                                <input type="email" name="email" class="form-control email" placeholder="Email Address" required>
                            </div>
                        </div> --}}

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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
    <div class="modal fade" id="userChargeOut" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Collect Money</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form class="form p-t-20">
                        {!! csrf_field() !!}
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

        $.ajaxSetup({
            headers: {
                'Authorization': 'Bearer Wq6U9iv5WErdYetknhvQ4d2Ke4OB36LKaxeDY5yD',
                'Access-Control-Allow-Origin': 'https://api.honorlink.org/api'
            }
        });

        var table = $('#user_list_table').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'print',
                // {
                //     text: 'Create User',
                //     action: function ( e, dt, node, config ) {
                //         $('#userModal').modal('show');
                //     }
                // }
            ],
            "bAutoWidth" : false,
            "ajax": {
                url: "https://api.honorlink.org/api/user-list",
                // headers: {
                //     'Authorization': 'Bearer Wq6U9iv5WErdYetknhvQ4d2Ke4OB36LKaxeDY5yD'
                // },
                type: 'GET',
                "dataSrc": function (json) {
                    return json;
                }
            },
            "columnDefs" : [
            {
                "targets": 0,
                'render': function(data, type, full, meta) {
                    // console.log(full)
                    return full['id'];
                }
            }, {
                "targets": 1,
                'render': function(data, type, full, meta) {
                    return full['agent_id'];
                }
            }, 
            {
                "targets": 2,
                'render': function(data, type, full, meta) {
                    return '<a href="{{ url('user-list') }}/'+ full['username']+'">' + full['username'] + '</a>';
                }
            }, {
                "targets": 3,
                'render': function(data, type, full, meta) {
                    return full['balance'] + " Pot";
                }
            }, {
                "targets": 4,
                'render': function(data, type, full, meta) {
                    return full['point'] + " P";
                }
            }, {
                "targets": 5,
                'render': function(data, type, full, meta) {
                    // return full['created_at'];
                    return moment(full['created_at']).add(1, 'hour').format('YYYY-DD-MM HH:mm');
                }
            }, {
                "targets": 6,
                'render': function(data, type, full, meta) {
                    return full['last_access_at'] != null ? moment(full['last_access_at']).add(1, 'hour').format('YYYY-DD-MM HH:mm') : "";
                }
            }, {
                "targets": 7,
                'render': function(data, type, full, meta) {
                    // return '<div style="width: 80px;color:#fff;"><a class="btn btn-info user-payment" data-toggle="modal" data-target="#userPayment" data-name="' + full[2] + '">충전</a></div>';
                    return '<div class="btn-group" role="group" aria-label="Charge In / Out" style="color:#fff;">' +
                            '<a class="btn btn-info user-payment" data-toggle="modal" data-name=' + full['username'] + ' data-target="#userChargeIn">충전</a>' +
                            '<a class="btn btn-danger user-collect" data-toggle="modal" data-name=' + full['username'] + ' data-balance=' + full['balance'] + ' data-target="#userChargeOut">회수</a>' +
                            '</div>';
                }
            }
        ],
            "initComplete": function(settings, json) {
                    // $('.user-payment').on('click', function() {
                    //     // var amount = $('.payment-amount').val();
                    //     var username = $(this).data('name');
                    // });

                    function format_number(x) {
                        return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
                    }

                    var is_checked = false;
                    var is_duplicate = false;

                    $('.check-user').on('click', function() {
                        var username = $('.username').val();

                        if (username != '') {
                            $('.username-loading').css('display', 'block');
                            $('.username').attr('disabled', true);
                            $('.check-label').text('Checking...');
                            $('.text_user_chk').text('Processing.');
                            is_checked = false;

                            $.getJSON( "https://api.honorlink.org/api/user?username="+ username)
                            .done(function( json ) {   
                                is_checked = true;
                                $('.username-loading').css('display', 'none');
                                $('.username').attr('disabled', false);
                                $('.check-label').text('Check');
                                
                                $('.text_user_chk').text('이미 사용중입니다.').addClass('text-danger');
                                is_duplicate = true;
                            })  
                            .fail(function( jqXHR, textStatus, error ) {
                                is_checked = true;
                                $('.username-loading').css('display', 'none');
                                $('.username').attr('disabled', false);
                                $('.check-label').text('Check');

                                $('.text_user_chk').text('사용가능합니다.').removeClass('text-danger');
                                is_duplicate = false;
                            });  

                            // $.ajax({
                            //     url: "https://api.honorlink.org/api/user?username=" +username,
                            //     type: 'GET',
                            //     // headers: {
                            //     //     'Authorization': 'Bearer Wq6U9iv5WErdYetknhvQ4d2Ke4OB36LKaxeDY5yD'
                            //     // },
                            //     beforeSend: function() {
                            //         $('.username-loading').css('display', 'block');
                            //         $('.username').attr('disabled', true);
                            //         $('.check-label').text('Checking...');
                            //         $('.text_user_chk').text('Processing.');
                            //         is_checked = false;
                            //     },
                            //     success: function(data) {
                            //         is_checked = true;
                            //         $('.username-loading').css('display', 'none');
                            //         $('.username').attr('disabled', false);
                            //         $('.check-label').text('Check');
                            //         var result = data;
                            //         if (result['status_code'] == 200) {
                            //             $('.text_user_chk').text('이미 사용중입니다.').addClass('text-danger');
                            //             is_duplicate = true;
                            //         } else {
                            //             $('.text_user_chk').text('사용가능합니다.').removeClass('text-danger');
                            //             is_duplicate = false;
                            //         }
                            //     },
                            //     error: function() {
                            //         console.log('error');
                            //     }
                            // });
                        }
                    });

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $('.new_user').on('click', function() {
                        if (is_checked == true) {
                            if (is_duplicate == false) {
                                var data = $('.create-user-form').serialize();
                                var username = $('.username').val();
                                var nickname = $('.nickname').val();
                                var pw = $('.password').val();
                                var email = $('.email').val();
                                $.ajax({
                                    url: "https://api.honorlink.org/api/user/create",
                                    // headers: {
                                    //     'Authorization': 'Bearer Wq6U9iv5WErdYetknhvQ4d2Ke4OB36LKaxeDY5yD',
                                    // },
                                    type: 'POST',
                                    data: {
                                        'username': username,
                                        'nickname': nickname
                                    },
                                    success: function(data) {
                                        console.log(data);
                                        if(data) {
                                            $.ajax({
                                                url: "{{ url('/create-user') }}",
                                                type: 'POST',
                                                data: {
                                                    'username': username,
                                                    'nickname': nickname,
                                                    'password' : pw,
                                                    'email' : email,
                                                    'user_id' : data['id'],
                                                    'balance' : data['balance'],
                                                    'point' : data['point'],
                                                    'created_at' : data['created_at']
                                                },
                                                success: function(data) {
                                                    if (data == 'success') {
                                                        $('#userModal').modal('hide');
                                                        table.ajax.reload();
                                                        swal("Success!", 'User created successfully.', "success");
                                                        // $.toast({
                                                        //     heading: 'Success',
                                                        //     text: 'User created successfully.',
                                                        //     position: 'top-right',
                                                        //     loaderBg: '#ff6849',
                                                        //     icon: 'success',
                                                        //     hideAfter: 3500,
                                                        //     stack: 6
                                                        // });
                                                    }
                                                }
                                            });
                                        }
                                    }
                                });
                            } else {

                            }
                        }
                    });
                }
        });

        var username_recharge = '';
        var amount = 0;

        $('#userChargeIn').on('show.bs.modal', function(e) {
            username_recharge = $(e.relatedTarget).data('name');
            $('.submit-recharge').on('click', function() {
                amount = $('.payment-amount').val();
                if (amount != 0) {
                    // if (total_holdings > amount) {
                        $.ajax({
                            url: "https://api.honorlink.org/api/user/add-balance",
                            // headers: {
                            //     'Authorization': 'Bearer Wq6U9iv5WErdYetknhvQ4d2Ke4OB36LKaxeDY5yD',
                            // },
                            type: 'POST',
                            data: {
                                'amount': amount,
                                'username': username_recharge
                            },
                            beforeSend: function() {

                            },
                            success: function(data) {
                                console.log(data)
                                            // var data = $.parseJSON(data);
                                            // var transaction = data['recharge'];
                                            // console.log(data);
                                            // console.log(transaction);
                                if (data) {
                                    updateTotalBalance();

                                    $.ajax({
                                        url: "{{ url('/transaction/log') }}",
                                        type: 'POST',
                                        data: {
                                            'trans_id': data['transaction_id'],
                                            'amount': data['amount'],
                                            'after': data['balance'],
                                            'user': data['username'],
                                            'type': 'deposit',
                                            'status': '1'
                                        },
                                        beforeSend: function() {

                                        },
                                        success: function(data) {

                                        }
                                    })

                                                // $('.total-holding-balance').html(format_number(~~data['info']['data']['balance']));
                                                // $('.total-user-holding-balance').html(format_number(~~data['total_balance']));
                                    swal("Success!", '' + data['amount'] +' Pot Holding balance recharged successfully.',"success");
                                } else {
                                    // swal("Failed","차감할 금액에 비해 해당 유저의 보유 금액이 부족합니다","error");
                                }
                                    $('#userChargeIn').modal('hide');
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.log(jqXHR.status);
                                $('#betDetails').modal('hide');
                                swal("Failed", "에이전트의 잔고가 부족합니다.", "error");
                            }
                        })
                    // }
                }

            });
                console.log(username);
        });

        $('#userChargeIn').on('hidden.bs.modal', function() {
            // location.reload();
            table.ajax.reload();
            username_recharge = '';
            $('.payment-amount').val('');
            amount = 0;
        });

        var username = '';
        var _balance = '';
        var collect_amount = 0;
        $('#userChargeOut').on('show.bs.modal', function(e) {
            username = $(e.relatedTarget).data('name');
            _balance = $(e.relatedTarget).data('balance');

            $('.submit-collect').on('click', function() {
                collect_amount = $('.collect-amount').val();
                if (collect_amount != 0) {
                    if(collect_amount > _balance) {
                        swal("Failed", "차감할 금액에 비해 해당 유저의 보유 금액이 부족합니다", "error");
                        $('#userChargeOut').modal('hide');
                    } else {
                                // if(balance > amount) {
                        $.ajax({
                            url: "https://api.honorlink.org/api/user/sub-balance",
                            // headers: {
                            //     'Authorization': 'Bearer Wq6U9iv5WErdYetknhvQ4d2Ke4OB36LKaxeDY5yD',
                            // },
                            type: 'POST',
                            data: {
                               'amount': collect_amount,
                                'username': username
                            },
                            beforeSend: function() {

                            },
                            success: function(data) {
                                console.log(data);
                                        // var data = $.parseJSON(data);
                                        // var transaction = data['collect'];
                                var collected_amount = data['amount'];
                                        // console.log(transaction);
                                if (data) {
                                    updateTotalBalance();
                                    $.ajax({
                                        url: "{{ url('/transaction/log') }}",
                                        type: 'POST',
                                        data: {
                                            'trans_id': data['transaction_id'],
                                            'amount': data['amount'],
                                            'after': data['balance'],
                                            'user': data['username'],
                                            'type': 'deposit',
                                            'status': '1'
                                        },
                                        beforeSend: function() {

                                        },
                                        success: function(data) {

                                        }
                                    })
                                            // $('.total-holding-balance').html(format_number(~~data['info']['data']['balance']));
                                            // $('.total-user-holding-balance').html(format_number(~~data['total_balance']));

                                    swal("Success!", '' + collected_amount +' Pot Holding balance collected successfully.',"success");
                                } else {
                                    swal("Failed","차감할 금액에 비해 해당 유저의 보유 금액이 부족합니다","error");
                                }
                                $('#userChargeOut').modal('hide');
                            }
                        });

                                // } else {
                                //     // console.log('차감할 금액에 비해 해당 유저의 보유 금액이 부족합니다.');
                                //     swal("Failed", "차감할 금액에 비해 해당 유저의 보유 금액이 부족합니다)", "error");
                                //     $('#userChargeOut').modal('hide');
                                // }
                    }
                }
            });
        });


        $('#userChargeOut').on('hidden.bs.modal', function() {
            table.ajax.reload();
            username = '';
            _balance = '';
            $('.collect-amount').val('');
            collect_amount = 0;
            // location.reload();
        });

    function updateTotalBalance() {
        $.ajax({
            async: true,
            url: "https://api.honorlink.org/api/my-info",
            // headers: {
            //     'Authorization': 'Bearer Wq6U9iv5WErdYetknhvQ4d2Ke4OB36LKaxeDY5yD',
            // },
            type: 'GET',
            success: function(data) {
                $('.total-holding-balance').text(data['balance'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + ' Pot');
            }
        });

        $.ajax({
            async: true,
            url: "https://api.honorlink.org/api/user-list",
            // headers: {
            //     'Authorization': 'Bearer Wq6U9iv5WErdYetknhvQ4d2Ke4OB36LKaxeDY5yD',
            // },
            type: 'GET',
            success: function(data) {
                var total = data.reduce(function(sum, current) {
                                return sum + current.balance;
                            }, 0);

                $('.total-user-holding-balance').text(total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + ' Pot');
            }
        });
    }
    </script>
@endsection
