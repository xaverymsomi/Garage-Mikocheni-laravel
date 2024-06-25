@extends('layouts.app')
@section('content')
<!-- page content starting -->
<?php
$customer = isset($user) ? $user->id : '';
$timezone	 = Auth::User()->timezone	;
?>

<div class="right_col" role="main">
  <div class="page-title">
    <div class="nav_menu">
      <nav>
        <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a>
          <a href="{!! url('/gatepass/list') !!}" id=""><i class=""><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}"></i><span class="titleup">
              {{ trans('message.Add Gatepass') }}</span></a>
        </div>
        @include('dashboard.profile')
      </nav>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_content">
          <form id="demo-form2" action="{!! url('/gatepass/store') !!}" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left input_mask gatepassAddForm">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="col-md-12 col-xs-12 col-sm-12 space">
              <h4 class="mt-1"><b>{{ trans('message.CUSTOMER INFORMATION') }}</b></h4>
              <p class="col-md-12 col-xs-12 col-sm-12 ln_solid"></p>
            </div>

            <div class="row row-mb-0">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group has-feedback {{ $errors->has('jobcard') ? ' has-error' : '' }} my-form-group">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="jobcard">{{ trans('message.JobCard No. ') }} <label class="color-danger">*</label> </label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <select name="jobcard" class="form-control form-select" id="selectjobcard" url="{!! url('/gatepass/gatedata') !!}" required>
                    <option value="">{{ trans('message.Select JobCard No') }}</option>
                    @if (!empty($jobno))
                    @foreach ($jobno as $jobnos)
                    <option value="{{ $jobnos->job_card }}">{{ $jobnos->job_card }}
                      @endforeach
                      @endif
                  </select>
                </div>
              </div>

              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group has-feedback {{ $errors->has('gatepass_no') ? ' has-error' : '' }}">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="gatepass_no">{{ trans('message.Gate_no') }} <label class="color-danger">*</label>

                </label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" id="gatepass_no" name="gatepass_no" class="form-control" value="{{ $code }}" placeholder="{{ trans('message.Auto Generated Gate Pass Number') }}" readonly />

                </div>
              </div>
            </div>

            <div class="row row-mb-0">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group has-feedback {{ $errors->has('firstname') ? ' has-error' : '' }} my-form-group">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="firstname">{{ trans('Full Name') }} <label class="color-danger">*</label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" id="customer" name="Customername" value="{{ $customer }}" placeholder="{{ trans('Enter Full Name') }}" class="form-control jobcard" required readonly>
                </div>
              </div>
            </div>

            <div class="row row-mb-0">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }} my-form-group">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="email">{{ trans('message.Email') }} <label class="color-danger">*</label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" id="email" name="email" value="" placeholder="{{ trans('message.Enter Email') }}" class="form-control jobcard" readonly>
                </div>
              </div>

              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group has-feedback {{ $errors->has('mobile') ? ' has-error' : '' }} my-form-group">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="mobile">{{ trans('message.Mobile No') }} <label class="color-danger">*</label>
                </label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" id="mobile" name="mobile" value="" placeholder="{{ trans('message.Enter Mobile No') }}" class="form-control jobcard" readonly>
                </div>
              </div>
            </div>

            <div class="col-md-12 col-xs-12 col-sm-12 space">
              <h4 class="mt-5"><b>{{ trans('message.VEHICLE INFORMATION') }}</b></h4>
              <p class="col-md-12 col-xs-12 col-sm-12 ln_solid"></p>
            </div>

            <div class="row row-mb-0">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group has-feedback {{ $errors->has('model_name') ? ' has-error' : '' }} my-form-group">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="model_name">{{ trans('message.Vehicle Name') }} <label class="color-danger">*</label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" id="vehicle" name="vehiclename" value="" placeholder="{{ trans('message.Enter Vehicle Name') }}" class="form-control jobcard" readonly>
                </div>
              </div>

              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group has-feedback {{ $errors->has('veh_type') ? ' has-error' : '' }} my-form-group">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="veh_type">{{ trans('message.Vehicle Type') }} <label class="color-danger">*</label>
                </label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" id="veh_type" name="veh_type" value="" placeholder="{{ trans('message.Enter Vehicle Type') }}" class="form-control jobcard" readonly>
              
                  
                </div>
              </div>
            </div>

            <div class="row row-mb-0">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group has-feedback {{ $errors->has('chassis') ? ' has-error' : '' }}">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="chassis">{{ trans('message.Chassis') }} </label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" id="chassis" name="chassis" value="" placeholder="{{ trans('message.Enter Chassis No.') }}" class="form-control jobcard" readonly>
                
                </div>
              </div>
            </div>

            <div class="col-md-12 col-xs-12 col-sm-12 space">
              <h4 class="mt-5"><b>{{ trans('message.OTHER INFORMATION') }}</b></h4>
              <p class="col-md-12 col-xs-12 col-sm-12 ln_solid"></p>
            </div>

            <div class="row">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group {{ $errors->has('out_date') ? ' has-error' : '' }} my-form-group">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 currency" for="servie_out_date">{{ trans('message.Vehicle Out Date') }} <label class="color-danger">*</label></label>
                <!-- today date in hidden type -->
                <?php $currendate = date('Y-m-d H:m:s'); ?>
                <input type="hidden" id="" name="today" placeholder="YYYY-MM:DD hh:mm:ss" class="form-control" value="{{ $currendate }}">
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 date">
                  <input type="text" id="outdate_gatepass" name="out_date" autocomplete="off" placeholder="yyyy-mm-dd hh:mm:ss" class="form-control gatepassOutdate datepicker" value="{{ old('date', now()->setTimezone($timezone)->format('Y-m-d H:i:s')) }}" onkeypress="return false;" required>
                </div>
              </div>
            </div>

            <!-- <div class="row">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                <a class="btn supplierCancleButton" href="{{ URL::previous() }}">{{ trans('CANCEL') }}</a>
                            </div>
                        </div>
                       
                        </div>
                        <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group">                         
                            <button type="submit" class="btn supplierSubmitButton">{{ trans('SUBMIT') }}</button> 
                        </div>
                        </div> -->

            <div class="row">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <!-- <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                <a class="btn btn-primary addGatepassCancelButton" href="{{ URL::previous() }}">{{ trans('message.CANCEL') }}</a>
              </div> -->
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                <button type="submit" class="btn btn-success addGatepassSubmitButton">{{ trans('message.SUBMIT') }}</button>
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
    /*datetimepicker*/
    $('.datepicker').datetimepicker({
      format: "{{ getDatetimepicker() }}",
      todayBtn: true,
      autoclose: 1,
      startDate: new Date(),
      language: "{{ getLangCode() }}",
    });


    /*select jobcard no fill the data*/
    $('body').on('change', '#selectjobcard', function() {
      var jobcard = $(this).val();
      var url = $(this).attr('url');

      $.ajax({
        type: 'GET',
        url: url,
        data: {
          jobcard: jobcard
        },
        success: function(data) {
          var gaterecord = jQuery.parseJSON(data);

          // Update the values of various form fields based on the AJAX response.
          updateField('#customer', gaterecord.name);
          updateField('#email', gaterecord.email);
          updateField('#mobile', gaterecord.mobile_no);
          updateField('#vehicle', gaterecord.modelname);
          updateField('#veh_type', gaterecord.vehicle_type);
          updateField('#chassis', gaterecord.chassisno);
        },
    });

    function updateField(fieldSelector, newValue) {
      // Set the new value for the field
      $(fieldSelector).val(newValue);

      // Hide the associated error message element
      var errorSelector = fieldSelector + '-error';
      $(errorSelector).css("display", "none");
    }
  });



    $('body').on('click', '.jobcard', function() {
      var f_name = $('#customer').val();
      var l_name = $('#lastname').val();

      var msg1 = "{{ trans('message.Gate Pass') }}";
      var msg2 = "{{ trans('message.Please select JobCard No!') }}";
      var msg6 = "{{ trans('message.OK')}}";

      if (f_name == "" || l_name == "") {
        swal({
          title: msg1,
          text: msg2,
          confirmButtonColor: "#297FCA",
          confirmButtonText: msg6,
        });
        return false;
      }
    });


    /*If date field have value then error msg and has error class should remove*/
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