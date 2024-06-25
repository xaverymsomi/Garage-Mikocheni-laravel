@extends('layouts.app')
@section('content')
<?php if (getLangCode() == 'pl') {
?>
  <style>
    @media (max-width: 320px) {
      ul.bar_tabs>li.active {
        margin-top: 0px !important;
        margin-left: 8px !important;
      }

      .x_panel {
        margin-top: 40px !important;
      }
    }

    @media (max-width: 30px) {
      ul.bar_tabs>li.active {
        margin-top: 0px !important;
        margin-left: 8px !important;
      }

      .x_panel {
        margin-top: 40px !important;
      }
    }

    /* new added */
    ul.recent_box {
      height: 220px;
      width: 100%;
    }
  </style>
<?php
} ?>
<?php if (
  getLangCode() == 'gr' ||
  getLangCode() == 'it' ||
  getLangCode() == 'id' ||
  getLangCode() == 'tr' ||
  getLangCode() == 'ro' ||
  getLangCode() == 'hr' ||
  getLangCode() == 'hu'
) {
?>
  <style>
    @media (max-width: 320px) {
      ul.bar_tabs>li.active {
        margin-top: 0px !important;
        margin-left: 0px !important;
      }

      .x_panel {
        margin-top: 40px !important;
      }
    }

    @media (max-width: 30px) {
      ul.bar_tabs>li.active {
        margin-top: 0px !important;
        margin-left: 0px !important;
      }

      .x_panel {
        margin-top: 40px !important;
      }
    }
  </style>
<?php
} ?>
<?php if (getlangCode() == 'ta') {
?>
  <style>
    @media (max-width: 320px) {
      ul.bar_tabs>li.active {
        margin-top: 0px !important;
        margin-left: 0px !important;
      }

      .x_panel {
        margin-top: 60px !important;
      }
    }

    @media (max-width: 30px) {
      ul.bar_tabs>li.active {
        margin-top: 0px !important;
        margin-left: 0px !important;
      }

      .x_panel {
        margin-top: 60px !important;
      }
    }

    @supports (-webkit-touch-callout: none) {
      ul.bar_tabs>li.active {
        margin-top: 1px !important;
        margin-left: 0px !important;
      }

      .x_panel {
        margin-top: 40px !important;
      }
    }
  </style>
<?php
} ?>
<?php if (
  getLangCode() == 'cs' ||
  getLangCode() == 'ru' ||
  getLangCode() == 'vi'
) {
?>
  <style>
    @media (max-width: 320px) {
      ul.bar_tabs>li.active {
        margin-top: 0px !important;
        margin-left: 0px !important;
      }

      .x_panel {
        margin-top: 40px !important;
      }
    }

    @media (max-width: 30px) {
      ul.bar_tabs>li.active {
        margin-top: 0px !important;
        margin-left: 0px !important;
      }

      .x_panel {
        margin-top: 40px !important;
      }
    }

    @supports (-webkit-touch-callout: none) {
      ul.bar_tabs>li.active {
        margin-top: 1px !important;
        margin-left: 0px !important;
      }

      .x_panel {
        margin-top: 40px !important;
      }
    }
  </style>
<?php
} ?>
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

  @media (min-width: 320px) {
    .ul.bar_tabs>li.active {
      margin-left: 4px !important;
    }
  }
</style>

