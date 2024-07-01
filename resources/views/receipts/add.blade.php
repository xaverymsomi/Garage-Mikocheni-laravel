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
          <a href="{!! url('/receipt/list') !!}" id=""><i class=""><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}"></i><span class="titleup">
              {{ trans('Add Receipt') }}</span></a>
        </div>
        @include('dashboard.profile')
      </nav>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_content">
          <form id="demo-form2" action="{!! url('/receipt/store') !!}" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left input_mask gatepassAddForm">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="col-md-12 col-xs-12 col-sm-12 space">
              <h4 class="mt-1"><b>{{ trans('CAPTURE RECEIPT') }}</b></h4>
              <p class="col-md-12 col-xs-12 col-sm-12 ln_solid"></p>
            </div>

            <div class="row row-mb-0">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group has-feedback {{ $errors->has('jobcard') ? ' has-error' : '' }} my-form-group">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="jobcard">{{ trans('Quotation No. ') }} <label class="color-danger">*</label> </label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <select name="jobcard" class="form-control form-select" id="selectjobcard" url="{!! url('/gatepass/gatedata') !!}" required>
                    <option value="">{{ trans('Select Quotation No') }}</option>
                    @if (!empty($jobno))
                    @foreach ($jobno as $jobnos)
                    <option value="{{ $jobnos->job_card }}" data-amount="{{ $jobnos->amount }}">{{ $jobnos->job_card }}</option>
                      @endforeach
                      @endif
                  </select>
                </div>
              </div>

              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group has-feedback {{ $errors->has('gatepass_no') ? ' has-error' : '' }}">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="gatepass_no">{{ trans('Invoice Amount') }} <label class="color-danger">*</label>

                </label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" id="invoice_amount" name="invoice_amount" value="" placeholder="{{ trans('Amount') }}" class="form-control" required readonly>

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
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }} my-form-group">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="email">{{ trans('message.Email') }} <label class="color-danger">*</label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" id="email" name="email" value="" placeholder="{{ trans('message.Enter Email') }}" class="form-control jobcard" readonly>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group has-feedback {{ $errors->has('gatepass_no') ? ' has-error' : '' }}">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="gatepass_no">{{ trans('Premium Currency:') }} <label class="color-danger">*</label>

                </label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" id="" name="" value="TZS" placeholder="{{ trans('Amount') }}" class="form-control" required readonly>

                </div>
              </div>
            </div>

            <div class="col-md-12 col-xs-12 col-sm-12 space">
              <h4 class="mt-5"><b>{{ trans('PAYMENT INFORMATION') }}</b></h4>
              <p class="col-md-12 col-xs-12 col-sm-12 ln_solid"></p>
            </div>

            <div class="row row-mb-0">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group has-feedback my-form-group">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="model_name">{{ trans('Mode:') }} <label class="color-danger">*</label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <select name="mode" id="" class="form-control">
                    <<option value="">{{ trans('Please Select') }}</option>
                    @if (!empty($payment_mode))
                    @foreach ($payment_mode as $payment_modes)
                    <option value="{{ $payment_modes->payment }}">
                       {{ $payment_modes->payment }}
                    </option>
                    @endforeach
                    @endif
                  </select>
                </div>
              </div>

              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group has-feedback my-form-group">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="veh_type">{{ trans('Reference No:') }} <label class="color-danger">*</label>
                </label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" id="" name="reference_no" value="{{ $code }}" placeholder="{{ trans('Enter Reference Number') }}" class="form-control jobcard" readonly>
              
                  
                </div>
              </div>
            </div>

            <div class="row row-mb-0">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group has-feedback">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="chassis">{{ trans('Insuer Bank:') }} </label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <select name="insuer" id="" class="form-control">
                    <<option value="">{{ trans('Please Select') }}</option>
                    @if (!empty($insuer))
                    @foreach ($insuer as $insuers)
                    <option value="{{ $insuers->insurer_bank }}">
                       {{ $insuers->insurer_bank }}
                    </option>
                    @endforeach
                    @endif
                  </select>
                </div>
              </div>
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group has-feedback">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="chassis">{{ trans('Collecting Bank:') }} </label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <select name="collecting_bank" id="" class="form-control">
                    <<option value="">{{ trans('Please Select') }}</option>
                    @if (!empty($collecting_bank))
                    @foreach ($collecting_bank as $collecting_banks)
                    <option value="{{ $collecting_banks->bank_name }}">
                       {{ $collecting_banks->bank_name }}
                    </option>
                    @endforeach
                    @endif
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group has-feedback">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="receiveamount">{{ trans('Amount:') }} <label class="color-danger">*</label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" id="receiveamount" name="receiveamount" value="" placeholder="{{ trans('Enter Received Amount') }}" class="form-control" required>
                </div>
              </div>
            
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group has-feedback">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="currency">{{ trans('Currency:') }} <label class="color-danger">*</label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <select name="currency" id="currency" class="form-control">
                    <option value="">{{ trans('Please Select') }}</option>
                    @if (!empty($currencies))
                    @foreach ($currencies as $currency)
                    <option value="{{ $currency->code }}" data-rate="{{ $currency->rate }}">
                      {{ $currency->code }}
                    </option>
                    @endforeach
                    @endif
                  </select>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group has-feedback">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="exchange_rate">{{ trans('Exchange Rate:') }} <label class="color-danger">*</label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <select name="exchange_rate" id="exchange_rate" class="form-control">
                    <option value="">{{ trans('message.Select Type') }}</option>
                    <option value="1">1.00</option>
                    <option value="2000">1USD</option>
                  </select>
                </div>
              </div>
            
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group has-feedback">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="equivalent">{{ trans('Equivalent Amount:') }} <label class="color-danger">*</label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" id="equivalent" name="equivalent" value="" placeholder="{{ trans('Equivalent Amount') }}" class="form-control" required readonly>
                </div>
              </div>
            </div>
            
              
              
            <div class="col-md-12 col-xs-12 col-sm-12 space">
              <h4 class="mt-5"><b>{{ trans('message.OTHER INFORMATION') }}</b></h4>
              <p class="col-md-12 col-xs-12 col-sm-12 ln_solid"></p>
            </div>

            <div class="row">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group {{ $errors->has('out_date') ? ' has-error' : '' }} my-form-group">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 currency" for="servie_out_date">{{ trans('Date & Time received') }} <label class="color-danger">*</label></label>
                <!-- today date in hidden type -->
                <?php $currendate = date('Y-m-d H:m:s'); ?>
                <input type="hidden" id="" name="today" placeholder="YYYY-MM:DD hh:mm:ss" class="form-control" value="{{ $currendate }}">
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 date">
                  <input type="text" id="outdate_gatepass" name="out_date" autocomplete="off" placeholder="yyyy-mm-dd hh:mm:ss" class="form-control gatepassOutdate datepicker" value="{{ old('date', now()->setTimezone($timezone)->format('Y-m-d H:i:s')) }}" onkeypress="return false;" required>
                </div>
              </div>
            </div>

           

            <div class="row">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <!-- <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                <a class="btn btn-primary addGatepassCancelButton" href="{{ URL::previous() }}">{{ trans('message.CANCEL') }}</a>
              </div> -->
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                <button type="submit" class="btn btn-success addGatepassSubmitButton">{{ trans('message.SUBMIT') }}</button>
              </div>
            </div>

          </form>.
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->


