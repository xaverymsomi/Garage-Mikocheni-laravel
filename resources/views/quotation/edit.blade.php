@extends('layouts.app')
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

<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="nav_menu">
            <nav>
                <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><a href="{!! url('/quotation/list') !!}" id=""><i class=""><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}"></i><span class="titleup">
                            {{ trans('message.Edit Quotation') }}</span></a>
                </div>
                @include('dashboard.profile')
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
            <div class="x_panel mb-0">
                <div class="x_content">
                    <form id="QuotationEdit-Form" method="post" action="update/{{ $service->id }}" enctype="multipart/form-data" class="form-horizontal upperform">

                        <div class="row row-mb-0">
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Quotation Number') }} <label class="color-danger">*</label></label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="text" name="jobno" class="form-control" value="{{ getQuotationNumber($service->job_no) }}" placeholder="{{ trans('message.Enter Job No') }}" readonly>
                                </div>
                            </div>

                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Customer Name') }} <label class="color-danger">*</label></label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <select name="Customername" id="sup_id" class="form-control select_customer_auto_search form-select" disabled>
                                        <option value="">{{ trans('message.Select Select Customer') }}</option>

                                        @if (!empty($customer))
                                        @foreach ($customer as $customers)
                                        <option value="{{ $customers->id }}" <?php if ($customers->id == $service->customer_id) {
                                                                                    echo 'selected';
                                                                                } ?>>
                                            {{ getCustomerName($customers->id) }}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row row-mb-0">
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="last-name">{{ trans('message.Vehicle Name') }} <label class="color-danger">*</label></label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <select name="vehicalname" class="form-control form-select" disabled>
                                        <option value="">{{ trans('message.Select vehicle Name') }}</option>
                                        @if (!empty($vehical))
                                        @foreach ($vehical as $vehicals)
                                        <option value="{{ $vehicals->id }}" <?php if ($vehicals->id == $service->vehicle_id) {
                                                                                echo 'selected';
                                                                            } ?>>
                                            {{ $vehicals->modelname }}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="p_date">{{ trans('message.Date') }} <label class="color-danger">*</label></label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 date">
                                    <input type="text" id="p_date" name="date" autocomplete="off" value="{{ $service->service_date }}" class="form-control datepicker" placeholder="yyyy-mm-dd hh:mm:ss" onkeypress="return false;" required />
                                </div>
                            </div>
                        </div>

                        <div class="row row-mb-0">
                        <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="branch">{{ trans('message.Branch') }} <label class="color-danger">*</label></label>

                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <select class="form-control select_branch form-select" name="branch">
                                        @foreach ($branchDatas as $branchData)
                                        <option value="{{ $branchData->id }}" <?php if ($service->branch_id == $branchData->id) {
                                                                                    echo 'selected';
                                                                                } ?>>
                                            {{ $branchData->branch_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                           
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Repair Category') }} <label class="color-danger">*</label></label>
                                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                    <select name="repair_cat" class="form-control repair_category form-select" required>
                                        @if (!empty($repairCategoryList))
                                        @foreach ($repairCategoryList as $repairCategoryListData)
                                        <option value="<?php echo $repairCategoryListData->slug; ?>" <?php if ($service->service_category == $repairCategoryListData->slug) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>
                                            {{ $repairCategoryListData->repair_category_name }}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 addremove">
                                    <button type="button" data-bs-target="#responsive-modal-color" data-bs-toggle="modal" class="btn btn-outline-secondary">{{ trans('+') }}</button>
                                </div>
                            </div>
                        </div>

                        <div class="row row-mb-0">
                           
                            <div id="dvCharge"class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback {{ $errors->has('charge') ? ' has-error' : '' }} my-form-group">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 currency" for="last-name">{{ trans('message.Fix Service Charge') }} (<?php echo getCurrencySymbols(); ?>) <label class="color-danger">*</label></label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="text" id="charge_required" name="charge" class="form-control fixServiceCharge" placeholder="{{ trans('message.Enter Fix Service Charge') }}" maxlength="8" value="{{ $service->charge }}">
                                    
                                </div>
                            </div>
                        </div>

<<<<<<< HEAD
                        <div class="row mt-3">
                            <div class="col-md-10 col-lg-10 col-xl-10 col-xxl-10 col-sm-10 col-xs-10 header">
                              <h4><b>{{ trans('message.SALE PART') }}</b>
                              <button type="button" id="add_new_product" class="btn btn-outline-secondary " url="{!! url('sales_part/add/getproductname') !!}" style="margin:5px 0px;">{{ trans('+') }} </button>
                                                                        
                            </h4>
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
                                  <th class="actionre">{{ trans('message.Action') }}</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $row_id = 0; ?>
                                @foreach ($stock as $stocks)
                                <tr id="row_id_<?php echo $row_id; ?>">
                                  <td class="tbl_td_selectManufac_error_<?php echo $row_id; ?>">
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
                                    <input type="hidden" name="product[tr_id][]" value="<?php echo $stocks->id; ?>" class="" form-control" data-id="<?php echo $row_id; ?>" id="<?php echo $row_id; ?>">
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
                                    <input type="text" name="product[price][]" class="product form-control prices price_<?php echo $row_id; ?>" value="{{ number_format($stocks->price,0) }}" autocomplete="off" id="price_<?php echo $row_id; ?>" row_id="<?php echo $row_id; ?>" style="width:100%;" required="true">
            
                                    <span id="price_error_<?php echo $row_id; ?>" class="help-block error-help-block color-danger" style="display: none">{{ trans('message.Price is required.') }}</span>
                                  </td>
                                  <td class="tbl_td_totaPrice_error_<?php echo $row_id; ?>">
                                    <input type="text" name="product[total_price][]" class="product form-control total_price total_price_<?php echo $row_id; ?>" value="{{ number_format($stocks->total_price,0) }}" id="total_price_<?php echo $row_id; ?>" style="width:100%;" readonly="true" required="true">
            
                                    <span id="total_price_error_<?php echo $row_id; ?>" class="help-block error-help-block color-danger" style="display: none">{{ trans('message.Total price is required.') }}</span>
                                  </td>
                                  <td align="center">
                                    <span class="product_delete" data-id="<?php echo $row_id; ?>" pid="<?php echo $stocks->id; ?>" url="{!! url('/sale_part/deleteproduct') !!}"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></span>
                                  </td>
                                </tr>
                                <?php
                                $row_id++; ?>
                                @endforeach
                              </tbody>
                            </table>
                          </div>

=======
>>>>>>> 723c46cc149b3e892bfe937a70101070799b9d16
                        <div class="row row-mb-0">
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('NOTE') }}</label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <textarea name="details" class="form-control details" maxlength="100">{{ $service->detail }}</textarea>
                                </div>
                            </div>

                            <!-- MOt Test Checkbox Start-->
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 motTextLabel" for="">{{ trans('message.MOT Test') }}</label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="checkbox" name="motTestStatusCheckbox" id="motTestStatusCheckbox" <?php if ($service->mot_status == 1) {
                                                                                                                        echo 'checked';
                                                                                                                    } ?> style="height:20px; width:20px; margin-right:5px; position: relative; top: 1px; margin-bottom: 12px;">
                                </div>
                            </div>
                            <!-- MOt Test Checkbox End-->
                        </div>
                        <!-- Wash Bay Feature -->
                        <div class="row row-mb-0">
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 washbayLabel" for="washbay">{{ trans('message.Wash Bay') }} <label class="text-danger"></label></label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 washbayInputDiv">
                                    <input type="checkbox" name="washbay" id="washBay" class="washBayCheckbox" <?php echo $washbayPrice ? 'checked' : ''; ?> style="height:20px; width:20px; margin-right:5px; position: relative; top: 6px; margin-bottom: 12px;">
                                </div>
                            </div>

                            <div id="washBayCharge" class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback {{ $errors->has('washBayCharge') ? ' has-error' : '' }}">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 currency" for="washBayCharge">{{ trans('message.Wash Bay Charge') }} (<?php echo getCurrencySymbols(); ?>)
                                    <label class="text-danger">*</label></label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="text" id="washBayCharge_required" name="washBayCharge" class="form-control washbay_charge_textbox" placeholder="{{ trans('message.Enter Wash Bay Charge') }}" value="<?php echo $washbayPrice ? $washbayPrice : ''; ?>" maxlength="10">

                                    <span id="washbay_error_span" class="help-block error-help-block color-danger" style="display:none"></span>
                                </div>
                            </div>
                        </div>
                        <!-- Wash Bay Feature -->

                        <div class="row row-mb-0" style="margin-top: 15px;">
                            <!-- Tax field start -->
                            @if (!empty($tax))
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="cus_name">{{ trans('message.Tax') }}</label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <table>
                                        <tbody>
                                            <?php $edit_tax = explode(', ', $service->tax_id); ?>
                                            @foreach ($tax as $taxes)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" id="tax" class="checkbox-inline check_tax sele_tax myCheckbox" name="Tax[]" value="<?php
                                                                                                                                                                echo $taxes->id; ?>" taxrate="{{ $taxes->tax }}" taxName="{{ $taxes->taxname }}" style="height:20px; width:20px; margin-right:5px; position: relative; top: 6px; margin-bottom: 12px;" <?php if (in_array($taxes->id, $edit_tax)) {
                                                                                                                                                                                                                                                                echo 'checked';
                                                                                                                                                                                                                                                            } ?>>
                                                    <?php
                                                    echo $taxes->taxname . '&nbsp' . $taxes->tax; ?>%
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endif
                            <!-- New Tax field End-->
                            
                        </div>
                        <!-- ************* MOT Module Starting ************* -->
                        <br /><br />
                        <div class="col-md-12 col-sm-12 col-xs-12 motMainPart" style="display: none">
                            <div class="col-md-9 col-sm-8 col-xs-8">
                                <h3>{{ trans('message.MOT Test') }}</h3>
                            </div>
                        </div>

                        <div class="col-md-12 col-xs-12 col-sm-12 panel-group motMainPart-1" style="display: none">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-bs-toggle="collapse" href="#collapse2" class="observation_Plus2" style="color:#5A738E"><i class=" fa fa-plus"></i>
                                            {{ trans('message.MOT Test View') }}</a>
                                    </h4>
                                </div>
                                <div id="collapse2" class="panel-collapse collapse">
                                    <div class="panel-body">

                                        <!-- Step:1 Starting -->
                                        <div class=" col-md-12 col-xs-12 col-sm-12 panel-group pGroup">
                                            <div class="panel panel-default">
                                                <div class="panel-heading pHeading">
                                                    <h4 class="panel-title">
                                                        <a data-bs-toggle="collapse" href="#collapse3" class="observation_Plus3" style="color:#5A738E"><i class="plus-minus fa fa-plus"></i>
                                                            {{ trans('message.Step 1: Fill MOT Details') }}</a>
                                                    </h4>
                                                </div>
                                                <div id="collapse3" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <div class=" col-md-12 col-xs-12 col-sm-12 panel-group pGroupInsideStep1">

                                                            <div class="row text-center">
                                                                <div class="col-md-3">
                                                                    <h5 class="boldFont">
                                                                        {{ trans('message.OK = Satisfactory') }}
                                                                    </h5>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <h5 class="boldFont">
                                                                        {{ trans('message.X = Safety Item Defact') }}
                                                                    </h5>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <h5 class="boldFont">
                                                                        {{ trans('message.R = Repair Required') }}
                                                                    </h5>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <h5 class="boldFont">
                                                                        {{ trans('message.NA = Not Applicable') }}
                                                                    </h5>
                                                                </div>
                                                            </div>

                                                            <!-- Inside Cab  Starting -->
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading pHeadingInsideStep1">
                                                                    <h4 class="panel-title">
                                                                        <a data-bs-toggle="collapse" href="#collapse5" class="observation_Plus4" style="color:#5A738E"><i class="plus-minus fa fa-plus"></i>
                                                                            {{ trans('message.Inside Cab') }}</a>
                                                                    </h4>
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
                                                                        @if (!empty($mot_inspections_answers))
                                                                        @if ($key % 2 != 1)
                                                                        <?php
                                                                        $a .=
                                                                            "<tr>
                                                                                                                                                                                                                                      																	<td>$inspection_library->code</td>
                                                                                                                                                                                                                                      																	<td>$inspection_library->point</td>
                                                                                                                                                                                                                                      																	<td>
                                                                                                                                                                                                                                      																	<select name=inspection[$inspection_library->id] data-id='$inspection_library->id' class='common'  id='$inspection_library->code'>																		
                                                                                                                                                                                                                                      															    		<option value='ok'" .
                                                                            ($mot_inspections_answers[$inspection_library->code] == 'ok' ? 'selected' : '') .
                                                                            ">OK</option>
                                                                                                                                                                                                                                      															    		<option value='x'" .
                                                                            ($mot_inspections_answers[$inspection_library->code] == 'x' ? 'selected' : '') .
                                                                            ">X</option>
                                                                                                                                                                                                                                      															    		<option value='r'" .
                                                                            ($mot_inspections_answers[$inspection_library->code] == 'r' ? 'selected' : '') .
                                                                            ">R</option>
                                                                                                                                                                                                                                      															    		<option value='na'" .
                                                                            ($mot_inspections_answers[$inspection_library->code] == 'na' ? 'selected' : '') .
                                                                            ">NA</option>
                                                                                                                                                                                                                                      															  		</select>
                                                                                                                                                                                                                                      															  		</td></tr>";
                                                                        ?>
                                                                        @else
                                                                        <?php
                                                                        $b .=
                                                                            "<tr>
                                                                                                                                                                                                                                      																	<td>$inspection_library->code</td>
                                                                                                                                                                                                                                      																	<td>$inspection_library->point</td>
                                                                                                                                                                                                                                      																	<td>
                                                                                                                                                                                                                                      																	<select name=inspection[$inspection_library->id] data-id='$inspection_library->id' class='common' id='$inspection_library->code'>
                                                                                                                                                                                                                                      															    	<option value='ok'" .
                                                                            ($mot_inspections_answers[$inspection_library->code] == 'ok' ? 'selected' : '') .
                                                                            ">OK</option>
                                                                                                                                                                                                                                      															    		<option value='x'" .
                                                                            ($mot_inspections_answers[$inspection_library->code] == 'x' ? 'selected' : '') .
                                                                            ">X</option>
                                                                                                                                                                                                                                      															    		<option value='r'" .
                                                                            ($mot_inspections_answers[$inspection_library->code] == 'r' ? 'selected' : '') .
                                                                            ">R</option>
                                                                                                                                                                                                                                      															    		<option value='na'" .
                                                                            ($mot_inspections_answers[$inspection_library->code] == 'na' ? 'selected' : '') .
                                                                            ">NA</option>
                                                                                                                                                                                                                                      															  		</select>
                                                                                                                                                                                                                                      															  		</td>
                                                                                                                                                                                                                                      															  		</tr>";
                                                                        ?>
                                                                        @endif
                                                                        @else
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
                                                                        @endif
                                                                        @endforeach

                                                                        <div class="row">
                                                                            <div class="col-md-6">
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
                                                                            <div class="col-md-6">
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
                                                                    <h4 class="panel-title">
                                                                        <a data-bs-toggle="collapse" href="#collapse6" class="observation_Plus4" style="color:#5A738E"><i class="plus-minus fa fa-plus"></i>
                                                                            {{ trans('message.Ground Level and Under Vehicle') }}</a>
                                                                    </h4>
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
                                                                        @if (!empty($mot_inspections_answers))
                                                                        @if ($key % 2 != 0)
                                                                        <?php
                                                                        $a .=
                                                                            "<tr>
                                                                                                                                                                                                                                      																	<td>$inspection_library->code</td>
                                                                                                                                                                                                                                      																	<td>$inspection_library->point</td>
                                                                                                                                                                                                                                      																	<td>
                                                                                                                                                                                                                                      																	<select name=inspection[$inspection_library->id] data-id='$inspection_library->id' class='common'  id='$inspection_library->code'>
                                                                                                                                                                                                                                      															    		<option value='ok'" .
                                                                            ($mot_inspections_answers[$inspection_library->code] == 'ok' ? 'selected' : '') .
                                                                            ">OK</option>
                                                                                                                                                                                                                                      															    		<option value='x'" .
                                                                            ($mot_inspections_answers[$inspection_library->code] == 'x' ? 'selected' : '') .
                                                                            ">X</option>
                                                                                                                                                                                                                                      															    		<option value='r'" .
                                                                            ($mot_inspections_answers[$inspection_library->code] == 'r' ? 'selected' : '') .
                                                                            ">R</option>
                                                                                                                                                                                                                                      															    		<option value='na'" .
                                                                            ($mot_inspections_answers[$inspection_library->code] == 'na' ? 'selected' : '') .
                                                                            ">NA</option>
                                                                                                                                                                                                                                      															  		</select>
                                                                                                                                                                                                                                      															  		</td></tr>";
                                                                        ?>
                                                                        @else
                                                                        <?php
                                                                        $b .=
                                                                            "<tr>
                                                                                                                                                                                                                                      																	<td>$inspection_library->code</td>
                                                                                                                                                                                                                                      																	<td>$inspection_library->point</td>
                                                                                                                                                                                                                                      																	<td>
                                                                                                                                                                                                                                      																	<select name=inspection[$inspection_library->id] data-id='$inspection_library->id' class='common'  id='$inspection_library->code'>
                                                                                                                                                                                                                                      															    	<option value='ok'" .
                                                                            ($mot_inspections_answers[$inspection_library->code] == 'ok' ? 'selected' : '') .
                                                                            ">OK</option>
                                                                                                                                                                                                                                      															    		<option value='x'" .
                                                                            ($mot_inspections_answers[$inspection_library->code] == 'x' ? 'selected' : '') .
                                                                            ">X</option>
                                                                                                                                                                                                                                      															    		<option value='r'" .
                                                                            ($mot_inspections_answers[$inspection_library->code] == 'r' ? 'selected' : '') .
                                                                            ">R</option>
                                                                                                                                                                                                                                      															    		<option value='na'" .
                                                                            ($mot_inspections_answers[$inspection_library->code] == 'na' ? 'selected' : '') .
                                                                            ">NA</option>
                                                                                                                                                                                                                                      															  		</select>
                                                                                                                                                                                                                                      															  		</td>
                                                                                                                                                                                                                                      															  		</tr>";
                                                                        ?>
                                                                        @endif
                                                                        @else
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
                                                                        @endif
                                                                        @endforeach

                                                                        <div class="row">
                                                                            <div class="col-md-6">
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
                                                                            <div class="col-md-6">
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
                                                    <h4 class="panel-title">
                                                        <a data-bs-toggle="collapse" href="#collapse4" class="observation_Plus5" style="color:#5A738E"><i class="plus-minus fa fa-plus"></i>
                                                            {{ trans('message.Step 2: Show Filled MOT Details') }}</a>
                                                    </h4>
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
                                                            @if (!empty($mot_inspections_answers))
                                                            @foreach ($inspection_points_library_data as $key => $value)
                                                            <thead>
                                                                @if ($mot_inspections_answers[$value->code] == 'x' || $mot_inspections_answers[$value->code] == 'r')
                                                                <tr style="" id="tr_{{ $value->id }}">
                                                                    <td id="">
                                                                        {{ $value->id }}
                                                                    </td>
                                                                    <td id="">
                                                                        {{ $value->point }}
                                                                    </td>
                                                                    <td id="row_{{ $value->id }}" class="text-uppercase">
                                                                        {{ $mot_inspections_answers[$value->code] }}
                                                                    </td>
                                                                </tr>
                                                                @else
                                                                <tr style="display: none;" id="tr_{{ $value->id }}">
                                                                    <td id="">
                                                                        {{ $value->id }}
                                                                    </td>
                                                                    <td id="">
                                                                        {{ $value->point }}
                                                                    </td>
                                                                    <td id="row_{{ $value->id }}" class="text-uppercase"> </td>
                                                                </tr>
                                                                @endif
                                                            </thead>
                                                            @endforeach
                                                            @else
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
                                                            @endif
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

                        <!-- ************* MOT Module Ending ************* -->

                        <!-- Custom Filed data value -->
                        @if (!empty($tbl_custom_fields))
                        <div class="col-md-12 col-xs-12 col-sm-12 space">
                            <h4><b>{{ trans('message.Custom Fields') }}</b></h4>
                            <p class="col-md-12 col-xs-12 col-sm-12 ln_solid"></p>
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
                        $userid = $service->id;
                        $datavalue = getCustomDataService($tbl_custom, $userid);

                        $subDivCount++;
                        ?>
                        @if ($myCounts % 2 == 0)
                        <div class="col-md-12 col-sm-6 col-xs-12">
                            @endif
                            <div class="form-group col-md-6  col-sm-6 col-xs-12 error_customfield_main_div_{{ $myCounts }}">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account-no">{{ $tbl_custom_field->label }} <label class="color-danger">{{ $red }}</label></label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
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
                                        <label><input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}]" value="{{ $k }}" <?php
                                                                                                                                                        //$formName = "product";
                                                                                                                                                        $getRadioValue = getRadioLabelValueForUpdateForAllModules($tbl_custom_field->form_name, $service->id, $tbl_custom_field->id);

                                                                                                                                                        if ($k == $getRadioValue) {
                                                                                                                                                            echo 'checked';
                                                                                                                                                        } ?>>
                                            {{ $val }}<label> &nbsp;
                                                @endforeach
                                    </div>
                                    @endif
                                    @elseif($tbl_custom_field->type == 'checkbox')
                                    <?php
                                    $checkboxLabelArrayList = getCheckboxLabelsList($tbl_custom_field->id);
                                    ?>
                                    @if (!empty($checkboxLabelArrayList))
                                    <?php
                                    $getCheckboxValue = getCheckboxLabelValueForUpdateForAllModules($tbl_custom_field->form_name, $service->id, $tbl_custom_field->id);
                                    ?>
                                    <div class="required_checkbox_parent_div_{{ $tbl_custom_field->id }}" style="margin-top: 5px;">
                                        @foreach ($checkboxLabelArrayList as $k => $val)
                                        <label><input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}][]" value="{{ $val }}" isRequire="{{ $required }}" fieldNameIs="{{ $tbl_custom_field->label }}" custm_isd="{{ $tbl_custom_field->id }}" class="checkbox_{{ $tbl_custom_field->id }} required_checkbox_{{ $tbl_custom_field->id }} checkbox_simple_class common_value_is_{{ $myCounts }} common_simple_class" rows_id="{{ $myCounts }}" <?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                                            if ($val == getCheckboxValForAllModule($tbl_custom_field->form_name, $service->id, $tbl_custom_field->id, $val)) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo 'checked';
                                                                                                                                                                                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                            ?>>
                                            {{ $val }}<label> &nbsp;
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
                                <!-- <button type="submit" class="btn btn-success updateQuotationButton">{{ trans('message.UPDATE') }}</button> -->
                                <a href="{{ url('quotation/list/modify/' . $service->id) }}" class="btn btn-success">{{ trans('message.Save and continue') }}</button></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Repair Add or Remove Model Start-->
    <div class="col-md-6">
        <div id="responsive-modal-color" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- <h4 class="modal-title fw-bold">{{ getNameSystem() }} </h4> -->
                        <h4 class="modal-title">{{ trans('message.Add Repair Category') }}</h4>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" action="" method="">
                        <div class="row">
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 form-group data_popup">
                                    <!-- <label>{{ trans('message.Repair Category Name') }}: <span class="text-danger">*</span></label> -->
                                    <input type="text" class="form-control model_input repair_category_name" name="repair_category_name" placeholder="{{ trans('message.Enter repair category name') }}" maxlength="20" />
                                </div>
                                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 form-group data_popup">
                                    <button type="button" class="btn btn-success model_submit addcolor" colorurl="{!! url('/addRepairCategory') !!}">{{ trans('message.Submit') }}</button>
                                </div>
                            </div>
                            <table class="table colornametype" align="center">
                                
                                <tbody>
                                    @foreach ($repairCategoryList as $repairCategory)
                                    <tr class="del-{{ $repairCategory->slug }} data_color_name row mx-1">
                                        <td class="text-start col-6">{{ $repairCategory->repair_category_name }}</td>
                                        <td class="text-end col-6">
                                            @if ($repairCategory->added_by_system !== 1)
                                            <button type="button" id="{{ $repairCategory->slug }}" deletecolor="{!! url('deleteRepairCategory') !!}" class="btn btn-danger text-white border-0 deletecolors"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            @else
                                            {{ trans('message.Added by system') }}
                                            @endif

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
    <!-- Repair Add or Remove Model End-->

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    var msg35 = "{{ trans('message.OK') }}";
    $(document).ready(function() {
        /*Datetime picker*/

        $('.datepicker').datetimepicker({
            format: "<?php echo getDateTimepicker(); ?>",
            todayBtn: true,
            autoclose: 1,
            startDate: new Date(),
            language: "{{ getLangCode() }}",
        });

        /*Service type free and paid*/
        $(function() {
            $("input[name='service_type']").html(function() {
                if ($("#paid").is(":checked")) {
                    $("#dvCharge").show();
                    $("#charge_required").attr('required', true);
                } else {
                    $("#dvCharge").hide();
                    $("#charge_required").removeAttr('required', false);
                }
            });

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

        // Initialize select2
        $(".select_customer_auto_search").select2();

        /*If date field have value then error msg and has error class remove*/
        $('body').on('change', '#p_date', function() {

            var pDateValue = $(this).val();

            if (pDateValue != null) {
                $('#p_date-error').css({
                    "display": "none"
                });
            }

            if (pDateValue != null) {
                $(this).parent().parent().removeClass('has-error');
            }
        });


        /*If select box have value then error msg and has error class remove*/
        $('#sup_id').on('change', function() {

            var supplierValue = $('select[name=Customername]').val();

            if (supplierValue != null) {
                $('#sup_id-error').css({
                    "display": "none"
                });
            }

            if (supplierValue != null) {
                $(this).parent().parent().removeClass('has-error');
            }
        });


        /*MOT main Accordian fade in out*/
        var i = 0;
        $('.observation_Plus2').click(function() {
            i = i + 1;
            if (i % 2 != 0) {
                $(this).parent().find(".fa-plus:first").removeClass("fa-plus").addClass(
                    "fa-minus");

            } else {
                $(this).parent().find(".fa-minus:first").removeClass("fa-minus").addClass(
                    "fa-plus");
            }
        });
        var j = 0;
        $('.observation_Plus3').click(function() {
            j = j + 1;
            if (j % 2 != 0) {
                $(this).parent().find(".fa-plus:first").removeClass("fa-plus").addClass(
                    "fa-minus");

            } else {
                $(this).parent().find(".fa-minus:first").removeClass("fa-minus").addClass(
                    "fa-plus");
            }
        });
        var k = 0;
        $('.observation_Plus4').click(function() {
            k = k + 1;
            if (k % 2 != 0) {
                $(this).parent().find(".fa-plus:first").removeClass("fa-plus").addClass(
                    "fa-minus");

            } else {
                $(this).parent().find(".fa-minus:first").removeClass("fa-minus").addClass(
                    "fa-plus");
            }
        });
        var l = 0;
        $('.observation_Plus5').click(function() {
            l = l + 1;
            if (l % 2 != 0) {
                $(this).parent().find(".fa-plus:first").removeClass("fa-plus").addClass(
                    "fa-minus");

            } else {
                $(this).parent().find(".fa-minus:first").removeClass("fa-minus").addClass(
                    "fa-plus");
            }
        });
        var m = 0;
        $('.observation_Plus4').click(function() {
            m = m + 1;
            if (m % 2 != 0) {
                $(this).parent().find(".fa-plus:first").removeClass("fa-plus").addClass(
                    "fa-minus");

            } else {
                $(this).parent().find(".fa-minus:first").removeClass("fa-minus").addClass(
                    "fa-plus");
            }
        });

        /*This for Step:1 and Step:1 Accordion of MoT View*/
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

        /*This for InsideCab and GroundLevelUnderVehicle Accordion*/
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

        /*If MOT check box is checked then show all MOT details otherwise not*/

        if ($('input[name="motTestStatusCheckbox"]').is(':checked')) {
            $('.motMainPart').css({
                "display": ""
            });
            $('.motMainPart-1').css({
                "display": ""
            });
        } else {
            $('.motMainPart').css({
                "display": "none"
            });
            $('.motMainPart-1').css({
                "display": "none"
            });
        }


        $('body').on('click', '#motTestStatusCheckbox', function() {

            if ($('input[name="motTestStatusCheckbox"]').is(':checked')) {
                $('.motMainPart').css({
                    "display": ""
                });
                $('.motMainPart-1').css({
                    "display": ""
                });
            } else {
                $('.motMainPart').css({
                    "display": "none"
                });
                $('.motMainPart-1').css({
                    "display": "none"
                });
            }
        });


        /*For display data from 'InsideCab  And Ground Level Under Vehicle' accordion to Step:2 Accordion*/
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

        /*Inside fix service text box only enter numbers data*/
        $('.fixServiceCharge').on('keyup', function() {

            var valueIs = $(this).val();

            if (/\D/g.test(valueIs)) {
                $(this).val("");
            } else if (valueIs == 0) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '.titalQuotation', function() {

            var titalQuotation = $(this).val();

            if (!titalQuotation.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '.details', function() {

            var details = $(this).val();

            if (!details.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        /*Custom Field manually validation*/
        var msg31 = "{{ trans('message.field is required') }}";
        var msg32 = "{{ trans('message.Only blank space not allowed') }}";
        var msg33 = "{{ trans('message.Special symbols are not allowed.') }}";
        var msg34 = "{{ trans('message.At first position only alphabets are allowed.') }}";

        /*Form submit time check validation for Custom Fields */
        $('body').on('click', '.updateQuotationButton', function(e) {
            $('#QuotationEdit-Form input, #QuotationEdit-Form select, #QuotationEdit-Form textarea')
                .each(
                    function(index) {
                        var input = $(this);
                        if (input.attr('name') == "Customername" || input.attr('name') ==
                            "vehicalname" || input.attr(
                                'name') == "date" || input.attr('name') == "repair_cat" || input.attr(
                                'name') ==
                            "service_type") {
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
                                } else if (!input.val().match(
                                        /^[a-zA-Z\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F][a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s\.\-\_]*$/
                                    )) {
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

            /*if washbay checkbox is checked then washbay charge textbox is required*/
            var washbay_trans = "{{ trans('message.Wash Bay Charge') }}";
            var washbay_value = $('#washBayCharge_required').val();

            if ($(".washBayCheckbox").is(':checked') == true) {
                if (washbay_value == "") {
                    //alert("is checked true : ");
                    $('#washBayCharge').addClass('has-error');
                    $('#washbay_error_span').text(washbay_trans + " " + msg31);
                    $('#washbay_error_span').css({
                        "display": ""
                    });
                    e.preventDefault();
                }
            }
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
                    } else if (!valueIs.match(
                            /^[a-zA-Z\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F][a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s\.\-\_]*$/
                        )) {
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
                        } else if (!valueIs.match(
                                /^[a-zA-Z\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F][a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s\.\-\_]*$/
                            )) {
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

        /*Wash-bay service charge textbox*/
        var isCheckWashbay = $(".washBayCheckbox").is(':checked');

        if (isCheckWashbay == true) {
            $("#washBayCharge").show();
            $("#washBayCharge_required").attr('required', true);
        } else {
            $("#washBayCharge").hide();
            $("#washBayCharge_required").removeAttr('required', false);
        }

        $('.washBayCheckbox').click(function() {

            if ($("#washBay").is(":checked")) {
                $("#washBayCharge").show();
                $("#washBayCharge_required").attr('required', true);
            } else {
                $("#washBayCharge").hide();
                $("#washBayCharge_required").removeAttr('required', false);
            }
        });

        $('body').on('keyup', '.washbay_charge_textbox', function() {

            var washbayVal = $(this).val();
            var numericDataWashbayMsg = "{{ trans('message.Only numeric data allowed.') }}";
            var washbay_trans = "{{ trans('message.Wash Bay Charge') }}";

            if (washbayVal != "") {
                if (!washbayVal.match(/^[1-9][0-9]*$/)) {
                    $(this).val("");
                    $('#washbay_error_span').text(numericDataWashbayMsg);
                    $('#washbay_error_span').css({
                        "display": ""
                    });
                    $('#washBayCharge').addClass('has-error');
                } else {
                    $('#washbay_error_span').css({
                        "display": "none"
                    });
                    $('#washBayCharge').removeClass('has-error');
                }
            } else {
                $('#washBayCharge').addClass('has-error');
                $('#washbay_error_span').text(washbay_trans + " " + msg31);
                $('#washbay_error_span').css({
                    "display": ""
                });
            }
        });

        // added by arjun for color module dynamic add item and reove item

        var msg51 = "{{ trans('message.Please enter only alphanumeric data') }}";
        var msg52 = "{{ trans('message.Only blank space not allowed') }}";
        var msg53 = "{{ trans('message.This Record is Duplicate') }}";
        var msg54 = "{{ trans('message.An error occurred :') }}";

        /*color add  model*/
        $('.addcolor').click(function() {
            var repair_category_name = $('.repair_category_name').val();
            var url = $(this).attr('colorurl');

            var msg55 = "{{ trans('message.Please enter repair category name') }}";

            function define_variable() {
                return {
                    addcolor_value: $('.repair_category_name').val(),
                    addcolor_pattern: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]+$/,
                    addcolor_pattern2: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]*$/
                };
            }

            var call_var_addcoloradd = define_variable();

            if (repair_category_name == "") {
                swal({
                    title: msg55,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });
            // } else if (!call_var_addcoloradd.addcolor_pattern.test(call_var_addcoloradd
            //         .addcolor_value)) {
            //     $('.repair_category_name').val("");
            //     swal({
            //         title: msg51,
            //         cancelButtonColor: '#C1C1C1',
            //         buttons: {
            //             cancel: msg35,
            //         },
            //         dangerMode: true,
            //     });
            } else if (!repair_category_name.replace(/\s/g, '').length) {
                $('.repair_category_name').val("");
                swal({
                    title: msg52,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });
            // } else if (!call_var_addcoloradd.addcolor_pattern2.test(call_var_addcoloradd
            //         .addcolor_value)) {
            //     $('.repair_category_name').val("");
            //     swal({
            //         title: msg34,
            //         cancelButtonColor: '#C1C1C1',
            //         buttons: {
            //             cancel: msg35,
            //         },
            //         dangerMode: true,
            //     });
            } else {
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {
                        repair_category_name: repair_category_name
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
                            $('.colornametype').append('<tr class=" row mx-1 ' + classname +
                                ' data_color_name"><td class="text-start">' +
                                repair_category_name +
                                '</td><td class="text-end"><button type="button" id=' +
                                data +
                                ' deletecolor="{!! url('deleteRepairCategory') !!}" class="btn btn-danger text-white border-0 deletecolors"><i class="fa fa-trash" aria-hidden="true"></i></button></a></td><tr>'
                            );

                            $('.repair_category').append('<option value=' + data + '>' +
                                repair_category_name +
                                '</option>');

                            $('.repair_category_name').val('');
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


        var msg101 = "{{ trans('message.Are You Sure?') }}";
        var msg102 = "{{ trans('message.You will not be able to recover this data afterwards!') }}";
        var msg103 = "{{ trans('message.Cancel') }}";
        var msg104 = "{{ trans('message.Yes, delete!') }}";
        var msg105 = "{{ trans('message.Done!') }}";
        var msg106 = "{{ trans('message.It was succesfully deleted!') }}";
        var msg107 = "{{ trans('message.Cancelled') }}";
        var msg108 = "{{ trans('message.Your data is safe') }}";
        var rcategorydelete = "{{ trans('message.Repair Category Deleted Successfully') }}";

        /*color Delete  model*/
        $('body').on('click', '.deletecolors', function() {
            var colorid = $(this).attr('id');
            var url = $(this).attr('deletecolor');

            swal({
                title: msg101,
                text: msg102,
                icon: "warning",
                buttons: [msg103, msg104],
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
                            $(".repair_category option[value=" + colorid + "]")
                                .remove();
                            swal({
                                title: msg105,
                                text: rcategorydelete,
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
                        title: msg107,
                        text: msg108,
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

    });
</script>
<<<<<<< HEAD
<script>
    $(document).ready(function() {
  
      $(function() {
        $('#vehi_bra_name').change(function() {
  
          var vehicale_id = $(this).val();
          var url = $(this).attr('bran_url');
          var qty = $('#qty').val();
          var msg11 = "{{ trans('message.An error occurred :') }}";
  
          $.ajax({
            type: 'GET',
            url: url,
            data: {
              vehicale_id: vehicale_id
            },
  
            success: function(response) {
              var price_dta = $('#price').val(response.price);
              if (response.qty == "not available") {
                $('#qty').attr('max', 0);
              } else {
                $('#qty').attr('max', response.qty);
              }
              var total_price = response.price * qty;
  
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
  
  
      $('body').on('click', '#qty', function() {
  
        var qty = $(this).val();
        var price = $('#price').val();
        var url = $(this).attr('url');
  
        var msg13 = "{{ trans('message.An error occurred :') }}";
        $.ajax({
          type: 'GET',
          url: url,
          data: {
            qty: qty,
            price: price
          },
          success: function(response) {
            total_price = price * qty;
            $('#total_price').val(total_price);
          },
          beforeSend: function() {
  
          },
          error: function(e) {
            alert(msg13 + " " + e.responseText);
            console.log(e);
          }
        });
      });
  
  
  
      $("#no_of_service").change(function() {
  
        var interval = $("#interval").val();
        var date_gape = $("#date_gape").val();
        var no_service = $("#no_of_service").val();
        var url = $(this).attr('url');
        var msg14 = "{{ trans('message.An error occurred :') }}";
        var msg31 = "{{ trans('message.Interval') }}";
        var msg32 = "{{ trans('message.Please select interval!') }}";
  
        if (interval != '' || date_gape != '' || no_service != '') {
          if ($("#interval").val() == '') {
            swal({
              title: msg31,
              text: msg32,
              icon: 'warning',
              cancelButtonColor: '#C1C1C1',
              buttons: {
                cancel: msg10,
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
                alert(msg14 + " " + e.responseText);
                console.log(e);
              },
              beforeSend: function() {
                $("#load_service_data").html("<center><h3>Loading...</h3></center>");
              }
            });
          }
        }
      });
  
  
      /*color add  model*/
      $('.addcolor').click(function() {
  
        var c_name = $('.c_name').val();
        var url = $(this).attr('colorurl');
        var msg15 = "{{ trans('message.An error occurred :') }}";
        var msg34 = "{{ trans('message.Please enter color name') }}";
        var msg35 = "{{ trans('message.This Record is Duplicate') }}";
  
        if (c_name == "") {
          swal({
            title: msg34,
            cancelButtonColor: '#C1C1C1',
            buttons: {
              cancel: msg10,
            },
            dangerMode: true,
          });
        } else {
          $.ajax({
            type: 'GET',
            url: url,
            data: {
              c_name: c_name
            },
            success: function(data) {
              var newd = $.trim(data);
              var classname = 'del-' + newd;
              if (data == '01') {
                swal({
                  title: msg35,
                  cancelButtonColor: '#C1C1C1',
                  buttons: {
                    cancel: msg10,
                  },
                  dangerMode: true,
                });
              } else {
                $('.colornametype').append('<tr class="' + classname +
                  ' data_color_name"><td class="text-center">' + c_name +
                  '</td><td class="text-center"><button type="button" colorid=' + data +
                  ' deletecolor="{!! url('sales/colortypedelete') !!}" class="btn btn-danger btn-xs colordelete">X</button></a></td><tr>'
                );
                $('.color_name_data').append('<option value=' + data + '>' + c_name + '</option>');
                $('.c_name').val('');
              }
            },
            error: function(e) {
              alert(msg15 + " " + e.responseText);
              console.log(e);
            }
          });
        }
      });
  
  
      /*color Delete  model*/
      $('body').on('click', '.colordelete', function() {
  
        var colorid = $(this).attr('colorid');
        var url = $(this).attr('deletecolor');
  
        var msg1 = "{{ trans('message.Are You Sure?') }}";
        var msg2 = "{{ trans('message.You will not be able to recover this data afterwards!') }}";
        var msg3 = "{{ trans('message.Cancel') }}";
        var msg4 = "{{ trans('message.Yes, delete!') }}";
        var msg5 = "{{ trans('message.Done!') }}";
        var msg6 = "{{ trans('message.It was succesfully deleted!') }}";
        var msg7 = "{{ trans('message.Cancelled') }}";
        var msg8 = "{{ trans('message.Your data is safe') }}";
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
                  text: msg6,
                  icon: 'success',
                  cancelButtonColor: '#C1C1C1',
                  buttons: {
                    cancel: msg10,
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
                cancel: msg10,
              },
              dangerMode: true,
            });
          }
        })
  
      });
  
      $(function() {
        $('#supplier_select').change(function() {
  
          var supplier_id = $(this).val();
          var url = $(this).attr('url');
          var msg46 = "{{ trans('message.An error occurred :') }}";
  
          $.ajax({
            type: 'GET',
            url: url,
            data: {
              supplier_id: supplier_id
            },
            success: function(response) {
              var res_supplier = jQuery.parseJSON(response);
              $('#mobile').attr('value', res_supplier.mobile_no);
              $('#email').attr('value', res_supplier.email);
              $('#address').text(res_supplier.address);
            },
            beforeSend: function() {
              $('#mobile').attr('value', 'Loading..');
              $('#email').attr('value', 'Loading..');
              $('#address').attr('value', 'Loading..');
            },
            error: function(e) {
              alert(msg46 + " " + e.responseText);
              console.log(e);
            }
          });
        });
      });
  
  
  
      $("#add_new_product").click(function() {
  
        var row_id = $("#tab_taxes_detail > tbody > tr").length;
        var url = $(this).attr('url');
        var msg47 = "{{ trans('message.An error occurred :') }}";
  
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
            $("#tab_taxes_detail > tbody").append(response.html);
            $("#add_new_product").prop('disabled', false);
            return false;
          },
          error: function(e) {
            alert(msg47 + " " + e.responseText);
            console.log(e);
          }
        });
      });
  
  
  
      $('body').on('click', '.product_delete', function() {
  
        var procuctid = $(this).attr('pid');
        var row_id = $(this).attr('data-id');
        var url = $(this).attr('url');
        var msg48 = "{{ trans('message.An error occurred :') }}";
  
        $.ajax({
          type: 'GET',
          url: url,
          data: {
            procuctid: procuctid
          },
          success: function(response) {
            $('table#tab_taxes_detail tr#row_id_' + row_id).remove();
          },
          error: function(e) {
            alert(msg48 + " " + e.responseText);
            console.log(e);
          }
        });
      });
  
  
  
      $('body').on('change', '.productid', '.qty', function() {
  
        var row_id = $(this).attr('row_did');
        var p_id = $(this).val();
        var qty = $('.qty_' + row_id).val();
        var price = $('.price_' + row_id).val();
        var url = $(this).attr('url');
        var msg49 = "{{ trans('message.An error occurred :') }}";
  
        $.ajax({
          type: 'GET',
          url: url,
          data: {
            p_id: p_id
          },
          success: function(response) {
            var json_obj = jQuery.parseJSON(response);
            var price = json_obj['price'];
            var total_price = price * qty;
            $('.price_' + row_id).val(price);
            $('.total_price_' + row_id).val(total_price);
            var product_no = json_obj['product_no'];
            $('.qty_' + row_id).html(product_no);
          },
          error: function(e) {
            alert(msg49 + " " + e.responseText);
            console.log(e);
          }
        });
      });
  
  
  
      $('body').on('keyup', '.qty', function() {
  
        var row_id = $(this).attr('row_id');
        var p_id = $('.select_productname_' + row_id).val();
        var qtyVal = $('.qty_' + row_id).val();
  
        var msg18 = "{{ trans('message.An error occurred :') }}";
        var msg20 = "{{ trans('message.First select product name') }}";
  
        if (p_id == '') {
          alert(msg20);
          $('.qty_' + row_id).val('');
        } else {
          if (/\D/g.test(this.value)) {
            $('.qty_' + row_id).val('');
  
            $('#quantity_error_' + row_id).css({
              "display": ""
            });
            $('.tbl_td_quantity_error_' + row_id).addClass('has-error');
          } else if (this.value <= 0) {
            $('.qty_' + row_id).val('');
  
            $('#quantity_error_' + row_id).css({
              "display": ""
            });
            $('.tbl_td_quantity_error_' + row_id).addClass('has-error');
          } else {
            var qty = $('.qty_' + row_id).val();
            var price = $('.price_' + row_id).val();
            var url = $(this).attr('url');
  
            $('#quantity_error_' + row_id).css({
              "display": "none"
            });
            $('.tbl_td_quantity_error_' + row_id).removeClass('has-error');
  
            $.ajax({
              type: 'GET',
              url: url,
              data: {
                qty: qty,
                price: price
              },
              success: function(response) {
                total_price = price * qty;
                $('.total_price_' + row_id).val(total_price);
              },
              beforeSend: function() {},
              error: function(e) {
                alert(msg18 + " " + e.responseText);
                console.log(e);
              }
            });
          }
        }
      });
      //Initialize select2
      $("#customer_select_box").select2();
  
  
      /*Get product name when changing manufacturer name*/
      $('body').on('change', '.select_producttype', function() {
  
        var row_id = $(this).attr('row_did');
        var m_id = $(this).val();
        var url = $(this).attr('m_url');
        //alert(url);
        $.ajax({
          type: 'GET',
          url: url,
          data: {
            m_id: m_id
          },
          success: function(response) {
            $('.select_productname_' + row_id).html(response);
          }
        });
      });
  
  
  
      $('body').on('blur', '.qty', function() {
  
        var row_id = $(this).attr('row_id');
        var productid = $('.select_productname_' + row_id).find(":selected").val();
        var qty = $(this).val();
        var url = $(this).attr('prd_url');
  
        var msg21 = "{{ trans('message.Product Not Available') }}";
        var msg22 = "{{ trans('message.Current Stock :') }}";
  
        $.ajax({
          type: 'GET',
          url: url,
          data: {
            qty: qty,
            productid: productid
          },
          success: function(response) {
            //var newd = $.trim(response);
            if (response.success == '1') {
              //swal('No Product Available');
              swal({
                title: msg21 + '\n' + msg22 + ' ' + response.currentStock,
                cancelButtonColor: '#C1C1C1',
                buttons: {
                  cancel: msg10,
                },
                dangerMode: true,
              });
              jQuery('.qty_' + row_id).val('');
              jQuery('.total_price_' + row_id).val('');
            }
          },
        });
      });
  
  
  
      $('body').on('click', '.productid', function() {
        var rowId = $(this).attr('row_did');
        var url = $(this).attr('url');
        var manufacture_selected = $('.select_producttype_' + rowId).val();
  
        var msg25 = "{{ trans('message.First Select Manufacturer') }}";
  
        if (manufacture_selected == "") {
          swal({
            title: msg25,
            showCancelButton: false,
            cancelButtonColor: "#C1C1C1",
            confirmButtonColor: "#297FCA",
            confirmButtonText: msg10,
            closeOnConfirm: false
          });
        }
      });
  
  
      /*datetimepicker*/
      $('.datepicker').datetimepicker({
        format: "<?php echo getDatepicker(); ?>",
        todayBtn: true,
        autoclose: 1,
        minView: 2,
        startDate: new Date(),
        language: "{{ getLangCode() }}",
      });
  
  
  
      /*Price field should editable and editable price should change the Total-Amount (on-time editable price )*/
      $('body').on('change', '.prices', function() {
  
        var row_id = $(this).attr('row_id');
        var qty = $('.qty_' + row_id).val();
        var price = $('.price_' + row_id).val();
        var total_price = price * qty;
  
        var regex = /^\d*(.\d{2})?$/;
  
        if (!regex.test(price)) {
          $('.price_' + row_id).val("");
          $('.price_' + row_id).attr('required', true);
  
          $('#price_error_' + row_id).css({
            "display": ""
          });
          $('.tbl_td_price_error_' + row_id).addClass('has-error');
        } else if (price == 0 || price == null) {
          $('.price_' + row_id).val("");
          $('.price_' + row_id).attr('required', true);
  
          $('#price_error_' + row_id).css({
            "display": ""
          });
          $('.tbl_td_price_error_' + row_id).addClass('has-error');
        } else {
          $('.price_' + row_id).val(price);
          $('.total_price_' + row_id).val(total_price);
  
          $('#price_error_' + row_id).css({
            "display": "none"
          });
          $('.tbl_td_price_error_' + row_id).removeClass('has-error');
        }
      });
  
  
      /*Form submit time specific field value changes time make validation using Jquery*/
      var msg1 = "{{ trans('message.field is required') }}";
      var msg2 = "{{ trans('message.Only blank space not allowed') }}";
      var msg3 = "{{ trans('message.Special symbols are not allowed.') }}";
      var msg4 = "{{ trans('message.At first position only alphabets are allowed.') }}";
  
      $('.salesPartEditSubmitButton').click(function(e) {
  
        var bill_no = $('#bill_no').val();
        var date = $('.dateValue').val();
        var selectCustomer = $('#customer_select_box').val();
        var salesmanname = $('#salesmanname').val();
  
        var count_row = $("#tab_taxes_detail > tbody > tr").length;
  
        if (bill_no == "") {
          $('#bill_no-error').css({
            "display": ""
          });
          $('.div_bill_no_error').addClass('has-error');
        } else {
          $('#bill_no-error').css({
            "display": "none"
          });
          $('.div_bill_no_error').removeClass('has-error');
        }
  
        if (date == "") {
          $('#salesDate-error').css({
            "display": ""
          });
          $('.div_date_error').addClass('has-error');
        } else {
          $('#salesDate-error').css({
            "display": "none"
          });
          $('.div_date_error').removeClass('has-error');
        }
  
        if (selectCustomer == "") {
          $('#customer_select_box-error').css({
            "display": ""
          });
          $('.div_customer_select_error').addClass('has-error');
          $('.select2-selection--single').addClass('has-error');
        } else {
          $('#customer_select_box-error').css({
            "display": "none"
          });
          $('.div_customer_select_error').removeClass('has-error');
        }
  
        if (salesmanname == "") {
          $('#salesmanname-error').css({
            "display": ""
          });
          $('.div_salesmanname_error').addClass('has-error');
        } else {
          $('#salesmanname-error').css({
            "display": "none"
          });
          $('.div_salesmanname_error').removeClass('has-error');
        }
  
  
        /*Table data validation*/
        for (var i = 1; i <= count_row; i++) {
  
          var selectPrd = $('.select_producttype_' + i).val();
          var selectPrdQty = $('.qty_' + i).val();
          var selectPrdId = $('.select_productname_' + i).val();
          //var selectPrdPrice = $('.price_'+i).val();
          //var selectPrdTotalPrice = $('.total_price_'+i).val();
  
          if (selectPrd == "") {
            $('#select_producttype_error_' + i).css({
              "display": ""
            });
            $('.tbl_td_selectManufac_error_' + i).addClass('has-error');
          } else {
            $('#select_producttype_error_' + i).css({
              "display": "none"
            });
            $('.tbl_td_selectManufac_error_' + i).removeClass('has-error');
          }
  
          if (selectPrdQty == "") {
            $('#quantity_error_' + i).css({
              "display": ""
            });
            $('.tbl_td_quantity_error_' + i).addClass('has-error');
          } else {
            $('#quantity_error_' + i).css({
              "display": "none"
            });
            $('.tbl_td_quantity_error_' + i).removeClass('has-error');
          }
  
          if (selectPrdId == "") {
            $('#select_productname_error_' + i).css({
              "display": ""
            });
            $('.tbl_td_selectProductname_error_' + i).addClass('has-error');
          } else {
            $('#select_productname_error_' + i).css({
              "display": "none"
            });
            $('.tbl_td_selectProductname_error_' + i).removeClass('has-error');
          }
        }
  
  
        $('#salespartEditForm input, #salespartEditForm select, #salespartEditForm textarea').each(
  
          function(index) {
            var input = $(this);
  
            if (input.attr('isRequire') == 'required') {
              var rowid = (input.attr('rows_id'));
              var labelName = (input.attr('fieldnameis'));
  
              if (input.attr('type') == 'textbox' || input.attr('type') == 'textarea') {
                if (input.val() == '' || input.val() == null) {
                  $('.common_value_is_' + rowid).val("");
                  $('#common_error_span_' + rowid).text(labelName + " : " + msg1);
                  $('#common_error_span_' + rowid).css({
                    "display": ""
                  });
                  $('.error_customfield_main_div_' + rowid).addClass('has-error');
                  e.preventDefault();
                  return false;
                } else if (!input.val().replace(/\s/g, '').length) {
                  $('.common_value_is_' + rowid).val("");
                  $('#common_error_span_' + rowid).text(labelName + " : " + msg2);
                  $('#common_error_span_' + rowid).css({
                    "display": ""
                  });
                  $('.error_customfield_main_div_' + rowid).addClass('has-error');
                  e.preventDefault();
                  return false;
                } else if (!input.val().match(/^[(a-zA-Z0-9\s)\p{L}]+$/u)) {
                  $('.common_value_is_' + rowid).val("");
                  $('#common_error_span_' + rowid).text(labelName + " : " + msg3);
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
                  $('.error_customfield_main_div_' + ids).removeClass('has-error');
                } else {
                  $('#common_error_span_' + rowid).text(labelName + " : " + msg1);
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
                  $('#common_error_span_' + rowid).text(labelName + " : " + msg1);
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
            }
          }
        );
      });
  
  
  
      $('body').on('change', '.dateValue', function() {
  
        var dateValue = $(this).val();
  
        if (dateValue == "") {
          $('#salesDate-error').css({
            "display": ""
          });
          $('.div_date_error').addClass('has-error');
        } else {
          $('#salesDate-error').css({
            "display": "none"
          });
          $('.div_date_error').removeClass('has-error');
        }
      });
  
  
  
      $('.customer_select').on('change', function() {
  
        var customerValue = $('select[name=cus_name]').val();
  
        if (customerValue == "") {
          $('#customer_select_box-error').css({
            "display": ""
          });
          $('.div_customer_select_error').addClass('has-error');
        } else {
          $('#customer_select_box-error').css({
            "display": "none"
          });
          $('.div_customer_select_error').removeClass('has-error');
        }
  
      });
  
  
  
      $('.salesmanname').on('change', function() {
  
        var salesmanValue = $('select[name=salesmanname]').val();
  
        if (salesmanValue == "") {
          $('#salesmanname-error').css({
            "display": ""
          });
          $('.div_salesmanname_error').addClass('has-error');
        } else {
          $('#salesmanname-error').css({
            "display": "none"
          });
          $('.div_salesmanname_error').removeClass('has-error');
        }
      });
  
  
  
      /*for table field validation*/
      $('body').on('change', '.select_producttype', function() {
  
        var row_id = $(this).attr("row_did");
        var manufactureValue = $('.select_producttype_' + row_id).val();
  
        if (manufactureValue == "") {
          $('#select_producttype_error_' + row_id).css({
            "display": ""
          });
          $('.tbl_td_selectManufac_error_' + row_id).addClass('has-error');
        } else {
          $('#select_producttype_error_' + row_id).css({
            "display": "none"
          });
          $('.tbl_td_selectManufac_error_' + row_id).removeClass('has-error');
        }
      });
  
  
      $('body').on('change', '.productid', function() {
  
        var row_id = $(this).attr("row_did");
        var prdValue = $('.select_productname_' + row_id).val();
  
        if (prdValue == "") {
          $('#select_productname_error_' + row_id).css({
            "display": ""
          });
          $('.tbl_td_selectProductname_error_' + row_id).addClass('has-error');
        } else {
          $('#select_productname_error_' + row_id).css({
            "display": "none"
          });
          $('.tbl_td_selectProductname_error_' + row_id).removeClass('has-error');
        }
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
              $('#common_error_span_' + rowid).text(labelName + " : " + msg1);
              $('#common_error_span_' + rowid).css({
                "display": ""
              });
              $('.error_customfield_main_div_' + rowid).addClass('has-error');
            } else if (valueIs.match(/^\s+/)) {
              $('.common_value_is_' + rowid).val("");
              $('#common_error_span_' + rowid).text(labelName + " : " + msg4);
              $('#common_error_span_' + rowid).css({
                "display": ""
              });
              $('.error_customfield_main_div_' + rowid).addClass('has-error');
            } else if (!valueIs.match(/^[(a-zA-Z0-9\s)\p{L}]+$/u)) {
              $('.common_value_is_' + rowid).val("");
              $('#common_error_span_' + rowid).text(labelName + " : " + msg3);
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
              $('#common_error_span_' + rowid).text(labelName + " : " + msg1);
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
                $('#common_error_span_' + rowid).text(labelName + " : " + msg4);
                $('#common_error_span_' + rowid).css({
                  "display": ""
                });
                $('.error_customfield_main_div_' + rowid).addClass('has-error');
              } else if (!valueIs.match(/^[(a-zA-Z0-9\s)\p{L}]+$/u)) {
                $('.common_value_is_' + rowid).val("");
                $('#common_error_span_' + rowid).text(labelName + " : " + msg3);
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
            $('#common_error_span_' + rowid).text(labelName + " : " + msg1);
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
            $('#common_error_span_' + rowid).text(labelName + " : " + msg1);
            $('#common_error_span_' + rowid).css({
              "display": ""
            });
            $('.error_customfield_main_div_' + rowid).addClass('has-error');
          }
        }
      });
    });
  </script>
=======
>>>>>>> 723c46cc149b3e892bfe937a70101070799b9d16

<!-- Form field validation -->
{!! JsValidator::formRequest('App\Http\Requests\StoreQuotationAddEditFormRequest', '#QuotationEdit-Form') !!}
<script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>

@endsection