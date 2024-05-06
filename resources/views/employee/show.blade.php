@extends('layouts.app')
@section('content')

<style>
  .right_side .table_row,
  .member_right .table_row {
    border-bottom: 1px solid #dedede;
    float: left;
    width: 100%;
    padding: 1px 0px 4px 2px;
  }

  .table_row .table_td {
    padding: 8px 8px !important;
  }

  .report_title {
    float: left;
    font-size: 20px;
    width: 100%;
  }
</style>

<!-- page content -->
<div class="right_col" role="main">
  <!-- free service  model-->
  <div id="myModal_free_service" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <!-- <div class="modal-header">
          <h4 id="myLargeModalLabel" class="modal-title">{{ trans('message.Free Service Details') }}</h4>
          <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
        </div> -->
        <div class="modal-body">
        </div>
      </div>
    </div>
  </div>
  <!-- Paid service  model-->
  <div id="myModal_paid_service" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <!-- <div class="modal-header">
          <h4 id="myLargeModalLabel" class="modal-title">{{ trans('message.Paid Service Details') }}</h4>
          <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
        </div> -->
        <div class="modal-body">
        </div>
      </div>
    </div>
  </div>
  <!-- Repeat job service  model-->
  <div id="myModal_repeat_service" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 id="myLargeModalLabel" class="modal-title">{{ trans('message.Repeat Job Service Details') }}</h4>
          <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
        </div>
      </div>
    </div>
  </div>
  <div class="">
    <div class="page-title">
      <div class="nav_menu">
        <nav>
          <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><span class="titleup"><a href="{!! url('/employee/list') !!}"><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}" class="me-2"></a>{{ $user->name }}</span>
          </div>
          @include('dashboard.profile')
        </nav>
      </div>
    </div>
  </div>
  <div class="view_page_header_bg">
    <div class="row">
      <div class="col-xl-10 col-md-9 col-sm-10">
        <div class="user_profile_header_left">
          {{-- <img class="user_view_profile_image" src="{{ URL::asset('public/employee/' . $user->image) }}"> --}}
          <div class="row">
            <div class="view_top1">
              <div class="col-xl-12 col-md-12 col-sm-12">
                <label class="nav_text h5 user-name">
                  {{ $user->name}}&nbsp;
                </label>
                @can('employee_edit')
                <div class="view_user_edit_btn d-inline">
                  <a href="{!! url('/employee/edit/' . $user->id) !!}">
                    <img src="{{ URL::asset('public/img/dashboard/Edit.png') }}">
                  </a>
                </div>
                @endcan
              </div>
              <div class="col-xl-12 col-md-12 col-sm-12 nav_text mt-2">
                <div class="d-lg-inline">
                  <i class=" fa fa-phone"></i> {{ $user->mobile_no }}
                </div>
                <div class="d-lg-inline">
                  <i class=" fa fa-envelope"></i> {{ $user->email }}
                </div>
              </div>
              <div class="col-xl-12 col-md-12 col-sm-12 heading_view mt-3" style="width: 90%;">
                <i class="fa-solid fa-location-dot"></i>
                <lable class="">
                  {{ $user->address }}
                  <!-- , <?php echo getCityName($user->city_id) != null ? getCityName($user->city_id) . ',' : ''; ?>{{ getStateName($user->state_id) }}, {{ getCountryName($user->country_id) }}. -->
                </lable>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-2 col-lg-3 col-md-3 col-sm-2">
        <div class="group_thumbs">
          <img src="{{ URL::asset('public/img/dashboard/Design.png') }}" height="93px" width="134px">
        </div>
      </div>
    </div>
  </div>
  @if (session('message'))
  <div class="row massage">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="checkbox checkbox-success checkbox-circle mb-2 alert alert-success alert-dismissible fade show">
        <input id="checkbox-10" type="checkbox" checked="">
        <label for="checkbox-10 colo_success" style="margin-left: 20px;font-weight: 600;"> {{ session('message') }} </label>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="padding: 1rem 0.75rem;"></button>
      </div>
    </div>
  </div>
  @endif
  <section id="" class="">
    <div class="panel-body padding_0 pb-0">
      <div class="row mt-4">
        <div class="col-xl-12 col-md-12 col-sm-12 table-responsive">
          <ul class="nav nav-tabs" role="tablist">
            <li class="active">
              <a href="" class="tab active fw-bold">
                {{ trans('message.GENERAL') }}</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="row margin_top_15px mx-1">
        <div class="col-xl-3 col-md-3 col-sm-6">
          <label class=" ">{{ trans('message.Display Name') }} </label><br>
          <label class="fw-bold">{{ $user->display_name  ?? $user->name }}<br></label>
        </div>
        <div class="col-xl-3 col-md-3 col-sm-6">
          <label class="">{{ trans('message.Date of Birth') }} </label><br>
          <label class="fw-bold">
            @if (!empty($user->birth_date))
            {{ date(getDateFormat(), strtotime($user->birth_date)) }}
            @else
            {{ trans('message.Not Added') }}
            @endif<br>
          </label>
        </div>
        <div class="col-xl-3 col-md-3 col-sm-6">
          <label class="">{{ trans('message.Gender') }} </label><br>
          <span class="txt_color fw-bold">
            @if ($user->gender == '1')
            <?php echo trans('message.Male'); ?>
            @else
            <?php echo trans('message.Female'); ?>
            @endif
          </span>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-xl-6 col-md-6 col-sm-6">
          <div class="guardian_div mb-3">
            <div class="row">

              <p class="fw-bold overflow-visible h5"> {{ trans('message.More Info') }}. </p>
              
              <div class="col-xl-6 col-md-6 col-sm-12 mt-1">
                <label class=""> {{ trans('message.Join Date') }} : </label>
                <label class="fw-bold">
                  {{ date(getDateFormat(), strtotime($user->join_date)) ?? trans('message.Not Added') }}
                </label>
              </div>
              <div class="col-xl-6 col-md-6 col-sm-12 mt-1">
                <label class=""> {{ trans('message.Left Date') }} : </label>
                <label class="fw-bold">
                @if (!empty($user->left_date))
                  {{ date(getDateFormat(), strtotime($user->left_date)) }}
                @else
                  {{ trans('message.Not Added') }}
                @endif
                </label>
              </div>
              <div class="col-xl-6 col-md-6 col-sm-12 mt-1">
                <label class=""> {{ trans('message.Designation') }} : </label>
                <label class="fw-bold">
                  {{ $user->designation ?? trans('message.Not Added') }}
                </label>
              </div>


              @if (!$tbl_custom_fields->count() !== 0)
              @foreach ($tbl_custom_fields as $tbl_custom_field)
              <?php
              $tbl_custom = $tbl_custom_field->id;
              $customerid = $user->id;

              $datavalue = getCustomData($tbl_custom, $customerid);
              ?>
              @if ($tbl_custom_field->type == 'radio')
              @if ($datavalue != '')
              <?php
              $radio_selected_value = getRadioSelectedValue($tbl_custom_field->id, $datavalue);
              ?>
              <div class="col-xl-6 col-md-6 col-sm-12 mt-1">
                <label class="">{{ $tbl_custom_field->label }} : </label>
                <label class="fw-bold">
                  {{ $radio_selected_value }}<br>
                </label>
              </div>

              @endif
              @else
              @if ($datavalue != '')
              <div class="col-xl-6 col-md-6 col-sm-12 mt-1">
                <label class="">{{ $tbl_custom_field->label }} : </label>
                <label class="fw-bold">
                  {{ $datavalue }}<br>
                </label>
              </div>
              @endif
              @endif
              @endforeach
              @else
              <p style="text-align: center;"><img src="{{ URL::asset('public/img/dashboard/No-Data.png') }}" width="300px"></p>
              @endif
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-md-6 col-sm-6">
          <div class="guardian_div mb-1">
            <p class="fw-bold overflow-visible h5"> {{ trans('message.Address Details') }} </p>
            <div class="row">
              <div class="col-xl-6 col-md-6 col-sm-12 mt-1">
                <label class=""> {{ trans('message.Country') }}: </label>
                <label class="fw-bold">
                  {{ getCountryName($user->country_id) }}
                </label>
              </div>
              <div class="col-xl-6 col-md-6 col-sm-12 mt-1">
                <label class=""> {{ trans('message.State') }}: </label>
                <label class="fw-bold">
                  {{ getStateName($user->state_id)  ?? trans('message.Not Added') }}
                </label>
              </div>
              <div class="col-xl-12 col-md-12 col-sm-12 mt-1">
                <label class=""> {{ trans('message.Town/City') }}: </label>
                <label class="fw-bold">
                  {{ getCityName($user->city_id)  ?? trans('message.Not Added') }}
                </label>
              </div>
              <!-- <div class="col-xl-6 col-md-6 col-sm-12 mt-1">
                <label class=""> {{ trans('message.Address') }}: </label>
                <label class="text-dark fw-bold">{{ $user->address }}</label>
              </div> -->
            </div>

          </div>

        </div>
      </div>

      <div class="row">
        <div class="col-md-6 col-xs-12 col-sm-12">
          <div class="x_panel guardian_div">
            <div class="x_title mb-0 p-0">
              <div class="row" align="left">
                <div class="col-md-10 col-xs-12 col-sm-12">
                  <p class="fw-bold overflow-visible h5">
                    {{ trans('message.Free Service Details') }}
                  </p>
                </div>
                <div class="col-md-2 col-xs-12 col-sm-12">

                  <ul class="nav navbar-right">
                    <li>
                      <form method="get" action="{{ action('JobCardcontroller@index') }}">
                        <input type="hidden" name="free" value="<?php echo 'free'; ?>" />
                        <button type="submit" class="btn  btn-default1 border-0"><img src="{{ URL::asset('public/img/dashboard/view.png') }}" style="width: 18px; height: 18px;"></button>
                      </form>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
            <?php $userid = Auth::User()->id; ?>
            @if (count($emp_free_service) !== 0)
            <?php $colors = array('date-color1', 'date-color2', 'date-color3', 'date-color4', 'date-color5'); // Define an array of colors
            $index = 0; ?>
            @foreach ($emp_free_service as $services)
            <?php
            $class = 'float-start date ' . $colors[$index % count($colors)]; // Get the color class based on the current index
            $index++; ?>

            <div class="x_content">

              <?php
              $date = $services->service_date;
              $month = date('M', strtotime($date));
              $day = date('d', strtotime($date));

              ?>

              <article class="media event">
                <?php echo '<a class="' . $class . '">'; ?>
                <p class="month"><?php echo $month; ?></p>
                <p class="day"><?php echo $day; ?></p>
                </a>
                <?php $view_data = getInvoiceStatus($services->job_no); ?>
                @if ($view_data == 'Yes')
                <a href="" data-bs-toggle="modal" emp_free="{{ $services->id }}" url="{!! url('/employee/free_service') !!}" data-bs-target="#myModal_free_service" print="20" class="emp_freeservice">
                  @else
                  <a href="{!! url('/jobcard/list/' . $services->id) !!}">
                    @endif
                    <div class="media-body mt-1">
                      <?php $dateservicefree = date('Y-m-d', strtotime($services->service_date)); ?>
                      <span class="jobdetails">{{ $services->job_no }} |
                        {{ date(getDateFormat(), strtotime($dateservicefree)) }}</span></br>
                      <span> {{ getCustomerName($services->customer_id) }} |
                        {{ getRegistrationNo($services->vehicle_id) }} |
                        {{ getVehicleName($services->vehicle_id) }}</span>
                    </div>
                    @if ($view_data == 'Yes')
                    <!-- <i class="fa fa-eye eye"
                              style="color:#5FCE9B;"
                              aria-hidden="true"></i> -->
                  </a>
                  @else
                  <!-- <i class="fa fa-eye eye"
                              style="color:#f0ad4e;"
                              aria-hidden="true"></i>-->
                </a>
                @endif
              </article>
            </div>
            @endforeach
            @else
            <p style="text-align: center;"><img src="{{ URL::asset('public/img/dashboard/No-Data.png') }}" width="300px"></p>
            @endif
          </div>
        </div>

        <!-- paid service -->
        <div class="col-md-6 col-xs-12 col-sm-12">
          <div class="x_panel guardian_div">
            <div class="x_title mb-0 p-0">
              <div class="row" align="left">
                <div class="col-md-10 col-xs-12 col-sm-12">
                  <p class="fw-bold overflow-visible h5">
                    {{ trans('message.Paid Service Details') }}
                  </p>
                </div>
                <div class="col-md-2 col-xs-12 col-sm-12">
                  <ul class="nav navbar-right">
                    <form method="get" action="{{ action('JobCardcontroller@index') }}">
                      <input type="hidden" name="paid" value="<?php echo 'paid'; ?>" />
                      <button type="submit" class="btn  btn-default1 border-0"><img src="{{ URL::asset('public/img/dashboard/view.png') }}" style="width: 18px; height: 18px;">
                      </button>
                    </form>
                  </ul>
                </div>
              </div>

              <div class="clearfix"></div>
            </div>

            @if (count($emp_paid_service) !== 0)
            <?php $colors = array('date-color1', 'date-color2', 'date-color3', 'date-color4', 'date-color5'); // Define an array of colors
            $index = 0; ?>
            @foreach ($emp_paid_service as $emp_paid)
            <?php
            $class = 'float-start date ' . $colors[$index % count($colors)]; // Get the color class based on the current index
            $index++; ?>
            <div class="x_content">
              <?php
              $date = $emp_paid->service_date;
              $month = date('M', strtotime($date));
              $day = date('d', strtotime($date));
              ?>
              <article class="media event">
                <?php echo '<a class="' . $class . '">'; ?>
                <p class="month"><?php echo $month; ?></p>
                <p class="day"><?php echo $day; ?></p>
                </a>
                <?php $view_data = getInvoiceStatus($emp_paid->job_no); ?>
                @if ($view_data == 'Yes')
                <a href="" data-bs-toggle="modal" emp_paid="{{ $emp_paid->id }}" url="{!! url('/employee/paid_service') !!}" data-bs-target="#myModal_paid_service" print="20" class="emp_paidservice">
                  @else
                  <a href="{!! url('/jobcard/list/' . $emp_paid->id) !!}">
                    @endif

                    <div class="media-body mt-1">
                      <?php $dateservicepaid = date('Y-m-d', strtotime($emp_paid->service_date)); ?>
                      <span class="jobdetails">{{ $emp_paid->job_no }} |
                        {{ date(getDateFormat(), strtotime($dateservicepaid)) }} </span></br>
                      <span> {{ getCustomerName($emp_paid->customer_id) }} |
                        {{ getRegistrationNo($emp_paid->vehicle_id) }} |
                        {{ getVehicleName($emp_paid->vehicle_id) }}</span>
                    </div>
                    @if ($view_data == 'Yes')
                    <!-- <i class="fa fa-eye eye"
                                style="color:#5FCE9B;"
                                aria-hidden="true"></i> -->
                  </a>
                  @else
                  <!-- <i class="fa fa-eye eye"
                                style="color:#f0ad4e;"
                                aria-hidden="true"></i> -->
                </a>
                @endif
              </article>
            </div>
            @endforeach
            @else
            <p style="text-align: center;"><img src="{{ URL::asset('public/img/dashboard/No-Data.png') }}" width="300px"></p>
            @endif
          </div>
        </div>
      </div>
      <!-- END PANEL BODY DIV-->

  </section>