<!-- Scripts starting -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // Default to the first option for exchange rate
    $('#exchange_rate option:eq(1)').prop('selected', true);
    
    // Function to calculate equivalent amount
    function calculateEquivalent() {
      var receivedAmount = parseFloat($('#receiveamount').val());
      var exchangeRate = parseFloat($('#exchange_rate').val());
      if (!isNaN(receivedAmount) && !isNaN(exchangeRate)) {
        var equivalentAmount = receivedAmount * exchangeRate;
        $('#equivalent').val(equivalentAmount.toFixed(2));
      } else {
        $('#equivalent').val('');
      }
    }
    
    // Calculate equivalent amount on change of received amount
    $('#receiveamount').on('input', function() {
      calculateEquivalent();
    });
    
    // Update exchange rate when currency is selected
    $('#currency').change(function() {
      var selectedOption = $(this).find('option:selected');
      var exchangeRate = selectedOption.data('rate');
      $('#exchange_rate').val(exchangeRate).change();
    });
    
    // Calculate equivalent amount on change of exchange rate
    $('#exchange_rate').change(function() {
      calculateEquivalent();
    });
    
    // Trigger calculation on page load if values are already filled
    calculateEquivalent();
  });
</script>

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
          updateField('#invoice_amount', gaterecord.charge);
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