<!-- page content -->
<div class="right_col" role="main">
  <!-- free service  model-->
  <div id="myModal-free-open" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-xs">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 id="myLargeModalLabel" class="modal-title"> {{ trans('message.Free Service Details') }}</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">

        </div>
      </div>
    </div>
  </div>
  <!-- Paid Service view -->
  <div id="myModal-paid-service" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-xs">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 id="myLargeModalLabel" class="modal-title">{{ trans('message.Paid Service Details') }}</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">

        </div>
      </div>
    </div>
  </div>
  <!--  Repeat job service view -->
  <div id="myModal-repeatjob" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-xs">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 id="myLargeModalLabel" class="modal-title">{{ trans('message.Repeat Job Service Details') }}</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">

        </div>
      </div>
    </div>
  </div>
  <!--  Free service customer view -->
  <div id="myModal-customer-modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-xs">
      <!-- Modal content-->
      <div class="modal-content">

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
            <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><span class="titleup"><a href="{!! url('/customer/list') !!}"><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}" class="me-2"></a>{{ $customer->name }}</span>
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
          {{-- <img class="user_view_profile_image" src="{{ URL::asset('public/customer/' . $customer->image) }}"> --}}
          <div class="row">
            <div class="view_top1">
              <div class="col-xl-12 col-md-12 col-sm-12">
                <label class="nav_text h5 user-name fh5">
                  {{ $customer->name }}&nbsp;
                </label>
                @can('customer_edit')
                <div class="view_user_edit_btn d-inline">
                  <a href="{!! url('/customer/list/edit/' . $customer->id) !!}">
                    <img src="{{ URL::asset('public/img/dashboard/Edit.png') }}">
                  </a>
                </div>
                @endcan
              </div>
              <div class="col-xl-12 col-md-12 col-sm-12 nav_text mt-2">
                <div class="d-lg-inline">
                  <i class=" fa fa-phone"></i> {{ $customer->mobile_no }}
                </div>
                <div class="d-lg-inline">
                  <i class=" fa fa-envelope"></i> {{ $customer->email }}
                </div>
              </div>
              <div class="col-xl-12 col-md-12 col-sm-12 heading_view mt-3" style="width: 90%;">
                <i class="fa-solid fa-location-dot"></i>
                <lable class="">
                  {{ $customer->address }}
                  <!-- , <?php echo getCityName($customer->city_id) != null ? getCityName($customer->city_id) . ',' : ''; ?>{{ getStateName($customer->state_id) }}, {{ getCountryName($customer->country_id) }}. -->
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
        <div class="col-xl-11 col-md-11 col-sm-11 pt-3 table-responsive">
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a href="{!! url('/customer/list/' . $customer->id) !!}" class="nav-link active fw-bold">
                {{ trans('message.GENERAL') }}</a>
            </li>
            @can('vehicle_view')
            <li class="nav-item">
              <a href="{!! url('/customer/list/vehicle/' . $customer->id) !!}" class="nav-link nav-link-not-active fw-bold">
                {{ trans('message.VEHICLE DETAILS') }}</a>
            </li>
            @endcan
            @can('jobcard_view')
            <li class="nav-item">
              <a href="{!! url('/customer/list/jobcard/' . $customer->id) !!}" class="nav-link nav-link-not-active fw-bold">
                {{ trans('message.JOB CARDS') }}</a>
            </li>
            @endcan
            @can('quotation_view')
            <li class="nav-item">
              <a href="{!! url('/customer/list/quotation/' . $customer->id) !!}" class="nav-link nav-link-not-active fw-bold">
                {{ trans('message.QUOTATIONS') }}</a>
            </li>
            @endcan
            @can('invoice_view')
            <li class="nav-item">
              <a href="{!! url('/customer/list/invoice/' . $customer->id) !!}" class="nav-link nav-link-not-active fw-bold">
                {{ trans('message.INVOICES') }}</a>
            </li>
            @endcan
            <li class="nav-item">
              <a href="{!! url('/customer/list/payment/' . $customer->id) !!}" class="nav-link nav-link-not-active fw-bold">
                {{ trans('message.PAYMENTS') }}</a>
            </li>
          </ul>

        </div>
        @canany(['vehicle_add', 'service_add', 'quotation_add', 'income_add'])
        <div class="ms-lg-auto col-xl-1 col-md-1 col-sm-1 text-end">
          <div class="dropdown_toggle">
            <img src="{{ URL::asset('public/img/icons/plus Button.png') }}" class="btn dropdown-toggle border-0" type="button" id="dropdownMenuButtonAction" data-bs-toggle="dropdown" aria-expanded="false">
            <ul class="dropdown-menu heder-dropdown-menu action_dropdown shadow py-2" aria-labelledby="dropdownMenuButtonAction">
              @can('vehicle_add')
              <li><a class="dropdown-item" href="{!! url('/vehicle/add') !!}?c_id={{ $customer->id }}"><i class="fa fa-plus" aria-hidden="true"></i> {{ trans('message.VEHICLE DETAILS') }}</a></li>
              @endcan
              @can('service_add')
              <li><a class="dropdown-item" href="{!! url('/service/add') !!}?c_id={{ $customer->id }}"><i class="fa fa-plus" aria-hidden="true"></i> {{ trans('message.JOB CARDS') }}</a></li>
              @endcan
              @can('quotation_add')
              <li><a class="dropdown-item" href="{!! url('/quotation/add') !!}?c_id={{ $customer->id }}"><i class="fa fa-plus" aria-hidden="true"></i> {{ trans('message.QUOTATIONS') }}</a></li>
              @endcan
              <!-- @can('income_add')
                  <li><a class="dropdown-item" href="?c_id={{ $customer->id }}"><i class="fa fa-plus" aria-hidden="true"></i> {{ trans('message.INVOICES') }}</a></li>
                  @endcan -->
            </ul>
          </div>
        </div>
        @endcanany
      </div>
      <div class="row margin_top_15px mx-1">
        <div class="col-xl-3 col-md-3 col-sm-6">
          <label class="">{{ trans('message.Display Name') }} </label><br>
          <label class="fw-bold">{{ $customer->name }}<br></label>
        </div>
        <div class="col-xl-3 col-md-3 col-sm-6">
          <label class="">{{ trans('message.Date of Birth') }}</label><br>
          <label class="fw-bold">
            @if (!empty($customer->birth_date))
            {{ date(getDateFormat(), strtotime($customer->birth_date)) }}
            @else
            {{ trans('message.Not Added') }}
            @endif<br>
          </label>
        </div>
        <div class="col-xl-3 col-md-3 col-sm-6">
          <label class="">{{ trans('message.Gender') }} </label><br>
          <span class="txt_color fw-bold">
            @if ($customer->gender == '0')
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

            <p class="fw-bold overflow-visible h5"> {{ trans('message.More Info') }}. </p>
            <div class="row">
              
              

              @if (!$tbl_custom_fields->count() !== 0)
              @foreach ($tbl_custom_fields as $tbl_custom_field)
              <?php
              $tbl_custom = $tbl_custom_field->id;
              $customerid = $customer->id;

              $datavalue = getCustomData($tbl_custom, $customerid);
              ?>
              @if ($tbl_custom_field->type == 'radio')
              @if ($datavalue != '')
              <?php
              $radio_selected_value = getRadioSelectedValue($tbl_custom_field->id, $datavalue);
              ?>
              <div class="col-xl-12 col-md-12 col-sm-12 mt-1">
                <label class="">{{ $tbl_custom_field->label }} : </label>
                <label class="fw-bold">
                  {{ $radio_selected_value }}<br>
                </label>
              </div>

              @endif
              @else
              @if ($datavalue != '')
              <div class="col-xl-12 col-md-12 col-sm-12 mt-1">
                <label class="">{{ $tbl_custom_field->label }} : </label>
                <label class="fw-bold">
                  {{ $datavalue }}<br>
                </label>
              </div>
              @endif
              @endif
              @endforeach
              @else
              <!-- <p style="text-align: center;">{{ trans('message.Data not available') }}</p> -->
              <p style="text-align: center;"><img src="{{ URL::asset('public/img/dashboard/No-Data.png') }}" width="200px"></p>
              @endif
            </div>
          </div>

        </div>
        <div class="col-xl-6 col-md-6 col-sm-6">
          <div class="guardian_div mb-2">
            <p class="fw-bold overflow-visible h5"> {{ trans('message.Address Details') }} </p>
            <div class="row">
              <div class="col-xl-6 col-md-6 col-sm-12 mt-1">
                <label class=""> {{ trans('message.Country') }}: </label>
                <label class="fw-bold">
                  {{ getCountryName($customer->country_id) }}
                </label>
              </div>
              <div class="col-xl-6 col-md-6 col-sm-12 mt-1">
                <label class=""> {{ trans('message.State') }}: </label>
                <label class="fw-bold">
                  {{ getStateName($customer->state_id)  ?? trans('message.Not Added') }}
                </label>
              </div>
              <div class="col-xl-12 col-md-12 col-sm-12 mt-1">
                <label class=""> {{ trans('message.Town/City') }}: </label>
                <label class="fw-bold">
                  {{ getCityName($customer->city_id)  ?? trans('message.Not Added') }}
                </label>
              </div>
              <!-- <div class="col-xl-6 col-md-6 col-sm-12 mt-1">
                <label class=""> {{ trans('message.Address') }}: </label>
                <label class="text-dark fw-bold">{{ $customer->address }}</label>
              </div> -->
            </div>

          </div>

        </div>
      </div>
      <div class="row mt-3">
        <div class="col-xl-6 col-md-6 col-sm-6">
          <div class="guardian_div mb-3">
            <div class="x_title row mb-0">
              <div class="col-10 ps-0">
                <p class="padding_8 fw-bold overflow-visible h5">{{ trans('message.Recent Vehicles') }}</p>
              </div>
              <div class="col-2">
                <ul class="nav navbar-right">
                  <li><a href="{!! url('/customer/list/vehicle/' . $customer->id) !!}" class="p-0"><img src="{{ URL::asset('public/img/dashboard/view.png') }}" style="width: 18px; height: 18px;"></a>
                  </li>
                </ul>
              </div>
              <div class="clearfix"></div>
            </div>

            <ul class="list-unstyled top_profiles scroll-view mb-0">
              @if (count($tbl_vehicles) !== 0)
              @foreach ($tbl_vehicles as $tbl_vehicless)
              <li class="media event d-flex align-items-center px-0 pb-0">
                <?php $vehicleimage = getVehicleImage($tbl_vehicless->id); ?>
                <a class="userpic">
                  <img src="{{ URL::asset('public/vehicle/' . $vehicleimage) }}" style="width: 55px;margin-right: 18px;" class="rounded">
                </a>
                <div class="media-body pt-1">
                  <p class="title mb-0"><strong>{{ $tbl_vehicless->modelname }}</strong>&nbsp;<i>{{ $tbl_vehicless->number_plate }}</i></p>
                  <p class="text-uppercase"> {{ getVehicleType($tbl_vehicless->vehicletype_id) }} </p>
                </div>
                <div style="margin-left: auto;">
                  <p>{{ $tbl_vehicless->dom }}</p>
                </div>
              </li>
              @endforeach
              @else
              <p style="text-align: center;"><img src="{{ URL::asset('public/img/dashboard/No-Data.png') }}" width="200px"></p>
              <!-- <p style="text-align: center;">{{ trans('message.Data not available') }}</p> -->
              @endif
            </ul>
          </div>

        </div>
        <div class="col-xl-6 col-md-6 col-sm-6">
          <div class="guardian_div mb-1">
            <div class="x_title row mb-0">
              <div class="col-10 ps-0">
                <p class="padding_8 fw-bold overflow-visible h5">{{ trans('message.Recent Job Cards') }}</p>
              </div>
              <div class="col-2">
                <ul class="nav navbar-right">
                  <li><a href="{!! url('/customer/list/jobcard/' . $customer->id) !!}" class="p-0"><img src="{{ URL::asset('public/img/dashboard/view.png') }}" style="width: 18px; height: 18px;"></a>
                  </li>
                </ul>
              </div>
              <div class="clearfix"></div>
            </div>
            <ul class="list-unstyled top_profiles scroll-view mb-0">
              @if (count($jobCards) !== 0)
              <?php $colors = array('date-color1', 'date-color2', 'date-color3'); // Define an array of colors
              $index = 0; ?>
              @foreach ($jobCards as $jobCard)
              <?php
              $class = 'float-start date ' . $colors[$index % count($colors)]; // Get the color class based on the current index
              $index++;
              $date = $jobCard->service_date;
              $month = date('M', strtotime($date));
              $day = date('d', strtotime($date));
              ?>
              <li class="media event d-flex align-items-center px-0 pb-0">

                <?php echo '<a class="' . $class . '">'; ?>
                <p class="month"><?php echo $month; ?></p>
                <p class="day"><?php echo $day; ?></p>
                </a>
                <div class="media-body pt-1">
                  <p class="title mb-0"><strong>{{ $jobCard->job_no }}</strong></p>
                  <p><i>{{ getVehicleNumberPlate($jobCard->vehicle_id) }}</i></p>
                </div>
                <div style="margin-left: auto;">
                  <p><br>{{ getVehicleName($jobCard->vehicle_id) }}</p>
                </div>
              </li>
              @endforeach
              @else
              <!-- <p style="text-align: center;">{{ trans('message.Data not available') }}</p> -->
              <p style="text-align: center;"><img src="{{ URL::asset('public/img/dashboard/No-Data.png') }}" width="200px"></p>
              @endif
            </ul>
          </div>
        </div>
      </div>

      <div class="row mt-1">
        <div class="col-xl-6 col-md-6 col-sm-6">
          <div class="guardian_div mb-3">
            <div class="x_title row mb-0">
              <div class="col-10 ps-0">
                <p class="padding_8 fw-bold overflow-visible h5">{{ trans('message.Recent Quotations') }}</p>
              </div>
              <div class="col-2">
                <ul class="nav navbar-right">
                  <li><a href="{!! url('/customer/list/quotation/' . $customer->id) !!}" class="p-0"><img src="{{ URL::asset('public/img/dashboard/view.png') }}" style="width: 18px; height: 18px;"></a>
                  </li>
                </ul>
              </div>
              <div class="clearfix"></div>
            </div>
            <ul class="list-unstyled top_profiles scroll-view mb-0">
              @if (count($quotations) !== 0)
              <?php $colors = array('date-color1', 'date-color2', 'date-color3'); // Define an array of colors
              $index = 0; ?>
              @foreach ($quotations as $quotation)
              <?php
              $class = 'float-start date ' . $colors[$index % count($colors)]; // Get the color class based on the current index
              $index++;
              $date = $quotation->service_date;
              $month = date('M', strtotime($date));
              $day = date('d', strtotime($date));
              ?>
              <li class="media event d-flex align-items-center px-0 pb-0">
                <?php echo '<a class="' . $class . '">'; ?>
                <p class="month"><?php echo $month; ?></p>
                <p class="day"><?php echo $day; ?></p>
                </a>
                <div class="media-body pt-1">
                  <p class="title mb-0"><strong>{{ getQuotationNumber($quotation->job_no) }}</strong>&nbsp;<i>{{ getVehicleNumberPlate($quotation->vehicle_id) }}</i></p>
                  <p class="text-capitalize"> {{ $quotation->service_category }} <a data-toggle="tooltip" data-placement="bottom" title="{{ $quotation->service_category }}" class="text-primary"><img src="{{ URL::asset('public/img/dashboard/icon.png') }}" width="14px"></a></p>
                  </p>
                </div>
                <div style="margin-left: auto;">
                  <p class="text-success fw-bold fs-6">{{ getCurrencySymbols() }} {{ getTotalPriceOfQuotation($quotation->id) }}</p>
                </div>
              </li>
              @endforeach
              @else
              <!-- <p style="text-align: center;">{{ trans('message.Data not available') }}</p> -->
              <p style="text-align: center;"><img src="{{ URL::asset('public/img/dashboard/No-Data.png') }}" width="200px"></p>
              @endif
            </ul>
          </div>

        </div>
        <div class="col-xl-6 col-md-6 col-sm-6">
          <div class="guardian_div mb-1">
            <div class="x_title row mb-0">
              <div class="col-10 ps-0">
                <p class="padding_8 fw-bold overflow-visible h5">{{ trans('message.Recent Invoices') }}</p>
              </div>
              <div class="col-2">
                <ul class="nav navbar-right">
                  <li><a href="{!! url('/customer/list/invoice/' . $customer->id) !!}" class="p-0"><img src="{{ URL::asset('public/img/dashboard/view.png') }}" style="width: 18px; height: 18px;"></a>
                  </li>
                </ul>
              </div>
              <div class="clearfix"></div>
            </div>
            <ul class="list-unstyled top_profiles scroll-view mb-0">
              @if (count($invoices) !== 0)
              <?php $colors = array('date-color1', 'date-color2', 'date-color3'); // Define an array of colors
              $index = 0; ?>
              @foreach ($invoices as $invoice)
              <?php
              $class = 'float-start date ' . $colors[$index % count($colors)]; // Get the color class based on the current index
              $index++;
              $date = $invoice->date;
              $month = date('M', strtotime($date));
              $day = date('d', strtotime($date));
              ?>
              <li class="media event d-flex align-items-center px-0 pb-0">
                <?php echo '<a class="' . $class . '">'; ?>
                <p class="month"><?php echo $month; ?></p>
                <p class="day"><?php echo $day; ?></p>
                </a>
                <div class="media-body pt-1">
                  <p class="title mb-0"><strong>{{ $invoice->invoice_number }}</strong>&nbsp;<i>
                      @if ($invoice->type == 0)
                      {{ getVehicleNumberPlateFromService($invoice->sales_service_id) ?? trans('message.Not Added') }}
                      @else
                      @if ($invoice->type == 1)
                      {{ getVehicleNumberPlateFromSale($invoice->sales_service_id) ?? trans('message.Not Added') }}
                      @else
                      {{ 'N/A' }}
                      @endif
                      @endif
                      {{ getVehicleNumberPlate($invoice->vehicle_id) }}</i></p>
                  <p>
                    {{-- <img src="{{ URL::asset('public/customer/' . $customer->image) }}" width="20px" height="20px" class="rounded-circle"> --}}

                    {{ getCustomerName($invoice->customer_id) }} <a data-toggle="tooltip" data-placement="bottom" title="{{ getCustomerName($invoice->customer_id); }}" class="text-primary"><img src="{{ URL::asset('public/img/dashboard/icon.png') }}" width="14px"></a></p>

                </div>
                @if ($invoice->payment_status == 0)
                <div style="margin-left: auto; background: rgba(255, 144, 84, 0.1); color:#E56E19" class="p-2">
                  <p class="fw-bold fs-6 mb-0">
                    {{ trans('message.UnPaid') }}
                  </p>
                </div>
                @else
                @if ($invoice->payment_status == 1)
                <div style="margin-left: auto;background: rgb(82 88 86 / 10%);color: #172D44;" class="p-2">
                  <p class="fw-bold fs-6 mb-0">
                    {{ trans('message.Partially paid') }}
                  </p>
                </div>
                @else
                @if ($invoice->payment_status == 2)
                <div style="margin-left: auto; background: rgba(80, 199, 142, 0.1); color:#20A144;" class="p-2">
                  <p class="fw-bold fs-6 mb-0">
                    {{ trans('message.Full Paid') }}
                  </p>
                </div>
                @endif
                @endif
                @endif

              </li>
              @endforeach
              @else
              <!-- <p style="text-align: center;">{{ trans('message.Data not available') }}</p> -->
              <p style="text-align: center;"><img src="{{ URL::asset('public/img/dashboard/No-Data.png') }}" width="200px"></p>
              @endif
            </ul>
          </div>

        </div>
      </div>
    </div>
    <!-- END PANEL BODY DIV-->

  </section>
