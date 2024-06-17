@extends('layouts.app')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="nav_menu">
        <nav>
          <div class="nav toggle">
          <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><span class="titleup">
                {{trans('message.General Settings') }}</span></a>
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
          <a href="{!! url('setting/general_setting/list') !!}" class="nav-link active"><span class="visible-xs"></span> <i class=""></i><b>{{ trans('message.GENERAL SETTINGS') }}</b></a>
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
          <a href="{!! url('setting/email_setting/list') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.EMAIL SETTING') }}</b></a>
          @endcan
        </li>

      </ul>

    </div>
    <div class="row">
      <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_content">
            <form id="general_setting_edit_form" method="post" action="{{ url('setting/general_setting/store') }}" enctype="multipart/form-data" class="form-horizontal upperform">

              <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
                <h4><b>{{ trans('BUSINESS INFORMATION') }} </b></h4>
                <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 ln_solid"></p>
              </div>

              <div class="row mt-3 has-feedback">
                <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 checkpointtext text-end" for="System_Name">{{ trans('message.System Name') }} <label class="color-danger">*</label>
                </label>
                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                  <input type="text" name="System_Name" class="form-control" placeholder="{{ trans('message.Enter System Name/Title') }}" required maxlength="50" value="{{ $settings_data->system_name }}">
                  @if ($errors->has('System_Name'))
                  <span class="help-block">
                    <span class="text-danger">{{ $errors->first('System_Name') }}</span>
                  </span>
                  @endif
                </div>
                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3"></div>
              </div>

              <div class="row mt-3">
                <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 checkpointtext text-end" for="start_year">{{ trans('message.Starting Year') }} </label>
                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 date">
                  <input type="text" name="start_year" class="form-control datepicker1" id="" value="{{ $settings_data->starting_year }}">
                </div>
              </div>

              <div class="row mt-3 has-feedback">
                <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 checkpointtext text-end" for="Phone_Number">{{ trans('message.Phone Number') }} <label class="color-danger">*</label>
                </label>
                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                  <input type="text" name="Phone_Number" class="form-control" placeholder="{{ trans('message.Enter Phone Number') }}" required maxlength="16" minlength="6" value="{{ $settings_data->phone_number }}">
                  @if ($errors->has('Phone_Number'))
                  <span class="help-block">
                    <span class="text-danger">{{ $errors->first('Phone_Number') }}</span>
                  </span>
                  @endif
                </div>
                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3"></div>
              </div>

              <div class="row mt-3 has-feedback">
                <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 checkpointtext text-end" for="Email">{{ trans('message.Email') }} <label class="color-danger">*</label>
                </label>
                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                  <input type="text" name="Email" class="form-control" placeholder="{{ trans('message.Enter Email Address') }}" required value="{{ $settings_data->email }}" maxlength="50">
                  @if ($errors->has('Email'))
                  <span class="help-block">
                    <span class="text-danger">{{ $errors->first('Email') }}</span>
                  </span>
                  @endif
                </div>
                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3"></div>
              </div>

              <div class="row mt-3 has-feedback">
                <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 checkpointtext text-end" for="address">{{ trans('message.Address') }} <label class="color-danger">*</label>
                </label>
                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                  <textarea name="address" class="form-control addressTextarea" rows="4" placeholder="{{ trans('message.Enter Address') }}" maxlength="100" required>{{ $settings_data->address }}</textarea>
                </div>
                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3"></div>
              </div>

              <div class="row mt-3 has-feedback">
                <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 checkpointtext text-end" for="Country">{{ trans('message.Country') }} <label class="color-danger">*</label>
                </label>
                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                  <select class="form-control select_country form-select" name="country_id" countryurl="{!! url('/getstatefromcountry') !!}" required>
                    <option value="">Select Country</option>
                    @foreach ($country as $countrys)
                    <option value="{{ $countrys->id }}" <?php if ($settings_data->country_id == $countrys->id) {
                                                          echo 'selected';
                                                        } ?>>{{ $countrys->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3"></div>
              </div>

              <div class="row mt-3 has-feedback">
                <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 checkpointtext text-end" for="state">{{ trans('message.State') }}</label>
                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                  <select class="form-control state_of_country form-select" name="state_id" stateurl="{!! url('/getcityfromstate') !!}">
                    <!-- <option value="">Select State</option> -->
                    @if (count($state) > 0)
                    @foreach ($state as $states)
                    <option value="{!! $states->id !!}" <?php if ($settings_data->state_id == $states->id) {
                                                          echo 'selected';
                                                        } ?>>{!! $states->name !!}</option>
                    @endforeach
                    @endif
                  </select>
                </div>
                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3"></div>
              </div>

              <div class="row mt-3 has-feedback">
                <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 checkpointtext text-end" for="city">{{ trans('message.City') }} </label>
                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                  <select class="form-control city_of_state form-select" name="city">
                    <!-- <option value="">Select City</option> -->
                    @if (count($city) > 0)
                    @foreach ($city as $citys)
                    <option value="{!! $citys->id !!}" <?php if ($settings_data->city_id == $citys->id) {
                                                          echo 'selected';
                                                        } ?>>{!! $citys->name !!}</option>
                    @endforeach
                    @endif
                  </select>
                </div>
                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3"></div>
              </div>
              <?php
              if (isAdmin(Auth::User()->role_id)) {
              ?>
                <div class="row mt-3">
                  <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 checkpointtext text-end" for="image">{{ trans('message.Logo Image') }}</label>
                  <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                    <input type="file" id="input-file-max-fs" name="Logo_Image" class="form-control dropify" data-max-file-size="5M">
                    @if ($errors->has('Logo_Image'))
                    <span class="help-block">
                      <span class="text-danger">{{ $errors->first('Logo_Image') }}</span>
                    </span>
                    @endif
                    <div class="col-md-12 col-sm-12 col-xs-12 printimg">
                      <img src="{{ url('public/general_setting/' . $settings_data->logo_image) }}" class="logo_img" width="100%">
                    </div>
                    <div class="dropify-preview">
                      <span class="dropify-render"></span>
                      <div class="dropify-infos">
                        <div class="dropify-infos-inner">
                          <p class="dropify-filename">
                            <span class="file-icon"></span>
                            <span class="dropify-filename-inner"></span>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3"></div>
                </div>
              <?php
              }
              ?>


              <div class="row mt-3">
                <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 checkpointtext text-end" for="image">{{ trans('message.Cover Image') }}</label>
                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                  <input type="file" id="input-file-max-fs" name="Cover_Image" class="form-control dropify" data-max-file-size="5M">
                  @if ($errors->has('Cover_Image'))
                  <span class="help-block">
                    <span class="text-danger">{{ $errors->first('Cover_Image') }}</span>
                  </span>
                  @endif

                  <img src="{{ url('public/general_setting/' . $settings_data->cover_image) }}" class="cov_img mt-2" height="250px" width="100%">

                  <div class="dropify-preview ">
                    <span class="dropify-render"></span>
                    <div class="dropify-infos">
                      <div class="dropify-infos-inner">
                        <p class="dropify-filename">
                          <span class="file-icon"></span>
                          <span class="dropify-filename-inner"></span>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3"></div>
              </div>

              <div class="row mt-3 has-feedback">
                <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 checkpointtext text-end" for="Paypal_Id">{{ trans('message.Paypal Email Id') }}
                </label>
                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                  <input type="text" name="Paypal_Id" class="form-control" placeholder="{{ trans('message.Enter Paypal Email Address') }}" maxlength="50" value="{{ $settings_data->paypal_id }}">
                  @if ($errors->has('Paypal_Id'))
                  <span class="help-block">
                    <span class="text-danger">{{ $errors->first('Paypal_Id') }}</span>
                  </span>
                  @endif
                </div>
                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3"></div>
              </div>
              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              @can('generalsetting_edit')

              <div class="row mt-3 has-feedback">
                <!-- <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group ">
                  <a class="btn cancel" href="{{ URL::previous() }}">{{ trans('message.CANCEL') }}</a>
                </div> -->
                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-2 mx-0">
                  <input type="submit" class="btn update general_setting_update" value="{{ trans('message.UPDATE') }}" />
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

<script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>

<script>
  $(document).ready(function() {

    $('.select_country').change(function() {

      countryid = $(this).val();
      var url = $(this).attr('countryurl');

      $.ajax({
        type: 'GET',
        url: url,
        data: {
          countryid: countryid
        },
        success: function(response) {
          $('.state_of_country').html(response);
        }
      });
    });

    $('body').on('change', '.state_of_country', function() {
      stateid = $(this).val();

      var url = $(this).attr('stateurl');
      $.ajax({
        type: 'GET',
        url: url,
        data: {
          stateid: stateid
        },
        success: function(response) {
          $('.city_of_state').html(response);
        }
      });
    });


    /*datetimepicker in starting_year*/
    $('.datepicker1').datetimepicker({
      format: "yyyy",
      endDate: new Date(),
      minView: 4,
      autoclose: true,
      startView: 4,
      language: "{{ getLangCode() }}",
    });


    // Basic
    $('.dropify').dropify();

    // Translated
    $('.dropify-fr').dropify({
      messages: {
        default: 'Glissez-déposez un fichier ici ou cliquez',
        replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
        remove: 'Supprimer',
        error: 'Désolé, le fichier trop volumineux'
      }
    });

    // Used events
    var drEvent = $('#input-file-events').dropify();

    drEvent.on('dropify.beforeClear', function(event, element) {
      return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
    });

    drEvent.on('dropify.afterClear', function(event, element) {
      var msg1 = "{{ trans('message.File deleted') }}";

      alert(msg1);
    });

    drEvent.on('dropify.errors', function(event, element) {
      console.log('Has Errors');
    });

    var drDestroy = $('#input-file-to-destroy').dropify();
    drDestroy = drDestroy.data('dropify')
    $('#toggleDropify').on('click', function(e) {
      e.preventDefault();
      if (drDestroy.isDropified()) {
        drDestroy.destroy();
      } else {
        drDestroy.init();
      }
    })


    /*If address have any white space then make empty address value*/
    $('body').on('keyup', '.addressTextarea', function() {

      var addressValue = $(this).val();

      if (!addressValue.replace(/\s/g, '').length) {
        $(this).val("");
      }
    });
  });
</script>

<!-- Form field validation -->
{!! JsValidator::formRequest('App\Http\Requests\StoreGeneralSettingEditFormRequest', '#general_setting_edit_form') !!}
<script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>

@endsection