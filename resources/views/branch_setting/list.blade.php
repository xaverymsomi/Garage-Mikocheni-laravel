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
                {{ trans('message.Branch Setting') }}</span></a>
          </div>
          @include('dashboard.profile')
        </nav>
      </div>
    </div>
    @include('success_message.message')

    <div class="x_content table-responsive">
      <ul class="nav nav-tabs">
        @can('generalsetting_view')
        <li class="nav-item">
          <a href="{!! url('setting/general_setting/list') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span> <i class="">&nbsp;</i><b>{{ trans('message.GENERAL SETTINGS') }}</b></a>
        </li>
        @endcan
        @can('timezone_view')
        <li class="nav-item">
          <a href="{!! url('setting/timezone/list') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.OTHER SETTINGS') }}</b></a>
        </li>
        @endcan
        @can('accessrights_view')
        <li class="nav-item">
          <a href="{!! url('setting/accessrights/show') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.ACCESS RIGHTS') }}</b></a>
        </li>
        @endcan
        @can('businesshours_view')
        <li class="nav-item">
          <a href="{!! url('setting/hours/list') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.BUSINESS HOURS') }}</b></a>
        </li>
        @endcan
        @can('stripesetting_view')
        <li class="nav-item">
          <a href="{!! url('setting/stripe/list') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.STRIPE SETTINGS') }}</b></a>
        </li>
        @endcan
        @can('branchsetting_view')
        <li class="nav-item">
          <a href="{!! url('branch_setting/list') !!}" class="nav-link active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.BRANCH SETTING') }}</b></a>
        </li>
        @endcan
        <li class="nav-item">
          @can('email_view')
          <a href="{!! url('setting/email_setting/list') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.EMAIL SETTING') }}</b></a>
          @endcan
        </li>
      </ul>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_content">
            <form id="branch_setting_edit_form" method="post" action="{{ url('branch_setting/store') }}" enctype="multipart/form-data" class="form-horizontal upperform">

              @can('branchsetting_view')
              <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space">
                <h4><b>{{ trans('message.BRANCH SETTING') }}</b></h4>
                <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 ln_solid"></p>
              </div>

              <div class="row mt-3">
                <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 checkpointtext text-end" for="Country">{{ trans('message.Select Branch') }} <label class="color-danger">*</label>
                </label>
                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                  <select class="form-control branchsetting form-select" name="select_branch " required>
                    @if (!empty($branchDatas))
                    @foreach ($branchDatas as $branchData)
                    <option value="{{ $branchData->id }}" <?php if ($branchSettingData->branch_id == $branchData->id) {
                                                            echo 'selected';
                                                          } ?>>
                      {{ $branchData->branch_name }}
                    </option>
                    @endforeach
                    @endif
                  </select>
                </div>
                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3"></div>
              </div>
              @endcan

              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              @can('branchsetting_edit')

              <div class="row mt-3">
                <!-- <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group">
                  <a class="btn branchsettingCancel" href="{{ URL::previous() }}">{{ trans('message.CANCEL') }}</a>
                </div> -->
                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group">
                  <button type="submit" class="btn btn_success_margin">{{ trans('message.UPDATE') }}</button>
                </div>
              </div>
              @endcan
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- page content end -->

<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>


<!-- Form field validation -->
{!! JsValidator::formRequest('App\Http\Requests\StoreBranchSettingEditFormRequest', '#branch_setting_edit_form') !!}
<script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>


@endsection