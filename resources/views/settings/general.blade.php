@extends('template.template')

@section('custom-css')
<link href="../assets/plugins/toast-master/css/jquery.toast.css" rel="stylesheet">
<link href="../assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">

<style>
    .thumb {
        width: 220px;
        position: relative;
        margin-bottom: 30px;
    }
    .thumb .profilePicPreview {
        width: 210px;
        height: 210px;
        display: block;
        border: 3px solid #f1f1f1;
        box-shadow: 0 0 5px 0 rgb(0 0 0 / 25%);
        border-radius: 10px;
        background-size: cover;
        background-position: center;
    }
    .thumb .profilePicUpload {
        font-size: 0;
        opacity: 0;
        width: 0;
    }
    .thumb .avatar-edit {
        position: absolute;
        bottom: -15px;
        right: 0;
    }
    .thumb .avatar-edit label {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        text-align: center;
        line-height: 45px;
        border: 2px solid #fff;
        font-size: 18px;
        cursor: pointer;
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
            <h6 class="page-title">General Settings</h6>
        </div>
        <div class="col-lg-6 col-sm-6">
            <!-- TradingView Widget BEGIN -->
            {{-- <div class="tradingview-widget-container">
                <div class="tradingview-widget-container__widget"></div>
                <div class="tradingview-widget-copyright"></div>
                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-single-quote.js" async>
                {
                "symbol": "FX_IDC:USDKRW",
                "width": "100%",
                "colorTheme": "light",
                "isTransparent": true,
                "locale": "en"
            }
                </script>
            </div> --}}
            <!-- TradingView Widget END -->
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="site_settings_form" method="post" action="">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> Site Title </label>
                                    <input class="form-control" type="text" name="sitename" value="{{ $settings->site_title ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Currency</label>
                                    <input class="form-control" type="text" name="currency" value="{{ $settings->currency ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Currency Symbol </label>
                                    <input class="form-control" type="text" name="currency_symbol" value="{{ $settings->currency_symbol ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Conversion Rate </label>
                                    <div class="input-group">
                                        <div class="input-group-addon">1 USD =</div>
                                        <input type="text" class="form-control method_rate" id="methodrate" name="conversion_rate" value="{{ $settings->conversion_rate ?? '' }}">
                                        <div class="input-group-addon"><span class="currency_symbol">{{ $settings->currency ?? '' }}</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-md-3">
                                <div class="thumb">
                                    <div class="avatar-preview">
                                        <div class="profilePicPreview" style="background-image: url('{{getImage(imagePath()['logo']['path'],imagePath()['logo']['size'])}}')"></div>
                                    </div>
                                    <div class="avatar-edit">
                                        <input type="file" name="image" class="profilePicUpload" id="image" accept=".png, .jpg, .jpeg">
                                        <label for="image" class="btn-primary"><i class="fa fa-pencil"></i></label>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary">Update</button>
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
        
    </script>
@endsection
