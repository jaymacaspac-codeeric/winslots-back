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
            <h6 class="page-title">Payment Gateways</h6>
        </div>
        <div class="col-lg-6 col-sm-6 text-right text-sm-right">
                <a class="btn btn-sm btn btn-info" href="{{ route('payment.create') }}">
                    <i class="fa fa-fw fa-plus"></i>Add New
                </a>
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
                                    <th>Gateway</th>
                                    <th>Currency</th>
                                    <th>Rate</th>
                                    <th>Status</th>
                                    <th>Type</th>
                                    <th>Action</th>
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
                url: "{{ route('payment.list') }}",
                type: 'GET',
                "dataSrc": function (json) {
                    return json;
                }
            },
            "columnDefs" : [
            {
                "targets": 0,
                'render': function(data, type, full, meta) {
                    var image = '<img src="{{ URL::asset('assets/images/gateway') }}/'+ full['image'] +'" alt="image" width="40" class="m-r-10">';
                    return image + full['name'];
                }
            }, {
                "targets": 1,
                'render': function(data, type, full, meta) {

                    return full['currency'];
                }
            }, {
                "targets": 2,
                'render': function(data, type, full, meta) {

                    return '1$ = ' + full['rate'] + ' ' + full['currency'];
                }
            }, {
                "targets": 3,
                'render': function(data, type, full, meta) {
                    var status = '';
                    if(full['status'] == 1) {
                        status = '<span class="label label-rounded label-success">Active</span>';
                    } else {
                        status = '<span class="label label-rounded label-danger">Disabled</span>';
                    }
                    return status;
                }
            }, {
                "targets": 4,
                'render': function(data, type, full, meta) {
                    var type = (full['crypto'] == 1) ? 'Crypto' : 'Fiat';
                    return type;
                }
            }, {
                "targets": 5,
                'render': function(data, type, full, meta) {
                    var is_active = '';
                    if(full['status'] == 1) {
                        is_active = '<button class="btn btn-warning waves-effect waves-light btn-sm m-l-5 deactivate" type="button" data-id="'+full['id']+'" data-name="'+full['name']+'" data-title="enable"> <i class="fa fa-eye-slash"></i> </button>';
                    } else {
                        is_active = '<button class="btn btn-success waves-effect waves-light btn-sm m-l-5 activate" type="button" data-id="'+full['id']+'" data-name="'+full['name']+'" data-title="disable"> <i class="fa fa-eye"></i> </button>';
                    }
                    var is_active_url = '{{ route("payment.edit", ":id") }}';
                    is_active_url = is_active_url.replace(':id', full['id']);
                    
                    return '<a href="'+is_active_url+'" class="btn btn-info waves-effect waves-light btn-sm text-white"> <i class="fa fa-pencil"></i> </a>'+
                            is_active +
                            '<a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light btn-sm text-white m-l-5 delete" data-id="'+full['id']+'" data-name="'+full['name']+'"> <i class="fa fa-trash-o"></i> </a>';
                }
            }, 
        ],
            "initComplete": function(settings, json) {
                $(document).on('click', '.deactivate', function () {
                    var name = $(this).data('name');
                    var id = $(this).data('id');

                    swal({
                        title: "Payment Method Disable Confirmation",
                        text: "Are you sure to disable " + name + " method?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#dd6b55",
                        confirmButtonText: "Disable",
                        closeOnConfirm: false
                    }, function (isConfirm) {
                        if (!isConfirm) return;
                        $.ajax({
                            url: "{{ route('payment.status') }}",
                            type: "POST",
                            data: {
                                '_token': "{{ csrf_token() }}",
                                'status': 0,
                                'id': id,
                                'name': name
                            },
                            success: function () {
                                // swal("Done!", "It was succesfully deleted!", "success");
                                swal.close();
                                table.ajax.reload();
                                iziToast.success({
                                    position: 'topRight',
                                    message: name + ' has been deactivated.',
                                });
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                // swal("Error deleting!", "Please try again", "error");
                            }
                        });
                    });
                });

                $(document).on('click', '.activate', function () {
                    var name = $(this).data('name');
                    var id = $(this).data('id');
                    
                    swal({
                        title: "Payment Method Activation Confirmation",
                        text: "Are you sure to activate " + name + " method?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#1976d2",
                        confirmButtonText: "Activate",
                        closeOnConfirm: false
                    }, function (isConfirm) {
                        if (!isConfirm) return;
                        $.ajax({
                            url: "{{ route('payment.status') }}",
                            type: "POST",
                            data: {
                                '_token': "{{ csrf_token() }}",
                                'status': 1,
                                'id': id,
                                'name': name
                            },
                            success: function () {
                                // swal("Done!", "It was succesfully deleted!", "success");
                                swal.close();
                                table.ajax.reload();
                                iziToast.success({
                                    position: 'topRight',
                                    message: name + ' has been activated.',
                                });
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                // swal("Error deleting!", "Please try again", "error");
                            }
                        });
                    });
                });

                $(document).on('click', '.delete', function () {
                    var name = $(this).data('name');
                    var id = $(this).data('id');

                    swal({
                        title: "Payment Method Delete Confirmation",
                        text: "Are you sure to delete " + name + " method?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#1976d2",
                        confirmButtonText: "Delete",
                        closeOnConfirm: false
                    }, function (isConfirm) {
                        if (!isConfirm) return;
                        $.ajax({
                            url: "{{ route('payment.delete') }}",
                            type: "POST",
                            data: {
                                '_token': "{{ csrf_token() }}",
                                'id': id
                            },
                            success: function () {
                                // swal("Done!", "It was succesfully deleted!", "success");
                                swal.close();
                                table.ajax.reload();
                                iziToast.success({
                                    position: 'topRight',
                                    message: name + ' has been deleted.',
                                });
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                // swal("Error deleting!", "Please try again", "error");
                            }
                        });
                    });
                });

            }
        });


    </script>
@endsection
