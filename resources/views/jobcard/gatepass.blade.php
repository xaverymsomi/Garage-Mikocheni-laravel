  @extends('layouts.app')
  @section('content')
  <style>
    .bootstrap-datetimepicker-widget table td span {
      width: 0px !important;
    }

    .table-condensed>tbody>tr>td {
      padding: 3px;
    }
  </style>

  <?php
  $timezone	 = Auth::User()->timezone	;
  $job_no = isset($suggestions) ? $suggestions->job_no : '';
  $f_name = isset($user) ? $user->name : '';
  $l_name = isset($user) ? $user->lastname : '';
  $email = isset($user) ? $user->email : '';
  $mobile = isset($user) ? $user->mobile_no : '';
  $number_plate = isset($vehicle) ? $vehicle->number_plate : '';
  $v_type = isset($vehicle) ? $vehicle->vehicletype_id : '';
  $chassis = isset($vehicle) ? $vehicle->chassisno : '';
  ?>
  <div class="right_col" role="main">
    <div class="page-title">
      <div class="nav_menu">
        <nav>
          <div class="nav toggle">
          <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a>
            <a href="{!! url('/jobcard/list') !!}" id=""><i class=""> <img src="{{ URL::asset('public/supplier/Back Arrow.png') }}"></i><span class="titleup">
                {{ trans('message.Add Gatepass') }}</span></a>
          </div>
          @include('dashboard.profile')
        </nav>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_content">
            <form id="demo-form2" action="{!! url('/jobcard/insert_gatedata') !!}" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left input_mask">

              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space">
                <h4 class="mt-1"><b>{{ trans('message.CUSTOMER INFORMATION') }}</b></h4>
                <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 ln_solid"></p>
              </div>

              <div class="row row-mb-0">
                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback {{ $errors->has('jobcard') ? ' has-error' : '' }} my-form-group">
                  <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="jobcard">{{ trans('message.JobCard No. ') }} <label class="color-danger">*</label></label>
                  <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                    <input type="text" id="jobcard" name="jobcard" value="<?php echo $job_no; ?>" class="form-control" placeholder="{{ trans('message.Enter Job Card Number') }}" required job_url="{!! url('jobcard/gatepass/autofill_data') !!}" readonly />
                  </div>
                </div>


                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback {{ $errors->has('gatepass_no') ? ' has-error' : '' }} my-form-group">
                  <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="gatepass_no">{{ trans('message.Gate_no') }} <label class="color-danger">*</label></label>
                  <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                    <input type="text" id="gatepass_no" name="gatepass_no" class="form-control" value="{{ $code }}" placeholder="{{ trans('message.Auto Generated Gate Pass Number') }}" readonly />
                  </div>
                </div>
              </div>

              <div class="row row-mb-0">
                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback {{ $errors->has('firstname') ? ' has-error' : '' }} my-form-group">
                  <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="firstname">{{ trans('message.First Name') }} <label class="color-danger">*</label></label>
                  <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                    <input type="text" id="firstname" name="firstname" value="{{ $f_name }}" class="form-control" placeholder="{{ trans('message.Enter First Name') }}" readonly />
                  </div>
                </div>

                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback {{ $errors->has('lastname') ? ' has-error' : '' }} my-form-group">
                  <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="lastname">{{ trans('message.Last Name') }} <label class="color-danger">*</label></label>
                  <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                    <input type="text" id="lastname" name="lastname" value="{{ $l_name }}" placeholder="{{ trans('message.Enter Last Name') }}" class="form-control" readonly>
                  </div>
                </div>
              </div>

              <div class="row row-mb-0">
                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback {{ $errors->has('email') ? ' has-error' : '' }} my-form-group">
                  <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="email">{{ trans('message.Email') }} <label class="color-danger">*</label></label>
                  <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                    <input type="text" id="email" name="email" value="{{ $email }}" placeholder="{{ trans('message.Enter Email') }}" class="form-control " readonly>
                  </div>
                </div>

                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback {{ $errors->has('mobile') ? ' has-error' : '' }} my-form-group">
                  <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="mobile">{{ trans('message.Mobile No') }} <label class="color-danger">*</label></label>
                  <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                    <input type="number" id="mobile" name="mobile" value="{{ $mobile }}" placeholder="{{ trans('message.Enter Mobile No') }}" class="form-control" readonly>
                  </div>
                </div>
              </div>

              <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space">
                <h4 class="mt-5"><b>{{ trans('message.VEHICLE INFORMATION') }}</b></h4>
                <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 ln_solid"></p>
              </div>

              <div class="row row-mb-0">
                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback {{ $errors->has('number_plate') ? ' has-error' : '' }} my-form-group">
                  <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="number_plate">{{ trans('message.Number Plate') }} <label class="color-danger">*</label></label>
                  <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                    <input type="text" id="number_plate" name="number_plate" value="{{ $number_plate }}" placeholder="{{ trans('message.Enter Number Plate') }}" class="form-control" readonly>
                  </div>
                </div>
 
                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback {{ $errors->has('veh_type') ? ' has-error' : '' }} my-form-group">
                  <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="veh_type">{{ trans('message.Vehicle Type') }} <label class="color-danger">*</label></label>
                  <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                    <input type="text" id="veh_type" name="veh_type" value="{{ getVehicleType($v_type) }}" placeholder="{{ trans('message.Enter Vehicle Type') }}" class="form-control" readonly>
                  </div>
                </div>
              </div>

              <div class="row row-mb-0">
                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback {{ $errors->has('chassis') ? ' has-error' : '' }}">
                  <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="chassis">{{ trans('message.Chassis') }} </label>
                  <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                    <input type="text" id="chassis" name="chassis" value="{{ $chassis }}" placeholder="{{ trans('message.Enter Chassis No.') }}" class="form-control" readonly>
                </div>
                </div>
                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback {{ $errors->has('kms') ? ' has-error' : '' }}">
                  <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="kms">{{ trans('message.KMs.Run') }} <label class="color-danger">*</label></label>
                  <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                    <input type="text" id="kms" name="kms" placeholder="{{ trans('message.Enter Kms. Run') }}" maxlength="10" class="form-control" required>
                  </div>
                </div>
              
              </div>
              <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space">
                <h4 class="mt-5"><b>{{ trans('message.OTHER INFORMATION') }}</b></h4>
                <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 ln_solid"></p>
              </div>

              <div class="row">
                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 {{ $errors->has('servie_out_date') ? ' has-error' : '' }} my-form-group">
                  <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 currency" for="servie_out_date">{{ trans('message.Vehicle Out Date') }} <label class="color-danger">*</label></label>

                  <!-- today date in hidden type -->
                  <?php $currendate = date('Y-m-d H:i:s'); ?>

                  <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 date">
                    <input type="text" id="outdate_gatepass" name="out_date" autocomplete="off" placeholder="yyyy-mm-dd hh:mm:ss" class="form-control gatepassOutdate datepicker" value="{{ old('date', now()->setTimezone($timezone)->format('Y-m-d H:i:s')) }}" onkeypress="return false;" required>
                  </div>

                  @if ($errors->has('servie_out_date'))
                  <span class="help-block">
                    <strong style="margin-left: 27%;">{{ $errors->first('servie_out_date') }}</strong>
                  </span>
                  @endif
                </div>
              </div>

              <div class="row">
                <!-- <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                  <a class="btn btn-primary" href="{{ URL::previous() }}">{{ trans('message.CANCEL') }}</a>
                </div> -->
                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                  <button type="submit" class="btn btn-success gatepassSubmitButton">{{ trans('message.SUBMIT') }}</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /page content -->


  <!-- Scripts starting -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


  <script>
    $(document).ready(function() {
      $(function() {
        $('.datepicker').datetimepicker({
          format: "<?php echo getDateTimepicker(); ?>",
          todayBtn: true,
          autoclose: 1,
          // minView: 2,
          startDate: new Date(),
        });


        $('body').on('click', '.ui-corner-all', function() {

          var job_id = $(this).text();
          var url = "{!! url('jobcard/gatepass/autofill_data') !!}";
          var msg1 = "{{ trans('message.An error occurred :') }}";

          $.ajax({
            type: 'GET',
            url: url,
            data: {
              job_id: job_id
            },
            success: function(response) {
              var res_job = jQuery.parseJSON(response);
              var d = res_job.service_date;
              var date = new Date(d);
              var final_date = date.toString('dd-MM-yyyy');

              $('#firstname').attr('value', res_job.name);
              $('#lastname').attr('value', res_job.lastname);
              $('#email').attr('value', res_job.email);
              $('#mobile').attr('value', res_job.mobile_no);

              $('#model_name').attr('value', res_job.modelname);
              $('#veh_type').attr('value', res_job.vehical_type);
              $('#chassis').attr('value', res_job.chasicno);
              $('#kms').attr('value', res_job.kms_run);
              $('#ser_date').attr('value', final_date);
            },
            error: function(e) {
              alert(msg1 + " " + e.responseText);
              console.log(e);
            }
          });
        });
      });

      $('body').on('change', '.gatepassOutdate', function() {

        var outDateValue = $(this).val();

        if (outDateValue != null) {
          $('#outdate_gatepass-error').css({
            "display": "none"
          });
        }

        if (outDateValue != null) {
          $(this).parent().parent().removeClass('has-error');
        }
      });
    });
  </script>

  <!-- Form field validation -->
  {!! JsValidator::formRequest('App\Http\Requests\StoreGatepassAddEditFormRequest', '#demo-form2') !!}
  <script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>
  @endsection