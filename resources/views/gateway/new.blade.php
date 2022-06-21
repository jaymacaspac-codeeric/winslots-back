@extends('template.template')

@section('custom-css')
<link href="{{ URL::asset('assets/plugins/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/bootstrap-switch/bootstrap-switch.min.css') }}" rel="stylesheet">

<style>
.payment-method-item .payment-method-header {
    display: flex;
    flex-wrap: wrap;
}
.payment-method-item .payment-method-header .thumb {
    width: 220px;
    position: relative;
    margin-bottom: 30px;
}
.payment-method-item .payment-method-header .thumb .profilePicPreview {
    width: 210px;
    height: 210px;
    display: block;
    border: 3px solid #f1f1f1;
    box-shadow: 0 0 5px 0 rgb(0 0 0 / 25%);
    border-radius: 10px;
    background-size: cover;
    background-position: center;
}
.payment-method-item .payment-method-header .thumb .profilePicUpload {
    font-size: 0;
    opacity: 0;
    width: 0;
}
.payment-method-item .payment-method-header .thumb .avatar-edit {
    position: absolute;
    bottom: -15px;
    right: 0;
}
.payment-method-item .payment-method-header .thumb .avatar-edit label {
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
            <h6 class="page-title">New Payment Gateway</h6>
        </div>
        <div class="col-lg-6 col-sm-6 text-right text-sm-right">
            <a class="btn btn-sm btn btn-info" href="{{ route('payment.index') }}">
                <i class="fa fa-arrow-left"></i> Go Back
            </a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="payment-gateway" action="{{ route('payment.save') }}" method="POST" enctype="multipart/form-data">
                    {!! csrf_field() !!}

                    <div class="payment-method-item">
                        <div class="payment-method-header">
                            <div class="thumb m-r-40">
                                <div class="avatar-preview">
                                    <div class="profilePicPreview" style="background-image: url('{{getImage(imagePath()['gateway']['path'],imagePath()['gateway']['size'])}}')"></div>
                                </div>
                                <div class="avatar-edit">
                                    <input type="file" name="image" class="profilePicUpload" id="image" accept=".png, .jpg, .jpeg">
                                    <label for="image" class="btn-primary"><i class="fa fa-pencil"></i></label>
                                </div>
                            </div>
    
                            <div class="content">
                                <div class="row m-t-40">
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                        <div class="form-group">
                                            <label class="control-label" for="gatewayname">Gateway Name <span class="text-danger">*</span></label>
                                            <input type="text" id="gatewayname" name="gateway_name" class="form-control" placeholder="Method Name">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                        <div class="form-group">
                                            <label class="control-label" for="methodcurrency">Currency <span class="text-danger">*</span></label>
                                            <input type="text" id="methodcurrency" name="method_currency" class="form-control" placeholder="Currency">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                        <div class="form-group">
                                            <label class="control-label" for="methodrate">Rate <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-addon">1 USD =</div>
                                                <input type="text" class="form-control method_rate" id="methodrate" name="method_rate" placeholder="0">
                                                <div class="input-group-addon"><span class="currency_symbol"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-lg-6 col-xl-4 bt-switch">
                                        <input type="checkbox" name="is_crypto" checked data-on-color="primary" data-off-color="warning" data-on-text="Crypto" data-off-text="Fiat">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-outline-info">
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white">Deposit Limit</h4></div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="control-label" for="minamount">Minimum Amount <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">$</div>
                                            <input type="text" class="form-control" id="minamount" name="min_amount" placeholder="0">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="maxamount">Maximum Amount <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">$</div>
                                            <input type="text" class="form-control" id="maxamount" name="max_amount" placeholder="0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-outline-info">
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white pull-left">Additional User Input</h4>
                                    <button type="button" class="btn waves-effect waves-light btn-outline-primary btn-sm pull-right text-right addUserData"><i class="fa fa-fw fa-plus"></i> Add New</button>
                                </div>
                                <div class="card-body">
                                    <div class="addedField">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-outline-info">
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white">Deposit Instruction</h4></div>
                                <div class="card-body">
                                    <textarea id="mymce" name="instruction"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn waves-effect waves-light btn-info">Save</button>
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
    <script src="{{ URL::asset('assets/plugins/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/bootstrap-switch/bootstrap-switch.min.js') }}"></script>

    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
    <script>
        $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();

        $('.bt-switch').on('switchChange.bootstrapSwitch', function (event, state) {
            console.log(state);
        });

        // $('.method_rate').number(true, 2);
        
            $('input[name=method_currency]').on('input', function () {
                $('.currency_symbol').text($(this).val());
            });

            $('.addUserData').on('click', function () {
                var html = `
                    <div class="row user-data">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <input name="field_name[]" class="form-control" type="text" required placeholder="Field Name">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <select name="type[]" class="form-control">
                                    <option value="text">Input Text</option>
                                    <option value="textarea">Textarea</option>
                                    <option value="file">File</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 ">
                            <select name="validation[]" class="form-control">
                                <option value="required">Required</option>
                                <option value="nullable">Optional</option>
                            </select>
                        </div>
                        <div class="col-lg-1">
                            <button class="btn btn-danger waves-effect waves-light removeBtn" type="button"> <i class="fa fa-times"></i> </button>
                        </div>
                    </div>`;
                $('.addedField').append(html);
            });

            $(document).on('click', '.removeBtn', function () {
                $(this).closest('.user-data').remove();
            });

            function proPicURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var preview = $(input).parents('.thumb').find('.profilePicPreview');
                        $(preview).css('background-image', 'url(' + e.target.result + ')');
                        $(preview).addClass('has-image');
                        $(preview).hide();
                        $(preview).fadeIn(650);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $(".profilePicUpload").on('change', function () {
                proPicURL(this);
            });

            if ($("#mymce").length > 0) {
                tinymce.init({
                    selector: "textarea#mymce",
                    theme: "modern",
                    height: 250,
                    menubar:false,
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "save table contextmenu directionality emoticons template paste textcolor"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | preview media fullpage | forecolor backcolor",
                });
            }
    </script>
@endsection