</div>
<!-- /page content -->


<!-- Scripts starting -->
<script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>

<script type="text/javascript">
  $(document).ready(function() {
    /******** Free Service only ********/
    $(".emp_freeservice").click(function() {

      $('.modal-body').html("");
      var emp_free = $(this).attr("emp_free");
      var url = $(this).attr('url');

      $.ajax({
        type: 'GET',
        url: url,
        data: {
          emp_free: emp_free
        },
        success: function(data) {
          $('.modal-body').html(data.html);
        },
        beforeSend: function() {
          $(".modal-body").html("<center><h2 class=text-muted><b>Loading...</b></h2></center>");
        },
        error: function(e) {
          alert("An error occurred: " + e.responseText);
          console.log(e);
        }
      });
    });



    /****** Repeat job Service only *******/
    $(".emp_repeatjob").click(function() {

      $('.modal-body').html("");
      var emp_repeat = $(this).attr("emp_repeat");
      var url = $(this).attr('url');

      $.ajax({
        type: 'GET',
        url: url,
        data: {
          emp_repeat: emp_repeat
        },
        success: function(data) {
          $('.modal-body').html(data.html);
        },
        beforeSend: function() {
          $(".modal-body").html("<center><h2 class=text-muted><b>Loading...</b></h2></center>");
        },
        error: function(e) {
          alert("An error occurred: " + e.responseText);
          console.log(e);
        }
      });
    });



    /******* Paid Service only ********/
    $(".emp_paidservice").click(function() {
      $('.modal-body').html("");
      var emp_paid = $(this).attr("emp_paid");
      var url = $(this).attr('url');

      $.ajax({
        type: 'GET',
        url: url,
        data: {
          emp_paid: emp_paid
        },
        success: function(data) {
          $('.modal-body').html(data.html);
        },
        beforeSend: function() {
          $(".modal-body").html("<center><h2 class=text-muted><b>Loading...</b></h2></center>");
        },
        error: function(e) {
          alert("An error occurred: " + e.responseText);
          console.log(e);
        }
      });
    });
  });
</script>

@endsection