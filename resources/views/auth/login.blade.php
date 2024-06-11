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
  <script>
    $(document).ready(function() {
      $(".input").click(function() {
        $('.login-username label').addClass("active");
        $('.login-password label').addClass("active");
      });
    });

    // 
  </script>

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

      .forgot_pwd_scl,
      .forgot_pwd_scl:hover {
        margin-left: 80px;
      }
    }

    @media (max-width: 320px) {
      .content-form-login-page-school-plugin.md-form {
        margin-left: 30px;
      }

      .forgot_pwd_scl,
      .forgot_pwd_scl:hover {
        margin-left: 80px;
      }
    }

    @media (min-width: 425px) and (max-width: 767px) {
      .content-form-login-page-school-plugin.md-form {
        margin-left: 80px;
      }

      .forgot_pwd_scl,
      .forgot_pwd_scl:hover {
        margin-left: 80px;
      }
    }

    @media (min-width: 768px) and (max-width: 991px) {
      .school-page .navbar-inverse {
        left: 0px;
      }
    }

    @media (min-width: 992px) and (max-width: 1199px) {
      .school-page .navbar-inverse {
        left: 0px;
        width: 51rem;
      }
    }
  </style>
</head>

<script>
  $(document).ready(function() {
    $("#user_login").attr("autocomplete", "off");
    $("#user_pass").attr("autocomplete", "new-password");
  });
</script>
<!-- Rest of your HTML content -->

<!-- <body class="login"> -->

<body class="school-login-page school-page">

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

          <div class="col-sm-5 col-md-5 sidebar">
            <div class="image-container">
              <img src="{{ URL::asset('/public/general_setting/' . getLogoSystem()) }}" alt="Your Image Description">
            </div>
          </div>

          <div class="col-sm-7 col-sm-offset-3 col-md-7 col-md-offset-2 main content-start">
            <div class="content-form-login-page-school-plugin md-form">
              <form class="form-horizontal" method="POST" action="{{ url('/login') }}">
                <input type="hidden" name="_token" value="ng6dqKQpcfVoWUABxW33aHAYV681V6asws3AxuZ0">
                {{ csrf_field() }}
                <p class="login-username">
                  <label for="user_login"> Email </label>
                  <input type="text" name="email" id="user_login" autocomplete="off" class="input" value="" size="20">
                  @if ($errors->has('email'))
                  <span class="help-block text-danger mt-1" style="width: 280px;">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                  @endif
                </p>
                <p class="login-password">
                  <label for="user_pass">Password</label>
                  <input type="password" name="password" id="user_pass" autocomplete="new-password" class="input" value="" size="20">
                  @if ($errors->has('password'))
                  <span class="help-block text-danger">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                  @endif
                </p>
                <p class="login-remember"><label><input name="rememberme" type="checkbox" id="rememberme" value="forever" />&nbsp;Remember me</label>
                </p>
                <a class="forgot_pwd_scl" href="{{ url('/password/reset') }}" title="Lost Password">Forgot Password?</a>

                <p class="login-submit">
                  <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary" value="Log In">
                  <input type="hidden" name="redirect_to" value=" ">

                </p>
              </form>
            </div>

          </div>
        </div>



      </div>
    </div>
  </div>
  <!-- <div class="animate form login_form">

        <div class="loginlogo"
          style="">
          <a href="">
            <img src="{{ URL::asset('public/general_setting/' . getLogoSystem()) }}"
              width="230"
              height="70"
              alt="Garage Management System"
              style="margin-top:20px;"></a>
        </div>

        <section class="login_content">
          <form class="form-horizontal"
            method="POST"
            action="{{ url('/login') }}">
            {{ csrf_field() }}

            <h1 class="logintextcolor text-center ">Login Form</h1>
            <div class="loginpading {{ $errors->has('email') ? ' has-error' : '' }}">
              <input type="text"
                class="form-control"
                name="email"
                placeholder="Email"
                value="{{ old('email') }}" />
              @if ($errors->has('email'))
              <div class="mb-1">
                <span class="text-start text-danger"
                  style="margin-top: -15px;">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
              </div>
              @endif
            </div>

            <div class="loginpading {{ $errors->has('password') ? ' has-error' : '' }}">
              <input type="password"
                class="form-control"
                name="password"
                placeholder="Password" />
              @if ($errors->has('password'))
              <div class="mb-1">
                <span class="text-align-start text-danger"
                  style="margin-top: -15px;">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
              </div>
              @endif
            </div>
            <div class="text-center">
              <button type="submit"
                class="btn btn-success submit">Log in</button>

            </div>


            <div class="separator text-center">

              <p class="change_link ">
                <a href="{{ url('/password/reset') }}"
                  class="to_register logintextcolor"> Forgot Password</a>
              </p>
              <div class="clearfix"></div>
              <br />


            </div>
          </form>
        </section>
      </div>

      <div id="register"
        class="animate form registration_form">
        <section class="login_content">
          <form>
            <h1>Create Account</h1>
            <div>
              <input type="text"
                class="form-control"
                placeholder="Username" />

            </div>
            <div class="">
              <input type="email"
                class="form-control"
                placeholder="Email" />

            </div>
            <div class="">
              <input type="password"
                class="form-control"
                placeholder="Password" />

            </div>
            <div>
              <a class="btn btn-default submit"
                href="index.html">Submit</a>
            </div>

            <div class="clearfix"></div>

            <div class="separator">
              <p class="change_link">Already a member ?
                <a href="#signin"
                  class="to_register"> Log in </a>
              </p>

              <div class="clearfix"></div>
              <br />

              <div>
                <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
              </div>
            </div>
          </form>
        </section>
      </div>
    </div>
    
    
  <!-- </div> -->

  @if (!empty(session('firsttime')))
  <script>
    var msg1 = "Your Installation is Successful"
    $(document).ready(function() {
      swal({
        title: msg1,

      }, function() {

        window.location.reload()
      });
    });
  </script>
  <?php Session::flush(); ?>
  @endif
</body>

</html>