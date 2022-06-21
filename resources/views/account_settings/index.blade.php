@extends('template.template')

@section('custom-css')
<link href="../assets/plugins/toast-master/css/jquery.toast.css" rel="stylesheet">
<link href="../assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">

<style>
    .avatar i {
        font-size: 60px;
    }
    .agent-breadcrumb .breadcrumb-item+.breadcrumb-item:before {
        content: "\e649";
        font-family: themify;
        color: #a6b7bf;
        font-size: 11px;
    }
    .breadcrumb-item+.breadcrumb-item::before {
        display: inline-block;
        padding-right: 0.5rem;
        padding-left: 0.5rem;
        color: #868e96;
        content: "/";
    }
    .agent-breadcrumb li {
        margin-top: 0px;
        margin-bottom: 0px;
    }
    .agent-breadcrumb {
        padding: 0px;
        background: transparent;
        font-size: 14px;
        margin-bottom: 0px;
        list-style: none;
        border-radius: 0.25rem;
    }
    .tooltip-content5 {
        width: 200px !important;
        font-size: 14px !important;
        left: -50% !important;
        margin: -20px 0 20px 0px !important;
    }
    .tooltip-inner2 {
        padding: 15px !important;
    }
    .mytooltip {
        z-index: 0;
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
            <h6 class="page-title">Account Settings</h6>
        </div>
        <div class="col-lg-6 col-sm-6 text-right text-sm-right">
                {{-- <a class="btn btn-sm btn btn-info" href="{{ route('payment.create') }}">
                    <i class="fa fa-fw fa-plus"></i>Add New
                </a> --}}
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body p-0">
                    <div class="d-flex p-3 bg-info align-items-center">
                        <div class="avatar text-white">
                            <i class="fa fa-user-circle-o"></i>
                            {{-- <img src="{{ getImage(imagePath()['profile']['admin']['path'],imagePath()['profile']['admin']['size'])}}" class="img-circle" alt="@lang('Image')"> --}}
                        </div>
                        <div class="pl-3">
                            <h4 class="text-white">{{ session('username') }}</h4>
                        </div>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Name
                            <span class="font-weight-bold">Super Admin</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Affiliated Agent
                            <span class="font-weight-bold">
                                <ol class="agent-breadcrumb">
                                    @foreach (array_reverse($affiliated_agents) as $agent)
                                        <li class="breadcrumb-item active">{{ $agent->agent_uname ?? 'site' }}</li>
                                    @endforeach
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">{{ session('username') }}</a></li>
                                </ol>
                            </span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Email
                            <span class="font-weight-bold">jaymacaspac@gmail.com</span>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                    Account Information
                </div>
                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    Account Information
                </div>
                <div class="card-body">
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
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                   Payment Method
                </div>
                <div class="card-body">
                    <form method="post" id="form-method" class="form-horizontal p-t-20 form-method">
                        @foreach ($payment_method as $method)
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">
                                    <a class="mytooltip" href="javascript:void(0)"> {{ $method->name }}
                                        <span class="tooltip-content5">
                                            <span class="tooltip-text3">
                                                <span class="tooltip-inner2">Deposit Limit (USD)<br/> 
                                                    Min : <span class="label label-info">{{ number_format($method->min_amount) }} USD</span>
                                                    Max : <span class="label label-warning">{{ number_format($method->max_amount) }} USD</span>
                                                    <hr>
                                                    Deposit Limit (KRW)<br/> 
                                                    Min : <span class="label label-info">{{ number_format($method->min_amount * $method->rate) }} KRW</span>
                                                    Max : <span class="label label-warning">{{ number_format($method->max_amount * $method->rate) }} KRW</span>
                                                </span>
                                            </span>
                                        </span>
                                    </a>
                                </label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="text" name="address[]" data-id="{{ $method->id }}" class="form-control address" placeholder="Enter Depositing Address" value="{{ $method->parameter ?? '' }}">
                                        <img src="{{ URL::asset('assets/images/gateway') }}/{{ $method->image }}" alt="image" width="45" height=40 class="input-group-addon">
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="form-group row m-b-0 text-center">
                            <div class="col-sm-12 col-sm-12 ">
                                <a href="javascript:void(0)" class="btn btn-info waves-effect waves-light save-method">Save</a>
                            </div>
                        </div>
                    </form>

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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.fn.serializeObject = function () {
            var o = {};
            var a = this.serializeArray();
            $.each(a, function () {
                if (o[this.name] !== undefined) {
                    if (!o[this.name].push) {
                        o[this.name] = [o[this.name]];
                    }
                    o[this.name].push(this.value || '');
                } else {
                    o[this.name] = this.value || '';
                }
            });

            return o;
        };

        $('.save-method').on('click', function() {
            var address = {};
            address['address'] = new Array();
            $('.address').each(function() {
                var item = {};
                item['id'] = $(this).data('id');
                item['value'] = $(this).val();

                address['address'].push(item);
            });
            console.log(address);

            $.ajax({
                url: "{{ route('method.save') }}",
                type: 'POST',
                data: address,
                success: function(data) {
                    notify(data[0][0], data[0][1])
                }
            });
        });

    </script>
@endsection
