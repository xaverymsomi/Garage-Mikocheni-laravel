@extends('layouts.app')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@section('content')
<style>
    .bootstrap-datetimepicker-widget table td span {
        width: 0px !important;
    }

    .table-condensed>tbody>tr>td {
        padding: 3px;
    }

    .panel-title {
        background-color: #f5f5f5;
        padding: 10px 15px;
    }
</style>
<style>
    .jobcardmargintop {
        margin-top: 9px;
    }

    .table>tbody>tr>td {
        padding: 10px;
        < !-- vertical-align: unset !important;
        -->
    }

    .jobcard_heading {
        margin-left: 0px;
        margin-bottom: 15px
    }

    label {
        margin-bottom: 0px;
    }

    .checkbox_padding {
        margin: 10px 0px;
    }

    .first_observation {
        margin-left: 23px;
    }

    .height {
        height: 28px;
    }

    .all {
        width: 226px;
    }
</style>

<!-- page content -->
<div class="right_col" role="main">

    <div class="page-title">
        <div class="nav_menu">
            <nav>
                <div class="nav toggle">
                    <span class="titleup">
                        <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a>
                        <a href="{!! url('/jobcard/list') !!}" id=""><i class=""><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}"></i><span class="titleup">
                                {{ trans('message.Process JobCard') }}</span></a>
                    </span>
                </div>

                @include('dashboard.profile')
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_content">
                {{-- <ul class="nav nav-tabs bar_tabs tabconatent customTabWidth" role="tablist">
                        @can('jobcard_view')
                            <li role="presentation" class=""><a href="{!! url('/jobcard/list') !!}"><span
                                        class="visible-xs"></span><i
                                        class="fa fa-list fa-lg">&nbsp;</i>{{ trans('message.List Of Job Cards') }}</span></a>
                </li>
                @endcan
                @can('jobcard_edit')
                <li role="presentation" class="active"><a href="{!! url('/jobcard/list/' . $services->id) !!}" class="process"><span class="visible-xs"></span><i class="fa fa-plus-circle fa-lg i">&nbsp;</i><b>{{ trans('message.Process JobCard') }}</b></span></a>
                </li>
                @endcan
                </ul> --}}
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space">
                                <h4><b>{{ trans('message.Processing Job for...') . $services->job_no }}</b></h4>
                                <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 ln_solid"></p>
                            </div>

                            <form method="post" action="{!! url('/jobcard/store') !!}" class="addJobcardForm">
                                <input type="hidden" class="service_id" name="service_id" value="{{ $services->id }}" />
                                <div class="row">
                                    <div class="row col-md-7 col-lg-7 col-xl-7 col-xxl-7 col-sm-7 col-xs-7">
                                        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12" colspan="2" valign="top">
                                            <h3><?php echo $logo->system_name; ?></h3>
                                        </div>
                                        <div class="row col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
                                            <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4  mt-3">
                                                <img src="{{ url('/public/general_setting/' . $logo->logo_image) }}" style="width: 170px;">
                                            </div>
                                            <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 garrageadd mt-3" valign="top">
                                                <img src="{{ URL::asset('public/img/icons/Vector (15).png') }}" class="p-1">
                                                <?php
                                                echo '' . $logo->email;
                                                ?>
                                                <?php
                                                echo '<br><i class="fa fa-phone fa-lg p-1" aria-hidden="true"></i>&nbsp;&nbsp;' . $logo->phone_number;
                                                ?>
                                                <br>
                                                <img src="{{ url::asset('public/img/icons/Vector (14).png') }}" class="p-1">&nbsp;
                                                <?php
                                                echo $logo->address . ' ';
                                                echo ', ' . getCityName($logo->city_id);
                                                echo ', ' . getStateName($logo->state_id);
                                                echo ', ' . getCountryName($logo->country_id);
                                                ?>
                                                <br>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-lg-5 col-xl-5 col-xxl-5 col-sm-5 col-xs-5">
                                        <div class="row row-mb-0">
                                            <label class="control-label jobcardmargintop col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">{{ trans('message.Job Card No') }}
                                                <label class="color-danger">*</label></label>
                                            <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                                <input type="text" id="job_no" name="job_no" value="{{ $services->job_no }}" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="row row-mb-0">
                                            <label class="control-label jobcardmargintop col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">{{ trans('message.In Date/Time') }}
                                                <label class="color-danger">*</label></label>
                                            <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 date">
                                                {{-- <span class="input-group-addon"><i
                                                            class="glyphicon glyphicon-calendar fa fa-calendar"></i></span> --}}
                                                <input type="text" id="in_date" name="in_date" value="<?php echo date(getDateFormat() . ' H:i:s', strtotime($services->service_date)); ?> " class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="row row-mb-0">
                                            <label class="control-label jobcardmargintop col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">{{ trans('message.Out Date/Time') }}
                                                <label class="color-danger">*</label></label>
                                            <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 date ">
                                                {{-- <span class="input-group-addon"><i
                                                                class="glyphicon glyphicon-calendar fa fa-calendar"></i></span> --}}
                                                <input type="text" id="out_date" name="out_date" autocomplete="off" value="<?php if (!empty($job->out_date)) {
                                                                                                                                echo date(getDateFormat() . ' H:i:s', strtotime($job->out_date));
                                                                                                                            } ?>" class="form-control outDateValue datepicker" placeholder="<?php echo getDatetimepicker(); ?>" required>
                                            </div>


                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space1">
                                    <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space1_solid">
                                    </p>
                                </div>
                                {{-- @if (empty($services->assign_to)) --}}

                                <div class="row mt-3">
                                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                        <label class="control-label jobcardmargintop col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">{{ trans('message.Assign To') }}
                                            <label class="color-danger">*</label></label>
                                        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                            <select id="AssigneTo" name="AssigneTo" class="form-control form-select">
                                                <option value="">
                                                    {{ trans('message.Select Assign To') }}
                                                </option>
                                                @if (!empty($employees))
                                                @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}" <?php if ($services->assign_to == $employee->id) {
                                                                                        echo 'selected';
                                                                                    } ?>>
                                                    {{ $employee->name }}
                                                </option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <span id="common_error_span" class="help-block error-help-block text-danger" style="display: none">{{ trans('message.Please Select Assign To.')}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space1">
                                    <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 ln_solid">
                                    </p>
                                </div>
                                {{-- @endif --}}

                                <div class="row">
                                    <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                                        <h2 class="text-left jobcard_heading fw-bold">{{ trans('message.Customer Details') }}
                                        </h2>
                                        <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space1_solid">
                                        </p>
                                        <div class="row row-mb-0">
                                            <label class="control-label jobcardmargintop col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">{{ trans('message.Name') }}:</label>
                                            <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                                <input type="text" id="name" name="name" class="form-control" value="{{ getCustomerName($services->customer_id) }}" readonly>
                                            </div>
                                        </div>
                                        <div class="row row-mb-0">
                                            <label class="control-label jobcardmargintop col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">{{ trans('message.Address') }}:</label>
                                            <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                                <input type="text" id="address" name="address" class="form-control" value="{{ getCustomerAddress($services->customer_id) }}" readonly>
                                            </div>
                                        </div>
                                        <div class="row row-mb-0">
                                            <label class="control-label jobcardmargintop col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">{{ trans('message.Contact No') }}:</label>
                                            <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                                <input type="text" id="con_no" name="con_no" class="form-control" value="{{ getCustomerMobile($services->customer_id) }}" readonly>
                                            </div>
                                        </div>

                                        <div class="row row-mb-0">
                                            <label class="control-label jobcardmargintop col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                                                {{ trans('message.Email') }}:</label>
                                            <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                                <input type="text" id="email" name="email" class="form-control" value="{{ getCustomerEmail($services->customer_id) }}" readonly>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 vehicle_space">
                                        <h2 class="text-left jobcard_heading fw-bold">{{ trans('message.Vehicle Details') }}
                                        </h2>
                                        <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space1_solid">
                                        </p>
                                        <div class="row row-mb-0">
                                            <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2">{{ trans('message.Model Name') }}:</label>
                                            <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                                                <input type="text" id="model" name="model" class="form-control" value="{{ $vehicle->modelname }}" readonly>
                                            </div>
                                            <label class="jobcardmargintop col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2">{{ trans('message.Chasis No') }}:
                                            </label>
                                            <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                                                <input type="text" id="chassisno" name="chassisno" class="form-control" value="{{ $vehicle->chassisno }}" readonly>
                                            </div>
                                        </div>
                                        <div class="row row-mb-0">
                                            <label class="jobcardmargintop control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2">{{ trans('message.Engine No') }}:
                                            </label>
                                            <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                                                <input type="text" id="engine_no" name="engine_no" class="form-control" value="{{ $vehicle->engineno }}" readonly>
                                            </div>

                                        </div>
                                        @if (!empty($s_date))
                                        <div class="row row-mb-0 divId" id="divId">
                                            <label class="control-label jobcardmargintop col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2">{{ trans('message.Date Of Sale') }}:
                                            </label>
                                            <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                                                <input type="text" id="sales_date" name="sales_date" class="form-control" value="{{ date(getDateFormat(), strtotime($s_date->date)) }}" readonly>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                            </div>
                                            <!-- <label class="jobcardmargintop col-md-2 col-sm-2 col-xs-12">{{ trans('message.Color') }}:</label>
                                                                      <div class="col-md-4 col-sm-4 col-xs-12">
                                                                         <input type="text" id="color" name="color" class="form-control" value="@if (!empty($color)) {{ $color->color }} @endif" readonly >
                                                                      </div> -->
                                        </div>
                                        @endif
                                        @if (!empty($job->coupan_no))
                                        <div class="row row-mb-0">
                                            <label class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2">{{ trans('message.Free Service Coupan No') }}:</label>
                                            <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                                                <input type="text" id="coupan_no" name="coupan_no" value="<?php if (!empty($job)) {
                                                                                                                echo "$job->coupan_no";
                                                                                                            } ?>" class="form-control" readonly>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                            </div>
                                        </div>
                                        @endif

                                        @if ($washbay_data != null)
                                        <div class="row row-mb-0">
                                            <label class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 jobcardmargintop">{{ trans('message.Wash Bay Charge') }}<label class="text-danger"></label>:</label>
                                            <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                                                <input type="text" id="washBay" name="washBayCharge" class="form-control" value="{{ $washbay_data->price }}" readonly>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space1">
                                    <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 ln_solid">
                                    </p>
                                </div>
                                <div class="row">
                                    <div class="col-md-10 col-lg-10 col-xl-10 col-xxl-10 col-sm-10 col-xs-10">
                                        <h3 class="fw-bold mt-0">{{ trans('message.Observation List') }}
                                            {{-- <button type="button" data-bs-target="#responsive-modal-observation" data-bs-toggle="modal" class="btn btn-outline-secondary clickAddNewButton ms-1"> + </button> --}}
                                        </h3>
                                    </div>
                                </div>
                                <div class="row panel-group">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h5 class="panel-title">
                                                <a data-bs-toggle="collapse" href="#collapse1" class="ob_plus"><i class="fa fa-plus"></i>
                                                    {{ trans('message.Observation Points') }}</a>
                                            </h5>
                                        </div>
                                        <div id="collapse1" class="panel-collapse collapse in">
                                            <div class="panel-body main_data table-responsive">
                                                <!-- Observation Checked Points -->
                                                <table class="table table-bordered table-sm main_data_points f-14" id="main_data_points" align="center">
                                                    <thead>
                                                        <tr>
                                                            <th class="fw-bold">{{ trans('message.Category') }}</th>
                                                            <th class="fw-bold">{{ trans('message.Observation Point') }}</th>
                                                            <th class="fw-bold">{{ trans('message.Select Product') }}</th>
                                                            
                                                        </tr>
                                                    </thead>

                                                    <tbody id="tbd">
                                                        <?php $i = 1; ?>
                                                    
                                                        <?php if ($obtale == []) {
                                                        ?>
                                                            <tr>
                                                                <?php echo "No Observation Found"; ?>
                                                            </tr>
                                                            <?php
                                                        } else {
                                                            foreach ($obtale as $datas) { ?>
                                                            <tr class="obs_point_data" id="<?php echo 'row_id_delete_' . $i; ?>">
                                                                <td>
                                                                    <input type="text" name="product2[category][]" class="form-control" value="<?php echo $datas->job_cartegory_name; ?>" readonly="true">
                                                                </td>
                                                                <td>

                                                                    <input type="text" name="product2[sub_points][]" class="form-control" value="<?php echo $datas->product; ?>" readonly="true">
                                                                </td>


                                                                <td>
                                                                    <input type="text" name="product2[sub_points][]" class="form-control" value="<?php echo $datas->observation; ?>" readonly="true">
                                                                </td>
                                                                <?php $i++;} ?>
                                                        <?php }?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-10 col-lg-10 col-xl-10 col-xxl-10 col-sm-10 col-xs-10 header">
                                      <h4><b>{{ trans('message.SALE PART') }}</b></h4>
                                    </div>
                                    <div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2">
                                    </div>
                                  </div>
                                  <div class="col-md-12 col-xs-12 col-sm-12 form-group table-responsive">
                                    <table class="table table-bordered adddatatable" id="tab_taxes_detail" align="center" style="font-size:14px;" width="100%">
                                      <thead>
                                        <tr>
                                          <th class="actionre">{{ trans('message.Manufacturer Name') }}</th>
                                          <th class="actionre">{{ trans('message.Product Name') }}</th>
                                          <th class="actionre">{{ trans('message.Quantity') }}</th>
                                          <th class="actionre" style="width:10%;">{{ trans('message.Price') }} (<?php echo getCurrencySymbols(); ?>)</th>
                                          <th class="actionre" style="width:13%;">{{ trans('message.Amount') }} (<?php echo getCurrencySymbols(); ?>)</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php $row_id = 0; ?>
                                        @foreach ($stock as $stocks)
                                        <tr id="row_id_<?php echo $row_id; ?>">
                                          <td class="tbl_td_selectManufac_error_<?php echo $row_id; ?>">
                                            {{-- <input type="text" value="" readonly> --}}
                                            <select class="form-control select_producttype select_producttype_<?php echo $row_id; ?> form-select" name="product[Manufacturer_id][]" m_url="{!! url('/purchase/producttype/names') !!}" row_did="<?php echo $row_id; ?>" data-id="<?php echo $row_id; ?>" style="width:100%;" required="true">
                                              <option value="">-{{ trans('message.Select Manufacturing Name') }}-</option>
                                              @if (!empty($manufacture_name))
                                              @foreach ($manufacture_name as $manufacture_nm)
                                              <option value="{{ $manufacture_nm->id }}" <?php if ($manufacture_nm->id == $stocks->product_type_id) {
                                                                                          echo 'selected';
                                                                                        } ?>>{{ $manufacture_nm->type }}</option>
                                              @endforeach
                                              @endif
                                            </select>
                    
                                            <span id="select_producttype_error_<?php echo $row_id; ?>" class="help-block error-help-block color-danger" style="display: none">{{ trans('message.Manufacturer name is required.') }}</span>
                                          </td>
                    
                                          <td class="tbl_td_selectProductname_error_<?php echo $row_id; ?>">
                                            <input type="hidden" name="product[tr_id][]" value="<?php echo $stocks->id; ?>" class="form-control" data-id="<?php echo $row_id; ?>" id="<?php echo $row_id; ?>">
                                            <select name="product[product_id][]" class="form-control form-select productid select_productname_<?php echo $row_id; ?>" url="{!! url('purchase/add/getproduct') !!}" row_did="<?php echo $row_id; ?>" data-id="<?php echo $row_id; ?>" style="width:100%;" required="true">
                                              <option value="">{{ trans('message.--Select Product--') }}</option>
                                              @if (!empty($brand))
                                              @foreach ($brand as $brands)
                                              <option value="{{ $brands->id }}" <?php if ($brands->id == $stocks->product_id) {
                                                                                  echo 'selected';
                                                                                } ?>>{{ $brands->name }}</option>
                                              @endforeach
                                              @endif
                                            </select>
                    
                                            <span id="select_productname_error_<?php echo $row_id; ?>" class="help-block error-help-block color-danger" style="display: none">{{ trans('message.Product name is required.') }}</span>
                                          </td>
                                          <td class="tbl_td_quantity_error_<?php echo $row_id; ?>">
                                            <input type="number" name="product[qty][]" url="{!! url('purchase/add/getqty') !!}" class="quantity form-control qty qty_<?php echo $row_id; ?>" prd_url="{{ url('/sale_part/get_available_product') }}" id="qty_<?php echo $row_id; ?>" autocomplete="off" row_id="<?php echo $row_id; ?>" value="{{ $stocks->quantity }}" maxlength="8" required="true">
                                            <!-- <span class="qty_<?php echo $row_id; ?>">{{ getProductcode($stocks->product_id) }}</span> -->
                    
                                            <span id="quantity_error_<?php echo $row_id; ?>" class="help-block error-help-block color-danger" style="display: none">{{ trans('message.Quantity is required.') }}</span>
                                          </td>
                                          <td class="tbl_td_price_error_<?php echo $row_id; ?>">
                                            <input type="text" name="product[price][]" class="product form-control prices price_<?php echo $row_id; ?>" value="{{ $stocks->price }}" autocomplete="off" id="price_<?php echo $row_id; ?>" row_id="<?php echo $row_id; ?>" style="width:100%;" required="true">
                    
                                            <span id="price_error_<?php echo $row_id; ?>" class="help-block error-help-block color-danger" style="display: none">{{ trans('message.Price is required.') }}</span>
                                          </td>
                                          <td class="tbl_td_totaPrice_error_<?php echo $row_id; ?>">
                                            <input type="text" name="product[total_price][]" class="product form-control total_price total_price_<?php echo $row_id; ?>" value="{{ $stocks->price * $stocks->quantity }}" id="total_price_<?php echo $row_id; ?>" style="width:100%;" readonly="true" required="true" >
                    
                                            <span id="total_price_error_<?php echo $row_id; ?>" class="help-block error-help-block color-danger" style="display: none">{{ trans('message.Total price is required.') }}</span>
                                          </td>
                                          
                                        </tr>
                                        <?php
                                        $row_id++; ?>
                                        @endforeach
                                      </tbody>
                                    </table>
                                  </div>
                                <div class="col-md-10 col-lg-10 col-xl-10 col-xxl-10 col-sm-10 col-xs-10">
                                    <h2 class="fw-bold mt-0">{{ trans('message.Other Service Charges') }}
                                        <button type="button" id="add_new_product" class="btn btn-outline-secondary mt-0 ms-1" url="{!! url('/jobcard/addproducts') !!}"> + </button>
                                    </h2>
                                </div>
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered addtaxtype" id="tab_products_detail" align="center">
                                            <thead>
                                                <tr>
                                                    <th class="all">{{ trans('message.Product') }}</th>
                                                    <th class="all">{{ trans('message.Price') }}
                                                        (<?php echo getCurrencySymbols(); ?>)
                                                    </th>
                                                    <th>{{ trans('message.Action') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (!empty($pros))
                                                <?php $id = 1; ?>
                                                @foreach ($pros as $product)
                                                <tr id="<?php echo 'row_id_' . $id; ?>">
                                                    <td>
                                                        <input type="text" name="other_product[]" class="form-control othr_prod_<?php echo $id; ?>" value="<?php echo $product->comment; ?>" id="othr_prod_<?php echo $id; ?>" othr_prod="<?php echo $product->id; ?>" maxlength="250">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="other_price[]" class="form-control other_service_price othr_price_<?php echo $id; ?>" id="oth_price" value="<?php echo $product->total_price; ?>" maxlength="8" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="trash_product" style="cursor: pointer;" data-id="<?php echo $id; ?>"><i class="fa fa-trash fa-2x" aria-hidden="true"></i>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <?php $id++; ?>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                               

                                <!-- Checking for Wash Bay Service Starting -->
                                @if ($washbay_data != null)
                                <div class="col-md-10 col-lg-10 col-xl-10 col-xxl-10 col-sm-10 col-xs-10">
                                    <h2 class="fw-bold mt-0">{{ trans('message.Wash Bay Service Charge') }}</h2>
                                </div>

                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:20px;">
                                        <table class="table table-bordered addtaxtype" align="center">
                                            <thead>
                                                <tr>
                                                    <th width="20%">{{ trans('message.Service') }}</th>
                                                    <th width="20%">
                                                        {{ trans('message.Price') }} (<?php echo getCurrencySymbols(); ?>)
                                                    </th>
                                                    <th>{{ trans('message.Action') }}</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <!-- <input type="text" name="" class="form-control" value="" id="" othr_prod="" > -->
                                                        {{ trans('message.Wash Bay') }}
                                                    </td>
                                                    <td>
                                                        <!-- <input type="text" name="washbayCharge" class="form-control" id="" value="{{ $washbay_data->price }}" > -->
                                                        {{ $washbay_data->price }}
                                                    </td>
                                                    <td>
                                                        @if ($washbay_data->initiate_status == 0)
                                                        <button type="button" class="btn btn-danger initiateProcessBtn border-0 text-light m-1" id="initiateProcessButton" url_init_process="{{ url('/jobcard/get_initial_process_status') }}">
                                                            <span id="" class="initiateButtonSpin glyphicon "></span>
                                                            {{ trans('message.Initiate Process') }}
                                                        </button>
                                                        @elseif($washbay_data->initiate_status == 1 || $washbay_data->initiate_status == 2)
                                                        <button type="button" class="btn btn-danger initiateProcessBtn border-0 text-light m-1" disabled="true">{{ trans('message.Initiate Process') }}</button>
                                                        @endif

                                                        @if ($washbay_data->initiate_status == 1)
                                                        <button type="button" class="btn btn-success completeProcess m-1" id="completeProcessBtn" url_complete_process="{{ url('/jobcard/complete_process_status') }}">
                                                            <span id="" class="completeProcessSpin glyphicon "></span>
                                                            {{ trans('message.Complete Process') }}</button>
                                                        &emsp;
                                                        @elseif($washbay_data->initiate_status == 0)
                                                        <button type="button" class="btn btn-success completeProcess m-1" disabled="true">
                                                            <span id="" class="completeProcessSpin glyphicon "></span>
                                                            {{ trans('message.Complete Process') }}</button>
                                                        &emsp;
                                                        @elseif($washbay_data->initiate_status == 2)
                                                        <button type="button" class="btn btn-success completeProcess m-1" disabled="true">
                                                            <span id="" class="completeProcessSpin glyphicon "></span>
                                                            {{ trans('message.Completed') }}</button>
                                                        &emsp;
                                                        @endif

                                                        <input type="checkbox" name="notifyCustomer" class="text-right notifyCustomerCheckbox" id="" checked>
                                                        {{ trans('message.Notify Customer') }}
                                                        <!-- <label class="control-label text-right" for="notifyCustomer">{{ trans('message.Notify Customer') }} <label class="text-danger"></label></label> -->
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @endif
                                <!-- Checking for Wash Bay Service Ending -->

                                <!-- model in observation Point -->
                                <div class="col-md-12">
                                    <div id="responsive-modal-observation" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">{{ trans('message.Observation Point') }}
                                                    </h4>
                                                    <button type="button" class="btn-close closeButton" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                </div>
                                                <div class="modal-body">
                                                    @if (!empty($tbl_checkout_categories))
                                                    @foreach ($tbl_checkout_categories as $checkoout)
                                                    <?php
                                                    if (getDataFromCheckoutCategorie($checkoout->checkout_point, $checkoout->vehicle_id) != null) {
                                                    ?>
                                                        <div class="panel-group">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h4 class="panel-title">
                                                                        <a data-bs-toggle="collapse" href="#collapse1-{{ $checkoout->id }}" class="ob_plus{{ $checkoout->id }}"><i class="fa fa-plus"></i>
                                                                            {{ $checkoout->checkout_point }}</a>
                                                                    </h4>
                                                                </div>
                                                                <div id="collapse1-{{ $checkoout->id }}" class="panel-collapse collapse">
                                                                    <div class="panel-body">
                                                                        <table class="table">
                                                                            <thead>
                                                                                <tr>
                                                                                    <td>
                                                                                        <b>#</b>
                                                                                    </td>
                                                                                    <td>
                                                                                        <b>{{ trans('message.Checkpoints') }}</b>
                                                                                    </td>
                                                                                    <td>
                                                                                        <b>{{ trans('message.Choose') }}</b>
                                                                                    </td>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php
                                                                                $i = 1;
                                                                                $subcategory = getCheckPointSubCategory($checkoout->checkout_point, $checkoout->vehicle_id);
                                                                                if (!empty($subcategory)) {
                                                                                    foreach ($subcategory as $subcategorys) { ?>
                                                                                        <tr class="id{{ $subcategorys->checkout_point }}">
                                                                                            <td class="col-md-1">
                                                                                                <?php echo $i++; ?>
                                                                                            </td>
                                                                                            <td class="row{{ $subcategorys->checkout_point }} col-md-4">
                                                                                                <?php echo $subcategorys->checkout_point;
                                                                                                //echo $subcategorys->id;
                                                                                                ?>
                                                                                                <?php $data = getCheckedStatus($subcategorys->id, $services->id); ?>
                                                                                            </td>
                                                                                            <td>
                                                                                                <input type="checkbox" <?php echo $data; ?> name="chek_sub_points" name="check_sub_points[]" check_id="{{ $subcategorys->id }}" class="check_pt" url="{!! url('jobcard/select_checkpt') !!}" s_id="{{ getServiceId($services->id) }}" sale_id="{{ $services->id }}" sub_pt="{{ $subcategorys->checkout_point }}" main_cat="{{ $checkoout->checkout_point }}">
                                                                                            </td>
                                                                                        </tr>
                                                                                <?php }
                                                                                } ?>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                    @endforeach
                                                    @else
                                                    <h6 class="text-center">{{ trans('message.No Observation Points Available For This Vehicle Model') }}</h6>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success col-md-offset-10 check_submit observationPointModelSubmitButton" style="margin-bottom:5px;" disabled="true">{{ trans('message.Submit') }}</button>
                                                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">{{ trans('message.Close') }}</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <!-- <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                                        <a class="btn btn-primary cancleJobcardCancelButton" href="{{ URL::previous() }}">{{ trans('message.CANCEL') }}</a>
                                    </div> -->
                                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                                        <button type="submit" class="btn btn-success addJobcardSubmitButton">{{ trans('message.SUBMIT') }}</button>
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /page content -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        var a = 0
        $('.ob_plus').click(function() {
            a = a + 1;
            if (a % 2 != 0) {
                $(this).parent().find(".fa-plus:first").removeClass("fa-plus").addClass(
                    "fa-minus");
            } else {
                $(this).parent().find(".fa-minus:first").removeClass("fa-minus").addClass(
                    "fa-plus");
            }
        });

        $('body').on('click', '.addJobcardSubmitButton', function(e) {
            var msg6 = "{{ trans('message.Please add Observation Points.') }}";
            var msg9 = "{{ trans('message.OK') }}";

            var assign_to = $('#AssigneTo').val();
            if (assign_to === "") {
                $('#common_error_span').css({
                    "display": ""
                });
                return false;
            } else {
                $('#common_error_span').css({
                    "display": "none"
                });
                // return true;
            }

            var ele = $('.product_ids').val();
            var ele1 = $('.prices').val();
            var ele2 = $('.qtyt').val();
            // if (ele == "" || ele1 == "" || ele2 == "") {
            //     swal({
            //         title: msg6,
            //         cancelButtonColor: '#C1C1C1',
            //         buttons: {
            //             cancel: msg9,
            //         },
            //         dangerMode: true,
            //     });
            //     return false;
            // }
            return true;
        });
        $('body').on('change', '#AssigneTo', function() {
            var assign_to = $('#AssigneTo').val();
            if (assign_to === "") {
                $('#common_error_span').css({
                    "display": ""
                });
            } else {
                $('#common_error_span').css({
                    "display": "none"
                });
            }
        });
        var i = 0;
        $('.observation_Plus').click(function() {
            i = i + 1;
            if (i % 2 != 0) {
                $(this).parent().find(".fa-plus:first").removeClass("fa-plus").addClass(
                    "fa-minus");

            } else {
                $(this).parent().find(".fa-minus:first").removeClass("fa-minus").addClass(
                    "fa-plus");
            }
        });

        $('.tbl_points, .check_submit').click(function() {

            var url = "<?php echo url('jobcard/get_obs'); ?>";
            var service_id = $('.service_id').val();

            var modifiedData = [];
            $('.obs_point_data').each(function(index) {
                var id = $(this).find('[name="pro_id_delete"]').val();

                var checkout_subpoints = $(this).find('[name="product2[category][]"]').val();
                var checkout_point = $(this).find('[name="product2[sub_points][]"]').val();
                var service_charge = $(this).find('[name="product2[service_charge][]"]').val();
                var product_id = $(this).find('[name="product2[product_id][]"]').val();
                var price = $(this).find('[name="product2[price][]"]').val();
                var quantity = $(this).find('[name="product2[qty][]"]').val();
                var total_price = $(this).find('[name="product2[total][]"]').val();
                var chargeable = $(this).find('.yes_no:checked').val();
                var category_comments = $(this).find('[name="product2[comment][]"]').val();

                modifiedData.push({
                    id: id,
                    checkout_subpoints: checkout_subpoints,
                    checkout_point: checkout_point,
                    product_id: product_id,
                    service_charge: service_charge,
                    price: price,
                    quantity: quantity,
                    total_price: total_price,
                    chargeable: chargeable,
                    category_comments: category_comments
                });
            });

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: url,
                data: {
                    service_id: service_id,
                    modifiedData: modifiedData
                },
                success: function(response) {
                    jQuery('.main_data').html(response.html);
                    jQuery('.modal').modal('hide');
                    // window.location.reload();
                },
                error: function(e) {
                    console.log(e);
                }
            });
        });

        $('input.check_pt[type="checkbox"]').click(function() {

            if ($(this).prop("checked") == true) {
                var value = 1;
                var url = $(this).attr('url');
                var id = $(this).attr('check_id');
                var sale_id = $(this).attr('sale_id');
                var main_cat = $(this).attr('main_cat');
                var sub_pt = $(this).attr('sub_pt');

                $('.observationPointModelSubmitButton').prop("disabled", false);


                var msg8 = "{{ trans('message.Error') }}";

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: url,
                    data: {
                        value: value,
                        id: id,
                        service_id: sale_id,
                        main_cat: main_cat,
                        sub_pt: sub_pt
                    },
                    success: function(response) {},
                    error: function(e) {
                        alert(msg8 + ' : ' + e)
                    }
                });
            } else if ($(this).prop("checked") == false) {
                var value = 0;
                var url = $(this).attr('url');
                var id = $(this).attr('check_id');
                var sale_id = $(this).attr('s_id');

                $('.observationPointModelSubmitButton').prop("disabled", false);



            }
        });



        $('.sa-warning').click(function() {

            var url = $(this).attr('url');

            var msg1 = "{{ trans('message.Are You Sure?') }}";
            var msg2 = "{{ trans('message.You will not be able to recover this data afterwards!') }}";
            var msg3 = "{{ trans('message.Cancel') }}";
            var msg4 = "{{ trans('message.Yes, delete!') }}";
            swal({
                title: msg1,
                text: msg2,
                icon: 'warning',
                cancelButtonColor: '#C1C1C1',
                buttons: [msg3, msg4],
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    window.location.href = url;
                }
            });
        });

        $('.observationclik').click(function() {

            var observation = $('.observation').val();
            var checkpoint = $('.checkpoint').val();
            var url = $(this).attr('addcheckurl');

            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    observation: observation,
                    checkpoint: checkpoint
                },
                success: function(response) {},
            });
        });

        $('.pointcomment').click(function() {

            var co_point = $(this).attr('point_id');
            var s_id = $(this).attr('s_id');
            var commentname = $('textarea.comment').val();
            var yesno = $('input:radio[name="yesno"][value="yes"]').prop('checked', true);
            var noyes = $('#yesno').attr('checked', true);
            var url = $(this).attr('commenturl');

            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    co_point: co_point,
                    commentname: commentname,
                    s_id: s_id,
                    yesno: yesno
                },
                success: function(response) {

                },
            });
        });

        $("#add_new_product").click(function() {

            var row_id = $("#tab_products_detail > tbody > tr").length;
            var url = $(this).attr('url');

            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    row_id: row_id
                },
                beforeSend: function() {
                    $("#add_new_product").prop('disabled', true);
                },
                success: function(response) {
                    $("#tab_products_detail > tbody").append(response);
                    $("#add_new_product").prop('disabled', false);
                    return false;
                },
                error: function(e) {

                }
            });
        });

        $('body').on('click', '.trash_product', function() {

            var row_id = $(this).attr('data-id');

            $('table#tab_products_detail tr#row_id_' + row_id).fadeOut();
            return false;
        });

        $('body').on('change', '.product_id', function() {

            var row_id = $(this).attr('row_did');

            var product_id = $(this).val();
            var url = $(this).attr('url');

            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    product_id: product_id
                },
                success: function(response) {
                    $('#product_' + row_id).attr('value', response);
                },
                error: function(e) {

                }
            });
        });

        $('body').on('keyup', '.qty', function() {

            var row_id = $(this).attr('row_id');
            var qty = $(this).val();
            var price = $('#product_' + row_id).val();
            var url = $(this).attr('url');

            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    qty: qty,
                    price: price
                },
                success: function(response) {
                    $('#total_' + row_id).attr('value', response);
                },
                beforeSend: function() {

                },
                error: function(e) {

                }
            });
        });

        $(function() {
            $('#Selectvehicle').change(function() {

                var vehicleid = $(this).val();
                var url = $(this).attr('url');

                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {
                        vehicleid: vehicleid
                    },
                    success: function(response) {
                        var res_vehicle = jQuery.parseJSON(response);
                        $('.point').attr('value', res_vehicle.checkout_point);
                    },
                    error: function(e) {
                        console.log(e);
                    }
                });
            });
        });

        /*datetimepicker*/
        $('.datepicker').datetimepicker({
            format: "<?php echo getDatetimepicker(); ?>",
            todayBtn: true,
            autoclose: 1,
        });


        $('body').on('change', '.product_ids', function() {
            var stock = $(this).find(":selected").attr('currnent');
        });

        $('body').on('click', '.delete', function() {

            var row_id = $(this).attr("data_id_trash");
            var delete_url = $(this).attr("delete_data_url");
            var service_id = $(this).attr("service_id");
            var del_pro = $('.del_pro_' + row_id).attr('value');
            var current_tr = $("#main_data_points tr").length;

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: delete_url,
                data: {
                    service_id: service_id,
                    del_pro: del_pro
                },
                success: function(response) {
                    $('#row_id_delete_' + row_id).remove();

                    if (current_tr == 2) {
                        window.location.reload()
                    }
                },
                error: function(e) {
                    console.log(e);
                }
            });
        });

        $('body').on('click', '.trash_product', function() {

            var row_id = $(this).attr("data-id");
            var del_oth_pro = $('#othr_prod_' + row_id).attr('othr_prod');
            var url = $(this).attr('oth_url');

            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    del_oth_pro: del_oth_pro
                },
                success: function(response) {
                    if (response == 1) {
                        $('.othr_prod_' + row_id).val(null);
                        $('.othr_price_' + row_id).val(null);
                    }
                },
                error: function(e) {
                    console.log(e);
                }
            });
            $('#row_id_' + row_id).fadeOut();
        });
        $('body').on('change', '.product_ids', function() {

            var row_id = $(this).attr('row_did');
            var product_id = $(this).val();
            var qt = $(this).attr('qtyappend');
            var serviceCharge = $('.charge_' + row_id).val();


            if (qt == '') {
                qt = $('.qnt_' + row_id).val();
            }
            var url = $(this).attr('url');

            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    product_id: product_id,
                    serviceCharge: serviceCharge
                },
                success: function(response) {
                    if (qt != '') {
                        var ttl = qt * response[0];
                        jQuery('.total1_' + row_id).val(ttl);
                    }

                    jQuery('.product1_' + row_id).val(response[0]);
                    $('.unit_' + row_id).html(response[2]);
                    $('.qnt_' + row_id).val('1');
                    jQuery('.total1_' + row_id).val(response[1]);
                },
                error: function(e) {
                    console.log(e);
                }
            });
        });

        $('.qtyt').keypress(function(event) {
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event
                    .which > 57)) {
                event.preventDefault();
            }
        });
        $('body').on('blur', '.qtyt', function() {

            var row_id = $(this).attr('row_id1');
            var productid = $('.product1s_' + row_id).find(":selected").val();
            var qty = $(this).val();
            var price = $('.product1_' + row_id).val();
            var url = $(this).attr('url');
            var msg5 = "{{ trans('message.Product Not Available') }}";
            var msg6 = "{{ trans('message.Current Stock :') }}";
            var msg9 = "{{ trans('message.OK') }}";

            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    qty: qty,
                    price: price,
                    productid: productid
                },
                success: function(response) {
                    if (response.success == '1') {
                        swal({
                            title: msg5 + '\n' + msg6 + ' ' + response.currentStock,
                            cancelButtonColor: '#C1C1C1',
                            buttons: {
                                cancel: msg9,
                            },
                            dangerMode: true,
                        });
                        jQuery('.qty_' + row_id).val('');
                        jQuery('.total1_' + row_id).val('');
                    } else {
                        jQuery('.total1_' + row_id).val('');
                        jQuery('.total1_' + row_id).val(response);
                        jQuery('#product1s_' + row_id).attr('qtyappend', qty);
                    }
                },
                beforeSend: function() {

                },
                error: function(e) {

                }
            });
        });

        /*Price field should editable and editable price should change the Total-Amount (on-time editable price )*/
        $('body').on('change', '.prices', function() {

            var row_id = $(this).attr('row_id');
            var qty = $('.qty_' + row_id).val();
            var price = $('.price_' + row_id).val();
            var total_price = price * qty;

            var product_is_selected = $('.product_id_option_' + row_id).val();

            if (price == 0 || price == null) {
                $('.price_' + row_id).val("");
                $('.price_' + row_id).attr('required', true);
            } else {
                $('.price_' + row_id).val(price);
                $('.total1_' + row_id).val(total_price);
            }
        });

        $('body').on('input', '.charge', function() {
            var row_id = $(this).attr('row_id');
            var totalInput = parseFloat($('.total1_' + row_id).val()) || 0;
            var previousServiceCharge = parseFloat($(this).data('previous-service-charge')) || 0;
            var serviceCharge = parseFloat($(this).val()) || 0;

            // Subtract the previous service charge
            var newTotal = totalInput - previousServiceCharge;

            // Add the new service charge
            newTotal += serviceCharge;

            // Update the total input value
            $('.total1_' + row_id).val(newTotal.toFixed());

            // Store the current service charge as the previous service charge for the next calculation
            $(this).data('previous-service-charge', serviceCharge);
        });


        $('body').on('keyup', '.kilometre', function() {

            var valueIs = $(this).val();
            var rex = /^[0-9]*\d?(\.\d{1,2})?$/;

            if (!valueIs.replace(/\s/g, '').length) {
                $(this).val("");
            } else if (valueIs == 0) {
                $(this).val("");
            } else if (!rex.test(valueIs)) {
                $(this).val("");
            }
        });


        // $('body').on('keyup', '.qtyt', function() {

        //     var valueIs = $(this).val();

        //     if (valueIs == 0) {
        //         $(this).val("");
        //     }
        // });

        $('body').on('change keyup', '.qtyt', function() {
            var row_id = $(this).attr('row_id1');
            var productid = $('.product1s_' + row_id).find(":selected").val();
            var qty = $(this).val();
            var price = $('.product1_' + row_id).val();
            var url = $(this).attr('url');
            var serviceCharge = $('.charge_' + row_id).val();
            var msg5 = "{{ trans('message.Product Not Available') }}";
            var msg6 = "{{ trans('message.Current Stock :') }}";

            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    qty: qty,
                    price: price,
                    productid: productid,
                    serviceCharge: serviceCharge
                },
                success: function(response) {
                    console.log('inside success function');
                    //var newd = $.trim(response);
                    if (response.success == '1') {
                        console.log('inside if condition');
                        //swal('No Product Available');
                        swal({
                            title: msg5 + '\n' + msg6 + response.currentStock,
                            cancelButtonColor: '#C1C1C1',
                            buttons: {
                                cancel: msg35,
                            },
                            dangerMode: true,
                        });

                        jQuery('.qty_' + row_id).val('');
                        jQuery('.total1_' + row_id).val('');
                    } else {
                        console.log('inside else condition');
                        jQuery('.total1_' + row_id).val('');
                        jQuery('.total1_' + row_id).val(response);
                        jQuery('#product1s_' + row_id).attr('qtyappend', qty);
                    }
                },
                beforeSend: function() {

                },
                error: function(e) {

                }
            });
        });


        var dateValueIs = $('.outDateValue').val();
        if (dateValueIs == "") {
            var today = new Date();
            var month_proper = (today.getMonth() + 1 <= 9) ? '-0' + (today.getMonth() + 1) : '-' + (today
                .getMonth() + 1);
            var date_proper = (today.getDate() <= 9) ? '0' + (today.getDate()) : '' + (today.getDate());
            var date = today.getFullYear() + month_proper + '-' + date_proper;
            var hours = 4;
            var hourss = hours + today.getHours()
            var time = hourss + ":" + today.getMinutes() + ":" + today.getSeconds();
            var dateTime = date + ' ' + time;

            $('.outDateValue').val(dateTime)
        }


        /*For Initiate process time send mail to Customer and Admin*/
        var emailMsg1 = "{{ trans('message.Email Notification') }}";
        var emailMsg2 = "{{ trans('message.Email Sent Successfully!') }}";
        var emailMsg3 = "{{ trans('message.OK') }}";

        $('.initiateProcessBtn').click(function() {

            var url = $(this).attr('url_init_process');
            var notifyCustomerValue = $('.notifyCustomerCheckbox').is(':checked');
            var serviceId = $('.service_id').val();

            $('.initiateButtonSpin').addClass('glyphicon-refresh spinning');
            $('.initiateProcessBtn').attr('disabled', true);

            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    serviceId: serviceId,
                    notifyCustomerValue: notifyCustomerValue
                },
                success: function(response) {
                    if (response == 1) {
                        swal({
                            title: emailMsg1,
                            text: emailMsg2,
                            cancelButtonColor: '#C1C1C1',
                            buttons: {
                                cancel: emailMsg3,
                            },
                            dangerMode: true,
                        });
                    }

                    $('.initiateButtonSpin').removeClass('glyphicon-refresh spinning');
                    $('.completeProcess').attr('disabled', false);
                    $('.completeProcess').attr("url_complete_process",
                        "{{ url('/jobcard/complete_process_status') }}");
                },
                error: function(e) {
                    console.log(e);
                }
            });
        });


        //For Complete process time send mail to Customer and Admin
        $('.completeProcess').click(function() {

            var url = $(this).attr('url_complete_process');
            var notifyCustomerValue = $('.notifyCustomerCheckbox').is(':checked');
            var serviceId = $('.service_id').val();

            $('.completeProcessSpin').addClass('glyphicon-refresh spinning');
            $('.completeProcess').text("Completed");
            $('.completeProcess').attr('disabled', true);

            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    serviceId: serviceId,
                    notifyCustomerValue: notifyCustomerValue
                },
                success: function(response) {
                    if (response == 1) {
                        swal({
                            title: emailMsg1,
                            text: emailMsg2,
                            cancelButtonColor: '#C1C1C1',
                            buttons: {
                                cancel: emailMsg3,
                            },
                            dangerMode: true,
                        });
                    }

                    $('.completeProcessSpin').removeClass('glyphicon-refresh spinning');
                },
                error: function(e) {
                    console.log(e);
                }
            });
        });

        $('.clickAddNewButton').on('click', function() {

            $('.check_submit').prop("disabled", true);
            $('.closeButton').prop('disabled', false);
        });

        /*Form submit at a time only single click*/
        $('.addJobcardSubmitButton').removeAttr('disabled'); //re-enable on document ready

        $('.addJobcardForm').submit(function() {
            $('.addJobcardSubmitButton').attr('disabled', 'disabled'); //disable on any form submit
        });

        $('.addJobcardForm').bind('invalid-form.validate', function() {
            $('.addJobcardSubmitButton').removeAttr('disabled'); //re-enable on form invalidation
        });
    });
</script>

@endsection