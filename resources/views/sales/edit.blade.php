@extends('layouts.app')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><a href="{!! url('/sales/list') !!}" id=" "><i class=""><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}"></i><span class="titleup">
                                {{ trans('message.Edit Vehicle Sells') }}</span></a>
                    </div>
                    @include('dashboard.profile')
                </nav>
            </div>
            @if (session('message'))
            <div class="row massage">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="checkbox checkbox-success checkbox-circle mb-2 alert alert-success alert-dismissible fade show">
                        <input id="checkbox-10" type="checkbox" checked="">
                        <label for="checkbox-10 colo_success" style="margin-left: 20px;font-weight: 600;">
                            {{ session('message') }} </label>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="padding: 1rem 0.75rem;"></button>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form id="vehicleSalesEditForm" method="post" action="update/{{ $sales->id }}" enctype="multipart/form-data" class="form-horizontal upperform">

                            <div class="row mt-0">
                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="last-name">{{ trans('message.Bill No') }} <label class="color-danger">*</label></label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                        <input type="text" id="bill_no" name="bill_no" class="form-control" value="{{ $sales->bill_no }}" readonly>
                                    </div>
                                </div>

                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="last-name">{{ trans('message.Sales Date') }} <label class="color-danger">*</label></label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 date">
                                        <?php
                                        if ($sales->date == '0000-00-00') {
                                            $salesdate = getDatepicker();
                                        } else {
                                            $salesdate = date(getDateFormat(), strtotime($sales->date));
                                        }
                                        ?>
                                        <input type="text" id="sales_date" name="date" autocomplete="off" class="form-control salesDate datepicker" placeholder="<?php echo getDateFormat(); ?>" value="{{ $salesdate }}" onkeypress="return false;" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Customer Name') }} <label class="color-danger">*</label></label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                        <select class="form-control select_customer_auto_search customer_name form-select" name="cus_name" id="supplier_select" required>
                                            @if (!empty($customer))
                                            @foreach ($customer as $customers)
                                            <option value="{{ $customers->id }}" <?php if ($customers->id == $sales->customer_id) {
                                                                                        echo 'selected';
                                                                                    } ?>>
                                                {{ $customers->name . ' ' . $customers->lastname }}
                                            </option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Salesman') }} <label class="color-danger">*</label></label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                        <select class="form-control form-select" name="salesmanname" id="" required>
                                            <option value="">{{ trans('message.Select Name') }}</option>
                                            @if (!empty($employee))
                                            @foreach ($employee as $employees)
                                            <option value="{{ $employees->id }}" <?php if ($employees->id == $sales->salesmanname) {
                                                                                        echo 'selected';
                                                                                    } ?>>
                                                {{ $employees->name . ' ' . $employees->lastname }}
                                            </option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Select Vehicle Brand') }} <label class="color-danger">*</label></label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                        <select class="form-control veh_brand form-select" name="vehi_bra_name" id="vehi_bra_name" bran_url="{!! url('sales/edit/getmodel_name') !!}" required>

                                            @foreach ($brand as $brands)
                                            <option value="{{ $brands->id }}" <?php if ($brands->id == $sales->vehicle_brand) {
                                                                                    echo 'selected';
                                                                                } ?>>
                                                {{ $brands->vehicle_brand }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="branch">{{ trans('message.Branch') }} <label class="color-danger">*</label></label>

                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                        <select class="form-control select_branch form-select" name="branch">
                                            @foreach ($branchDatas as $branchData)
                                            <option value="{{ $branchData->id }}" <?php if ($sales->branch_id == $branchData->id) {
                                                                                        echo 'selected';
                                                                                    } ?>>
                                                {{ $branchData->branch_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                               
                            </div>

                            <div class="row mt-3">
                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">Select Model <label class="color-danger">*</label></label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                        <select class="form-control selectmodel form-select" name="vehicale_name" id="vehicale_select" url="{!! url('sales/edit/getrecord') !!}" chasisurl="{!! url('sales/edit/getchasis') !!}" required>
                                            @if (!empty($vehicale))
                                            @foreach ($vehicale as $vehicales)
                                            <option class="modelnm" value="{{ $vehicales->id }}" modelname="<?php echo $vehicales->modelname; ?>" brand="<?php echo $vehicales->vehiclebrand_id; ?>" vhi_type="<?php $vehicales->vehicletype_id; ?>" <?php if ($vehicales->id == $sales->vehicle_id) {
                                                                                                                                                                                                                                                            echo 'selected';
                                                                                                                                                                                                                                                        } ?>>
                                                {{ $vehicales->modelname }}
                                            </option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback {{ $errors->has('price') ? ' has-error' : '' }}">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Price') }} (<?php echo getCurrencySymbols(); ?>) <label class="color-danger">*</label></label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">

                                        <input type="text" id="price" name="price" class="form-control" id="price" maxlength="10" value="{{ $sales->price }}" readonly>
                                        @if ($errors->has('price'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Color') }} <label class="color-danger">*</label></label>
                                    <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                                        <select id="color_type" name="color" class="form-control color_name_data form-select" required>
                                            <option value="">{{ trans('message.-- Select Color --') }}</option>
                                            @if (!empty($color))
                                            @foreach ($color as $colors)
                                            <option value="{{ $colors->id }}" <?php if ($colors->id == $sales->color_id) {
                                                                                    echo 'selected';
                                                                                } ?> style="background-color:{{ $colors->color_code }}; color: #ffffff;">
                                                {{ $colors->color }}
                                            </option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 addremove">
                                        <button type="button" data-bs-target="#responsive-modal-color" data-bs-toggle="modal" class="btn btn-outline-secondary btn-sm">{{ trans('message.Add/Remove') }}</button>
                                    </div>
                                </div>

                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Total Price') }} (<?php echo getCurrencySymbols(); ?>) <label class="color-danger">*</label></label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">

                                        <input type="text" id="total_price" name="total_price" class="form-control" value="{{ $sales->total_price }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                               
                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="last-name">{{ trans('message.Chassis') }} </label>

                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                        <select id="chassis_num" name="chassis" class="form-control form-select">
                                            @foreach ($vehicale as $vehicles)
                                            <option value="<?php echo $vehicles->chassisno; ?>" <?php if ($vehicles->id == $sales->vehicle_id) {
                                                                                                    echo 'selected';
                                                                                                } ?>>
                                                <?php echo $vehicles->chassisno; ?></option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
                                    <h2 class="ms-2">
                                    <b>{{ trans('message.NUMBER OF SERVICES') }}</b>
                                    <p class="col-md-12 col-xs-12 col-sm-12 ln_solid"></p>
                                </h2>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="last-name">{{ trans('message.Interval') }} <label class="color-danger">*</label></label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                        <select name="interval" id="interval" class="form-control form-select">
                                            <option value="">{{ trans('message.Number of Interval') }}</option>
                                            <option value="1" <?php if ($sales->interval == 1) {
                                                                    echo 'selected';
                                                                } ?>>{{ trans('message.1 Month') }}
                                            </option>
                                            <option value="2" <?php if ($sales->interval == 2) {
                                                                    echo 'selected';
                                                                } ?>>{{ trans('message.2 Month') }}
                                            </option>
                                            <option value="3" <?php if ($sales->interval == 3) {
                                                                    echo 'selected';
                                                                } ?>>{{ trans('message.3 Month') }}
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Date Gap') }}</label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                        <select name="date_gape" id="date_gape" class="form-control form-select">
                                            <option value="0" <?php if ($sales->date_gap == 0) {
                                                                    echo 'selected';
                                                                } ?>>{{ trans('message.1 Day') }}
                                            </option>
                                            <option value="3" <?php if ($sales->date_gap == 3) {
                                                                    echo 'selected';
                                                                } ?>>{{ trans('message.3 Day') }}
                                            </option>
                                            <option value="5" <?php if ($sales->date_gap == 5) {
                                                                    echo 'selected';
                                                                } ?>>{{ trans('message.5 Day') }}
                                            </option>
                                            <option value="10" <?php if ($sales->date_gap == 10) {
                                                                    echo 'selected';
                                                                } ?>>{{ trans('message.10 Day') }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="last-name">{{ trans('message.Number of Services') }} <label class="color-danger">*</label></label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                        <select name="no_of_services" id="no_of_service" class="form-control no_of_service form-select" url="{!! url('sales/add/getservices') !!}">
                                            <option value="0">{{ trans('message.Number of Services') }} </option>
                                            <option value="1" <?php if ($sales->no_of_services == 1) {
                                                                    echo 'selected';
                                                                } ?>>1</option>
                                            <option value="2" <?php if ($sales->no_of_services == 2) {
                                                                    echo 'selected';
                                                                } ?>>2</option>
                                            <option value="3" <?php if ($sales->no_of_services == 3) {
                                                                    echo 'selected';
                                                                } ?>>3</option>
                                            <option value="4" <?php if ($sales->no_of_services == 4) {
                                                                    echo 'selected';
                                                                } ?>>4</option>
                                            <option value="5" <?php if ($sales->no_of_services == 5) {
                                                                    echo 'selected';
                                                                } ?>>5</option>
                                            <option value="6" <?php if ($sales->no_of_services == 6) {
                                                                    echo 'selected';
                                                                } ?>>6</option>
                                            <option value="7" <?php if ($sales->no_of_services == 7) {
                                                                    echo 'selected';
                                                                } ?>>7</option>
                                            <option value="8" <?php if ($sales->no_of_services == 8) {
                                                                    echo 'selected';
                                                                } ?>>8</option>
                                            <option value="9" <?php if ($sales->no_of_services == 9) {
                                                                    echo 'selected';
                                                                } ?>>9</option>
                                            <option value="10" <?php if ($sales->no_of_services == 10) {
                                                                    echo 'selected';
                                                                } ?>>10</option>
                                            <option value="11" <?php if ($sales->no_of_services == 11) {
                                                                    echo 'selected';
                                                                } ?>>11</option>
                                            <option value="12" <?php if ($sales->no_of_services == 12) {
                                                                    echo 'selected';
                                                                } ?>>12</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Assign To') }} <label class="color-danger">*</label></label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                        <select class="form-control form-select" name="assigne_to" id="assigne_to" required>
                                            <option value="">{{ trans('message.Select Name') }}</option>
                                            @if (!empty($employee))
                                            @foreach ($employee as $employees)
                                            <option value="{{ $employees->id }}" <?php if ($employees->id == $sales->assigne_to) {
                                                                                        echo 'selected';
                                                                                    } ?>>
                                                {{ $employees->name . ' ' . $employees->lastname }}
                                            </option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="table-responsive" id="load_service_data">
                                    <table class="table" id="widthOfTableForResponsive" align="center" style="width: 80%;">
                                        <?php $i = 1; ?>
                                        @if (!empty($sales_services))
                                        @foreach ($sales_services as $sales_service)
                                        <tr class="data_of_type">
                                            <td class="text-center">{{ $i }}</td>
                                            <td class="text-center"><input type="text" class="form-control first_width" value="{{ $sales_service->full_date }}" name="service[service_date][]" readonly></td>
                                            <td class="text-center"><input type="text" class="form-control second_width" name="service[service_text][]" value="{{ $sales_service->title }}" readonly></td>
                                            <td class="text-center"><input type="text" class="form-control second_width" name="service[service_job][]" value="{{ $sales_service->job_no }}" readonly></td>
                                        </tr>
                                        <?php $i++; ?>
                                        @endforeach
                                        @endif
                                    </table>
                                </div>
                            </div>

                            <!-- Custom Filed data value -->
                            @if (!empty($tbl_custom_fields))
                            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space">
                                <h4><b>{{ trans('message.Custom Fields') }}</b></h4>
                                <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 ln_solid">
                                </p>
                            </div>
                            <?php
                            $subDivCount = 0;
                            ?>
                            @foreach ($tbl_custom_fields as $myCounts => $tbl_custom_field)
                            <?php
                            if ($tbl_custom_field->required == 'yes') {
                                $required = 'required';
                                $red = '*';
                            } else {
                                $required = '';
                                $red = '';
                            }
                            $tbl_custom = $tbl_custom_field->id;
                            $userid = $sales->id;
                            $datavalue = getCustomDataSales($tbl_custom, $userid);

                            $subDivCount++;
                            ?>
                            @if ($myCounts % 2 == 0)
                            <div class="row col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
                                @endif
                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 error_customfield_main_div_{{ $myCounts }}">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="account-no">{{ $tbl_custom_field->label }} <label class="color-danger">{{ $red }}</label></label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                        @if ($tbl_custom_field->type == 'textarea')
                                        <textarea name="custom[{{ $tbl_custom_field->id }}]" class="form-control textarea_{{ $tbl_custom_field->id }} textarea_simple_class common_simple_class common_value_is_{{ $myCounts }}" placeholder="{{ trans('message.Enter') }} {{ $tbl_custom_field->label }}" maxlength="100" isRequire="{{ $required }}" type="textarea" fieldNameIs="{{ $tbl_custom_field->label }}" rows_id="{{ $myCounts }}" {{ $required }}>{{ $datavalue }}</textarea>

                                        <span id="common_error_span_{{ $myCounts }}" class="help-block error-help-block color-danger" style="display: none"></span>
                                        @elseif($tbl_custom_field->type == 'radio')
                                        <?php
                                        $radioLabelArrayList = getRadiolabelsList($tbl_custom_field->id);
                                        ?>
                                        @if (!empty($radioLabelArrayList))
                                        <div style="margin-top: 5px;">
                                            @foreach ($radioLabelArrayList as $k => $val)
                                            <input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}]" value="{{ $k }}" <?php
                                                                                                                                                    $getRadioValue = getRadioLabelValueForUpdateForAllModules($tbl_custom_field->form_name, $sales->id, $tbl_custom_field->id);

                                                                                                                                                    if ($k == $getRadioValue) {
                                                                                                                                                        echo 'checked';
                                                                                                                                                    } ?>>
                                            {{ $val }} &nbsp;
                                            @endforeach
                                        </div>
                                        @endif
                                        @elseif($tbl_custom_field->type == 'checkbox')
                                        <?php
                                        $checkboxLabelArrayList = getCheckboxLabelsList($tbl_custom_field->id);
                                        ?>
                                        @if (!empty($checkboxLabelArrayList))
                                        <?php
                                        $getCheckboxValue = getCheckboxLabelValueForUpdateForAllModules($tbl_custom_field->form_name, $sales->id, $tbl_custom_field->id);
                                        ?>
                                        <div class="required_checkbox_parent_div_{{ $tbl_custom_field->id }}" style="margin-top: 5px;">
                                            @foreach ($checkboxLabelArrayList as $k => $val)
                                            <input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}][]" value="{{ $val }}" isRequire="{{ $required }}" fieldNameIs="{{ $tbl_custom_field->label }}" custm_isd="{{ $tbl_custom_field->id }}" class="checkbox_{{ $tbl_custom_field->id }} required_checkbox_{{ $tbl_custom_field->id }} checkbox_simple_class common_value_is_{{ $myCounts }} common_simple_class" rows_id="{{ $myCounts }}" <?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        if ($val == getCheckboxValForAllModule($tbl_custom_field->form_name, $sales->id, $tbl_custom_field->id, $val)) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ?>>
                                            {{ $val }} &nbsp;
                                            @endforeach
                                            <span id="common_error_span_{{ $myCounts }}" class="help-block error-help-block color-danger" style="display: none"></span>
                                        </div>
                                        @endif
                                        @elseif($tbl_custom_field->type == 'textbox')
                                        <input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}]" placeholder="{{ trans('message.Enter') }} {{ $tbl_custom_field->label }}" value="{{ $datavalue }}" maxlength="30" class="form-control textDate_{{ $tbl_custom_field->id }} textdate_simple_class common_value_is_{{ $myCounts }} common_simple_class" isRequire="{{ $required }}" fieldNameIs="{{ $tbl_custom_field->label }}" rows_id="{{ $myCounts }}" {{ $required }}>

                                        <span id="common_error_span_{{ $myCounts }}" class="help-block error-help-block color-danger" style="display:none"></span>
                                        @elseif($tbl_custom_field->type == 'date')
                                        <input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}]" placeholder="{{ trans('message.Enter') }} {{ $tbl_custom_field->label }}" value="{{ $datavalue }}" maxlength="30" class="form-control textDate_{{ $tbl_custom_field->id }} date_simple_class common_value_is_{{ $myCounts }} common_simple_class" isRequire="{{ $required }}" fieldNameIs="{{ $tbl_custom_field->label }}" rows_id="{{ $myCounts }}" onkeydown="return false" {{ $required }}>

                                        <span id="common_error_span_{{ $myCounts }}" class="help-block error-help-block color-danger" style="display:none"></span>
                                        @endif
                                    </div>
                                </div>
                                @if ($myCounts % 2 != 0)
                            </div>
                            @endif
                            @endforeach
                            <?php
                            if ($subDivCount % 2 != 0) {
                                echo '</div>';
                            }
                            ?>
                            @endif
                            <!-- Custom Filed data value End-->
                            <div class="row">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <!-- <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                                    <a class="btn btn-primary" href="{{ URL::previous() }}">{{ trans('message.CANCEL') }}</a>
                                </div> -->
                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                                    <button type="submit" class="btn btn-success updateVehicleSaleButton">{{ trans('message.UPDATE') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Color Add or Remove Model-->
                    <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                    <div id="responsive-modal-color" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title">{{ trans('message.Add Color Name') }}</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                            </div>
                            <div class="modal-body">
                            <form class="form-horizontal" action="" method="">
                                <div class="row">
                                <div class="col-md-5 form-group data_popup">
                                    <input type="text" id="c_name" class="form-control model_input c_name" name="c_name" placeholder="{{ trans('message.Enter color name') }}"  maxlength="20"/>
                                </div>
                                <div class="col-md-3 form-group data_popup">
                                    <input type="color" id="c_code" name="c_code" class="form-control model_input w-150 c_code">
                                </div>
                                <div class="col-md-4 form-group data_popup">
                                    <button type="button" class="btn btn-success model_submit addcolor" colorurl="{!! url('/color_name_add') !!}">{{ trans('message.Submit') }}</button>
                                </div>
                                </div>
                                <table class="table colornametype" align="center">
                                
                                <tbody>
                                    @foreach ($color as $colors)
                                    <tr class="del-{{ $colors->id }} data_color_name row mx-1">
                                    <td class="text-first col-6">{{ $colors->color }}</td>
                                    <td class="text-end col-6">
                                        <div class="color_code d-inline-block" style="background-color:{{ getColor($colors->id) }};">{{ $colors->color_code }}</div>
                                        <button type="button" id="{{ $colors->id }}" deletecolor="{!! url('colortypedelete') !!}" class="btn btn-danger text-white border-0 deletecolors d-inline-block"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                </table>
                            </form>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->


<!-- Scripts starting -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    var msg35 = "{{ trans('message.OK') }}";
    $(document).ready(function() {

        $('input[name=qty]').keyup(function() {
            $(this).val($(this).val().replace(/[^\d]/, ''));
        });


        $(function() {

            $('#vehicale_select').change(function() {

                var vehicale_id = $(this).val();
                var url = $(this).attr('url');
                var qty = $('#qty').val();
                var msg11 = "{{ trans('message.An error occurred :') }}";

                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {
                        vehicale_id: vehicale_id
                    },

                    success: function(response) {
                        var res_cust = jQuery.parseJSON(response);
                        var price_dta = res_cust.price;

                        $('#price').attr('value', res_cust.price);
                        total_price = price_dta * 1;
                        $('#total_price').val(total_price);
                    },
                    beforeSend: function() {
                        $('#price').attr('value', 'Loading...');
                    },
                    error: function(e) {
                        alert(msg11 + " " + e.responseText);
                        console.log(e);
                    }
                });
            });


            $('#vehicale_select').change(function() {

                var url = $(this).attr('chasisurl');
                var modelname = $('option:selected', this).attr('modelname');
                var vehicle_id = $('option:selected', this).val();
                var msg12 = "{{ trans('message.An error occurred :') }}";

                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {
                        modelname: modelname,
                        vehicle_id: vehicle_id
                    },

                    success: function(response) {
                        $('#chassis_num').html(response);
                    },
                    beforeSend: function() {
                        $('#price').attr('value', 'Loading...');
                    },
                    error: function(e) {
                        alert(msg12 + " " + e.responseText);
                        console.log(e);
                    }
                });
            });
        });



        $('.veh_brand').change(function() {

            var url = $(this).attr('bran_url');
            var brand_name = $(this).val();
            var msg13 = "{{ trans('message.Somthing went wrong') }}";
            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    brand_name: brand_name
                },
                success: function(response) {
                    $('.modelnm').remove();
                    $('.selectmodel').append(response);
                },
                error: function(e) {
                    alert(msg13 + " : " + e.responseText);
                    console.log(e);
                },
            });
        });



        $('body').on('keyup', '#qty', function() {

            var qty = $('#qty').val();
            var price = $('#price').val();
            var url = $(this).attr('url');
            var msg14 = "{{ trans('message.An error occurred :') }}";

            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    qty: qty,
                    price: price
                },
                success: function(response) {
                    total_price = price * 1;
                    $('#total_price').val(total_price);
                },
                beforeSend: function() {

                },
                error: function(e) {
                    alert(msg14 + " : " + e.responseText);
                    console.log(e);
                }
            });
        });



        $("#no_of_service").change(function() {

            var interval = $("#interval").val();
            var date_gape = $("#date_gape").val();
            var no_service = $("#no_of_service").val();
            var url = $(this).attr('url');

            var msg21 = "{{ trans('message.Interval') }}";
            var msg22 = "{{ trans('message.Please select interval!') }}";
            var msg15 = "{{ trans('message.An error occurred :') }}";

            if (interval != '' || date_gape != '' || no_service != '') {
                if ($("#interval").val() == '') {
                    swal({
                        title: msg21,
                        text: msg22,
                        cancelButtonColor: '#C1C1C1',
                        buttons: {
                            cancel: msg35,
                        },
                        dangerMode: true,
                    });
                    $('#no_of_service').html(
                        '<option value="0">No of service </option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option>'
                    );
                    return false;
                }

                if (interval != '' && date_gape != '' && no_service != '') {
                    $("#date_gape").change(function() {
                        $("#load_service_data").css("display", "none");
                        $('#no_of_service').html(
                            '<option value="0">No of service </option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option>'
                        );
                    });

                    $("#interval").change(function() {
                        $("#load_service_data").css("display", "none");
                        $('#no_of_service').html(
                            '<option value="0">No of service </option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option>'
                        );
                    });

                    $("#no_of_service").change(function() {
                        $("#load_service_data").css("display", "block");
                    });

                    $.ajax({
                        type: 'GET',
                        url: url,
                        data: {
                            interval: interval,
                            date_gape: date_gape,
                            no_service: no_service
                        },
                        success: function(response) {
                            $("#load_service_data").html(response);
                        },
                        error: function(e) {
                            alert(msg15 + " : " + e.responseText);
                            console.log(e);
                        },
                        beforeSend: function() {
                            $("#load_service_data").html(
                                "<center><h3>Loading...</h3></center>");
                        }
                    });
                }
            }
        });



       /*color add  model*/
    $('.addcolor').click(function() {
            var c_name = $('.c_name').val();
            var c_code = $('.c_code').val();
            var url = $(this).attr('colorurl');

            var msg55 = "{{ trans('message.Please enter color name') }}";
            
            function define_variable() {
                return {
                    addcolor_value: $('.c_name').val(),
                    addcolor_pattern: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]+$/,
                    addcolor_pattern2: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]*$/
                };
            }

            var call_var_addcoloradd = define_variable();

            if (c_name == "") {
                swal({
                    title: msg55,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });
            } else if (!call_var_addcoloradd.addcolor_pattern.test(call_var_addcoloradd
                    .addcolor_value)) {
                $('.c_name').val("");
                swal({
                    title: msg51,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });
            } else if (!c_name.replace(/\s/g, '').length) {
                $('.c_name').val("");
                swal({
                    title: msg52,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });
            } else if (!call_var_addcoloradd.addcolor_pattern2.test(call_var_addcoloradd
                    .addcolor_value)) {
                $('.c_name').val("");
                swal({
                    title: msg34,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });
            } else if (!colorPickerChanged) {
                swal({
                    title: "Please Select color",
                    cancelButtonColor: "#C1C1C1",
                    buttons: {
                        cancel: "OK",
                    },
                    dangerMode: true,
                });
                return;
            } else {
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {
                        c_name: c_name,
                        c_code: c_code
                    },

                    //Form submit at a time only one for addColorModel
                    beforeSend: function() {
                        $(".addcolor").prop('disabled', true);
                    },

                    success: function(data) {
                        var newd = $.trim(data);
                        var classname = 'del-' + newd;

                        if (data == '01') {
                            swal({
                                title: msg53,
                                cancelButtonColor: '#C1C1C1',
                                buttons: {
                                    cancel: msg35,
                                },
                                dangerMode: true,
                            });
                        } else {
                            $('.colornametype').append('<tr class="data_color_name row mx-1 ' + classname +
                                '"><td class="text-start col-6">' + c_name +
                                '</td><td class="text-end col-6"><div class="color_code d-inline-block" style="background-color:' + c_code + '; margin-right:4px;">' + c_code + '</div><button type="button" id=' +
                                data +
                                ' deletecolor="{!! url('colortypedelete') !!}" class="btn btn-danger text-white border-0 deletecolors"><i class="fa fa-trash" aria-hidden="true"></i></button></a></td><tr>'
                            );

                            $('.color_name_data').append('<option value=' + data + ' style="background-color:' + c_code + ';color: #ffffff;">' + c_name +
                                '</option>');

                            $('.c_name').val('');
                        }

                        //Form submit at a time only one for addColorModel
                        $(".addcolor").prop('disabled', false);
                        return false;
                    },
                    error: function(e) {
                        alert(mag20 + ' ' + e.responseText);
                        console.log(e);
                    }
                });
            }
    });



        /*color Delete  model*/
        $('body').on('click', '.deletecolors', function() {

            var colorid = $(this).attr('id');
            var url = $(this).attr('deletecolor');

            var msg1 = "{{ trans('message.Are You Sure?') }}";
            var msg2 = "{{ trans('message.You will not be able to recover this data afterwards!') }}";
            var msg3 = "{{ trans('message.Cancel') }}";
            var msg4 = "{{ trans('message.Yes, delete!') }}";
            var msg5 = "{{ trans('message.Done!') }}";
            var msg6 = "{{ trans('message.It was succesfully deleted!') }}";
            var msg7 = "{{ trans('message.Cancelled') }}";
            var msg8 = "{{ trans('message.Your data is safe') }}";
            var colordelete = "{{ trans('message.Color Deleted Successfully') }}";

            swal({
                title: msg1,
                text: msg2,
                icon: "warning",
                buttons: [msg3, msg4],
                dangerMode: true,
                cancelButtonColor: "#C1C1C1",
            }).then((isConfirm) => {
                if (isConfirm) {
                    $.ajax({
                        type: 'GET',
                        url: url,
                        data: {
                            colorid: colorid
                        },
                        success: function(data) {
                            $('.del-' + colorid).remove();
                            $(".color_name_data option[value=" + colorid + "]")
                                .remove();
                            swal({
                                title: msg5,
                                text: colordelete,
                                icon: 'success',
                                cancelButtonColor: '#C1C1C1',
                                buttons: {
                                    cancel: msg35,
                                },
                                dangerMode: true,
                            });
                        }
                    });
                } else {
                    swal({
                        title: msg7,
                        text: msg8,
                        icon: 'error',
                        cancelButtonColor: '#C1C1C1',
                        buttons: {
                            cancel: msg35,
                        },
                        dangerMode: true,
                    });
                }
            })
        });

        /*datetimepicker*/
        $('.datepicker').datetimepicker({
            format: "<?php echo getDatepicker(); ?>",
            todayBtn: true,
            autoclose: 1,
            minView: 2,
            language: "{{ getLangCode() }}",
        });

        // Initialize select2
        $(".select_customer_auto_search").select2();



        /*If select box have value then error msg and has error class remove*/
        $('body').on('change', '.salesDate', function() {

            var dateValue = $(this).val();

            if (dateValue != null) {
                $('#sales_date-error').css({
                    "display": "none"
                });
            }

            if (dateValue != null) {
                $(this).parent().parent().removeClass('has-error');
            }
        });



        $('.customer_name').on('change', function() {

            var customerValue = $('select[name=cus_name]').val();

            if (customerValue != null) {
                $('#supplier_select-error').css({
                    "display": "none"
                });
            }

            if (customerValue != null) {
                $(this).parent().parent().removeClass('has-error');
            }
        });



        /*Custom Field manually validation*/
        var msg31 = "{{ trans('message.field is required') }}";
        var msg32 = "{{ trans('message.Only blank space not allowed') }}";
        var msg33 = "{{ trans('message.Special symbols are not allowed.') }}";
        var msg34 = "{{ trans('message.At first position only alphabets are allowed.') }}";

        /*Form submit time check validation for Custom Fields */
        $('body').on('click', '.updateVehicleSaleButton', function(e) {
            $('#vehicleSalesEditForm input, #vehicleSalesEditForm select, #vehicleSalesEditForm textarea')
                .each(

                    function(index) {
                        var input = $(this);

                        if (input.attr('name') == "date" || input.attr('name') == "cus_name" || input
                            .attr('name') ==
                            "salesmanname" || input.attr('name') == "vehi_bra_name" || input.attr(
                                'name') ==
                            "vehicale_name" || input.attr('name') == "color" || input.attr('name') ==
                            "price") {
                            if (input.val() == "") {
                                return true;
                            } else {
                                return true;
                            }
                        } else if (input.attr('isRequire') == 'required') {
                            var rowid = (input.attr('rows_id'));
                            var labelName = (input.attr('fieldnameis'));

                            if (input.attr('type') == 'textbox' || input.attr('type') == 'textarea') {
                                if (input.val() == '' || input.val() == null) {
                                    $('.common_value_is_' + rowid).val("");
                                    $('#common_error_span_' + rowid).text(labelName + " : " + msg31);
                                    $('#common_error_span_' + rowid).css({
                                        "display": ""
                                    });
                                    $('.error_customfield_main_div_' + rowid).addClass('has-error');
                                    e.preventDefault();
                                    return false;
                                } else if (!input.val().replace(/\s/g, '').length) {
                                    $('.common_value_is_' + rowid).val("");
                                    $('#common_error_span_' + rowid).text(labelName + " : " + msg32);
                                    $('#common_error_span_' + rowid).css({
                                        "display": ""
                                    });
                                    $('.error_customfield_main_div_' + rowid).addClass('has-error');
                                    e.preventDefault();
                                    return false;
                                } else if (!input.val().match(/^[(a-zA-Z0-9\s)\p{L}]+$/u)) {
                                    $('.common_value_is_' + rowid).val("");
                                    $('#common_error_span_' + rowid).text(labelName + " : " + msg33);
                                    $('#common_error_span_' + rowid).css({
                                        "display": ""
                                    });
                                    $('.error_customfield_main_div_' + rowid).addClass('has-error');
                                    e.preventDefault();
                                    return false;
                                }
                            } else if (input.attr('type') == 'checkbox') {
                                var ids = input.attr('custm_isd');
                                if ($(".required_checkbox_" + ids).is(':checked')) {
                                    $('#common_error_span_' + rowid).css({
                                        "display": "none"
                                    });
                                    $('.error_customfield_main_div_' + rowid).removeClass('has-error');
                                    $('.required_checkbox_parent_div_' + ids).css({
                                        "color": ""
                                    });
                                    $('.error_customfield_main_div_' + rowid).removeClass('has-error');
                                } else {
                                    $('#common_error_span_' + rowid).text(labelName + " : " + msg31);
                                    $('#common_error_span_' + rowid).css({
                                        "display": ""
                                    });
                                    $('.error_customfield_main_div_' + rowid).addClass('has-error');
                                    $('.required_checkbox_' + ids).css({
                                        "outline": "2px solid #a94442"
                                    });
                                    $('.required_checkbox_parent_div_' + ids).css({
                                        "color": "#a94442"
                                    });
                                    e.preventDefault();
                                    return false;
                                }
                            } else if (input.attr('type') == 'date') {
                                if (input.val() == '' || input.val() == null) {
                                    $('.common_value_is_' + rowid).val("");
                                    $('#common_error_span_' + rowid).text(labelName + " : " + msg31);
                                    $('#common_error_span_' + rowid).css({
                                        "display": ""
                                    });
                                    $('.error_customfield_main_div_' + rowid).addClass('has-error');
                                    e.preventDefault();
                                    return false;
                                } else {
                                    $('#common_error_span_' + rowid).css({
                                        "display": "none"
                                    });
                                    $('.error_customfield_main_div_' + rowid).removeClass('has-error');
                                }
                            }
                        } else if (input.attr('isRequire') == "") {
                            //Nothing to do
                        }
                    }
                );
        });


        /*Anykind of input time check for validation for Textbox, Date and Textarea*/
        $('body').on('keyup', '.common_simple_class', function() {

            var rowid = $(this).attr('rows_id');
            var valueIs = $('.common_value_is_' + rowid).val();
            var requireOrNot = $('.common_value_is_' + rowid).attr('isrequire');
            var labelName = $('.common_value_is_' + rowid).attr('fieldnameis');
            var inputTypes = $('.common_value_is_' + rowid).attr('type');

            if (requireOrNot != "") {
                if (inputTypes != 'radio' && inputTypes != 'checkbox' && inputTypes != 'date') {
                    if (valueIs == "") {
                        $('.common_value_is_' + rowid).val("");
                        $('#common_error_span_' + rowid).text(labelName + " : " + msg31);
                        $('#common_error_span_' + rowid).css({
                            "display": ""
                        });
                        $('.error_customfield_main_div_' + rowid).addClass('has-error');
                    } else if (valueIs.match(/^\s+/)) {
                        $('.common_value_is_' + rowid).val("");
                        $('#common_error_span_' + rowid).text(labelName + " : " + msg34);
                        $('#common_error_span_' + rowid).css({
                            "display": ""
                        });
                        $('.error_customfield_main_div_' + rowid).addClass('has-error');
                    } else if (!valueIs.match(/^[(a-zA-Z0-9\s)\p{L}]+$/u)) {
                        $('.common_value_is_' + rowid).val("");
                        $('#common_error_span_' + rowid).text(labelName + " : " + msg33);
                        $('#common_error_span_' + rowid).css({
                            "display": ""
                        });
                        $('.error_customfield_main_div_' + rowid).addClass('has-error');
                    } else {
                        $('#common_error_span_' + rowid).css({
                            "display": "none"
                        });
                        $('.error_customfield_main_div_' + rowid).removeClass('has-error');
                    }
                } else if (inputTypes == 'date') {
                    if (valueIs != "") {
                        $('#common_error_span_' + rowid).css({
                            "display": "none"
                        });
                        $('.error_customfield_main_div_' + rowid).removeClass('has-error');
                    } else {
                        $('.common_value_is_' + rowid).val("");
                        $('#common_error_span_' + rowid).text(labelName + " : " + msg31);
                        $('#common_error_span_' + rowid).css({
                            "display": ""
                        });
                        $('.error_customfield_main_div_' + rowid).addClass('has-error');
                    }
                } else {
                    //alert("Yes i am radio and checkbox");
                }
            } else {
                if (inputTypes != 'radio' && inputTypes != 'checkbox' && inputTypes != 'date') {
                    if (valueIs != "") {
                        if (valueIs.match(/^\s+/)) {
                            $('.common_value_is_' + rowid).val("");
                            $('#common_error_span_' + rowid).text(labelName + " : " + msg34);
                            $('#common_error_span_' + rowid).css({
                                "display": ""
                            });
                            $('.error_customfield_main_div_' + rowid).addClass('has-error');
                        } else if (!valueIs.match(/^[(a-zA-Z0-9\s)\p{L}]+$/u)) {
                            $('.common_value_is_' + rowid).val("");
                            $('#common_error_span_' + rowid).text(labelName + " : " + msg33);
                            $('#common_error_span_' + rowid).css({
                                "display": ""
                            });
                            $('.error_customfield_main_div_' + rowid).addClass('has-error');
                        } else {
                            $('#common_error_span_' + rowid).css({
                                "display": "none"
                            });
                            $('.error_customfield_main_div_' + rowid).removeClass('has-error');
                        }
                    } else {
                        $('#common_error_span_' + rowid).css({
                            "display": "none"
                        });
                        $('.error_customfield_main_div_' + rowid).removeClass('has-error');
                    }
                }
            }
        });


        /*For required checkbox checked or not*/
        $('body').on('click', '.checkbox_simple_class', function() {

            var rowid = $(this).attr('rows_id');
            var requireOrNot = $('.common_value_is_' + rowid).attr('isrequire');
            var labelName = $('.common_value_is_' + rowid).attr('fieldnameis');
            var inputTypes = $('.common_value_is_' + rowid).attr('type');
            var custId = $('.common_value_is_' + rowid).attr('custm_isd');

            if (requireOrNot != "") {
                if ($(".required_checkbox_" + custId).is(':checked')) {
                    $('.required_checkbox_' + custId).css({
                        "outline": ""
                    });
                    $('.required_checkbox_' + custId).css({
                        "color": ""
                    });
                    $('#common_error_span_' + rowid).css({
                        "display": "none"
                    });
                    $('.required_checkbox_parent_div_' + custId).css({
                        "color": ""
                    });
                    $('.error_customfield_main_div_' + rowid).removeClass('has-error');
                } else {
                    $('#common_error_span_' + rowid).text(labelName + " : " + msg31);
                    $('.required_checkbox_' + custId).css({
                        "outline": "2px solid #a94442"
                    });
                    $('.required_checkbox_' + custId).css({
                        "color": "#a94442"
                    });
                    $('#common_error_span_' + rowid).css({
                        "display": ""
                    });
                    $('.required_checkbox_parent_div_' + custId).css({
                        "color": "#a94442"
                    });
                    $('.error_customfield_main_div_' + rowid).addClass('has-error');
                }
            }
        });



        $('body').on('change', '.date_simple_class', function() {

            var rowid = $(this).attr('rows_id');
            var valueIs = $('.common_value_is_' + rowid).val();
            var requireOrNot = $('.common_value_is_' + rowid).attr('isrequire');
            var labelName = $('.common_value_is_' + rowid).attr('fieldnameis');
            var inputTypes = $('.common_value_is_' + rowid).attr('type');
            var custId = $('.common_value_is_' + rowid).attr('custm_isd');

            if (requireOrNot != "") {
                if (valueIs != "") {
                    $('#common_error_span_' + rowid).css({
                        "display": "none"
                    });
                    $('.error_customfield_main_div_' + rowid).removeClass('has-error');
                } else {
                    $('#common_error_span_' + rowid).text(labelName + " : " + msg31);
                    $('#common_error_span_' + rowid).css({
                        "display": ""
                    });
                    $('.error_customfield_main_div_' + rowid).addClass('has-error');
                }
            }
        });
    });
</script>

<script>
    // Color name to HTML color value mapping
    const colorMap = {
        "red": "#ff0000",
        "blue": "#0000FF",
        "green": "#008000",
        "black": "#000000",
        "brown": "#A52A2A",
        "grey": "#808080",
        "pink": "#FFC0CB",
        "purple": "#800080",
        "yellow": "#FFFF00",
    };
    let colorPickerChanged = false;
    function removeSpecialSymbols(str) {
        return str.replace(/[^a-zA-Z0-9]/g, '');
    }

    // Get references to the color input and text input
    const colorInput = document.getElementById("c_code");
    const textInput = document.getElementById("c_name");

    // Add an event listener to the color input to update the text input
    colorInput.addEventListener("input", function () {
        const cleanedColorCode = removeSpecialSymbols(colorInput.value);
        textInput.value = `custom${cleanedColorCode}`;
        colorPickerChanged = true;
    });
</script>

<!-- Form field validation -->
{!! JsValidator::formRequest('App\Http\Requests\StoreVehicleSaleAddEditFormRequest', '#vehicleSalesEditForm') !!}
<script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>

@endsection