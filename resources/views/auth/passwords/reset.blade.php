<!DOCTYPE html>

<html lang="en">

<head>
    <!-- <meta content="text/html; charset=UTF-8"> -->
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ URL::asset('fevicol.png') }}" type="image/gif" sizes="16x16">
    <title>{{ getNameSystem() }}</title>

    <!-- Bootstrap -->
    <link href="{{ URL::asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ URL::asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ URL::asset('vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    {{-- <link href="{{ URL::asset('vendors/bootstrap-daterangepicker/daterangepicker.css') }} "
    rel="stylesheet"> --}}

    <!-- Custom Theme Style -->
    <link href="{{ URL::asset('build/css/custom.min.css') }} " rel="stylesheet">
    <!-- Own Theme Style -->
    <link href="{{ URL::asset('build/css/own.css') }} " rel="stylesheet">
    <link href="{{ URL::asset('build/css/roboto.css') }} " rel="stylesheet">

    <!-- sweetalert -->
    {{-- <link href="{{ URL::asset('vendors/sweetalert/sweetalert.css') }}"
    rel="stylesheet"
    type="text/css"> --}}

    <!-- Custom Theme Scripts -->
    <script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/custom.min.js') }}" defer="defer"></script>
    <script src="{{ URL::asset('vendors/sweetalert/dist/sweetalert.min.js') }}"></script>
    <style>
        .login_form {
            background: #2A3F54;
        }

        .login_content {
            text-shadow: none;
        }

        @media only screen and (max-width: 575px) {
            .content-form-login-page-school-plugin.md-form {
                margin-left: 50px;
            }


        }

        @media only screen and (width: 575px) {
            .logo-title-img-school-plugin {
                margin-top: 60px;
                margin-left: 50px;
                width: 450px;
            }

            .forgot_pwd_scl,
            .forgot_pwd_scl:hover {
                margin-left: 0px;
            }
        }

        @media only screen and (max-width: 575px) {
            .header-title-trusted-plugin {
                font-size: 30px;
            }

            .heade-content-login-page {
                margin: 0px 0px 0px;
                border-bottom-left-radius: 0px;
                border-bottom-right-radius: 0px;
            }

            .main-div-school-container {
                background-color: transparent;
                border-radius: 0px;
                box-shadow: 0px 0px 0px 0px rgba(20, 20, 20, 0.5);
            }

            .img-second-right-side-min-sch .img-second-bck-contn-sch {
                display: none;
            }

            .img-one-right-side-min-sch .img-first-bck-contn-sch {
                display: none;
            }

            img.img-first-bck-contn-sch-round {
                display: none;
            }

            .logo-title-img-school-plugin {
                margin-top: 60px;
                margin-left: auto;
            }

            .logo-title-img-school-plugin a img {
                width: auto;
                background-color: rgba(234, 107, 0, 0.07);
            }

            .col-sm-7.col-sm-offset-3.col-md-7.col-md-offset-2.main.content-start {
                margin-top: 0px;

            }

            .background-main-div-plugin-login .container {
                top: 0px;
                width: 100%;
            }

            img.head_logo {
                display: none;
            }

        }

        @media (max-width: 1024px) and (min-width: 768px) {
            .header-title-trusted-plugin {
                font-size: 50px;
            }

            .heade-content-login-page {
                margin: 0px 0px 0px;
                border-bottom-left-radius: 50px;
                border-bottom-right-radius: 50px;
            }

            img.head_logo {
                display: none;
            }

            .school-page .navbar-inverse {
                background-color: rgba(234, 107, 0, 0.07);
                border-color: rgba(234, 107, 0, 0.07);
                padding: 0px 0px;
                border-radius: 0px;
                left: 18px;
                width: 43rem;
            }

            .col-sm-7.col-sm-offset-3.col-md-7.col-md-offset-2.main.content-start {
                /* margin-top: 10px; */
                width: 100%;
                margin: 8px 10px;
            }

            img.img-first-bck-contn-sch-round {
                position: absolute;
                top: 620px;
                right: 30px;
            }

        }
    </style>

    <style>
        @media (max-width: 375px) {

            .content-form-login-page-school-plugin.md-form {
                margin-left: 55px;
            }
        }

        @media (max-width: 320px) {
            .content-form-login-page-school-plugin.md-form {
                margin-left: 35px;
            }
        }

        @media (min-width: 425px) and (max-width: 767px) {

            .content-form-login-page-school-plugin.md-form {
                margin-left: 85px;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            .content-form-login-page-school-plugin.md-form {
                margin-left: 20px;
                margin-top: 100px;
            }
        }

        @media (min-width: 992px) and (max-width: 1199px) {
            .content-form-login-page-school-plugin.md-form {

                margin-top: 20px;
                margin-left: 130px;
            }
        }

        @media (min-width: 1200px) and (max-width: 1399px) {
            .content-form-login-page-school-plugin.md-form {

                margin-top: 20px;
                margin-left: 190px;
            }
        }

        @media (min-width: 1400px) {
            .content-form-login-page-school-plugin.md-form {

                margin-top: 20px;
                margin-left: 190px;
            }
        }
    </style>
    <script>
        $(document).ready(function() {
            // alert('111');
            $(".input").click(function() {
                // alert('hyy');
                $('.login-username label').addClass("active");
            });
        });

        // 
    </script>
    <script>
        $(document).ready(function() {
            $("#email_reset").attr("autocomplete", "off");
        });
    </script>

</head>

<body class="login_reset_pwd">

    <div class="img-all-background-box-bck-main-cont">
        <div class="img-one-right-side-min-sch">
            <img class="img-first-bck-contn-sch" src="{{ URL::asset('public/general_setting/Group 18368.png') }}">
        </div>

        <div class="img-second-right-side-min-sch">
            <img class="img-second-bck-contn-sch" src="{{ URL::asset('public/general_setting/Group 18367 (1).png') }}">
        </div>
        <div class="img-one-right-side-min-sch">
            <img class="img-first-bck-contn-sch-round" src="{{ URL::asset('public/general_setting/Group 18369.png') }}">
        </div>
    </div>
    <div>
        <!-- <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a> -->

        <div class="background-main-div-plugin-login">
            <div class="container">
                <div class="main-div-school-container">
                    <div class="header-bnner-login-page-mc">
                        <div class="heade-content-login-page">
                            <h1 class="header-title-trusted-plugin">
                                <img src="{{ URL::asset('public/general_setting/medal 1.png') }}" class="head_logo">
                                <span class="double_shadow_to_text_plugin_trusted"> {{ getNameSystem() }}</span>
                            </h1>
                            <!-- <h3 class="selling-codecanyon-plugin">Best in segment on codecanyon</h3> -->
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-sm-5 col-md-4 sidebar">

                            <div class="image-container">
                                <img src="{{ URL::asset('/public/general_setting/' . getLogoSystem()) }}" alt="Your Image Description">
                            </div>
                        </div>

                        <div class="col-sm-7 col-sm-offset-3 col-md-6 col-md-offset-2 main content-start">
                            <div class="content-form-login-page-school-plugin md-form">
                                <form class="form-horizontal" method="POST" action="{{ url('/passwordchange') }}">
                                    {{ csrf_field() }}
                                    <h3 class="logintextcolor fw-bold">New Password</h3>
                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <p class="login-username mt-3">
                                        <!-- <label for="email_reset"> Email </label> -->
                                        <input type="email" name="email" id="email_reset" autocomplete="off" class="input" value="{{ $email or old('email') }}" size="20" required>

                                        @if ($errors->has('email'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </p>

                                    <p class="login-username mt-3">
                                        <label for="email_reset"> Enter New Password </label>
                                        <input type="password" name="password" id="email_reset" autocomplete="off" class="input" required>

                                        @if ($errors->has('password'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </p>

                                    <p class="login-username mt-3">
                                        <label for="email_reset"> Confirm Password </label>
                                        <input type="password" name="password_confirmation" id="email_reset" autocomplete="off" class="input" required>

                                        @if ($errors->has('password_confirmation'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                        @endif
                                    </p>

                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <button type="submit" class="btn btn-success pass_reset">
                                                <i class="fa fa-btn fa-refresh"></i> Reset Password
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>



                </div>
            </div>
        </div>

    </div>

    <script>
        window.onload = function() {
            var url = window.location.href;

            var segments = url.split('/');
            var lastSegment = segments[segments.length - 1];

            if (isValidEmail(lastSegment)) {
                document.getElementById('email_reset').value = lastSegment;
            }
        };

        function isValidEmail(email) {
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }
    </script>

</body>

</html>