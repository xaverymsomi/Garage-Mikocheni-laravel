@extends('layouts.app')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="nav_menu">
        <nav>
          <div class="nav toggle">
          <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><a href="{{ URL::previous() }}" id=""><i class=""><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}"></i><span class="titleup">
                {{ trans('Email Settings') }}</span></a>
          </div>
          @include('dashboard.profile')
        </nav>
      </div>
    </div>
    @include('success_message.message')
    <div class="x_content table-responsive">
      <ul class="nav nav-tabs">
        <li class="nav-item">
          @can('generalsetting_view')
          <a href="{!! url('setting/general_setting/list') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span> <i class=""></i><b>{{ trans('message.GENERAL SETTINGS') }}</b></a>
          @endcan
        </li>

        <li class="nav-item">
          @can('timezone_view')
          <a href="{!! url('setting/timezone/list') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.OTHER SETTINGS') }}</b></a>
          @endcan
        </li>

        <li class="nav-item">
          @can('accessrights_view')
          <a href="{!! url('setting/accessrights/show') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.ACCESS RIGHTS') }}</b></a>
          @endcan
        </li>

        <li class="nav-item">
          @can('businesshours_view')
          <a href="{!! url('setting/hours/list') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.BUSINESS HOURS') }}</b></a>
          @endcan
        </li>

        <li class="nav-item">
          @can('stripesetting_view')
          <a href="{!! url('setting/stripe/list') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.STRIPE SETTINGS') }}</b></a>
          @endcan
        </li>

        <li class="nav-item">
          @can('branchsetting_view')
          <a href="{!! url('branch_setting/list') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.BRANCH SETTING') }}</b></a>
          @endcan
        </li>

        <li class="nav-item">
          @can('email_view')
          <a href="{!! url('setting/email_setting/list') !!}" class="nav-link active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.EMAIL SETTING') }}</b></a>
          @endcan
        </li>

      </ul>

    </div>
    <div class="row">
      <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_content">
            <form id="email_setting_form" method="post" action="{{ url('setting/email_setting/store') }}" enctype="multipart/form-data" class="form-horizontal upperform">

              <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space">
                <h4><b>{{ trans('message.Update Your Email Configuration Here!') }}</b></h4>
                <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 ln_solid"></p>
              </div>

              <div class="row mt-3">
                <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 text-end" for="Phone_Number">{{ trans('message.Email Driver') }} <label class="color-danger">*</label>
                </label>
                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                  <input type="text" name="MAIL_DRIVER" id="MAIL_DRIVER" class="form-control" placeholder="{{ trans('message.Enter Email Driver') }}" value="{{ $configData['MAIL_DRIVER'] }}" required>
                </div>
                <div class="control-label col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6"><a data-toggle="tooltip" data-placement="bottom" title="Information" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> {{ trans('message.Specify the email driver. Use smtp for SMTP protocol') }} </div>
              </div>
              <div class="row mt-3">
                <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 text-end" for="Phone_Number">{{ trans('message.SMTP Server') }} <label class="color-danger">*</label>
                </label>
                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                  <input type="text" name="MAIL_HOST" id="MAIL_HOST" class="form-control" placeholder="{{ trans('message.Enter SMTP Server') }}" value="{{ $configData['MAIL_HOST'] }}" required>
                </div>
                <div class="control-label col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6"><a data-toggle="tooltip" data-placement="bottom" title="Information" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> {{ trans('message.Enter the SMTP server address. Example: smtp.gmail.com') }} </div>
              </div>
              <div class="row mt-3">
                <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 text-end" for="Phone_Number">{{ trans('message.SMTP Port') }} <label class="color-danger">*</label>
                </label>
                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                  <input type="text" name="MAIL_PORT" id="MAIL_PORT" class="form-control" placeholder="{{ trans('message.Enter SMTP Port') }}" value="{{ $configData['MAIL_PORT'] }}" required>
                </div>
                <div class="control-label col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6"><a data-toggle="tooltip" data-placement="bottom" title="Information" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> {{ trans('message.Specify the SMTP port number. Example: 465 for SSL') }} </div>
              </div>
              <div class="row mt-3">
                <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 text-end" for="Phone_Number">{{ trans('message.Email Address') }} <label class="color-danger">*</label>
                </label>
                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                  <input type="email" name="MAIL_USERNAME" id="MAIL_USERNAME" class="form-control" placeholder="{{ trans('message.Enter Email Address') }}" value="{{ $configData['MAIL_USERNAME'] }}" required>
                </div>
                <div class="control-label col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6"><a data-toggle="tooltip" data-placement="bottom" title="Information" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> {{ trans('message.Enter your full email address') }} </div>
              </div>
              <div class="row mt-3">
                <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 text-end" for="Phone_Number">{{ trans('message.Password') }} <label class="color-danger">*</label>
                </label>
                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                  <input type="password" name="MAIL_PASSWORD" id="MAIL_PASSWORD" class="form-control" placeholder="{{ trans('message.Enter Password') }}" value="{{ $configData['MAIL_PASSWORD'] }}" required>
                </div>
                <div class="control-label col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6"><a data-toggle="tooltip" data-placement="bottom" title="Information" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> {{ trans('message.Provide your email account password. Keep it confidential') }} </div>
              </div>
              <div class="row mt-3">
                <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 text-end" for="Phone_Number">{{ trans('message.Encryption') }} <label class="color-danger"></label>
                </label>
                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                  <input type="text" name="MAIL_ENCRYPTION" id="MAIL_ENCRYPTION" class="form-control" placeholder="{{ trans('message.Enter Encryption') }}" value="{{ $configData['MAIL_ENCRYPTION'] }}">
                </div>
                <div class="control-label col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6"><a data-toggle="tooltip" data-placement="bottom" title="Information" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> {{ trans('message.Choose the encryption method: ssl for SSL/TLS, or null for no encryption') }} </div>
              </div>

              <div class="row mt-3">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group">
                  <button type="submit" class="btn btn_success_margin">{{ trans('message.UPDATE') }}</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- page content end -->

<script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>

<!-- Form field validation -->
{!! JsValidator::formRequest('App\Http\Requests\EmailRequest', '#email_setting_form') !!}
<script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>

@endsection