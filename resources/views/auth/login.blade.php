<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="cache-control" content="private, max-age=0, no-cache">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="0">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('assets/images/logo.png') }}">
    <title>WINSLOTS</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ URL::asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- morris CSS -->
    <link href="{{ URL::asset('assets/plugins/morrisjs/morris.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
    {{-- <link href="{{ URL::asset('css/custom.css') }}" rel="stylesheet"> --}}
    <!-- You can change the theme colors from here -->
    {{-- <link href="{{ URL::asset('css/colors/blue.css') }}" id="theme" rel="stylesheet"> --}}
    <style>
        body {
            background: #f2f2f2;
            font-family: 'Varela', sans-serif;
            font-size: 14px;
            line-height: 1.5;
            color: #333;
            position: relative;
            min-height: 100%;
        }

        label {
            margin-top: 6px;
            line-height: 17px;
        }

        a {
            color: #fff;
        }

        a:focus,
        a:hover {
            color: #008080;
        }

        .checkbox-inline+.checkbox-inline,
        .radio-inline+.radio-inline {
            margin-top: 6px;
        }

        /******* Login Page *******/

        .relative {
            position: relative;
        }

        .login-container-wrapper .logo,
        .login-container-wrapper .welcome {
            margin: 0 0 20px 0;
            font-size: 16px;
            color: #34495e;
            text-align: center;
            letter-spacing: 1px;
        }

        .login-container-wrapper .logo {
            /* text-align: center; */
            position: absolute;
            top: -84px;
            margin: 0 auto;
            /* width: 25%; */
            left: 29%;
            border-radius: 50%;
            /* background-color: #344455; */
            padding: 25px;
        }

        .login-container-wrapper {
            max-width: 400px;
            margin: 10% auto 8%;
            padding: 40px;
            box-sizing: border-box;
            background: rgba(255, 255, 255, 1);
            /* box-shadow: 1px 1px 10px 1px #000000, 8px 8px 0px 0px #344454, 12px 12px 10px 0px #000000; */
            position: relative;
            padding-top: 80px;
            /* border-radius: 10px;
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            -ms-border-radius: 10px;
            -o-border-radius: 10px; */
        }

        .login-container-wrapper::before {
            position: absolute;
            content: '';
            bottom: -15px;
            left: -15px;
            background-color: #009e85;
            width: 100%;
            height: 100%;
            z-index: -10;
            /* border-radius: 10px;
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            -ms-border-radius: 10px;
            -o-border-radius: 10px; */
        }

        .logo .fa {
            font-size: 50px;
        }

        .login input:focus + .fa{
            color:#50dfd5;
        }

        .login-form .form-group {
            margin-right: 0;
            margin-left: 0;
        }

        .login-form i {
            position: absolute;
            top: 18px;
            right: 20px;
            color: #009e85;
        }

        .login-form .input-lg {
            font-size: 16px;
            height: 52px;
            padding: 10px 25px;
            border-radius: 0;
        }

        .login input[type="text"],
        .login input[type="password"],
        .login input:focus {
            /* background-color: rgba(40, 52, 67, 0.75); */
            border: 1px solid #009e85;
            /* color: #eee; */
            border-left: 4px solid #1e645f;
        }

        .login input:focus {
            border-left: 4px solid #50dfd5;
        }

        input:-webkit-autofill,
        textarea:-webkit-autofill,
        select:-webkit-autofill {
            background-color: rgba(40, 52, 67, 0.75)!important;
            background-image: none;
            color: rgb(0, 0, 0);
            border-color: #FAFFBD;
        }

        .login .checkbox label,
        .login .checkbox a {
            color: #34495e;
        }

        .btn-success {
            background-color: transparent;
            background-image: none;
            padding: 8px 50px;
            border-radius: 0;
            border: 2px solid #93a5ab;
            box-shadow: inset 0 0 0 0 #7692A7;
            -webkit-transition: all ease 0.8s;
            -moz-transition: all ease 0.8s;
            transition: all ease 0.8s;
        }

        .btn-success:focus,
        .btn-success:hover,
        .btn-success.active,
        .btn-success:active {
            background-color: transparent;
            border-color: #fff;
            box-shadow: inset 0 0 100px 0 #7692A7;
            color: #FFF;
        }

        #particles-js {
            /*   background: cornflowerblue; */
            width:100%;
            height:100%;
            position:absolute;
            z-index:-1;
        }
        
        .login-form-container {
            height: 100%;
            width: 100%;
            padding: 5%;
            position: fixed;
            /* background-image: url(assets/images/bg1.jpg); */
            background: rgba(241, 242, 181, 1);
            background: -moz-radial-gradient(center, ellipse cover, rgba(255, 255, 255, 1) 0%, rgba(0, 73, 61, 1) 100%);
            background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, rgba(255, 255, 255, 1)), color-stop(100%, rgba(0, 73, 61, 1)));
            background: -webkit-radial-gradient(center, ellipse cover, rgba(255, 255, 255, 1) 0%, rgba(0, 73, 61, 1) 100%);
            background: -o-radial-gradient(center, ellipse cover, rgba(255, 255, 255, 1) 0%, rgba(0, 73, 61, 1) 100%);
            background: -ms-radial-gradient(center, ellipse cover, rgba(255, 255, 255, 1) 0%, rgba(0, 73, 61, 1) 100%);
            background: radial-gradient(ellipse at center, rgba(255, 255, 255, 1) 0%, rgba(0, 73, 61, 1) 100%);
            filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#f1f2b5', endColorstr='#00493d', GradientType=1);
        }
    </style>
