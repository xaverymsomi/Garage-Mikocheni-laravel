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

  <style>
    .step {
      color: #5A738E !important;
    }

  </style>

  <!-- page content -->
  <div class="right_col"
    role="main">
    <div class="page-title">
      <div class="nav_menu">
        <nav>
          <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"> </i><span class="titleup">&nbsp
                {{ trans('message.JobCard') }}</span></a>
          </div>
          @include('dashboard.profile')
        </nav>
      </div>
    </div>
    <div class="x_content">
      <ul class="nav nav-tabs bar_tabs tabconatent"
        role="tablist">
        @can('jobcard_view')
          <li role="presentation"
            class=""><a href="{!! url('/jobcard/list') !!}"><span class="visible-xs"></span> <i
                class="fa fa-list fa-lg">&nbsp;</i>{{ trans('message.List Of Job Cards') }}</a></li>
        @endcan
        @can('jobcard_add')
          <li role="presentation"
            class="active "><a href="{!! url('/jobcard/add') !!}"><span class="visible-xs"></span><i
                class="fa fa-plus-circle fa-lg">&nbsp;</i><b>{{ trans('message.Add Jobcard') }}</b></a></li>
        @endcan
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_content">
            <div class="panel panel-default">
              <div class="panel-heading step titleup">{{ trans('message.Step - 1 : Add Service Details...') }}</div>
              <form method="post"
                action="{{ url('/service/store') }}"
                enctype="multipart/form-data"
                class="form-horizontal upperform addJobcardForm">

                <div class="form-group">
                  <div class="">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12"
                      for="first-name">{{ trans('message.Jobcard Number') }} <label class="text-danger">*</label></label>
                    <div class="col-md-4 col-sm-4 col-xs-12">

                      <input type="text"
                        id="jobno"
                        name="jobno"
                        class="form-control"
                        value="{{ $code }}"
                        readonly>
                    </div>
                  </div>
                  <div class="">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12"
                      for="first-name">{{ trans('message.Customer Name') }} <label class="text-danger">*</label></label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <select name="Customername"
                        class="form-control select_vhi"
                        cus_url="{!! url('service/get_vehi_name') !!}"
                        required>
                        <option value="">{{ trans('message.Select Customer') }}</option>
                        @if (!empty($customer))
                          @foreach ($customer as $customers)
                            <option value="{{ $customers->customer_id }}">
                              {{ getCustomerName($customers->customer_id) }}
                          @endforeach
                        @endif
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12"
                      for="last-name">{{ trans('message.Vehicle Name') }} <label class="text-danger">*</label></label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <select name="vehicalname"
                        class="form-control"
                        id="vhi"
                        required>
                        <option value="">{{ trans('message.Select vehicle Name') }}</option>
                      </select>
                    </div>
                  </div>
                  <div class="">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12"
                      for="last-name">{{ trans('message.Date') }} <label class="text-danger">*</label></label>
                    <div class="col-md-4 col-sm-4 col-xs-12 input-group date datepicker">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                      <input type="text"
                        id="name"
                        name="date"
                        class="form-control"
                        placeholder="<?php echo getDatepicker();
                        echo ' hh:mm:ss'; ?>"
                        required>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12"
                      for="first-name">{{ trans('message.Title') }}</label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <input type="text"
                        name="title"
                        placeholder="{{ trans('message.Enter Title') }}"
                        class="form-control">
                    </div>
                  </div>
                  <div class="">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12"
                      for="last-name">{{ trans('message.Assign To') }} <label class="text-danger">*</label></label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <select id="AssigneTo"
                        name="AssigneTo"
                        class="form-control"
                        required>
                        <option value="">-- {{ trans('message.Select Assign To') }} --</option>
                        @if (!empty($employee))
                          @foreach ($employee as $employees)
                            <option value="{{ $employees->id }}">{{ $employees->name }}</option>
                          @endforeach
                        @endif
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12"
                      for="first-name">{{ trans('message.Repair Category') }} <label
                        class="text-danger">*</label></label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <select name="repair_cat"
                        class="form-control"
                        required>
                        <option value="">{{ trans('message.-- Select Repair Category--') }}</option>
                        <option value="breakdown">{{ trans('message.Breakdown') }}</option>
                        <option value="booked vehicle">{{ trans('Booked Vehicle') }}</option>
                        <option value="repeat job">{{ trans('Repeat Job') }}</option>
                        <option value="customer waiting">{{ trans('Customer Waiting') }}</option>
                      </select>
                    </div>
                  </div>
                  <label class="control-label col-md-2 col-sm-2 col-xs-12"
                    for="service_type">{{ trans('message.Service Type') }} <label class="text-danger">*</label></label>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <label class="radio-inline"><input type="radio"
                        name="service_type"
                        id="free"
                        value="free"
                        required>{{ trans('message.Free') }}</label>

                    <label class="radio-inline"><input type="radio"
                        name="service_type"
                        id="paid"
                        value="paid"
                        required>{{ trans('message.Paid') }}</label>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2 col-sm-2 col-xs-12"
                    for="details">{{ trans('message.Details') }} <label class="text-danger">*</label></label>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <textarea class="form-control"
                      name="details"
                      id="details"
                      required></textarea>
                  </div>
                  <div id="dvCharge"
                    style="display: none">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12"
                      for="last-name">{{ trans('message.Fix Service Charge') }} (<?php echo getCurrencySymbols(); ?>) <label
                        class="text-danger">*</label></label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <input type="text"
                        id="charge_required"
                        name="charge"
                        class="form-control"
                        placeholder="{{ trans('message.Enter Fix Service Charge') }}"
                        required>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12"
                      for="reg_no">{{ trans('message.Registration No.') }}</label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <input type="text"
                        name="reg_no"
                        id="reg_no"
                        placeholder="{{ trans('message.Enter Registration Number') }}"
                        class="form-control"
                        readonly>
                    </div>
                  </div>
                </div>
                <input type="hidden"
                  name="_token"
                  value="{{ csrf_token() }}">

                <div class="form-group">
                  <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                    <a class="btn btn-primary"
                      href="{{ URL::previous() }}">{{ trans('message.Cancel') }}</a>
                    <button type="submit"
                      class="btn btn-success addJobcardSubmitButton">{{ trans('message.Submit') }}</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>
  <script type="text/javascript">
    $(".datepicker").datetimepicker({
      format: "<?php echo getDatetimepicker(); ?>",
      maxDate: new Date(),

    });
  </script>
  <!--  service type  free and paid -->
  <script>
    $(function() {
      $("input[name='service_type']").click(function() {
        if ($("#paid").is(":checked")) {
          $("#dvCharge").show();
          $("#charge_required").attr('required', true);
        } else {
          $("#dvCharge").hide();
          $("#charge_required").removeAttr('required', false);
        }
      });
    });
  </script>

  <script>
    $(document).ready(function() {

      $('body').on('change', '.select_vhi', function() {

        var url = $(this).attr('cus_url');
        var cus_id = $(this).val();

        $.ajax({

          type: 'GET',
          url: url,
          data: {
            cus_id: cus_id
          },
          success: function(response) {
            $('.modelnms').remove();
            $('#vhi').append(response);

          }

        });
      });


      $('body').on('click', '#vhi', function() {

        var cus_id = $('.select_vhi').val();

        var msg1 = "{{ trans('message.Customer') }}";
        var msg2 = "{{ trans('message.Please select Customer!') }}";
        var msg3 = "{{ trans('message.OK') }}";

        if (cus_id == "") {
          swal({  
                    title: msg1,  
                    text: msg2,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                      cancel: msg3,
                    },
                    dangerMode: true,
                });
         
          return false;
        }
      });

      $('body').on('change', '#vhi', function() {

        var vehi_id = $('.modelnms:selected').val();

        var url = '{{ url('service/getregistrationno') }}';
        $.ajax({

          type: 'GET',
          url: url,
          data: {
            vehi_id: vehi_id
          },
          success: function(response) {
            var res = $.trim(response);
            if (res == "") {
              $('#reg_no').val(res);
              $('#reg_no').removeAttr('readonly');
            } else {
              $('#reg_no').val(res);
              $('#reg_no').attr('readonly', true);
            }
          }
        });

      });
    });
  </script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('.addJobcardSubmitButton').removeAttr('disabled'); //re-enable on document ready
    });
    $('.addJobcardForm').submit(function() {
      $('.addJobcardSubmitButton').attr('disabled', 'disabled'); //disable on any form submit
    });

    $('.addJobcardForm').bind('invalid-form.validate', function() {
      $('.addJobcardSubmitButton').removeAttr('disabled'); //re-enable on form invalidation
    });
  </script>

@endsection