</div>
<!-- Page content end -->



<!-- Scripts starting -->
<script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>

<script type="text/javascript">
  /****** Free Service only *******/
  $(document).ready(function() {
    $(".freeserviceopen").click(function() {
      $('.modal-body').html("");

      var f_serviceid = $(this).attr("f_serviceid");
      var url = $(this).attr('url');

      $.ajax({
        type: 'GET',
        url: url,
        data: {
          f_serviceid: f_serviceid
        },
        success: function(data) {
          $('.modal-body').html(data.html);
        },
        beforeSend: function() {
          $(".modal-body").html(
            "<center><h2 class=text-muted><b>Loading...</b></h2></center>");
        },
        error: function(e) {
          alert("An error occurred: " + e.responseText);
          console.log(e);
        }
      });
    });


    /****** Paid Service only *******/
    $(".paidservice").click(function() {
      $('.modal-body').html("");

      var p_serviceid = $(this).attr("p_serviceid");
      var url = $(this).attr('url');

      $.ajax({
        type: 'GET',
        url: url,
        data: {
          p_serviceid: p_serviceid
        },
        success: function(data) {
          $('.modal-body').html(data.html);
        },
        beforeSend: function() {
          $(".modal-body").html(
            "<center><h2 class=text-muted><b>Loading...</b></h2></center>");
        },
        error: function(e) {
          alert("An error occurred: " + e.responseText);
          console.log(e);
        }
      });
    });

    /******* Repeat job  Service only *******/
    $(".repeatjobservice").click(function() {
      $('.modal-body').html("");

      var r_service = $(this).attr("r_service");
      var url = $(this).attr('url');

      $.ajax({
        type: 'GET',
        url: url,
        data: {
          r_service: r_service
        },
        success: function(data) {
          $('.modal-body').html(data.html);
        },
        beforeSend: function() {
          $(".modal-body").html(
            "<center><h2 class=text-muted><b>Loading...</b></h2></center>");
        },
        error: function(e) {
          alert("An error occurred: " + e.responseText);
          console.log(e);
        }
      });
    });

    /******* Free cusomer model service *******/
    $(".customeropenmodel").click(function() {
      $('.modal-body').html("");
      var open_customer_id = $(this).attr("open_customer_id");
      var url = $(this).attr('url');

      $.ajax({
        type: 'GET',
        url: url,
        data: {
          servicesid: open_customer_id
        },
        success: function(data) {
          $('.modal-body').html(data.html);
        },
        beforeSend: function() {
          $(".modal-body").html(
            "<center><h2 class=text-muted><b>Loading...</b></h2></center>");
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