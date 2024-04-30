@extends('layouts.app')
@section('content')
{{-- <script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script> --}}
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
    <div class="">
        <div class="nav_menu">
            <nav>
                <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><a href="{!! url('/quotation/list') !!}" id=""><i class=""><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}"></i><span class="titleup">
                            {{ trans('message.Quotation Process') }}</span></a>
                </div>
                @include('dashboard.profile')
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
            <div class="x_panel mb-0">
                <form method="post" action="{!! url('/quotation/add_modify_quotation') !!}" class="addJobcardForm">
                    <input type="hidden" class="service_id" name="service_id" value="{{ $services->id }}" />
                    <!-- <hr /> -->
                    <div class="row row-mb-0">
                        <div class="row col-md-7 col-lg-7 col-xl-7 col-xxl-7 col-sm-7 col-xs-7">
                            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12" colspan="2" valign="top">
                                <h4><?php echo $logo->system_name; ?></h4>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col-lg-5 col-xl-5 col-xxl-5 col-sm-5 col-xs-5 printimg mx-0 mt-4">
                                    <img src="{{ url('/public/general_setting/' . $logo->logo_image) }}" width="200">
                                </div>
                                <div class="col-md-7 col-lg-7 col-xl-7 col-xxl-7 col-sm-7 col-xs-7 garrageadd mt-4" valign="top">
                                    <img src="{{ URL::asset('public/img/icons/Vector (14).png') }}">&nbsp;

                                    <?php
                                    echo $logo->address . ', ';
                                    echo ',' . getCityName($logo->city_id);
                                    echo ', ' . getStateName($logo->state_id);
                                    echo ', ' . getCountryName($logo->country_id);
                                    ?>
                                    <br>
                                    <img src="{{ URL::asset('public/img/icons/Vector (15).png') }}">
                                    <?php
                                    echo ' ' . $logo->email;
                                    echo '<br><i class="fa fa-phone fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;' . $logo->phone_number;
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 col-lg-5 col-xl-5 col-xxl-5 col-sm-5 col-xs-5 pt-4">
                            <div class="row pt-4 row-mb-0">
                                <label class="control-label jobcardmargintop col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">{{ trans('message.Quotation No') }}<label class="color-danger">*</label></label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="text" id="job_no" name="job_no" value="{{ getQuotationNumber($services->job_no) }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <label class="control-label jobcardmargintop col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">{{ trans('message.In Date/Time') }}<label class="color-danger">*</label></label>                                
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="text" id="in_date" name="in_date" value="<?php echo date(getDateFormat() . ' H:i:s', strtotime($services->service_date)); ?> " class="form-control date_picker" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space1">
                        <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space1_solid"></p>
                    </div>
                    <div class="row row-mb-0">
                        <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                            <h2 class="text-left jobcard_heading fw-bold">{{ trans('message.Customer Details') }}</h2>
                            <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space1_solid"></p>
                            <div class="row row-mb-0">
                                <label class="control-label jobcardmargintop col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">{{ trans('message.Name') }}</label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="text" id="name" name="name" class="form-control" value="{{ getCustomerName($services->customer_id) }}" readonly>
                                </div>
                            </div>
                            <div class="row row-mb-0">
                                <label class="control-label jobcardmargintop col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">{{ trans('message.Address') }}</label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="text" id="address" name="address" class="form-control" value="{{ getCustomerAddress($services->customer_id) }}" readonly>
                                </div>
                            </div>
                            <div class="row row-mb-0">
                                <label class="control-label jobcardmargintop col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">{{ trans('message.Contact No') }}</label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="text" id="con_no" name="con_no" class="form-control" value="{{ getCustomerMobile($services->customer_id) }}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <label class="control-label jobcardmargintop col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                                    {{ trans('message.Email') }}</label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="text" id="email" name="email" class="form-control" value="{{ getCustomerEmail($services->customer_id) }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                            <h2 class="text-left jobcard_heading fw-bold">{{ trans('message.Vehicle Details') }}</h2>
                            <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space1_solid"></p>
                            <div class="row row-mb-0">
                                <label class="control-label jobcardmargintop col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">{{ trans('message.Model Name') }}</label>
                                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                    <input type="text" id="model" name="model" class="form-control" value="{{ $vehicale->modelname }}" readonly>
                                </div>
                                <div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2"></div>
                            </div>
                            @if (!empty($vehicale->chassisno))
                            <div class="row row-mb-0">
                                <label class="control-label jobcardmargintop col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">{{ trans('message.Chasis No') }}</label>
                                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                    <input type="text" id="chassisno" name="chassisno" class="form-control" value="{{ $vehicale->chassisno }}" readonly>
                                </div>
                                <div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2"></div>
                            </div>
                            @endif
                            @if (!empty($vehicale->chassisno))
                            <div class="row row-mb-0">
                                <label class="control-label jobcardmargintop col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">{{ trans('message.Engine No') }}</label>
                                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                    <input type="text" id="engine_no" name="engine_no" class="form-control" value="{{ $vehicale->engineno }}" readonly>
                                </div>
                                <div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2"></div>
                            </div>
                            @endif
                            @if (!empty($s_date))
                            <div class="row row-mb-0">
                                <label class="control-label jobcardmargintop col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                                    {{ trans('message.Date Of Sale') }}</label>
                                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                    <input type="text" id="sales_date" name="sales_date" class="form-control" value="{{ date(getDateFormat(), strtotime($s_date->date)) }}" readonly>
                                </div>
                                <div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2"></div>
                            </div>
                            @endif
                            @if (!empty($job->coupan_no))
                            <div class="row row-mb-0">
                                <label class="control-label jobcardmargintop col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                                    {{ trans('message.Free Service Coupan No') }}:</label>
                                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                    <input type="text" id="coupan_no" name="coupan_no" value="<?php if (!empty($job)) {
                                                                                                    echo "$job->coupan_no";
                                                                                                } ?>" class="form-control">>
                                </div>
                                <div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2"></div>
                            </div>
                            @endif
                            @if ($washbayPrice != null)
                            <div class="row row-mb-0">
                                <label class="control-label jobcardmargintop col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                                    {{ trans('message.Wash Bay Charge') }} (<?php echo getCurrencySymbols(); ?>)</label>
                                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                    <input type="text" id="washBay" name="washBayCharge" value="{{ $washbayPrice }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2"></div>
                            @endif
                        </div>

                    </div>
                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space1">
                        <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 ln_solid"></p>
                    </div>
                    <div class="row">
                        <div class="col-md-10 col-lg-10 col-xl-10 col-xxl-10 col-sm-10 col-xs-10">
                            <h3 class="fw-bold mt-0">{{ trans('message.Observation List') }}
                                <button type="button" data-bs-target="#responsive-modal-observation" data-bs-toggle="modal" class="btn btn-outline-secondary clickAddNewButton ms-1"> + </button>
                            </h3>
                        </div>
                        <!-- <div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2" style="padding-top:3px;">
                                <button type="button" data-bs-target="#responsive-modal-observation"
                                    data-bs-toggle="modal"
                                    class="btn btn-outline-secondary clickAddNewButton"> + </button>
                            </div> -->
                    </div>
                    <div class="col-md-12 col-xs-12 col-sm-12 panel-group">
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
                                    <table class="table table-bordered main_data_points" id="main_data_points" align="center">
                                        <thead>
                                            <tr>
                                                <th class="fw-bold">{{ trans('message.Category') }}</th>
                                                <th class="fw-bold" style="width:10%;">{{ trans('message.Observation Point') }}</th>
                                                <th class="fw-bold" style="width:10%;">{{ trans('message.Service Charge') }}</th>
                                                <th class="fw-bold" style="width:10%;">{{ trans('message.Select Product') }}</th>
                                                <th class="fw-bold" style="width:9%;">{{ trans('message.Price') }}
                                                    (<?php echo getCurrencySymbols(); ?>)
                                                </th>
                                                <th class="fw-bold" style="width:10%;">{{ trans('message.Qty') }}</th>
                                                <th class="fw-bold" style="width:10%;">{{ trans('message.Total') }}
                                                    (<?php echo getCurrencySymbols(); ?>)</th>
                                                <th class="fw-bold" style="width:10%;">{{ trans('message.Chargeable') }}</th>
                                                <th class="fw-bold">{{ trans('message.Comments') }}</th>
                                                <th class="fw-bold">{{ trans('message.Action') }}</th>
                                            </tr>
                                        </thead>

                                        <tbody id="tbd">
                                            <?php $i = 1; ?>
                                            <?php foreach ($data as $datas) { ?>
                                                <tr class="obs_point_data" id="<?php echo 'row_id_delete_' . $i; ?>">
                                                    <td>
                                                        <input type="text" name="product2[category][]" class="form-control" value="<?php echo $datas->checkout_subpoints; ?>" readonly="true">
                                                        <input type="hidden" name="pro_id_delete" class="del_pro_<?php echo $i; ?>" id="del_pro_<?php echo $i; ?>" value="<?php echo $datas->id; ?>">
                                                    </td>

                                                    <td>
                                                        <input type="text" name="product2[sub_points][]" class="form-control" value="<?php echo $datas->checkout_point; ?>" readonly="true">
                                                    </td>

                                                    <td>
                                                        <input type="number" name="product2[service_charge][]" value="<?php echo $datas->service_charge; ?>" class="form-control charge charge_{{ $i }}" row_id="{{ $i }}" maxlength="8">                                                    
                                                    </td>

                                                    <td>
                                                        <select name="product2[product_id][]" class="form-control product_ids product1s_{{ $i }} form-select" url="{{ url('/jobcard/getprice') }}" row_did="{{ $i }}" id="product1s_{{ $i }}" qtyappend="">
                                                            <option value="">{{ trans('message.Select Product') }}
                                                            </option>
                                                            <?php foreach ($product as $products) {
                                                                if ($products->id == $datas->product_id) {
                                                                    $is_select = "selected";
                                                                } else {
                                                                    $is_select = "";
                                                                }
                                                            ?>
                                                                <option value="<?php echo $products->id; ?>" <?php echo $is_select; ?>>
                                                                    <?php echo $products->name; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        @if (!empty($products))
                                                        <input type="text" name="product2[price][]" value="<?php if (!empty($data)) {
                                                                                                                echo $datas->price;
                                                                                                            } ?>" value="<?php echo $products->price; ?>" class="form-control prices rate product1_<?php echo $i; ?> product1_<?php echo $i; ?> price_<?php echo $i; ?>" id="product1_<?php echo $i; ?>" row_id="{{ $i }}" maxlength="8" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <input type="number" min="0" oninput="this.value = Math.abs(this.value)" name="product2[qty][]" class="form-control qtyt qnt_<?php echo $i; ?> <?php echo 'qty_' . $i; ?> pe-0" row_id1="<?php echo $i; ?>" value="<?php if (!empty($data)) {
                                                                                                                                                                                                                                                                            echo $datas->quantity;
                                                                                                                                                                                                                                                                        } ?>" url="<?php echo url('/jobcard/gettotalprice'); ?>" id="<?php echo 'qty_' . $i; ?>" style="width:100%;float:left;">
                                                        <!-- <span class="unit_<?php echo $i; ?>"></span> -->
                                                    </td>

                                                    <td>
                                                        <input type="text" name="product2[total][]" value="<?php if (!empty($data)) {
                                                                                                                echo $datas->total_price;
                                                                                                            } ?>" value="0" class="form-control total1 total1_<?php echo $i; ?>" id="total1_<?php echo $i; ?>" readonly="true" />
                                                    </td>

                                                    <td>
                                                        <input type="radio" name="yesno_[]<?php echo $i; ?>" class="yes_no m-0" value="1" <?php if ($datas->chargeable == 1) {
                                                                                                                                                                        echo 'checked';
                                                                                                                                                                    } ?> style=" height:13px; width:20px;">{{ trans('message.Yes') }}

                                                        <input type="radio" name="yesno_[]<?php echo $i; ?>" class="yes_no" value="0" <?php if ($datas->chargeable == 0) {
                                                                                                                                                                        echo 'checked';
                                                                                                                                                                    } ?> style="height:13px; width:20px; margin-right:0px;">{{ trans('message.No') }} 
                                                    </td>
                                                    <td>
                                                        <textarea name="product2[comment][]" class="form-control" maxlength="250">{{ $datas->category_comments }}</textarea>
                                                    </td>
                                                    <td class="text-center">
                                                        <i class="fa fa-trash fa-2x delete" style="cursor: pointer;" data_id_trash="<?php echo $i; ?>" delete_data_url=" <?php echo url('/jobcard/delete_on_reprocess'); ?>" service_id="<?php echo $viewid; ?>"></i>
                                                        <input type="hidden" name="obs_id[]" class="form-control" value="<?php echo $datas->id; ?>">
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row panel-group">
                        <div class="col-md-10 col-lg-10 col-xl-10 col-xxl-10 col-sm-10 col-xs-10">
                            <h2 class="fw-bold mt-0">{{ trans('message.Other Service Charges') }}
                                <button type="button" id="add_new_product" class="btn btn-outline-secondary mt-0 ms-1" url="{!! url('/jobcard/addproducts') !!}"> +
                                </button>
                            </h2>
                        </div>
                        <!-- <div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2">
                                <button type="button" id="add_new_product" class="btn btn-outline-secondary mt-0"
                                    url="{!! url('/jobcard/addproducts') !!}"> + 
                                </button>
                            </div> -->
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-xs-12 col-sm-12 table-responsive">
                            <table class="table table-bordered addtaxtype" id="tab_products_detail" align="center">
                                <thead>
                                    <tr>
                                        <th class="all">{{ trans('message.Service') }}</th>
                                        <th class="all">{{ trans('message.Price') }} (<?php echo getCurrencySymbols(); ?>)
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
                                            <input type="text" name="other_price[]" class="form-control otherPriceCheckVal other_service_price othr_price_<?php echo $id; ?>" id="oth_price" value="<?php echo $product->total_price; ?>" maxlength="8" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                        </td>
                                        <td class="text-center">
                                            <span class="trash_product" style="cursor: pointer;" data-id="<?php echo $id; ?>" oth_url="<?php echo url('jobcard/oth_pro_delete'); ?>"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></span>
                                        </td>
                                    </tr>
                                    <?php $id++; ?>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Checking for MOT Test status -->
                    <!-- @if ($fetch_mot_test_status->mot_status == 1)
                    <div class="col-md-12 col-sm-12 col-xm-12 panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title fw-bold">{{ trans('message.MOT Test Service Charge') }}</h5>
                            </div>
                        </div>
                    </div>
                    @endif -->
                    <!-- End MOT Test Checking -->

                    <!-- model in observation Point -->
                    <div class="col-md-12">
                        <div id="responsive-modal-observation" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">{{ trans('message.Observation Point') }}</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                    </div>
                                    <div class="modal-body">
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
                                                                                <td class="col-md-1"><?php echo $i++; ?>
                                                                                </td>
                                                                                <td class="row{{ $subcategorys->checkout_point }} col-md-4">
                                                                                    <?php echo $subcategorys->checkout_point;
                                                                                    ?> <?php $data = getCheckedStatus($subcategorys->id, $services->id); ?>
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
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success col-md-offset-10 check_submit observationPointModelSubmitButton" style="margin-bottom:5px;" disabled="true">{{ trans('message.Submit') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:5px; margin-bottom:15px;">
                        <div class="col-md-8 col-sm-12 col-xs-12">
                            <label>
                                <input type="checkbox" id="finalSubmit" name="finalSubmit" class="" style="height:20px; width:20px; margin-right:5px; top: 6px; margin-bottom: 12px;">
                                <span for="finalSubmit" class="text-danger">{{ trans('message.Quotaion is final, then click here.') }}</span>
                            </label>
                        </div>
                    </div> -->

                    <div class="row">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <!-- <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                                <a class="btn btn-primary cancelJobcardSubmitButton" href="{{ URL::previous() }}">{{ trans('message.CANCEL') }}</a>
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
<!-- /page content -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
    var msg35 = "{{ trans('message.OK') }}"
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

        var i = 0;
        $('.observation_Plus').click(function() {
            i = i + 1;
            if (i % 2 != 0) {
                $(this).parent().find(".fa-minus:first").removeClass("fa-minus").addClass(
                    "fa-plus");

            } else {
                $(this).parent().find(".fa-plus:first").removeClass("fa-plus").addClass(
                    "fa-minus");
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
                // var sale_id = $(this).attr('sale_id');
                var sale_id = $(this).attr('sale_id');
                var main_cat = $(this).attr('main_cat');
                var sub_pt = $(this).attr('sub_pt');

                $('.observationPointModelSubmitButton').prop("disabled", false);
                $('.closeButton').attr("disabled", "true");

                var msg13 = "{{ trans('message.Error') }}";

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
                        alert(msg13 + " : " + e)
                    }
                });
            } else if ($(this).prop("checked") == false) {
                var value = 0;
                var url = $(this).attr('url');
                var id = $(this).attr('check_id');
                var sale_id = $(this).attr('s_id');

                $('.observationPointModelSubmitButton').prop("disabled", false);
                $('.closeButton').attr("disabled", "true");

                $.ajax({
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    data: {
                        value: value,
                        id: id,
                        service_id: sale_id
                    },
                    success: function(response) {},
                    error: function(e) {}
                });
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
                success: function(response) {},
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
            language: "{{ getLangCode() }}",
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
            var qt = $(this).attr('qtymessageend');
            var url = $(this).attr('url');
            var serviceCharge = $('.charge_' + row_id).val();

            if (qt == '') {
                qt = $('.qnt_' + row_id).val();
            }

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

        /*Price field should editable and editable price should change the Total-Amount (on-time editable price )*/
        $('body').on('input', '.prices', function() {

            var row_id = $(this).attr('row_id');
            var qty = $('.qty_' + row_id).val();
            var price = $('.price_' + row_id).val();
            var serviceCharge = parseFloat($('.charge_' + row_id).val()) || 0;
            var total_price = parseFloat(price * qty) || 0;

            var total = serviceCharge + total_price;

            var product_is_selected = $('.product_id_option_' + row_id).val();

            if (price == 0 || price == null) {
                $('.price_' + row_id).val("");
                $('.qty_' + row_id).val("");
                $('.total1_' + row_id).val("");
            } else {
                $('.price_' + row_id).val(price);
                $('.qty_' + row_id).val("1");
                $('.total1_' + row_id).val(total);
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

            console.log('total input: ' + totalInput);
            console.log('previous service charge: ' + previousServiceCharge);
            console.log('service charge: ' + serviceCharge);
            console.log('new total: ' + newTotal);

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

        $('.clickAddNewButton').on('click', function() {

            $('.check_submit').prop("disabled", true);
            $('.closeButton').prop('disabled', false);
        });

        /*When input less than 1 after text box will be clear*/
        $('body').on('blur', '.qtyt', function() {
            $qtyVal = $(this).val();
            var row_id = $(this).attr('row_id1');

            if ($qtyVal == 0) {
                $('.qty_' + row_id).val('');
                $('.total1_' + row_id).val('');
            }
        });

        $('body').on('blur', '.otherPriceCheckVal', function() {
            $qtyVal = $(this).val();

            if ($qtyVal == 0) {
                $(this).val("");
            }
        });

        /*Form submit at a time only one*/
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