</head>
<body class="login">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> 
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    {{-- <section id="wrapper" class="login-container"> --}}
        {{-- <div class="login-header"><img src="assets/images/logo.png"></div> --}}
    {{-- <section id="wrapper"> --}}
        {{-- <div class="login-register">
        <div class="login-header"><img src="assets/images/logo.png"></div>

            <div class="login-box card">
                <div class="card-body">
                    <form class="form-control-line alogin" id="loginform" method="post" action="{{ url('/login') }}">
                        {!! csrf_field() !!}
                        <div class="login-form">
                            <h3 class="box-title m-b-20 text-center">Sign In</h3>
                            @if(Session::has('fail'))
                                <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                            @endif
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input type="text" class="form-control" name="username" placeholder="Username" required autocomplete="off"> 
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input class="form-control" name="password" type="password" placeholder="Password" required> 
                                </div>
                            </div>
                            <div class="form-group text-center m-t-20">
                                <div class="col-xs-12">
                                    <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit" name="submit">Log In</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}

        <section id="wrapper" class="">
            <div class="login-form-container container-fluid">
                <div class="login-container-wrapper clearfix">
                    <div class="logo">
                        <img src="assets/images/logo.png">
                    </div>
                    <div class="welcome"><strong>Admin Login</strong></div>
        
                    <form class="form-horizontal login-form alogin" method="post" action="{{ url('/login') }}">
                        {!! csrf_field() !!}
                        @if(Session::has('fail'))
                            <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                        @endif
                        <div class="form-group relative">
                            <input id="login_username" class="form-control input-lg" type="text" name="username" placeholder="Username" required>
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="form-group relative password">
                            <input id="login_password" class="form-control input-lg" type="password" name="password" placeholder="Password" required>
                            <i class="fa fa-lock"></i>
                        </div>
                        {{-- <div class="checkbox pull-left m-b-5">
                            <label> <a class="forget" href="" title="forget">Forgot your password</a> </label>
                        </div> --}}
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" name="submit">Login</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </section>
    {{-- </section> --}}
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ URL::asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ URL::asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{  URL::asset('js/jquery.slimscroll.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ URL::asset('js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ URL::asset('js/sidebarmenu.js') }}"></script>
    <!--stickey kit -->
    <script src="{{ URL::asset('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ URL::asset('js/custom.min.js') }}"></script>
    <!-- <script src="js/login.js"></script> -->
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--sparkline JavaScript -->
    <script src="{{ URL::asset('assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <!--morris JavaScript -->
    <script src="{{ URL::asset('assets/plugins/raphael/raphael-min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/morrisjs/morris.min.js') }}"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="{{ URL::asset('assets/plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>
</body>

</html>