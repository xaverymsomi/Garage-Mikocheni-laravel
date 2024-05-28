@extends('layouts.app')
@section('content')
<?php $timezone	= Auth::User()->timezone; ?>
<style>
    .bootstrap-datetimepicker-widget table td span {
        width: 0px !important;
    }

    .table-condensed>tbody>tr>td {
        padding: 3px;
    }

    .step1 {
        color: #5A738E !important;
        background-color: #f5f5f5;
        border-color: #ddd;
        padding: 10px 15px;
    }

    #date_of_birth-error {
        margin: 0px;
    }

    .jobcardmargintop {
        margin-top: 9px;
    }

    .table>tbody>tr>td {
        padding: 10px;
        vertical-align: unset !important;
    }

    .jobcard_heading {
        margin-left: 19px;
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

    .step1 {
        color: #5A738E !important;

        background-color: #f5f5f5;
        border-color: #ddd;
        padding: 10px 15px;
    }

    .panel-title {
        background-color: #f5f5f5;
        padding: 10px 15px;
    }

    .bootstrap-datetimepicker-widget table td span {
        width: 0px !important;
    }

    .table-condensed>tbody>tr>td {
        padding: 3px;
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
                        <a href="{!! url('/jobcard/list') !!}" id=""><i class=""><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}"></i><span class="titleup">&nbsp;
                                {{ trans('message.JobCard') }}</span></a>
                    </span>
                </div>

                @include('dashboard.profile')
            </nav>
        </div>
    </div>
    @if (session('message'))
    <div class="row massage">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="checkbox checkbox-success checkbox-circle mb-2 alert alert-success alert-dismissible fade show">

                <label for="checkbox-10 colo_success" style="margin-left: 20px;font-weight: 600;">
                    {{ session('message') }} </label>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="padding: 1rem 0.75rem;"></button>
            </div>
        </div>
    </div>
    @endif
    <div class="x_content">

        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space">
                        <h4><b>{{ trans('message.Step - 2 : Add Jobcard Details...') }}</b></h4>
                        <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 ln_solid"></p>
                    </div>

                    <form id="service2Step" method="post" action="{{ url('/service/add_jobcard') }}" class="addJobcardForm">
                        <input type="hidden" class="service_id" name="service_id" value="{{ $service_data->id }}" />

                        <div class="row">
                            <div class="row col-md-7 col-lg-7 col-xl-7 col-xxl-7 col-sm-7 col-xs-7">
                                <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12" colspan="2" valign="top">
                                    <h3><?php echo $logo->system_name; ?></h3>
                                </div>
                                <div class="row col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
                                    <div class="col-md-5 col-lg-5 col-xl-5 col-xxl-5 col-sm-5 col-xs-5 printimg mx-0 mt-4">
                                        <img src="{{ url('/public/general_setting/' . $logo->logo_image) }}" width="130">
                                    </div>
                                    <div class="col-md-7 col-lg-7 col-xl-7 col-xxl-7 col-sm-7 col-xs-7 garrageadd mt-4" valign="top">
                                        <img src="{{ url::asset('public/img/icons/Vector (14).png') }}">&nbsp;
                                        <?php
                                        echo $logo->address . ' ';
                                        echo ',' . getCityName($logo->city_id);
                                        echo ',' . getStateName($logo->state_id);
                                        echo ', ' . getCountryName($logo->country_id);
                                        ?>
                                        <br>
                                        <img src="{{ URL::asset('public/img/icons/Vector (15).png') }}">
                                        <?php
                                        echo '' . $logo->email;
                                        echo '<br><i class="fa fa-phone fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;' . $logo->phone_number;
                                        ?>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 col-lg-5 col-xl-5 col-xxl-5 col-sm-5 col-xs-5">
                                <div class="row row-mb-0">
                                    <label class="control-label jobcardmargintop col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">{{ trans('message.Job Card No') }}
                                        : <label class="color-danger">*</label></label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                        <input type="text" id="job_no" name="job_no" value="{{ $service_data->job_no }}" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="row row-mb-0">
                                    <label class="control-label jobcardmargintop col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">{{ trans('message.In Date/Time') }}
                                        : <label class="color-danger">*</label></label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 date">
                                        <input type="text" id="in_date" name="in_date" value="<?php echo date(getDateFormat() . ' H:i:s', strtotime($service_data->service_date)); ?>" class="form-control datepicker" placeholder="<?php echo getDateFormat();
                                                                                                                                                                                                                                    echo ' hh:mm:ss'; ?>" readonly>
                                    </div>
                                </div>
                                <div class="row row-mb-0">
                                    <label class="control-label jobcardmargintop col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">{{ trans('message.Expected Out Date/Time') }}
                                        : <label class="color-danger">*</label> </label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 date ">
                                        <input type="text" id="date_of_birth" autocomplete="off" name="out_date" class="form-control datepicker" placeholder="<?php echo getDatepicker();
                                                                                                                                                                echo ' hh:mm:ss'; ?>" onkeypress="return false;" value="{{ old('date', now()->setTimezone($timezone)->format('Y-m-d H:i:s')) }}" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                                <h2 class="text-left fw-bold">{{ trans('message.Customer Details') }}
                                </h2>
                                <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space1_solid">
                                </p>
                                <div class="row row-mb-0">
                                    <label class="control-label jobcardmargintopcol-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">{{ trans('message.Name') }}:</label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                        <input type="hidden" name="cust_id" value="{{ $service_data->customer_id }}">
                                        <input type="text" id="name" name="name" value="{{ getCustomerName($service_data->customer_id) }}" class="form-control">
                                    </div>
                                </div>
                                <div class="row row-mb-0">
                                    <label class="control-label jobcardmargintop col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">{{ trans('message.Address') }}:
                                    </label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                        <input type="text" id="address" value="{{ getCustomerAddress($service_data->customer_id) }}" name="address" class="form-control">
                                    </div>
                                </div>
                                <div class="row row-mb-0">
                                    <label class="control-label jobcardmargintop col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">{{ trans('message.Contact No') }}:</label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                        <input type="text" id="con_no" name="con_no" value="{{ getCustomerMobile($service_data->customer_id) }}" class="form-control">
                                    </div>
                                </div>
                                <div class="row row-mb-0">
                                    <label class="control-label jobcardmargintop col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                                        {{ trans('message.Email') }}: </label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                        <input type="text" id="email" name="email" value="{{ getCustomerEmail($service_data->customer_id) }}" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 vehicle_space">
                                <h2 class="text-left fw-bold">{{ trans('message.Vehicle Details') }}
                                </h2>
                                <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space1_solid">
                                </p>
                                <div class="row mt-2">
                                    <label class="jobcardmargintop col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3">{{ trans('message.Model Name') }}:</label>
                                    <div class="col-md-5 col-lg-5 col-xl-5 col-xxl-5 col-sm-5 col-xs-5">
                                        <input type="hidden" name="vehi_id" value="{{ $vehical->id }}">
                                        <input type="text" id="model" name="model" class="form-control" value="{{ $vehical->modelname }}">
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4"></div>
                                </div>
                                @if (!empty($vehical->chassisno))
                                <div class="row mt-2">
                                    <label class="jobcardmargintop col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3">{{ trans('message.Chasis No') }}:</label>
                                    <div class="col-md-5 col-lg-5 col-xl-5 col-xxl-5 col-sm-5 col-xs-5">
                                        <input type="text" id="chassis" name="chassis" class="form-control" value="{{ $vehical->chassisno }}">
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4"></div>
                                </div>
                                @endif

                                @if (!empty($vehical->engineno))
                                <div class="row mt-2">
                                    <label class="control-label col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3">{{ trans('message.Engine No') }}:</label>
                                    <div class="col-md-5 col-lg-5 col-xl-5 col-xxl-5 col-sm-5 col-xs-5">
                                        <input type="text" id="engine_no" name="engine_no" class="form-control" value="{{ $vehical->engineno }}" />
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4"></div>
                                </div>
                                @endif
                                
                               
                                @if ($service_data->service_type == 'free')
                                <div class="row mt-2 ">
                                    <label class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3">{{ trans('message.Free Service Coupan No') }}<label class="text-danger">*</label> :</label>
                                    <div class="col-md-5 col-lg-5 col-xl-5 col-xxl-5 col-sm-5 col-xs-5">
                                        <select id="coupan_no" name="coupan_no" class="form-control" required>
                                            <option value=""> {{ trans('message.Select Free Coupen') }}</option>
                                            @foreach ($free_coupan as $coupan)
                                            <?php $useddata = getUsedCoupon($service_data->customer_id, $service_data->vehicle_id, $coupan->job_no); ?>
                                            @if ($useddata == 0)
                                            <option value="{{ $coupan->job_no }}">{{ $coupan->job_no }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        <div class="text-danger" style="display: none;" id="service-coupon-error">
                                            {{ trans('message.Please Select Free Service Coupon.') }}
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4"></div>
                                </div>
                                @endif
                                @if (!empty($sale_date))
                                <div class="row mt-2" id="divId">
                                    <label class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3">{{ trans('message.Date Of Sale') }}
                                        :</label>
                                    <div class="col-md-5 col-lg-5 col-xl-5 col-xxl-5 col-sm-5 col-xs-5">
                                        <input type="text" id="sales_date" name="sales_date" class="form-control datepicker" value="{{ date(getDateFormat(), strtotime($sale_date->date)) }}">
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4"></div>
                                </div>
                                @endif

                                @if ($washbay_price != null)
                                <div class="row mt-2">
                                    <label class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3">{{ trans('message.Wash Bay Charge') }}<label class="text-danger"></label>:</label>
                                    <div class="col-md-5 col-lg-5 col-xl-5 col-xxl-5 col-sm-5 col-xs-5">
                                        <input type="text" id="washBay" name="washBayCharge" class="form-control" value="{{ $washbay_price->price }}" readonly>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4"></div>
                                </div>
                                @endif

                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space1">
                            <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 ln_solid"></p>
                        </div>

                        {{-- <div class="row">
                        <div class="row">
                            <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3 ms-1">
                                <h3>{{ trans('message.Observation List') }}</h3>
                            </div>
                            <div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 ps-0">
                                <button type="button" data-bs-target="#responsive-modal-observation" data-bs-toggle="modal" class="btn btn-outline-secondary clickAddNewButton ms-0 mt-2"> + </button>
                            </div>

                        </div> --}}
                        {{-- <div class=" col-md-12 col-xs-12 col-sm-12 panel-group">

                        </div>
                        <div class=" col-md-12 col-xs-12 col-sm-12 panel-group">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h6 class="panel-title tbl_points">
                                        <a class="observation_Plus1" data-bs-toggle="collapse" href="#collapse1" role="button" aria-expanded="true" aria-controls="collapseExample">
                                            <i class="fa fa-plus"></i>
                                            {{ trans('message.Observation Points') }}</a>
                                        </a>
                                    </h6>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <table class="table main_data">
                                            <!-- Observation Checcked Points -->
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div> --}}
<!-- Observation Part -->
<div class="row mt-4">
    <div class="col-md-10 col-lg-10 col-xl-10 col-xxl-10 col-sm-10 col-xs-10 header">
        <h4>
            <b>{{ trans('OBSERVATION PART') }}</b>
            <button type="button" id="add_new_observation" class="btn btn-outline-secondary">{{ trans('+') }}</button>
        </h4>
    </div>
    <div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2"></div>
</div>
<div class="col-md-12 col-xs-12 col-sm-12 form-group table-responsive">
    <table class="table table-bordered adddatatable" id="observation_table" align="center">
        <thead>
            <tr>
                <th class="actionre">{{ trans('Job cartegory') }}</th>
                <th class="actionre">{{ trans('Area of Observation') }}</th>
                <th class="actionre">{{ trans('Observation Details') }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="tbl_td_selectManufac_error">
                    <select class="form-control select_producttype form-select" name="jognum[Manufacturer_id][]" m_url="{!! url('/purchase/producttype/names') !!}">
                        <option value="">{{ trans('Job cartegory') }}</option>
                        @if(!empty($categoryJob))
                            @foreach ($categoryJob as $item)
                                <option value="{{ $item->repair_category_name }}">{{ $item->repair_category_name }}</option>
                            @endforeach
                        @endif
                    </select>
                    <span class="help-block error-help-block color-danger" style="display: none">{{ trans('message.Manufacturer name is required.') }}</span>
                </td>
                <td class="tbl_td_selectProductname_error">
                    <select name="jognum[product_id][]" class="form-control productid form-select" >
                        <option value="">{{ trans('message.--Select Product--') }}</option>
                        
                        @if(!@empty($selectProduct))
                            @foreach ($selectProduct as $item)
                                <option value="{{ $item->point }}">{{ $item->point }}</option>
                            @endforeach
                        @endif
                        
                    </select>
                    <span class="help-block error-help-block color-danger" style="display: none">{{ trans('message.Product name is required.') }}</span>
                </td>
                <td class="tbl_td_quantity_error">
                    <textarea name="jognum[qty][]" id="" cols="4" rows="3"></textarea>
                    <span class="help-block error-help-block color-danger" style="display: none">{{ trans('message.Quantity is required.') }}</span>
                </td>
            </tr>
        </tbody>
    </table>
</div>


<!-- Templates for new rows -->
<template id="observation-row-template">
    <tr>
        <td class="tbl_td_selectManufac_error">
            <select class="form-control select_producttype form-select" name="jognum[Manufacturer_id][]" m_url="{!! url('/purchase/producttype/names') !!}">
                <option value="">{{ trans('Job cartegory') }}</option>
                @if(!empty($categoryJob))
                    @foreach ($categoryJob as $item)
                        <option value="{{ $item->repair_category_name }}">{{ $item->repair_category_name }}</option>
                    @endforeach
                @endif
            </select>
            <span class="help-block error-help-block color-danger" style="display: none">{{ trans('message.Manufacturer name is required.') }}</span>
        </td>
        <td class="tbl_td_selectProductname_error">
            <select name="jognum[product_id][]" class="form-control productid form-select" url="{!! url('purchase/add/getproduct') !!}">
                <option value="">{{ trans('message.--Select Product--') }}</option>
                 @if(!@empty($selectProduct))
                    @foreach ($selectProduct as $item)
                        <option value="{{ $item->point }}">{{ $item->point }}</option>
                    @endforeach
                @endif
            </select>
            <span class="help-block error-help-block color-danger" style="display: none">{{ trans('message.Product name is required.') }}</span>
        </td>
        <td class="tbl_td_quantity_error">
            <textarea name="jognum[qty][]" id="" cols="4" rows="3"></textarea>
            <span class="help-block error-help-block color-danger" style="display: none">{{ trans('message.Quantity is required.') }}</span>
        </td>
    </tr>
</template>
                        </div>

                        <!-- ************* MOT Module Starting ************* -->
                        @if ($service_data->mot_status == 1)
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="col-md-9 col-sm-8 col-xs-8">
                                <h4>{{ trans('message.MOT Test') }}</h4>
                            </div>
                        </div>

                        <div class="col-md-12 col-xs-12 col-sm-12 panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h6 class="panel-title">
                                        <a class="observation_Plus2" data-bs-toggle="collapse" href="#collapse2" role="button" aria-expanded="true" aria-controls="collapseExample">
                                            <i class="fa fa-plus"></i>
                                            {{ trans('message.MOT Test View') }}</a>
                                        </a>
                                    </h6>
                                </div>
                                <div id="collapse2" class="panel-collapse collapse">
                                    <div class="panel-body">

                                        <!-- Step:1 Starting -->
                                        <div class=" col-md-12 col-xs-12 col-sm-12 panel-group pGroup">
                                            <div class="panel panel-default">
                                                <div class="panel-heading pHeading">
                                                    <h6 class="panel-title">
                                                        <a class="observation_Plus" data-bs-toggle="collapse" href="#collapse3" role="button" aria-expanded="true" aria-controls="collapseExample">
                                                            <i class="fa fa-plus"></i>
                                                            {{ trans('message.Step 1: Fill MOT Details') }}</a>
                                                        </a>
                                                    </h6>
                                                </div>
                                                <div id="collapse3" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <div class=" col-md-12 col-xs-12 col-sm-12 panel-group pGroupInsideStep1">

                                                            <div class="row text-center">
                                                                <div class="col-md-3">
                                                                    <h6 class="boldFont text-start">
                                                                        {{ trans('message.OK = Satisfactory') }}
                                                                    </h6>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <h6 class="boldFont text-start">
                                                                        {{ trans('message.X = Safety Item Defact') }}
                                                                    </h6>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <h6 class="boldFont text-start">
                                                                        {{ trans('message.R = Repair Required') }}
                                                                    </h6>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <h6 class="boldFont text-start">
                                                                        {{ trans('message.NA = Not Applicable') }}
                                                                    </h6>
                                                                </div>
                                                            </div>

                                                            <!-- Inside Cab  Starting -->
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading pHeadingInsideStep1">
                                                                    <h6 class="panel-title">
                                                                        <a class="observation_Plus3" data-bs-toggle="collapse" href="#collapse5" role="button" aria-expanded="true" aria-controls="collapseExample">
                                                                            <i class="fa fa-plus"></i>
                                                                            {{ trans('message.Inside Cab') }}</a>
                                                                        {{-- </a> --}}
                                                                    </h6>

                                                                </div>
                                                                <div id="collapse5" class="panel-collapse collapse">
                                                                    <div class="panel-body">


                                                                        @php
                                                                        $a = $b = '';
                                                                        $count = count($inspection_points_library_data);
                                                                        $count = $count / 2;
                                                                        @endphp

                                                                        @foreach ($inspection_points_library_data as $key => $inspection_library)
                                                                        @if ($inspection_library->inspection_type == 1)
                                                                        @if ($key % 2 != 1)
                                                                        <?php
                                                                        $a .= "<tr>
                                                                                                                                                                                                                                                                                                                                                                                                                                                																		<td>$inspection_library->code</td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                																		<td>$inspection_library->point</td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                																		<td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                																		<select name=inspection[$inspection_library->id] data-id='$inspection_library->id' class='common'  id='$inspection_library->code'>
                                                                                                                                                                                                                                                                                                                                                                                                                                                																    		<option value='ok'>OK</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                																    		<option value='x'>X</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                																    		<option value='r'>R</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                																    		<option value='na'>NA</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                																  		</select>
                                                                                                                                                                                                                                                                                                                                                                                                                                                																  		</td></tr>";
                                                                        ?>
                                                                        @else
                                                                        <?php
                                                                        $b .= "<tr>
                                                                                                                                                                                                																																																	<td>$inspection_library->code</td>
                                                                                                                                                                                                																																																	<td>$inspection_library->point</td>
                                                                                                                                                                                                																																																	<td>
                                                                                                                                                                                                																																																	<select name=inspection[$inspection_library->id] data-id='$inspection_library->id' class='common' id='$inspection_library->code'>
                                                                                                                                                                                                																																																		<option value='ok'>OK</option>
                                                                                                                                                                                                																																																		<option value='x'>X</option>
                                                                                                                                                                                                																																																		<option value='r'>R</option>
                                                                                                                                                                                                																																																		<option value='na'>NA</option>
                                                                                                                                                                                                																																																		</select>
                                                                                                                                                                                                																																																		</td>
                                                                                                                                                                                                																																																		</tr>";
                                                                        ?>
                                                                        @endif
                                                                        @endif
                                                                        @endforeach
                                                                        <div class="row">
                                                                            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                                                                <table class="table">
                                                                                    <thead class="thead-dark">
                                                                                        <tr>
                                                                                            <th><b>{{ trans('message.Code') }}</b>
                                                                                            </th>
                                                                                            <th><b>{{ trans('message.Inspection Details') }}</b>
                                                                                            </th>
                                                                                            <th><b>{{ trans('message.Answer') }}</b>
                                                                                            </th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <?php echo $a; ?>
                                                                                </table>
                                                                            </div>
                                                                            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                                                                <table class="table">
                                                                                    <thead class="thead-dark smallDisplayTheadHiddenInsideCab">
                                                                                        <tr>
                                                                                            <th><b>{{ trans('message.Code') }}</b>
                                                                                            </th>
                                                                                            <th><b>{{ trans('message.Inspection Details') }}</b>
                                                                                            </th>
                                                                                            <th><b>{{ trans('message.Answer') }}</b>
                                                                                            </th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <?php echo $b; ?>
                                                                                </table>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Inside Cab  Ending -->

                                                        </div>

                                                        <!-- Ground Level and Under Vehicle  Starting -->
                                                        <div class=" col-md-12 col-xs-12 col-sm-12 panel-group pGroupInsideStep1">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading pHeadingInsideStep1">
                                                                    <h6 class="panel-title">
                                                                        <a class="observation_Plus4" data-bs-toggle="collapse" href="#collapse6" role="button" aria-expanded="true" aria-controls="collapseExample">
                                                                            <i class="fa fa-plus"></i>
                                                                            {{ trans('message.Ground Level and Under Vehicle') }}</a>
                                                                    </h6>
                                                                </div>
                                                                <div id="collapse6" class="panel-collapse collapse">
                                                                    <div class="panel-body">
                                                                        @php
                                                                        $a = $b = '';
                                                                        $count = count($inspection_points_library_data);
                                                                        $count = $count / 2;
                                                                        @endphp

                                                                        @foreach ($inspection_points_library_data as $key => $inspection_library)
                                                                        @if ($inspection_library->inspection_type == 2)
                                                                        @if ($key % 2 != 0)
                                                                        <?php
                                                                        $a .= "<tr>
                                                                                                                                                                                                                                                                                                                                                                                                                                                																		<td>$inspection_library->code</td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                																		<td>$inspection_library->point</td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                																		<td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                																		<select name=inspection[$inspection_library->id] data-id='$inspection_library->id' class='common'  id='$inspection_library->code'>
                                                                                                                                                                                                                                                                                                                                                                                                                                                																    		<option value='ok'>OK</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                																    		<option value='x'>X</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                																    		<option value='r'>R</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                																    		<option value='na'>NA</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                																  		</select>
                                                                                                                                                                                                                                                                                                                                                                                                                                                																  		</td></tr>";
                                                                        ?>
                                                                        @else
                                                                        <?php
                                                                        $b .= "<tr>
                                                                                                                                                                                                                                                                                                                                                                                                                                                																		<td>$inspection_library->code</td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                																		<td>$inspection_library->point</td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                																		<td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                																		<select name=inspection[$inspection_library->id] data-id='$inspection_library->id' class='common'  id='$inspection_library->code'>
                                                                                                                                                                                                                                                                                                                                                                                                                                                																    	<option value='ok'>OK</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                																    	<option value='x'>X</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                																    	<option value='r'>R</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                																    	<option value='na'>NA</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                																  		</select>
                                                                                                                                                                                                                                                                                                                                                                                                                                                																  		</td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                																  		</tr>";
                                                                        ?>
                                                                        @endif
                                                                        @endif
                                                                        @endforeach
                                                                        <div class="row">
                                                                            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                                                                <table class="table">
                                                                                    <thead class="thead-dark">
                                                                                        <tr>
                                                                                            <th><b>{{ trans('message.Code') }}</b>
                                                                                            </th>
                                                                                            <th><b>{{ trans('message.Inspection Details') }}</b>
                                                                                            </th>
                                                                                            <th><b>{{ trans('message.Answer') }}</b>
                                                                                            </th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <?php echo $a; ?>
                                                                                </table>
                                                                            </div>
                                                                            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                                                                <table class="table">
                                                                                    <thead class="thead-dark smallDisplayTheadHiddenGroundLevel">
                                                                                        <tr>
                                                                                            <th><b>{{ trans('message.Code') }}</b>
                                                                                            </th>
                                                                                            <th><b>{{ trans('message.Inspection Details') }}</b>
                                                                                            </th>
                                                                                            <th><b>{{ trans('message.Answer') }}</b>
                                                                                            </th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <?php echo $b; ?>
                                                                                </table>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Ground Level and Under Vehicle Ending -->

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Step 1: Ending -->

                                        <!-- Step 2: Show Filled MOT Details Starting -->
                                        <div class=" col-md-12 col-xs-12 col-sm-12 panel-group pGroup">
                                            <div class="panel panel-default">
                                                <div class="panel-heading pHeading">
                                                    <h6 class="panel-title">
                                                        <a class="observation_Plus5" data-bs-toggle="collapse" href="#collapse4" role="button" aria-expanded="true" aria-controls="collapseExample">
                                                            <i class="fa fa-plus"></i>
                                                            {{ trans('message.Step 2: Show Filled MOT Details') }}</a>
                                                    </h6>
                                                </div>
                                                <div id="collapse4" class="panel-collapse collapse">
                                                    <div class="panel-body">

                                                        <table class="table">
                                                            <thead class="thead-dark">
                                                                <tr>
                                                                    <th><b>{{ trans('message.Code') }}</b></th>
                                                                    <th><b>{{ trans('message.Inspection Details') }}</b>
                                                                    </th>
                                                                    <th><b>{{ trans('message.Answer') }}</b></th>
                                                                <tr>
                                                            </thead>

                                                            @foreach ($inspection_points_library_data as $key => $value)
                                                            <thead>
                                                                <tr style="display: none;" id="tr_{{ $value->id }}">
                                                                    <td id="">
                                                                        {{ $value->id }}
                                                                    </td>
                                                                    <td id="">
                                                                        {{ $value->point }}
                                                                    </td>
                                                                    <td id="row_{{ $value->id }}" class="text-uppercase"> </td>
                                                                </tr>
                                                            </thead>
                                                            @endforeach
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Step 2: Show Filled MOT Details Ending -->

                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <!-- ************* MOT Module Ending ************* -->


                        <div class="row">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <!-- <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                                <a class="btn btn-primary" href="{{ URL::previous() }}">{{ trans('message.CANCEL') }}</a>
                            </div> -->
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                                <button type="submit" id="submitButton" class="btn btn-success jobcardFormSubmitButton">{{ trans('message.SUBMIT') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
    </div></div>
        </div>
    </div>
</div>
</div>

<!-- model in observation Point -->

{{-- <div class="col-md-12">
<div class="col-md-12">
    <div id="responsive-modal-observation" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ trans('message.Observation Point') }}</h4>
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
                                        <a data-bs-toggle="collapse" href="#collapse1-{{ $checkoout->id }}" class="ob_plus{{ $checkoout->id }}"><i class="fa fa-plus"></i> {{ $checkoout->checkout_point }} </a>
                                    </h4>
                                </div>
                                <div id="collapse1-{{ $checkoout->id }}" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <td><b>#</b></td>
                                                    <td><b>{{ trans('message.Checkpoints') }}</b></td>
                                                    <td><b>{{ trans('message.Choose') }}</b></td>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php

                                                $i = 1;
                                                $subcategory = getCheckPointSubCategory($checkoout->checkout_point, $checkoout->vehicle_id);
                                                if (!empty($subcategory)) {
                                                    foreach ($subcategory as $subcategorys) { ?>

                                                        <tr class="id{{ $subcategorys->checkout_point }}">
                                                            <td class="col-md-1"><?php echo $i++; ?></td>

                                                            <td class="row{{ $subcategorys->checkout_point }} col-md-4">

                                                                <?php echo $subcategorys->checkout_point;
                                                                //echo $subcategorys->id;
                                                                ?>
                                                                <?php $data = getCheckedStatus($subcategorys->id, getServiceId($service_data->id)); ?>
                                                            </td>
                                                            <td>
                                                                <input type="checkbox" <?php echo $data; ?> name="chek_sub_points" name="check_sub_points[]" check_id="{{ $subcategorys->id }}" class="check_pt" url="{!! url('service/select_checkpt') !!}" s_id="{{ getServiceId($service_data->id) }}">
                                                            </td>
                                                        </tr>

                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function() {
                                var i = 0;
                                $('.ob_plus{{ $checkoout->id }}').click(function() {
                                    i = i + 1;
                                    if (i % 2 != 0) {
                                        $(this).parent().find(".glyphicon-plus:first").removeClass("glyphicon-plus").addClass(
                                            "glyphicon-minus");
                                    } else {
                                        $(this).parent().find(".glyphicon-minus:first").removeClass("glyphicon-minus").addClass(
                                            "glyphicon-plus");
                                    }
                                });
                            });
                        </script>

                    <?php } ?>
                    @endforeach
                    @else
                    <h6 class="text-center">{{ trans('message.No Observation Points Available For This Vehicle Model') }}</h6>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div> --}}

</div>

<!-- /page content -->


<!-- Scripts starting -->
<!-- Display observation points in list -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {

        $('.tbl_points, .check_submit').click(function() {

            var url = "<?php echo url('service/get_obs'); ?>"
            var service_id = $('.service_id').val();

            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    service_id: service_id
                },
                success: function(response) {
                    $('.main_data').html(response.html);
                    $('.modal').modal('hide');
                },
                error: function(e) {
                    console.log(e);
                }
            });
        });


        /*Checkpoints in modal*/
        var msg10 = "{{ trans('message.An error occurred :') }}";

        $('input.check_pt[type="checkbox"]').click(function() {

            if ($(this).prop("checked") == true) {
                var value = 1;
                var url = $(this).attr('url');
                var id = $(this).attr('check_id');
                var s_id = $(this).attr('s_id');

                $('.check_submit').prop("disabled", false);
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {
                        value: value,
                        id: id,
                        service_id: s_id
                    },
                    success: function(response) {

                    },
                    error: function(e) {
                        alert(msg10 + " " + e.responseText);
                        console.log(e);
                    }
                });
            } else if ($(this).prop("checked") == false) {

                var value = 0;
                var url = $(this).attr('url');
                var id = $(this).attr('check_id');
                var s_id = $(this).attr('s_id');

                $('.check_submit').prop("disabled", false);

                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {
                        value: value,
                        id: id,
                        service_id: s_id
                    },
                    success: function(response) {

                    },
                    error: function(e) {
                        alert(msg10 + " " + e.responseText);
                        console.log(e);
                    }
                });
            }
        });


        /*delete in script*/
        $('.sa-warning').click(function() {

            var url = $(this).attr('url');

            var msg1 = "{{ trans('message.Are You Sure?') }}";
            var msg2 = "{{ trans('message.You will not be able to recover this data afterwards!') }}";
            var msg3 = "{{ trans('message.Cancel') }}";
            var msg4 = "{{ trans('message.Yes, delete!') }}";

            swal({
                title: msg1,
                text: msg2,
                type: "warning",
                showCancelButton: true,
                cancelButtonText: msg3,
                cancelButtonColor: "#C1C1C1",
                confirmButtonColor: "#297FCA",
                confirmButtonText: msg4,
                closeOnConfirm: false
            }, function() {
                window.location.href = url;

            });
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
        var c = 0;
        $('.observation_Plus1').click(function() {
            c = c + 1;
            if (c % 2 != 0) {
                $(this).parent().find(".fa-plus:first").removeClass("fa-plus").addClass(
                    "fa-minus");
            } else {
                $(this).parent().find(".fa-minus:first").removeClass("fa-minus").addClass(
                    "fa-plus");
            }
        });
        var l = 0;
        $('.observation_Plus3').click(function() {
            l = l + 1;
            if (l % 2 != 0) {
                $(this).parent().find(".fa-plus:first").removeClass("fa-plus").addClass(
                    "fa-minus");

            } else {
                $(this).parent().find(".fa-minus:first").removeClass("fa-minus").addClass(
                    "fa-plus");
            }
        });
        var a = 0;
        $('.observation_Plus4').click(function() {
            a = a + 1;
            if (a % 2 != 0) {
                $(this).parent().find(".fa-plus:first").removeClass("fa-plus").addClass(
                    "fa-minus");

            } else {
                $(this).parent().find(".fa-minus:first").removeClass("fa-minus").addClass(
                    "fa-plus");
            }
        });
        var b = 0;
        $('.observation_Plus5').click(function() {
            b = b + 1;
            if (b % 2 != 0) {
                $(this).parent().find(".fa-plus:first").removeClass("fa-plus").addClass(
                    "fa-minus");
            } else {
                $(this).parent().find(".fa-minus:first").removeClass("fa-minus").addClass(
                    "fa-plus");
            }
        });
        var j = 0;
        $('.observation_Plus2').click(function() {
            j = j + 1;
            if (j % 2 != 0) {
                $(this).parent().find(".fa-plus:first").removeClass("fa-plus").addClass(
                    "fa-minus");

            } else {
                $(this).parent().find(".fa-minus:first").removeClass("fa-minus").addClass(
                    "fa-plus");
            }
        });

        $('.datepicker').datetimepicker({
            format: "<?php echo getDatetimepicker(); ?>",
            todayBtn: true,
            autoclose: 1,
            language: "{{ getLangCode() }}",
        });
        $(function() {

            function toggleIcon(e) {
                $(e.target)
                    .prev('.pHeading')
                    .find(".plus-minus")
                    .toggleClass('glyphicon-plus glyphicon-minus');
            }
            $('.pGroup').on('hidden.bs.collapse', toggleIcon);
            $('.pGroup').on('shown.bs.collapse', toggleIcon);
        });

        $(function() {

            function toggleIcon(e) {
                $(e.target)
                    .prev('.pHeadingInsideStep1')
                    .find(".plus-minus")
                    .toggleClass('glyphicon-plus glyphicon-minus');
            }
            $('.pGroupInsideStep1').on('hidden.bs.collapse', toggleIcon);
            $('.pGroupInsideStep1').on('shown.bs.collapse', toggleIcon);
        });


        $('.common').change(function(e) {

            var selectBoxValue = $(this, ':selected').val();
            var id = $(this).attr('data-id');

            if (selectBoxValue == "r" || selectBoxValue == "x") {
                $('#tr_' + id).css("display", "");
                $('#row_' + id).html(selectBoxValue);
            } else {
                $('#tr_' + id).css("display", "none");
            }
        });


        /*If date field have value then error msg and has error class remove*/
        $('#date_of_birth').on('change', function() {

            var pDateValue = $(this).val();

            if (pDateValue != null) {
                $('#date_of_birth-error').css({
                    "display": "none",
                });
            }

            if (pDateValue != null) {
                $(this).parent().parent().removeClass('has-error');
            }
        });

        $('.clickAddNewButton').on('click', function() {

            $('.check_submit').prop("disabled", true);
            $('.closeButton').prop('disabled', false);
        });


        $('body').on('keyup', '.kmsValid', function() {

            var kmsVal = $(this).val();
            var rex = /^[0-9]*\d?(\.\d{1,2})?$/;

            if (!kmsVal.replace(/\s/g, '').length) {
                $(this).val("");
            }
            if (kmsVal == 0) {
                $(this).val("");
            } else if (!rex.test(kmsVal)) {
                $(this).val("");
            }
        });
        $('body').on('click', '#submitButton', function(e) {
            var service_id = $('#coupan_no').val();
            if (service_id == "") {
                $('#service-coupon-error').css("display", "");
                $('#submitButton').addClass('disabled');
                $('#submitButton').prop('disabled', true);
            } else {
                $('#service-coupon-error').css("display", "none");
                $('#submitButton').removeClass('disabled');
            }
        });
        $('#coupan_no').change(function(e) {
            var pDateValue = $(this).val();

            if (pDateValue == "") {
                $('#service-coupon-error').css("display", "");
                $('#submitButton').addClass('disabled');
            } else {
                $('#service-coupon-error').css("display", "none");
                $('#submitButton').removeClass('disabled');
            }
            $('#submitButton').prop('disabled', !pDateValue);
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
    // Function to add a new observation row
    const addNewObservation = () => {
        const template = document.querySelector('#observation-row-template').innerHTML;
        const tbody = document.querySelector('#observation_table tbody');
        tbody.insertAdjacentHTML('beforeend', template);
    };

    // Function to add a new sell row
    const addNewSell = () => {
        const template = document.querySelector('#sell-row-template').innerHTML;
        const tbody = document.querySelector('#sell_table tbody');
        tbody.insertAdjacentHTML('beforeend', template);
    };

    // Event listener for add observation button
    document.querySelector('#add_new_observation').addEventListener('click', addNewObservation);

    // Event listener for add sell button
    document.querySelector('#add_new_sell').addEventListener('click', addNewSell);
    
    // Function to remove a row
    window.removeRow = (element) => {
        const row = element.closest('tr');
        row.remove();
    };
});

</script>

<!-- Form field validation -->
{!! JsValidator::formRequest('App\Http\Requests\StoreServiceSecondStepAddFormRequest', '#service2Step') !!}
<script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>

@endsection