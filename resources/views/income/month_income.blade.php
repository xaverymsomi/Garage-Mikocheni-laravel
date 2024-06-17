@extends('layouts.app')
@section('content')

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="nav_menu">
        <nav>
          <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><a href="{!! url('/income/list') !!}" id=""><i class=""><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}"></i><span class="titleup" id="dynamicText">
                {{ trans('message.Monthly Income Reports') }}</span></a>
            @can('income_add')
            <a href="{!! url('/income/add') !!}" id="">
              <img src="{{ URL::asset('public/img/icons/plus Button.png') }}">
            </a>
            @endcan
          </div>
          @include('dashboard.profile')
        </nav>
      </div>
    </div> 
  </div>
  <div class="row">


    <div class="col-md-12 col-sm-12 col-xs-12">

        <div class="x_panel">
        <div class="x_content">
          <form id="incomeMonthReportForm" method="post" action="{{ url('/income/income_report') }}" enctype="multipart/form-data" class="form-horizontal upperform addMonthIncomeSubmitButton">
            <div class="col-md-12 col-xs-12 col-sm-12">
              <h4><b>{{ trans('message.INCOME DETAILS') }}</b></h4>
              <hr style="margin-top:0px;">
              <p class="col-md-12 col-xs-12 col-sm-12"></p>
            </div>

            {{-- <div class="row"> --}}
            <div class="row {{ $errors->has('start_date') ? ' has-error' : '' }}">
              <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 checkpointtext text-end" for="st_date">{{ trans('message.Start Date') }} <label class="color-danger">*</label>
              </label>

              <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 date ">
                <input type="text" id="start_date" name="start_date" autocomplete="off" class="form-control expStartDate start_date" value="{{ old('start_date') }}" placeholder="<?php echo getDatepicker(); ?>" onkeypress="return false;" required />
              </div>
              @if ($errors->has('start_date'))
              <span class="help-block denger" style="margin-left: 27%;">
                <strong>{{ $errors->first('start_date') }}</strong>
              </span>
              @endif
              <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3"></div>
            </div>
            {{-- </div> --}}

            {{-- <div class="row"> --}} 
            <div class="row mt-3 {{ $errors->has('end_date') ? ' has-error' : '' }}">
              <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 checkpointtext text-end" for="end_date">{{ trans('message.End Date') }} <label class="color-danger">*</label>
              </label>

              <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 date ">
                <input type="text" id="end_date" name="end_date" autocomplete="off" class="form-control expenseEndDate end_date" value="{{ old('end_date') }}" placeholder="<?php echo getDatepicker(); ?>" onkeypress="return false;" required />
              </div>
              <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3"></div>
              @if ($errors->has('end_date'))
              <span class="help-block denger" style="margin-left: 27%;">
                <strong>{{ $errors->first('end_date') }}</strong>
              </span>
              @endif
            </div>
            {{-- </div> --}}

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="row">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <!-- <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
              <a class="btn btn-primary" href="{{ URL::previous() }}">{{ trans('message.CANCEL') }}</a>
              </div> -->
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-2 mx-0">
              <button type="submit" class="btn btn-success addMonthIncomeForm">{{ trans('message.SUBMIT') }}</button>
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
    $(".start_date,.input-group-addon").click(function() {

      var dateend = $('#end_date').val('');

    });

    $(".start_date").datetimepicker({
        format: "<?php echo getDatepicker(); ?>",
        minView: 2,
        autoclose: 1,
        language: "{{ getLangCode() }}",
      }).on('changeDate', function(selected) {
        var startDate = new Date(selected.date.valueOf());

        $('.end_date').datetimepicker({
          format: "<?php echo getDatepicker(); ?>",
          minView: 2,
          autoclose: 1,
          language: "{{ getLangCode() }}",
        }).datetimepicker('setStartDate', startDate);
      })
      .on('clearDate', function(selected) {
        $('.end_date').datetimepicker('setStartDate', null);
      })


    $('.end_date').click(function() {

      var date = $('#start_date').val();
      var msg1 = "{{ trans('message.First Select Start Date') }}";
      var msg2 = "{{ trans('message.OK')}}";

      if (date == '') {
        swal({
          title: msg1,
          cancelButtonColor: '#C1C1C1',
          buttons: {
            cancel: msg2,
          },
          dangerMode: true,
        });
      } else {
        $('.end_date').datetimepicker({
          format: "<?php echo getDatepicker(); ?>",

        })
      }
    });


    /*If select box have value then error msg and has error class remove*/
    $('.expStartDate').on('change', function() {

      var dateValue = $(this).val();

      if (dateValue != null) {
        $('#start_date-error').css({
          "display": "none"
        });
      }

      if (dateValue != null) {
        $(this).parent().parent().removeClass('has-error');
      }
    });


    $('.expenseEndDate').on('change', function() {

      var dateValue = $(this).val();

      if (dateValue != null) {
        $('#end_date-error').css({
          "display": "none"
        });
      }

      if (dateValue != null) {
        $(this).parent().parent().removeClass('has-error');
      }
    });
  });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var titleUpElement = document.getElementById("dynamicText");

        if (titleUpElement.innerText.length > 10) {
            titleUpElement.style.fontSize = "18px";
        }
    });
</script>


<!-- Form field validation -->
{!! JsValidator::formRequest('App\Http\Requests\StoreExpenseMonthlyReportFormRequest', '#incomeMonthReportForm') !!}
<script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>

@endsection