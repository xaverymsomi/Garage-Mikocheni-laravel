@extends('layouts.app')
@section('content')

<style>
    .bootstrap-datetimepicker-widget table td span {
        width: 0px !important;
    }

    .panel-title {
        background-color: #f5f5f5;
        padding: 10px 15px;
    }

    .table-condensed>tbody>tr>td {
        padding: 3px;
    }

    .delete-row {
            cursor: pointer;
            color: red;
        }
</style>
<style>
    .step {
        color: #5A738E !important;
    }

    .invalid-feedback {
        color: red;
    }

    .blur-modal {
        filter: blur(2px);
    }
</style>

<!-- page content -->
<div class="right_col" role="main">

    <div class="page-title">
        <div class="nav_menu">
            <nav>
                <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><a href="{!! url('/quotation/list') !!}" id=""><i class=""><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}"></i><span class="titleup">
                            {{ trans('message.Add Quotation') }}</span></a>
                </div>
                @include('dashboard.profile')
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
            <div class="x_panel mb-0">
                <div class="x_content">
                    <div class="panel panel-default">
                        <form id="QuotationAdd-Form" method="post" action="{{ url('/quotation/store') }}" enctype="multipart/form-data" class="form-horizontal upperform serviceAddForm" border="10">

                            <div class="row row-mb-0">
                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Quotation Number') }} <label class="color-danger">*</label></label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                        <input type="text" id="jobno" name="jobno" class="form-control" value="{{ $code }}" readonly>
                                    </div>
                                </div>

                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Customer Name') }} <label class="color-danger">*</label></label>
                                    <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                        <select name="Customername" id="cust-id" class="form-control select_vhi select_customer_auto_search form-select" cus_url="{!! url('service/get_vehi_name') !!}" required>
                                            <option value="">{{ trans('message.Select Customer') }}</option>
                                            @if (!empty($customer))
                                            @foreach ($customer as $customers)
                                            <option value="{{ $customers->id }}" {{ request()->input('c_id') == $customers->id ? 'selected' : '' }}>
                                                {{ getCustomerName($customers->id) }}
                                            </option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 addremove">
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-outline-secondary ">{{ trans('+') }}</button>
                                    </div>
                                </div>
                            </div>

                            <div class="row row-mb-0">
                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="last-name">{{ trans('message.Vehicle Name') }} <label class="color-danger">*</label></label>
                                    <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                        <select name="vehicalname" class="form-control modelnameappend form-select" id="vhi" required>
                                            <option value="">{{ trans('message.Select vehicle Name') }}</option>
                                            <!-- Option comes from Controller -->
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 addremove">
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#vehiclemymodel" class="btn btn-outline-secondary vehiclemodel">{{ trans('+') }}</button>
                                    </div>
                                </div>

                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="p_date">{{ trans('message.Date') }} <label class="color-danger">*</label></label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 date">
                                        <input type='text' class="form-control datepicker2" name="date" autocomplete="off" id='p_date' placeholder="yyyy-mm-dd hh:mm:ss" value="{{ old('date', now()->format('Y-m-d H:i:s')) }}" onkeypress="return false;" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row row-mb-0">

                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="branch">{{ trans('message.Branch') }} <label class="color-danger">*</label></label>

                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                        <select class="form-control select_branch form-select" name="branch">
                                            @if (Auth::user()->role_id === 6)
                                            @php
                                            $branchDatar = App\Branch::where('id', 2)->get();
                                            @endphp
                                            @foreach ($branchDatar as $branchData)
                                            <option value="{{ $branchData->id }}">
                                                {{ $branchData->branch_name }}
                                            </option>
                                            @endforeach
                                            @else
                                            @foreach ($branchDatas as $branchData)
                                            <option value="{{ $branchData->id }}">
                                                {{ $branchData->branch_name }}
                                            </option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('Job Category') }} <label class="color-danger">*</label></label>
                                    <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                        <select name="repair_cat" class="form-control repair_category form-select" required>
                                            <option value="">{{ trans('-- Select Job Category--') }}
                                            </option>
                                            @if (!empty($repairCategoryList))
                                            @foreach ($repairCategoryList as $repairCategoryListData)
                                            <option value="<?php echo $repairCategoryListData->slug; ?>">
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


                            <div class="row"> 
                                <div id="dvCharge" class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback 
                                    {{ $errors->has('charge') ? ' has-error' : '' }}">

                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 currency" for="last-name">{{ trans('message.Fix Service Charge') }}
                                        (<?php echo getCurrencySymbols(); ?>) <label class="color-danger">*</label></label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                        <input type="text" id="charge_required" name="charge" class="form-control fixServiceCharge" placeholder="{{ trans('message.Enter Fix Service Charge') }}" value="{{ old('charge') }}" maxlength="8">
                                        @if ($errors->has('charge'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('charge') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                </div>

                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="details">{{ trans('NOTE') }}</label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                        <textarea class="form-control" name="details" id="details" maxlength="100">{{ old('details') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div id="" class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback ">

                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 currency" for="last-name">{{ trans('Insurer Name') }}
                                   <label class="color-danger">*</label></label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="text" id="" name="insurer" class="form-control" placeholder="{{ trans('Enter Insurer Name') }}" value="{{ old('insurer') }}">
                                    
                                </div>

                            </div>
                            <div id="" class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback">

                            <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 currency" for="last-name">{{ trans('Broker Name') }}
                               <label class="color-danger">*</label></label>
                            <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                <input type="text" id="" name="broker" class="form-control " placeholder="{{ trans('Enter Broker Name') }}" value="{{ old('Broker') }}">
                                
                            </div>

                        </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Checkbox for applying discount -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="applyDiscountCheckbox">
                                        <label class="form-check-label" for="applyDiscountCheckbox">
                                            Apply Discount
                                        </label>
                                    </div>
                            
                                    <!-- Options for discount -->
                                    <div id="discountOptions" style="display: none;">
                                        <label for="discountOption">Select discount option:</label>
                                        <select class="form-select" id="discountOption">
                                            <option value="none">Select an option</option>
                                            <option value="option1">1 - 3 vehicles</option>
                                            <option value="option2">4 - 10 vehicles</option>
                                            <option value="option3">11 + vehicles</option>
                                        </select>
                                        <div id="discountPercentageInput" style="display: none;">
                                            <label for="discountPercentage">Enter discount percentage:</label>
                                            <input type="number" id="discountPercentage" name="discountPercentage" class="form-control" placeholder="Enter discount percentage" min="0" max="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Sell Part -->



<div class="row mt-4">
    <div class="col-md-10 col-lg-10 col-xl-10 col-xxl-10 col-sm-10 col-xs-10 header">
        <h4><b>{{ trans('message.SALE PART') }}</b>
        <button type="button" id="add_new_product" class="btn btn-outline-secondary" url="{!! url('sales_part/add/getproductname') !!}">{{ trans('+') }} </button>
        </h4>   
    </div>
    <div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2">
    </div>
</div>
<div class="col-md-12 col-xs-12 col-sm-12 form-group table-responsive">
    <table class="table table-bordered adddatatable" id="tab_taxes_detail" align="center">
        <thead>
            <tr>
                <th class="actionre">{{ trans('message.Manufacturer Name') }}</th>
                <th class="actionre">{{ trans('message.Product Name') }}</th>
                <th class="actionre">{{ trans('message.Quantity') }}</th>
                <th class="actionre" style="width:10%;">{{ trans('message.Price') }}
                    (<?php echo getCurrencySymbols(); ?>)</th>
                <th class="actionre" style="width:13%;">{{ trans('message.Amount') }}
                    (<?php echo getCurrencySymbols(); ?>)</th>
                <th class="actionre">{{ trans('message.Action') }}</th>
            </tr>
        </thead>
        <tbody>
            <tr id="row_id_1">
                <td class="tbl_td_selectManufac_error_1">
                    <select class="form-control select_producttype select_producttype_1 form-select" name="product[Manufacturer_id][]" m_url="{!! url('/purchase/producttype/names') !!}" row_did="1" data-id="1" id="">
                        <option value="">
                            -{{ trans('message.Select Manufacturing Name') }}-</option>
                        @if (!empty($manufacture_name))
                        @foreach ($manufacture_name as $manufacture_nm)
                        <option value="{{ $manufacture_nm->id }}">
                            {{ $manufacture_nm->type }}
                        </option>
                        @endforeach
                        @endif
                    </select>

                    <span id="select_producttype_error_1" class="help-block error-help-block color-danger" style="display: none">{{ trans('message.Manufacturer name is required.') }}</span>
                </td>
                <td class="tbl_td_selectProductname_error_1">
                    <select name="product[product_id][]" class="form-control productid select_productname_1 form-select" id="productid" url="{!! url('purchase/add/getproduct') !!}" row_did="1" data-id="1">
                        <option value="">{{ trans('message.--Select Product--') }}
                        </option>
                        @if (!empty($brand))
                        @
                        @foreach ($brand as $brands)
                        <option value="{{ $brands->id }}">{{ $brands->name }}
                        </option>
                        @endforeach
                        @endif
                    </select>

                    <span id="select_productname_error_1" class="help-block error-help-block color-danger" style="display: none">{{ trans('message.Product name is required.') }}</span>
                </td>
                <td class="tbl_td_quantity_error_1">
                    <input type="number" name="product[qty][]" url="{!! url('purchase/add/getqty') !!}" prd_url="{{ url('/sale_part/get_available_product') }}" class="quantity form-control qty qty_1 qtyt" id="qty_1" autocomplete="off" row_id="1" value="" maxlength="8">
                    <!-- <span class="qty_1"></span> -->

                    <span id="quantity_error_1" class="help-block error-help-block color-danger" style="display: none">{{ trans('message.Quantity is required.') }}</span>
                </td>
                <td class="tbl_td_price_error_1">
                    <input type="text" name="product[price][]" class="product form-control prices price_1" value="" id="price_1" row_id="1" style="width:100%;">

                    <span id="price_error_1" class="help-block error-help-block color-danger" style="display: none">{{ trans('message.Price is required.') }}</span>
                </td>
                <td class="tbl_td_totaPrice_error_1">
                    <input type="text" name="product[total_price][]" class="product form-control total_price total_price_1" value="" style="width:100%;" id="total_price_1" readonly="true" required="true">

                    <span id="total_price_error_1" class="help-block error-help-block color-danger" style="display: none">{{ trans('message.Total price is required.') }}</span>
                </td>
                <td align="center">
                    <input type="hidden" value="1" name="row_number" class="row_number">
                </td>
            </tr>
        </tbody>
    </table>
</div>

                            <div class="row row-mb-0">
                               
                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 washbayLabel" for="washbay">{{ trans('message.Wash Bay') }} <label class="text-danger"></label></label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 washbayInputDiv">
                                        <input type="checkbox" name="washbay" id="washBay" class="washBayCheckbox" {{ old('washbay') ? 'checked' : '' }} style="height:20px; width:20px; margin-right:5px; position: relative; top: 1px; margin-bottom: 12px;">
                                    </div>
                                </div>
                                <div id="washBayCharge" class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback {{ $errors->has('washBayCharge') ? ' has-error' : '' }}">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 currency" for="washBayCharge">{{ trans('message.Wash Bay Charge') }} (<?php echo getCurrencySymbols(); ?>)
                                        <label class="color-danger">*</label></label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                        <input type="text" id="washBayCharge_required" name="washBayCharge" class="form-control washbay_charge_textbox" placeholder="{{ trans('message.Enter Wash Bay Charge') }}" value="{{ old('washBayCharge') }}" maxlength="10">

                                        <span id="washbay_error_span" class="help-block error-help-block color-danger" style="display:none"></span>
                                    </div>
                                </div>
                            {{-- </div> --}}


                            <!-- Wash Bay Feature -->
                            {{-- <div class="row row-mb-0"> --}}
                                <!-- Tax field start -->
                                @if (!empty($tax))
                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="cus_name">{{ trans('message.Tax') }}</label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                        <table>
                                            <tbody>
                                                @foreach ($tax as $taxes)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" id="tax_{{ $taxes->taxname }}" class="checkbox-inline check_tax sele_tax myCheckbox" name="Tax[]" value="<?php
                                                                                                                                                                                        echo $taxes->id; ?>" taxrate="{{ $taxes->tax }}" taxName="{{ $taxes->taxname }}" style="height:20px; width:20px; margin-right:5px; position: relative; top: 6px; margin-bottom: 12px;">
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
                            <!-- Wash Bay Feature -->
                            <!-- ************* MOT Module Starting ************* -->
                            {{-- <br /><br />
                            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 motMainPart" style="display: none">
                                <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
                                    <h4 class="Mottestfont">{{ trans('message.MOT Test') }}</h4>
                                </div>
                            </div> --}}

                             {{--<div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 panel-group motMainPart-1" style="display: none">
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
                                            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 panel-group pGroup">
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
                                                                        <h6 class="boldFont">
                                                                            {{ trans('message.OK = Satisfactory') }}
                                                                        </h6>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <h6 class="boldFont">
                                                                            {{ trans('message.X = Safety Item Defact') }}
                                                                        </h6>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <h6 class="boldFont">
                                                                            {{ trans('message.R = Repair Required') }}
                                                                        </h6>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <h6 class="boldFont">
                                                                            {{ trans('message.NA = Not Applicable') }}
                                                                        </h6>
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
                                                                                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 table-responsive">
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
                                                            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 panel-group pGroupInsideStep1">
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading pHeadingInsideStep1">
                                                                        <h4 class="panel-title">
                                                                            <a data-bs-toggle="collapse" href="#collapse6" class="observation_Plus5" style="color:#5A738E"><i class="plus-minus fa fa-plus"></i>
                                                                                {{ trans('message.Ground Level and Under Vehicle') }}</a>
                                                                        </h4>
                                                                    </div>
                                                                    <div id="collapse6" class="panel-collapse collapse">
                                                                        <div class="panel-body">
                                                                            

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
                                                                                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 table-responsive">
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
                                            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 panel-group pGroup">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading pHeading">
                                                        <h4 class="panel-title">
                                                            <a data-bs-toggle="collapse" href="#collapse4" class="observation_Plus6" style="color:#5A738E"><i class="plus-minus fa fa-plus"></i>
                                                                {{ trans('message.Step 2: Show Filled MOT Details') }}</a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapse4" class="panel-collapse collapse">
                                                        <div class="panel-body table-responsive">

                                                            <table class="table">
                                                                <thead class="thead-dark">
                                                                    <tr>
                                                                        <th><b>{{ trans('message.Code') }}</b></th>
                                                                        <th><b>{{ trans('message.Inspection Details') }}</b>
                                                                        </th>
                                                                        <th><b>{{ trans('message.Answer') }}</b></th>
                                                                    <tr>
                                    
                                                                        
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
                            </div> --}}

                            <!-- ************* MOT Module Ending ************* -->
                            <!-- Start Custom Field, (If register in Custom Field Module)  -->
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

                            $subDivCount++;
                            ?>
                            @if ($myCounts % 2 == 0)
                            <div class="col-md-12 col-sm-6 col-xs-12 row-mb-0">
                                @endif
                                <div class="form-group col-md-6 col-sm-6 col-xs-12 error_customfield_main_div_{{ $myCounts }}">

                                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account-no">{{ $tbl_custom_field->label }} <label class="color-danger">{{ $red }}</label></label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        @if ($tbl_custom_field->type == 'textarea')
                                        <textarea name="custom[{{ $tbl_custom_field->id }}]" class="form-control textarea_{{ $tbl_custom_field->id }} textarea_simple_class common_simple_class common_value_is_{{ $myCounts }}" placeholder="{{ trans('message.Enter') }} {{ $tbl_custom_field->label }}" maxlength="100" isRequire="{{ $required }}" type="textarea" fieldNameIs="{{ $tbl_custom_field->label }}" rows_id="{{ $myCounts }}" {{ $required }}></textarea>

                                        <span id="common_error_span_{{ $myCounts }}" class="help-block error-help-block color-danger" style="display: none"></span>
                                        @elseif($tbl_custom_field->type == 'radio')
                                        <?php
                                        $radioLabelArrayList = getRadiolabelsList($tbl_custom_field->id);
                                        ?>
                                        @if (!empty($radioLabelArrayList))
                                        <div style="margin-top: 5px;">
                                            @foreach ($radioLabelArrayList as $k => $val)
                                            <label><input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}]" value="{{ $k }}" <?php if ($k == 0) {
                                                                                                                                                                echo 'checked';
                                                                                                                                                            } ?>>{{ $val }}</label>
                                            &nbsp;
                                            @endforeach
                                        </div>
                                        @endif
                                        @elseif($tbl_custom_field->type == 'checkbox')
                                        <?php
                                        $checkboxLabelArrayList = getCheckboxLabelsList($tbl_custom_field->id);
                                        $cnt = 0;
                                        ?>

                                        @if (!empty($checkboxLabelArrayList))
                                        <div class="required_checkbox_parent_div_{{ $tbl_custom_field->id }}" style="margin-top: 5px;">
                                            @foreach ($checkboxLabelArrayList as $k => $val)
                                            <label><input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}][]" value="{{ $val }}" isRequire="{{ $required }}" fieldNameIs="{{ $tbl_custom_field->label }}" custm_isd="{{ $tbl_custom_field->id }}" class="checkbox_{{ $tbl_custom_field->id }} required_checkbox_{{ $tbl_custom_field->id }} checkbox_simple_class common_value_is_{{ $myCounts }} common_simple_class" rows_id="{{ $myCounts }}">
                                                {{ $val }}</label> &nbsp;
                                            <?php $cnt++; ?>
                                            @endforeach
                                            <span id="common_error_span_{{ $myCounts }}" class="help-block error-help-block color-danger" style="display: none"></span>
                                        </div>
                                        <input type="hidden" name="checkboxCount" value="{{ $cnt }}">
                                        @endif
                                        @elseif($tbl_custom_field->type == 'textbox')
                                        <input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}]" class="form-control textDate_{{ $tbl_custom_field->id }} textdate_simple_class common_value_is_{{ $myCounts }} common_simple_class" placeholder="{{ trans('message.Enter') }} {{ $tbl_custom_field->label }}" maxlength="30" isRequire="{{ $required }}" fieldNameIs="{{ $tbl_custom_field->label }}" rows_id="{{ $myCounts }}" {{ $required }}>

                                        <span id="common_error_span_{{ $myCounts }}" class="help-block error-help-block color-danger" style="display:none"></span>
                                        @elseif($tbl_custom_field->type == 'date')
                                        <input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}]" class="form-control textDate_{{ $tbl_custom_field->id }} date_simple_class common_value_is_{{ $myCounts }} common_simple_class" placeholder="{{ trans('message.Enter') }} {{ $tbl_custom_field->label }}" maxlength="30" isRequire="{{ $required }}" fieldNameIs="{{ $tbl_custom_field->label }}" rows_id="{{ $myCounts }}" {{ $required }} onkeydown="return false">

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
                            <!-- End Custom Field -->

                            <div class="row">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <!-- <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                                    <a class="btn btn-primary quotationCancelButton" href="{{ URL::previous() }}">{{ trans('message.CANCEL') }}</a>

                                </div> -->
                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                                    <button type="submit" class="btn btn-success quotationSubmitButton">{{ trans('message.Save and continue') }}</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--customer add model -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">{{ trans('message.Customer Details') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
                </div>

                @include('success_message.message')
                <div class="modal-body">
                    <div class="x_content">
                        <form id="formcustomer" action="" method="POST" name="formcustomer" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left input_mask">

                            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space">
                                <h4><b>{{ trans('message.Personal Information') }}</b></h4>
                                <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 ln_solid"></p>
                            </div>
                            <div class="row">
                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('Full Name') }} <label class="color-danger">*</label> </label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                        <input type="text" id="firstname" name="firstname" class="form-control" value="{{ old('firstname') }}" placeholder="{{ trans('Enter Full Name') }}" maxlength="25" />
                                        <span class="text-danger" id="errorlfirstname" style="display: none;">
                                            {{ trans('Full name is required.') }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                                        {{ trans('message.Gender') }}
                                        <label class="color-danger">*</label></label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                        <input type="radio" class="gender" name="gender" value="0" checked>{{ trans('message.Male') }}
                                        <input type="radio" class="gender" name="gender" value="1">
                                        {{ trans('message.Female') }}
                                    </div>
                                </div>
                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group {{ $errors->has('mobile') ? ' has-error' : '' }}">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="mobile">{{ trans('message.Mobile No.') }} <label class="color-danger">*</label></label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text" id="mobile" name="mobile" placeholder="{{ trans('message.Enter Mobile No') }}" value="{{ old('mobile') }}" class="form-control" maxlength="16" minlength="6">
                                        <span class="text-danger" id="errorlmobile" style="display: none;">
                                            {{ trans('message.Contact number is required.') }}
                                        </span>
                                        <span class="text-danger" id="errorlmobile_length" style="display: none;">
                                            {{ trans('message.Contact number minimum 6 digits.') }}
                                        </span>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="Email">{{ trans('message.Email') }} <label class="color-danger">*</label></label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                        <input type="text" id="email" name="email" placeholder="{{ trans('message.Enter Email') }}" value="{{ old('email') }}" class="form-control" maxlength="50">
                                        <span class="text-danger" id="errorlemail" style="display: none;">
                                            {{ trans('message.Email is required.') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="Password">{{ trans('message.Password') }} <label class="color-danger">*</label></label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                        <input type="password" id="password" name="password" placeholder="{{ trans('message.Enter Password') }}" class="form-control col-md-7 col-xs-12" maxlength="20">
                                        <span class="text-danger" id="errorlpassword" style="display: none;">
                                            {{ trans('message.Password is required.') }}
                                        </span>
                                        <span class="text-danger" id="errorlpassword_length" style="display: none;">
                                            {{ trans('message.Password length minimum 6 character.') }}
                                        </span>
                                        <span class="text-danger" id="errorlpassword_combine" style="display: none;">
                                            {{ trans('message.Password must be combination of letters and numbers.') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 currency p-1 ps-2 px-5" for="Password">{{ trans('message.Confirm Password') }}
                                        <label class="color-danger">*</label></label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="{{ trans('message.Enter Confirm Password') }}" class="form-control col-md-7 col-xs-12" maxlength="20">
                                        <span class="text-danger" id="errorlpassword_confirmation" style="display: none;">
                                            {{ trans('message.Confirm password is required.') }}
                                        </span>
                                        <span class="text-danger" id="errorlpassword_confirmation_same" style="display: none;">
                                            {{ trans('message.Password and Confirm Password does not match.') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 row form-group">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-12">{{ trans('message.Date of Birth') }}</label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 date">
                                        <input type="text" autocomplete="off" class="form-control datepicker" placeholder="<?php echo getDatepicker(); ?>" name="dob" value="{{ old('dob') }}" onkeypress="return false;" />
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space">
                                <h4><b>{{ trans('message.Address') }}</b></h4>
                                <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 ln_solid"></p>
                            </div>
                            <div class="row">
                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="Country">{{ trans('message.Country') }} <label class="color-danger">*</label></label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                        <select class="form-control select_country form-select" id="country_id" name="country_id" countryurl="{!! url('/getstatefromcountry') !!}">
                                            <option value="">{{ trans('message.Select Country') }}</option>
                                            @foreach ($country as $countrys)
                                            <option value="{{ $countrys->id }}">{{ $countrys->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger" id="errorlcountry_id" style="display: none;">
                                            {{ trans('message.Country field is required.') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group has-feedback">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="State ">{{ trans('message.State') }} </label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                        <select class="form-control state_of_country form-select" id="state_id" name="state_id" stateurl="{!! url('/getcityfromstate') !!}">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group has-feedback">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="Town/City">{{ trans('message.Town/City') }}</label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                        <select class="form-control city_of_state form-select" id="city" name="city">
                                        </select>
                                    </div>
                                </div>

                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group ">
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="Address">{{ trans('message.Address') }} <label class="color-danger">*</label></label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                        <textarea class="form-control" id="address" name="address" maxlength="100">{{ old('address') }}</textarea>
                                        <span class="text-danger" id="errorladdress" style="display: none;">
                                            {{ trans('message.Address field is required.') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-125 col-xs-12">
                                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-125 col-xs-12 text-center">
                                        <!-- <a class="btn btn-primary cancelcustomer" data-bs-dismiss="modal">{{ trans('message.CANCEL') }}</a> -->
                                        <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                                            <button type="submit" class="btn btn-success addcustomer">{{ trans('message.SUBMIT') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm mx-2" data-bs-dismiss="modal">{{ trans('message.Close') }}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- vehicle model -->
    <div class="modal" id="vehiclemymodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">{{ trans('message.Vehicle Details') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
                </div>
                @include('success_message.message')

                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal upperform">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="customer_id" value="" class="hidden_customer_id">
                        <div class="row">
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Vehicle Type') }} <label class="color-danger">*</label></label>
                                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                    <select class="form-control select_vehicaltype form-select" id="vehical_id1" name="vehical_id" vehicalurl="{!! url('/vehicle/vehicaltypefrombrand') !!}" required>
                                        <option value="">{{ trans('message.Select Vehicle Type') }}</option>
                                        @if (!empty($vehical_type))
                                        @foreach ($vehical_type as $vehical_types)
                                        <option value="{{ $vehical_types->id }}">
                                            {{ $vehical_types->vehicle_type }}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <span class="color-danger" id="errorlvehical_id1"></span>
                                </div>
                                <div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 addremove">
                                    <button type="button" class="btn btn-outline-secondary btn-sm showmodal ms-1" data-show-modal="responsive-modal">
                                        +
                                    </button>
                                </div>
                            </div>

                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="branch">{{ trans('message.Branch') }} <label class="color-danger">*</label></label>

                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <select class="form-control select_branch_vehicle form-select" id="select_branch_vehicle" name="branch_vehicle">
                                        @foreach ($branchDatas as $branchData)
                                        <option value="{{ $branchData->id }}">{{ $branchData->branch_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="row mt-3">
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Vehicle Brand') }}<label class="color-danger">*</label></label>
                                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                    <select class="form-control select_vehicalbrand form-select" id="vehicabrand1" name="vehicabrand">
                                        <option value="">Select Vehical Brand</option>
                                    </select>
                                    <span class="color-danger">
                                        <strong id="errorlvehicabrand1"></strong>
                                    </span>
                                </div>
                                <div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 addremove">
                                    <button type="button" class="btn btn-outline-secondary btn-sm showmodal ms-1" data-show-modal="responsive-modal-brand">
                                        +
                                    </button>
                                </div>
                            </div>

                        </div>
                        <div class="row mt-3">
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="last-name">{{ trans('message.Model Name') }} <label class="color-danger">*</label></label>
                                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                    <select class="form-control model_addname form-select" id="modelname1" name="modelname" required>
                                        <option value="">{{ trans('message.Select Model Name') }}</option>
                                        @if (!empty($model_name))
                                        @foreach ($model_name as $model_names)
                                        <option value="{{ $model_names->model_name }}">
                                            {{ $model_names->model_name }}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <span class="color-danger" id="errorlmodelname1"></span>
                                </div>
                                <div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 addremove">
                                    <button type="button" class="btn btn-outline-secondary btn-sm showmodal ms-1" data-show-modal="responsive-modal-vehi-model">
                                        +
                                    </button>
                                </div>
                            </div>

                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Model Years') }}</label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 date">
                                    <input type="text" name="modelyear" id="modelyear1" class="form-control myDatepicker2" />
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Fuel Type') }}</label>
                                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                    <select class="form-control select_fueltype form-select" id="fueltype1" name="fueltype">
                                        <option value="">{{ trans('message.Select fuel type') }} </option>
                                        @if (!empty($fuel_type))
                                        @foreach ($fuel_type as $fuel_types)
                                        <option value="{{ $fuel_types->id }}">{{ $fuel_types->fuel_type }}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 addremove">
                                    <button type="button" class="btn btn-outline-secondary btn-sm showmodal ms-1" data-show-modal="responsive-modal-fuel">
                                        +
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Engine No') }}</label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="text" name="engineno" id="engineno1" value="{{ old('engineno') }}" placeholder="{{ trans('message.Enter Engine No') }}" maxlength="30" class="form-control">
                                    <span class="color-danger" id="errorlengineno1"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Number Plate') }} <label class="text-danger"></label></label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="text" id="number_plate" name="number_plate" value="{{ old('number_plate') }}" placeholder="{{ trans('message.Enter Number Plate') }}" maxlength="30" class="form-control">
                                </div>
                            </div>
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Chasic No') }}</label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="text" name="chasicno" id="chasicno1" value="{{ old('chasicno') }}" placeholder="{{ trans('message.Enter ChasicNo') }}" maxlength="30" class="form-control">
                                    <span class="color-danger" id="errorlchasicno1"></span>
                                </div>
                            </div>

                        </div>

                        <div class="form-group col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 mt-3">
                            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 text-center">
                                <!-- <a class="btn btn-primary cancelvehicleservice" href="{{ URL::previous() }}">{{ trans('message.CANCEL') }}</a> -->
                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                                    <button type="button" class="btn btn-success addvehicleservice">{{ trans('message.SUBMIT') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary modal_close mx-1" data-bs-dismiss="modal">{{ trans('message.Close') }}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Model Name -->
    <div class="col-md-6">
        <div id="responsive-modal-vehi-model" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ trans('message.Add Model Name') }}</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" action="" method="post">
                            <div class="row">
                                <div class="col-md-5 form-group data_popup">
                                    <select class="form-control vehical_id model_input form-select vehi_brand_id" name="vehical_id" id="vehicleTypeSelect" vehicalurl="{!! url('/vehicle/vehicalformtype') !!}" required>
                                        <option value="">{{ trans('message.Select Brand') }}</option>
                                        @if (!empty($vehical_brand))
                                        @foreach ($vehical_brand as $vehical_brands)
                                        <option value="{{ $vehical_brands->id }}">{{ $vehical_brands->vehicle_brand }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 form-group data_popup">
                                    <input type="text" class="form-control model_input vehi_modal_name" name="model_name" id="model_name" placeholder="{{ trans('message.Enter Model Name') }}" maxlength="20" required />
                                </div>
                                <div class="col-md-4 form-group data_popup">
                                    <button type="button" class="btn btn-success model_submit vehi_model_add" modelurl="{!! url('/vehicle/vehicle_model_add') !!}">{{ trans('message.Submit') }}</button>
                                </div>
                            </div>
                            <table class="table vehi_model_class">

                                <tbody>

                                    @if (!empty($model_name))
                                    @foreach ($model_name as $model_names)
                                    <tr class="mod-{{ $model_names->id }} data_color_name row mx-1">
                                        <td class="text-start col-6">{{ $model_names->model_name }}
                                        </td>
                                        <td class="text-end col-6">
                                            <button type="button" modelid="{{ $model_names->id }}" deletemodel="{!! url('/vehicle/vehicle_model_delete') !!}" class="btn btn-danger text-white border-0 modeldeletes"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Model Name -->
    <!-- Vehicle Type  -->
    <div class="col-md-6">
        <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"> {{ trans('message.Add Vehicle Type') }}</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal formaction" action="" method="">
                            <div class="row">
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 form-group data_popup">
                                    <!-- <label>{{ trans('message.Vehicle Type:') }} <span class="text-danger">*</span></label> -->
                                    <input type="text" class="form-control model_input vehical_type" name="vehical_type" id="vehical_type" placeholder="{{ trans('message.Enter Vehicle Type') }}" maxlength="20" required />
                                </div>
                                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 mt-4 form-group data_popup">

                                    <button type="button" class="btn btn-success vehi_model_add vehicaltypeadd" url="{!! url('/vehicle/vehicle_type_add') !!}">{{ trans('message.Submit') }}</button>
                                </div>
                            </div>
                            <table class="table vehical_type_class align-center">
                                <tbody>
                                    @if (!empty($vehical_type))
                                    @foreach ($vehical_type as $vehical_types)
                                    <tr class="del-{{ $vehical_types->id }} data_vehicle_type_name row mx-1">
                                        <td class="text-start col-6 w-50">{{ $vehical_types->vehicle_type }}</td>
                                        <td class="text-end col-6 w-50">
                                            <button type="button" vehicletypeid="{{ $vehical_types->id }}" deletevehical="{!! url('/vehicle/vehicaltypedelete') !!}" class="btn btn-danger text-white border-0 deletevehicletype "><i class="fa fa-trash" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End  Vehicle Type  -->

    <!-- Vehicle Brand -->
    <div class="col-md-6">
        <div id="responsive-modal-brand" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ trans('message.Add Vehicle Brand') }}</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" action="" method="">
                            <div class="row">
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 form-group data_popup">
                                    <!-- <label>{{ trans('message.Vehicle Type:') }} <span class="text-danger">*</span></label> -->
                                    <select class="form-control model_input vehical_id form-select" name="vehical_id" id="vehicleTypeSelect" vehicalurl="{!! url('/vehicle/vehicalformtype') !!}" required>
                                        <option>{{ trans('message.Select Vehicle Type') }}</option>
                                        @if (!empty($vehical_type))
                                        @foreach ($vehical_type as $vehical_types)
                                        <option value="{{ $vehical_types->id }}">
                                            {{ $vehical_types->vehicle_type }}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <!-- <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4"></div> -->
                            </div>
                            <div class="row">
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 form-group data_popup">
                                    <!-- <label>{{ trans('message.Vehicle Brand:') }} <span class="text-danger">*</span></label> -->
                                    <input type="text" class="form-control model_input vehical_brand" name="vehical_brand" id="vehical_brand" placeholder="{{ trans('message.Enter Vehicle brand') }}" maxlength="25" required />
                                </div>
                                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 form-group data_popup">

                                    <button type="button" class="btn btn-success model_submit vehicalbrandadd" vehiclebrandurl="{!! url('/vehicle/vehicle_brand_add') !!}">{{ trans('message.Submit') }}</button>
                                </div>
                            </div>
                            <table class="table vehical_brand_class align-center">
                                <!-- <thead>
                                    <tr>
                                        <td class="text-center"><strong>{{ trans('message.Vehicle Brand') }}</strong></td>
                                        <td class="text-center"><strong>{{ trans('message.Action') }}</strong></td>
                                    </tr>
                                </thead> -->
                                <tbody>
                                    @if (!empty($vehical_brand))
                                    @foreach ($vehical_brand as $vehical_brands)
                                    <tr class="del-{{ $vehical_brands->id }} data_vehicle_brand_name row mx-1">
                                        <td class="text-start col-6 w-50">{{ $vehical_brands->vehicle_brand }}</td>
                                        <td class="text-end col-6 w-50">
                                            <button type="button" brandid="{{ $vehical_brands->id }}" deletevehicalbrand="{!! url('/vehicle/vehicalbranddelete') !!}" class="btn btn-danger text-white border-0 deletevehiclebrands"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Vehicle Brand -->
    <!-- Fuel Type -->
    <div class="col-md-6">
        <div id="responsive-modal-fuel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ trans('message.Add Fuel Type') }}</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" action="" method="post">
                            <div class="row">
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 form-group data_popup">
                                    <!-- <label>{{ trans('message.Fuel Type:') }} <span class="text-danger">*</span></label> -->
                                    <input type="text" class="form-control model_input fuel_type" name="fuel_type" id="fuel_type" placeholder="{{ trans('message.Enter Fuel Type') }}" maxlength="20" required />
                                </div>
                                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 form-group data_popup">

                                    <button type="button" class="btn btn-success model_submit fueltypeadd" fuelurl="{!! url('/vehicle/vehicle_fuel_add') !!}">{{ trans('message.Submit') }}</button>
                                </div>
                            </div>
                            <table class="table fuel_type_class" align="center">
                                <tbody>
                                    @if (!empty($fuel_type))
                                    @foreach ($fuel_type as $fuel_types)
                                    <tr class="del-{{ $fuel_types->id }} data_of_type row mx-1">
                                        <td class="text-start col-6">{{ $fuel_types->fuel_type }}</td>
                                        <td class="text-end col-6">
                                            <button type="button" fuelid="{{ $fuel_types->id }}" deletefuel="{!! url('/vehicle/fueltypedelete') !!}" class="btn btn-danger text-white border-0 fueldeletes"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end Fuel Type -->


    <div class="modal fade" id="add_category" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ trans('message.Add New Checkpoint Category') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row form-group">
                        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                            <input id="cat" placeholder="{{ trans('message.Enter Checkpoint Category Name') }}" name="category" type="text" class="form-control model_input add_newcat" value="" maxlength="25" required />
                        </div>
                        <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 text-center">
                            <button type="button" class="btn btn-success model_submit add_cat btn-sm mx-3">{{ trans('message.Submit') }}</button>
                        </div>
                    </div>
                    <!-- <table class="table producttype" align="center">
                          <tbody>
                          @foreach ($cat_name as $cat_names)
                            <tr class="data_of_type row mx-1">
                              <td class="text-start col-6">{{ $cat_names->checkout_point }}</td>
                              <td class="text-end col-6">
                                <button type="button" data-id="{{ $cat_names->id }}" deleteproduct="{!! url('deleteuser/') !!}" class="btn btn-danger text-white border-0 deleteproducted"><i class="fa fa-trash" aria-hidden="true"></i></button>
                              </td>
                            </tr>
                           
                            @endforeach
                          </tbody>
                        </table> -->
                 
                </div>
                <div class="modal-footer border-top-0">
                </div>
            </div>
        </div>
    </div>

    <!-- Repair Add or Remove Model Start-->
    <div class="col-md-6">
        <div id="responsive-modal-color" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ trans('Add Job Category') }}</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" action="" method="">
                            <div class="row">
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 form-group data_popup">
                                    <input type="text" class="form-control model_input repair_category_name" name="repair_category_name" placeholder="{{ trans('Enter Job category name') }}" maxlength="20" />
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
<!-- /page content -->
<!-- Scripts starting -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
    var msg35 = "{{ trans('message.OK') }}";
    $(document).ready(function() {

        $('.modal').on('show.bs.modal', function () {
            // Add blur class to all modals except the currently shown modal
            $('.modal').not(this).addClass('blur-modal');
        });

        $('.modal').on('hidden.bs.modal', function () {
            // Remove blur class from all modals
            $('.modal').removeClass('blur-modal');
        });


        var msg100 = "{{ trans('message.An error occurred :') }}";

        $("#formcustomer").on('submit', (function(event) {

            function define_variable() {
                return {
                    firstname: $("#firstname").val(),
                    lastname: $("#lastname").val(),
                    displayname: $("#displayname").val(),
                    company_name: $("#company_name").val(),
                    email: $("#email").val(),
                    password: $("#password").val(),
                    password_confirmation: $("#password_confirmation").val(),
                    mobile: $("#mobile").val(),
                    landlineno: $("#landlineno").val(),
                    image: $("#image").val(),
                    country_id: $("#country_id option:selected").val(),
                    state_id: $("#state_id option:selected").val(),
                    city: $("#city option:selected").val(),
                    address: $("#address").val(),
                    name_pattern: /^[a-zA-Z\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]+$/,
                    name_pattern2: /^[a-zA-Z\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]*$/,
                    company_patt: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]*$/,
                    lenghtLimit: /^[0-9]{6,16}$/,
                    mobile_pattern: /^[- +()]*[0-9][- +()0-9]*$/,
                    email_pattern: /^([a-zA-Z0-9_\.\-\+\'])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/
                };
            }

            event.preventDefault();
            var call_var_customeradd = define_variable();
            var errro_msg = [];
            //first name
            if (call_var_customeradd.firstname == "") {
                var msg = "{{ trans('message.First name is required.') }}";
                $('#errorlfirstname').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorlfirstname').html("");
                errro_msg = [];
            }

            if (!call_var_customeradd.name_pattern.test(call_var_customeradd.firstname)) {
                var msg = "{{ trans('message.First name is only alphabets and space.') }}";
                $("#firstname").val("");
                $('#errorlfirstname').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorlfirstname').html("");
                errro_msg = [];
            }

            if (!call_var_customeradd.firstname.replace(/\s/g, '').length) {

                var msg = "{{ trans('message.Only blank space not allowed') }}";
                $("#firstname").val("");
                $('#errorlfirstname').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorlfirstname').html("");
                errro_msg = [];
            }

            if (!call_var_customeradd.name_pattern2.test(call_var_customeradd.firstname)) {
                var msg = "{{ trans('message.At first position only alphabets are allowed.') }}";
                $("#firstname").val("");
                $('#errorlfirstname').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorlfirstname').html("");
                errro_msg = [];
            }

            //last name
            if (call_var_customeradd.lastname == "") {
                var msg = "{{ trans('message.Last name is required.') }}";
                $('#errorllastname').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorllastname').html("");
                errro_msg = [];
            }
            if (!call_var_customeradd.name_pattern.test(call_var_customeradd.lastname)) {
                var msg = "{{ trans('message.Last name is only alphabets and space.') }}";
                $('#errorllastname').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorllastname').html("");
                errro_msg = [];
            }

            if (!call_var_customeradd.lastname.replace(/\s/g, '').length) {

                var msg = "{{ trans('message.Only blank space not allowed') }}";
                $("#lastname").val("");
                $('#errorllastname').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorllastname').html("");
                errro_msg = [];
            }

            if (!call_var_customeradd.name_pattern2.test(call_var_customeradd.lastname)) {
                var msg = "{{ trans('message.At first position only alphabets are allowed.') }}";
                $('#errorllastname').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorllastname').html("");
                errro_msg = [];
            }

            //Display name
            if (call_var_customeradd.displayname != "") {

                if (!call_var_customeradd.name_pattern.test(call_var_customeradd.displayname)) {
                    var msg = "{{ trans('message.Display name is only alphabets and space.') }}";
                    $("#displayname").val("");
                    $('#errorldisplayname').html(msg);
                    errro_msg.push(msg);
                    return false;
                } else if (!call_var_customeradd.displayname.replace(/\s/g, '').length) {

                    var msg = "{{ trans('message.Only blank space not allowed') }}";
                    $("#displayname").val("");
                    $('#errorldisplayname').html(msg);
                    errro_msg.push(msg);
                    return false;
                } else if (!call_var_customeradd.name_pattern2.test(call_var_customeradd
                        .displayname)) {
                    var msg =
                        "{{ trans('message.At first position only alphabets are allowed.') }}";
                    $("#displayname").val("");
                    $('#errorldisplayname').html(msg);
                    errro_msg.push(msg);
                    return false;
                } else {
                    $('#errorldisplayname').html("");
                    errro_msg = [];
                }
            } else {
                $('#errorldisplayname').html("");
                errro_msg = [];
            }

            //Company name
            if (call_var_customeradd.company_name != "") {

                if (!call_var_customeradd.company_name.replace(/\s/g, '').length) {

                    var msg = "{{ trans('message.Only blank space not allowed') }}";
                    $("#company_name").val("");
                    $('#errorlcompanyName').html(msg);
                    errro_msg.push(msg);
                    return false;
                } else if (!call_var_customeradd.company_patt.test(call_var_customeradd
                        .company_name)) {
                    var msg =
                        "{{ trans('message.Only alphanumeric, space, dot, @, _, and - are allowed.') }}";
                    $("#company_name").val("");
                    $('#errorlcompanyName').html(msg);
                    errro_msg.push(msg);
                    return false;
                } else if (!call_var_customeradd.name_pattern2.test(call_var_customeradd
                        .company_name)) {
                    var msg =
                        "{{ trans('message.At first position only alphabets are allowed.') }}";
                    $("#company_name").val("");
                    $('#errorlcompanyName').html(msg);
                    errro_msg.push(msg);
                    return false;
                } else {
                    $('#errorlcompanyName').html("");
                    errro_msg = [];
                }
            } else {
                $('#errorlcompanyName').html("");
                errro_msg = [];
            }

            //Email 
            if (call_var_customeradd.email == "") {
                var msg = "{{ trans('message.Email is required.') }}";
                $('#errorlemail').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorlemail').html("");
                errro_msg = [];
            }

            if (!call_var_customeradd.email.replace(/\s/g, '').length) {

                var msg = "{{ trans('message.Only blank space not allowed') }}";
                $("#email").val("");
                $('#errorlemail').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorlfirstname').html("");
                errro_msg = [];
            }

            if (!call_var_customeradd.email_pattern.test(call_var_customeradd.email)) {
                var msg =
                    "{{ trans('message.Please enter a valid email address. Like : sales@mojoomla.com') }}";
                $('#errorlemail').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorlemail').html("");
                errro_msg = [];
            }

            //Password 
            if (call_var_customeradd.password == "") {
                var msg = "{{ trans('message.Password is required.') }}";
                $('#errorlpassword').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorlpassword').html("");
                errro_msg = [];
            }
            //Confirm Password 
            if (call_var_customeradd.password_confirmation == "") {
                var msg = "{{ trans('message.Confirm password is required.') }}";
                $('#errorlpassword_confirmation').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorlpassword_confirmation').html("");
                errro_msg = [];
            }

            //same Password and password_confirmation  
            if (call_var_customeradd.password != call_var_customeradd.password_confirmation) {
                var msg = "{{ trans('message.Password and Confirm Password does not match.') }}";
                $('#errorlpassword_confirmation').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorlpassword').html("");
                errro_msg = [];
            }

            //Mobile number 
            if (call_var_customeradd.mobile == "") {
                var msg = "{{ trans('message.Contact number is required.') }}";
                $('#errorlmobile').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorlmobile').html("");
                errro_msg = [];
            }
            if (!call_var_customeradd.mobile_pattern.test(call_var_customeradd.mobile)) {
                var msg =
                    "{{ trans('message.Contact number must be number, plus, minus and space only.') }}";
                $("#mobile").val("");
                $('#errorlmobile').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorlmobile').html("");
                errro_msg = [];
            }

            if (!call_var_customeradd.mobile.replace(/\s/g, '').length) {

                var msg = "{{ trans('message.Only blank space not allowed') }}";
                $("#mobile").val("");
                $('#errorlmobile').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorlmobile').html("");
                errro_msg = [];
            }

            //LandLine number
            if (call_var_customeradd.landlineno != "") {
                if (!call_var_customeradd.mobile_pattern.test(call_var_customeradd.landlineno)) {
                    var msg =
                        "{{ trans('message.Landline number must be number, plus, minus and space only.') }}";
                    $("#landlineno").val("");
                    $('#errorllandlineno').html(msg);
                    errro_msg.push(msg);
                    return false;
                } else if (!call_var_customeradd.lenghtLimit.test(call_var_customeradd
                        .landlineno)) {
                    var msg = "{{ trans('message.Landline number between 6 to 16 digits only') }}";
                    $("#landlineno").val("");
                    $('#errorllandlineno').html(msg);
                    errro_msg.push(msg);
                    return false;
                } else if (!call_var_customeradd.landlineno.replace(/\s/g, '').length) {

                    var msg = "{{ trans('message.Only blank space not allowed') }}";
                    $("#landlineno").val("");
                    $('#errorllandlineno').html(msg);
                    errro_msg.push(msg);
                    return false;
                } else {
                    $('#errorllandlineno').html("");
                    errro_msg = [];
                }
            } else {
                $('#errorllandlineno').html("");
                errro_msg = [];
            }

            //Country 
            if (call_var_customeradd.country_id == "") {
                var msg = "{{ trans('message.Country field is required.') }}";
                $('#errorlcountry_id').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorlcountry_id').html("");
                errro_msg = [];
            }
            //Address 
            if (call_var_customeradd.address == "") {
                var msg = "{{ trans('message.Address field is required.') }}";
                $('#errorladdress').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorladdress').html("");
                errro_msg = [];
            }

            if (!call_var_customeradd.address.replace(/\s/g, '').length) {

                var msg = "{{ trans('message.Only blank space not allowed') }}";
                $("#address").val("");
                $('#errorladdress').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorladdress').html("");
                errro_msg = [];
            }

            if (errro_msg == "") {
                var firstname = $('#firstname').val();
                var lastname = $('#lastname').val();
                var displayname = $('#displayname').val();
                var company_name = $('#company_name').val();
                var gender = $(".gender:checked").val();
                var dob = $("#datepicker").val();
                var email = $("#email").val();
                var password = $("#password").val();
                var mobile = $("#mobile").val();
                var landlineno = $("#landlineno").val();
                var image = $("#image").val();
                var country_id = $("#country_id option:selected").val();
                var state_id = $("#state_id option:selected").val();
                var city = $("#city option:selected").val();
                var address = $("#address").val();

                $.ajax({
                    type: 'POST',
                    url: '{!! url('service/customeradd') !!}',
                    data: new FormData(this),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    contentType: false,
                    cache: false,
                    processData: false,

                    success: function(data) {
                        $('.select_vhi').append('<option value=' + data['customerId'] +
                            '>' + data[
                                'customer_fullname'] + '</option>');

                        var firstname = $('#firstname').val('');
                        var lastname = $('#lastname').val('');
                        var displayname = $('#displayname').val('');
                        var gender = $(".gender:checked").val('');
                        var dob = $("#datepicker").val('');
                        var email = $("#email").val('');
                        var password = $("#password").val('');
                        var mobile = $("#mobile").val('');
                        var landlineno = $("#landlineno").val('');
                        var image = $("#image").val('');
                        var country_id = $("#country_id option:selected").val('');
                        var state_id = $("#state_id option:selected").val('');
                        var city = $("#city option:selected").val('');
                        var address = $("#address").val('');
                        var company_name = $("#company_name").val('');
                        $(".addcustomermsg").removeClass("hide");

                        $('.hidden_customer_id').val(data['customerId']);
                        $('#myModal').modal('toggle');
                    },
                    error: function(e) {
                        alert(msg100 + " " + e.responseText);
                        console.log(e);
                    }
                });
            }
        }));

        /*customer model state to city*/
        $('.select_country').change(function() {
            countryid = $(this).val();
            var url = $(this).attr('countryurl');
            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    countryid: countryid
                },
                success: function(response) {
                    $('.state_of_country').html(response);
                }
            });
        });


        $('body').on('change', '.state_of_country', function() {
            stateid = $(this).val();

            var url = $(this).attr('stateurl');
            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    stateid: stateid
                },
                success: function(response) {
                    $('.city_of_state').html(response);
                }
            });
        });

        /*vehical Type from brand*/
        $('.select_vehicaltype').change(function() {
            vehical_id = $(this).val();
            var url = $(this).attr('vehicalurl');

            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    vehical_id: vehical_id
                },
                success: function(response) {
                    $('.select_vehicalbrand').html(response);
                }
            });
        });

        /*images show in multiple in for loop*/
        $(".imageclass").click(function() {
            $(".classimage").empty();
        });


        function preview_images() {
            var total_file = document.getElementById("images").files.length;

            for (var i = 0; i < total_file; i++) {

                $('#image_preview').append(
                    "<div class='col-md-3 col-sm-3 col-xs-12' style='padding:5px;'><img class='uploadImage' src='" +
                    URL
                    .createObjectURL(event.target.files[i]) + "' width='100px' height='60px'> </div>");
            }
        }

        var msg100 = "{{ trans('message.An error occurred :') }}";

        /*vehicle add*/
        $('body').on('click', '.addvehicleservice', function(event) {

            function define_variable() {
                return {
                    vehical_id1: $("#vehical_id1").val(),
                    chasicno1: $("#chasicno1").val(),
                    vehicabrand1: $("#vehicabrand1").val(),
                    modelname1: $("#modelname1").val(),
                    engineno1: $("#engineno1").val(),
                    pp: $('#price1').val(),
                    pricePattern: /^[0-9]*$/,
                };
            }

            event.preventDefault();
            var call_var_vehicleadd = define_variable();
            var errro_msg = [];
            //Vehicle type
            if (call_var_vehicleadd.vehical_id1 == "") {
                var msg = "Vehical type is required";
                $('#errorlvehical_id1').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorlvehical_id1').html("");
                errro_msg = [];
            }

            //Vehical brand
            if (call_var_vehicleadd.vehicabrand1 == "") {
                var msg = "Vehical brand is required";
                $('#errorlvehicabrand1').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorlvehicabrand1').html("");
                errro_msg = [];
            }
            //Model name
            if (call_var_vehicleadd.modelname1 == "") {
                var msg = "Model name is required";
                $('#errorlmodelname1').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorlmodelname1').html("");
                errro_msg = [];
            }
            //Price
            if (call_var_vehicleadd.pp == "") {
                var msg = "Price is required";
                $('#ppe').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#ppe').html("");
                errro_msg = [];
            }

            if (!call_var_vehicleadd.pp.replace(/\s/g, '').length) {
                var msg = "Only blank space not allowed";
                $('#price1').val("");
                $('#ppe').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#ppe').html("");
                errro_msg = [];
            }

            if (!call_var_vehicleadd.pricePattern.test(call_var_vehicleadd.pp)) {
                var msg = "Only numeric data allowed";
                $('#price1').val("");
                $('#ppe').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#ppe').html("");
                errro_msg = [];
            }

            if (errro_msg == "") {
                var vehical_id1 = $('#vehical_id1').val();
                var chasicno1 = $('#chasicno1').val();
                var vehicabrand1 = $('#vehicabrand1').val();
                var modelyear1 = $('#modelyear1').val();
                var fueltype1 = $('#fueltype1').val();
                var gearno1 = $('#gearno1').val();
                var modelname1 = $('#modelname1').val();
                var price1 = $('#price1').val();
                var odometerreading1 = $('#odometerreading1').val();
                var dom1 = $('#dom1').val();
                var gearbox1 = $('#gearbox1').val();
                var gearboxno1 = $('#gearboxno1').val();
                var engineno1 = $('#engineno1').val();
                var enginesize1 = $('#enginesize1').val();
                var keyno1 = $('#keyno1').val();
                var engine1 = $('#engine1').val();
                var numberPlate = $('#number_plate').val();
                var customer_id = $('.hidden_customer_id').val();
                var branch_id_vehicle = $('.select_branch_vehicle').val();

                $.ajax({

                    type: 'get',
                    url: '{!! url('/service/vehicleadd') !!}',
                    data: {
                        vehical_id1: vehical_id1,
                        chasicno1: chasicno1,
                        vehicabrand1: vehicabrand1,
                        modelyear1: modelyear1,
                        fueltype1: fueltype1,
                        gearno1: gearno1,
                        modelname1: modelname1,
                        price1: price1,
                        odometerreading1: odometerreading1,
                        dom1: dom1,
                        gearbox1: gearbox1,
                        gearboxno1: gearboxno1,
                        engineno1: engineno1,
                        enginesize1: enginesize1,
                        keyno1: keyno1,
                        engine1: engine1,
                        numberPlate: numberPlate,
                        customer_id: customer_id,
                        branch_id_vehicle: branch_id_vehicle
                    },
                    success: function(data) {

                        var modelname1 = $('#modelname1').val();

                        $('.modelnameappend').append('<option value=' + data + '>' +
                            modelname1 + '</option>');
                        var vehical_id1 = $('#vehical_id1').val('');
                        var chasicno1 = $('#chasicno1').val('');
                        var vehicabrand1 = $('#vehicabrand1').val('');
                        var modelyear1 = $('#modelyear1').val('');
                        var fueltype1 = $('#fueltype1').val('');
                        var gearno1 = $('#gearno1').val('');
                        var modelname1 = $('#modelname1').val('');
                        var price1 = $('#price1').val('');
                        var odometerreading1 = $('#odometerreading1').val('');
                        var dom1 = $('#dom1').val('');
                        var gearbox1 = $('#gearbox1').val('');
                        var gearboxno1 = $('#gearboxno1').val('');
                        var engineno1 = $('#engineno1').val('');
                        var enginesize1 = $('#enginesize1').val('');
                        var keyno1 = $('#keyno1').val('');
                        var engine1 = $('#engine1').val('');
                        var number_plate = $('#number_plate').val('');
                        $(".addvehiclemsg").removeClass("hide");
                        $('#vehiclemymodel').modal('toggle');

                    },
                    error: function(e) {
                        alert(msg31 + " " + e.responseText);
                        console.log(e);
                    }
                });
            }
        });


        var msg10 = "{{ trans('message.Please enter only alphanumeric data') }}";
        var msg11 = "{{ trans('message.Only blank space not allowed') }}";
        var msg12 = "{{ trans('message.This Record is Duplicate') }}";

        /*Add Vehicle Model*/
        $('.vehi_model_add').click(function() {
            var model_name = $('.vehi_modal_name').val();
            var model_url = $(this).attr('modelurl');
            var brand_id = $('.vehi_brand_id').val();

            var msg9 = "{{ trans('message.Please enter model name') }}";

            function define_variable() {
                return {
                    vehicle_model_value: $('.vehi_modal_name').val(),
                    vehicle_model_pattern: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]+$/,
                    vehicle_model_pattern2: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]*$/
                };
            }

            var call_var_vehiclemodeladd = define_variable();

            if (model_name == "") {
                swal({
                    title: msg9,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });
            } else if (!call_var_vehiclemodeladd.vehicle_model_pattern.test(call_var_vehiclemodeladd
                    .vehicle_model_value)) {
                $('.vehi_modal_name').val("");
                swal({
                    title: msg14,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });
            } else if (!model_name.replace(/\s/g, '').length) {
                $('.vehi_modal_name').val("");
                swal({
                    title: msg15,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });
            } else if (!call_var_vehiclemodeladd.vehicle_model_pattern2.test(call_var_vehiclemodeladd
                    .vehicle_model_value)) {
                $('.vehi_modal_name').val("");
                swal({
                    title: msg34,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });
            } else {
                $.ajax({
                    type: 'GET',
                    url: model_url,
                    data: {
                        model_name: model_name,
                        brand_id: brand_id
                    },

                    beforeSend: function() {
                        $(".vehi_model_add").prop('disabled', true);
                    },

                    success: function(data) {
                        var newd = $.trim(data);
                        var classname = 'mod-' + newd;

                        if (newd == '01') {
                            swal({
                                title: msg16,
                                cancelButtonColor: '#C1C1C1',
                                buttons: {
                                    cancel: msg35,
                                },
                                dangerMode: true,
                            });
                        } else {
                            $('.vehi_model_class').append('<tr class=" data_color_name row mx-1 ' + classname +
                                '"><td class="text-start col-6">' +
                                model_name +
                                '</td><td class="text-end col-6"><button type="button" modelid=' +
                                data +
                                ' deletemodel="{!! url('/vehicle/vehicle_model_delete') !!}" class="btn btn-danger text-white border-0 modeldeletes"><i class="fa fa-trash" aria-hidden="true"></i></button></a></td><tr>'
                            );
                            $('.model_addname').append("<option value='" + model_name +
                                "'>" + model_name +
                                "</option>");
                            $('.vehi_modal_name').val('');
                        }

                        $(".vehi_model_add").prop('disabled', false);
                        return false;
                    },
                });
            }
        });

        $('body').on('click', '.modeldeletes', function() {
            var mod_del_id = $(this).attr('modelid');
            var del_url = $(this).attr('deletemodel');

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
                        url: del_url,
                        data: {
                            mod_del_id: mod_del_id
                        },
                        success: function(data) {
                            $('.mod-' + mod_del_id).remove();
                            $(".color_name_data option[value=" + mod_del_id + "]")
                                .remove();
                            swal({
                                title: msg5,
                                text: msg6,
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

        /*vehicle type*/
        $('.vehicaltypeadd').click(function() {

            var vehical_type = $('.vehical_type').val();
            var url = $(this).attr('url');

            var msg13 = "{{ trans('message.Please enter vehicle type') }}";
            var msg14 = "{{ trans('message.Please enter only alphanumeric data') }}";
            var msg15 = "{{ trans('message.Only blank space not allowed') }}";
            var msg16 = "{{ trans('message.This Record is Duplicate') }}";

            function define_variable() {
                return {
                    vehicle_type_value: $('.vehical_type').val(),
                    vehicle_type_pattern: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]+$/,
                    vehicle_type_pattern2: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]*$/
                };
            }

            var call_var_vehicletypeadd = define_variable();

            if (vehical_type == "") {
                swal({
                    title: msg13,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });
            } else if (!call_var_vehicletypeadd.vehicle_type_pattern.test(call_var_vehicletypeadd
                    .vehicle_type_value)) {
                $('.vehical_type').val("");
                swal({
                    title: msg14,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });
            } else if (!vehical_type.replace(/\s/g, '').length) {
                $('.vehical_type').val("");
                swal({
                    title: msg15,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });
            } else if (!call_var_vehicletypeadd.vehicle_type_pattern2.test(call_var_vehicletypeadd
                    .vehicle_type_value)) {
                $('.vehical_type').val("");
                swal({
                    title: msg34,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });
            } else {
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {
                        vehical_type: vehical_type
                    },
                    success: function(data) {
                        var newd = $.trim(data);
                        var classname = 'del-' + newd;

                        if (newd == '01') {
                            swal({
                                title: msg16,
                                cancelButtonColor: '#C1C1C1',
                                buttons: {
                                    cancel: msg35,
                                },
                                dangerMode: true,
                            });
                        } else {
                            $('.vehical_type_class').append('<tr class="' + classname +
                                ' data_vehicle_type_name"><td class="text-center">' +
                                vehical_type +
                                '</td><td class="text-center"><button type="button" vehicletypeid=' +
                                data +
                                ' deletevehical="{!! url(' / vehicle / vehicaltypedelete ') !!}" class="btn btn-danger btn-sm deletevehicletype fa fa-trash"></button></a></td><tr>'
                            );

                            $('.select_vehicaltype').append('<option value=' + data + '>' +
                                vehical_type + '</option>');

                            $('.vehical_type').val('');

                            $('.vehical_id').append('<option value=' + data + '>' +
                                vehical_type + '</option>');

                            $('.vehical_type').val('');
                        }
                    },
                });
            }
        });

        /*vehical Type delete*/
        $('body').on('click', '.deletevehicletype', function() {

            var vtypeid = $(this).attr('vehicletypeid');
            var url = $(this).attr('deletevehical');

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
                            vtypeid: vtypeid
                        },
                        success: function(data) {
                            $('.del-' + vtypeid).remove();
                            $(".color_name_data option[value=" + vtypeid + "]")
                                .remove();
                            swal({
                                title: msg5,
                                text: msg6,
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


        /*vehical brand*/
        $('.vehicalbrandadd').click(function() {
            var vehical_id = $('.vehical_id').val();
            var vehical_brand = $('.vehical_brand').val();
            var url = $(this).attr('vehiclebrandurl');

            var msg17 = "{{ trans('message.Please first select vehicle type') }}";
            var msg18 = "{{ trans('message.Please enter vehicle brand') }}";
            var msg19 = "{{ trans('message.Please enter only alphanumeric data') }}";
            var msg20 = "{{ trans('message.Only blank space not allowed') }}";
            var msg21 = "{{ trans('message.This Record is Duplicate') }}";

            function define_variable() {
                return {
                    vehicle_brand_value: $('.vehical_brand').val(),
                    vehicle_brand_pattern: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]+$/,
                    vehicle_brand_pattern2: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]*$/
                };
            }

            var call_var_vehiclebrandadd = define_variable();

            if ($("#vehicleTypeSelect")[0].selectedIndex <= 0) {

                swal({
                    title: msg17,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });
            } else {
                if (vehical_brand == "") {
                    swal({
                        title: msg18,
                        cancelButtonColor: '#C1C1C1',
                        buttons: {
                            cancel: msg35,
                        },
                        dangerMode: true,
                    });
                } else if (!call_var_vehiclebrandadd.vehicle_brand_pattern.test(call_var_vehiclebrandadd
                        .vehicle_brand_value)) {
                    $('.vehical_brand').val("");
                    swal({
                        title: msg19,
                        cancelButtonColor: '#C1C1C1',
                        buttons: {
                            cancel: msg35,
                        },
                        dangerMode: true,
                    });

                } else if (!vehical_brand.replace(/\s/g, '').length) {
                    // var str = "    ";
                    $('.vehical_brand').val("");
                    swal({
                        title: msg20,
                        cancelButtonColor: '#C1C1C1',
                        buttons: {
                            cancel: msg35,
                        },
                        dangerMode: true,
                    });
                } else if (!call_var_vehiclebrandadd.vehicle_brand_pattern2.test(
                        call_var_vehiclebrandadd
                        .vehicle_brand_value)) {
                    $('.vehical_brand').val("");
                    swal({
                        title: msg34,
                        cancelButtonColor: '#C1C1C1',
                        buttons: {
                            cancel: msg35,
                        },
                        dangerMode: true,
                    });
                } else {
                    $.ajax({
                        type: 'GET',
                        url: url,
                        data: {
                            vehical_id: vehical_id,
                            vehical_brand: vehical_brand
                        },
                        success: function(data) {
                            var newd = $.trim(data);
                            var classname = 'del-' + newd;

                            if (newd == "01") {
                                swal({
                                    title: msg21,
                                    cancelButtonColor: '#C1C1C1',
                                    buttons: {
                                        cancel: msg35,
                                    },
                                    dangerMode: true,
                                });
                            } else {
                                $('.vehical_brand_class').append('<tr class="' + classname +
                                    ' data_vehicle_brand_name"><td class="text-center">' +
                                    vehical_brand +
                                    '</td><td class="text-center"><button type="button" brandid=' +
                                    data +
                                    'deletevehicalbrand="{!! url('vehicle/vehicalbranddelete') !!}" class="btn btn-danger btn-sm deletevehiclebrands fa fa-trash"></button></a></td><tr>'
                                );

                                $('.select_vehicalbrand').append('<option value=' + data +
                                    '>' + vehical_brand +
                                    '</option>');

                                $('.vehical_brand').val('');
                            }
                        },
                    });
                }
            }
        });


        /*vehical brand delete*/
        $('body').on('click', '.deletevehiclebrands', function() {
            var vbrandid = $(this).attr('brandid');
            var url = $(this).attr('deletevehicalbrand');

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
                            vbrandid: vbrandid
                        },
                        success: function(data) {
                            $('.del-' + vbrandid).remove();
                            $(".color_name_data option[value=" + vbrandid + "]")
                                .remove();
                            swal({
                                title: msg5,
                                text: msg6,
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



        var today = new Date();
        var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
        var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
        var dateTime = date + ' ' + time;

        $('.datepicker').datetimepicker({
            format: "<?php echo getDatepicker(); ?>",
            todayBtn: true,
            autoclose: 1,
            minView: 2,
            endDate: new Date(),
            language: "{{ getLangCode() }}",
        });



        $(".datepickercustmore").datetimepicker({
            format: "<?php echo getDatepicker(); ?>",
            minDate: new Date(),
            todayBtn: true,
            autoclose: 1,
            minView: 2,
            language: "{{ getLangCode() }}",
        });
        $('.datepicker2').datetimepicker({
            format: "<?php echo getDateTimepicker(); ?>",
            todayBtn: true,
            autoclose: 1,
            startDate: new Date(),
            language: "{{ getLangCode() }}",
        });

        $('.datepicker1').datetimepicker({
            format: "<?php echo getDatepicker(); ?>",
            todayBtn: true,
            autoclose: 1,
            minView: 2,
            endDate: new Date(),
            language: "{{ getLangCode() }}",
        });
        $('.myDatepicker2').datetimepicker({
            format: "yyyy",
            endDate: new Date(),
            minView: 4,
            autoclose: true,
            startView: 4,
            language: "{{ getLangCode() }}",
        });

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



        var msg1 = "{{ trans('message.Alert') }}";
        var msg2 = "{{ trans('message.Please select customer!') }}";

        $('body').on('change', '.select_vhi', function() {

            var url = $(this).attr('cus_url');
            var cus_id = $(this).val();
            var modelnms = $(this).val();

            $.ajax({

                type: 'GET',
                url: url,
                data: {
                    cus_id: cus_id,
                    modelnms: modelnms
                },
                success: function(response) {

                    $('.modelnms').remove();
                    $('#vhi').append(response);
                }

            });
        });


        $('body').on('click', '#vhi', function() {

            var cus_id = $('.select_vhi').val();

            if (cus_id == "") {

                swal({
                    title: msg1,
                    text: msg2,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });

                return false;
            }
        });

        /*If vehicle add when customer is selected otherwise not add vehicle*/
        $('body').on('click', '.vehiclemodel', function() {

            var cus_id = $('.select_vhi').val();

            if (cus_id == "") {
                swal({
                    title: msg1,
                    text: msg2,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });

                $('#vehiclemymodel').modal('toggle');
                return false;

            } else {
                $('#vehiclemymodel').show();
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

        /*Fuel type*/
        $('.fueltypeadd').click(function() {

            var fuel_type = $('.fuel_type').val();
            var url = $(this).attr('fuelurl');

            var msg21 = "{{ trans('message.Please enter fuel type') }}";
            var msg22 = "{{ trans('message.Please enter only alphanumeric data') }}";
            var msg23 = "{{ trans('message.Only blank space not allowed') }}";
            var msg24 = "{{ trans('message.This Record is Duplicate') }}";
            var msg25 = "{{ trans('message.An error occurred :') }}";

            function define_variable() {
                return {
                    vehicle_fuel_value: $('.fuel_type').val(),
                    vehicle_fuel_pattern: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]+$/,
                    vehicle_fuel_pattern2: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]*$/
                };
            }

            var call_var_vehiclefueladd = define_variable();

            if (fuel_type == "") {
                swal({
                    title: msg21,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });
            } else if (!call_var_vehiclefueladd.vehicle_fuel_pattern.test(call_var_vehiclefueladd
                    .vehicle_fuel_value)) {
                $('.fuel_type').val("");
                swal({
                    title: msg22,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });

            } else if (!fuel_type.replace(/\s/g, '').length) {
                // var str = "    ";
                $('.fuel_type').val("");
                swal({
                    title: msg23,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });
            } else if (!call_var_vehiclefueladd.vehicle_fuel_pattern2.test(call_var_vehiclefueladd
                    .vehicle_fuel_value)) {
                $('.fuel_type').val("");
                swal({
                    title: msg34,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });

            } else {
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {
                        fuel_type: fuel_type
                    },
                    success: function(data) {
                        var newd = $.trim(data);
                        var classname = 'del-' + newd;

                        if (newd == '01') {
                            swal({
                                title: msg24,
                                cancelButtonColor: '#C1C1C1',
                                buttons: {
                                    cancel: msg35,
                                },
                                dangerMode: true,
                            });
                        } else {
                            $('.fuel_type_class').append('<tr class="' + classname +
                                ' data_of_type"><td class="text-center">' +
                                fuel_type +
                                '</td><td class="text-center"><button type="button" fuelid=' +
                                data +
                                ' deletefuel="{!! url(' / vehicle / fueltypedelete ') !!}" class="btn btn-danger btn-sm fueldeletes fa fa-trash"></button></a></td><tr>'
                            );

                            $('.select_fueltype').append('<option value=' + data + '>' +
                                fuel_type + '</option>');

                            $('.fuel_type').val('');
                        }
                    },
                });
            }
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
        $('#cust_id').on('change', function() {

            var supplierValue = $('select[name=Customername]').val();

            if (supplierValue != null) {
                $('#cust_id-error').css({
                    "display": "none"
                });

                /*If select customer after customer id assigned to vehicle add form customer_id inputbox*/
                $('.hidden_customer_id').val(supplierValue);
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
        var k = 0;
        $('.observation_Plus3').click(function() {
            k = k + 1;
            if (k % 2 != 0) {
                $(this).parent().find(".fa-plus:first").removeClass("fa-plus").addClass(
                    "fa-minus");

            } else {
                $(this).parent().find(".fa-minus:first").removeClass("fa-minus").addClass(
                    "fa-plus");
            }
        });
        var j = 0;
        $('.observation_Plus4').click(function() {
            j = j + 1;
            if (j % 2 != 0) {
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
        $('.observation_Plus6').click(function() {
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


        /*If firstly enter any whitespace then clear textbox*/
        $('body').on('keyup', '#firstname', function() {

            var firstname = $(this).val();

            if (!firstname.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '#lastname', function() {

            var lastname = $(this).val();

            if (!lastname.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '#displayname', function() {

            var displayname = $(this).val();

            if (!displayname.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '#company_name', function() {

            var company_name = $(this).val();

            if (!company_name.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '#mobile', function() {

            var mobile = $(this).val();

            if (!mobile.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '#landlineno', function() {

            var landlineno = $(this).val();

            if (!landlineno.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '#address', function() {

            var address = $(this).val();

            if (!address.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '.vehical_type', function() {

            var vehical_typeVal = $(this).val();

            if (!vehical_typeVal.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '.vehical_brand', function() {

            var vehical_brandVal = $(this).val();

            if (!vehical_brandVal.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '.fuel_type', function() {

            var fuel_typeVal = $(this).val();

            if (!fuel_typeVal.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '.vehi_modal_name', function() {

            var vehi_modal_nameVal = $(this).val();

            if (!vehi_modal_nameVal.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });


        $('body').on('keyup', '#chasicno1', function() {

            var chasicno1 = $(this).val();

            if (!chasicno1.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '#gearno1', function() {

            var gearno1 = $(this).val();

            if (!gearno1.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '#price1', function() {

            var price1 = $(this).val();

            if (!price1.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '#odometerreading1', function() {

            var odometerreading1 = $(this).val();

            if (!odometerreading1.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '#gearbox1', function() {

            var gearbox1 = $(this).val();

            if (!gearbox1.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '#gearboxno1', function() {

            var vehi_modal_nameVal = $(this).val();

            if (!vehi_modal_nameVal.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '#engineno1', function() {

            var engineno1 = $(this).val();

            if (!engineno1.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '#enginesize1', function() {

            var enginesize1 = $(this).val();

            if (!enginesize1.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '#engine1', function() {

            var engine1 = $(this).val();

            if (!engine1.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '#keyno1', function() {

            var keyno1 = $(this).val();

            if (!keyno1.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '#number_plate', function() {

            var number_plate = $(this).val();

            if (!number_plate.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '.titalQuotation', function() {

            var titalQuotation = $(this).val();

            if (!titalQuotation.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '#details', function() {

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
        $('body').on('click', '.quotationSubmitButton', function(e) {
            $('#QuotationAdd-Form input, #QuotationAdd-Form select, #QuotationAdd-Form textarea').each(

                function(index) {
                    var input = $(this);

                    if (input.attr('name') == "Customername" || input.attr('name') ==
                        "vehicalname" || input.attr(
                            'name') == "date" || input.attr('name') == "repair_cat" || input.attr(
                            'name') ==
                        "service_type") {
                        if (input.val() == "") {
                            return false;
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
                                $('.error_customfield_main_div_' + ids).removeClass('has-error');
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
        $('body').on('click', '.fueldeletes', function() {
            var msg3 = "{{ trans('message.Cancel') }}";
            var msg4 = "{{ trans('message.Yes, delete!') }}";
            var msg5 = "{{ trans('message.Done!') }}";
            var msg6 = "{{ trans('message.It was succesfully deleted!') }}";
            var msg7 = "{{ trans('message.Cancelled') }}";
            var msg8 = "{{ trans('message.Your data is safe') }}";
            var fueltypeid = $(this).attr('fuelid');
            var url = $(this).attr('deletefuel');
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
                            fueltypeid: fueltypeid
                        },
                        success: function(data) {
                            $('.del-' + fueltypeid).remove();
                            $(".color_name_data option[value=" + fueltypeid + "]")
                                .remove();
                            swal({
                                title: msg5,
                                text: msg6,
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
                                repair_category_name + '</option>');

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
                            // alert(colorid)
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
        Array.from(document.getElementsByClassName('showmodal')).forEach((e) => {
            e.addEventListener('click', function(element) {
                element.preventDefault();
                if (e.hasAttribute('data-show-modal')) {
                    showModal(e.getAttribute('data-show-modal'));
                }
            });
        });

        // Show modal dialog
        function showModal(modal) {
            const mid = document.getElementById(modal);
            let myModal = new bootstrap.Modal(mid);
            myModal.show();
        }
        $('body').on('change', '.select_vehicaltype', function() {
            var vehicle_type = $('.select_vehicaltype').val();

            if (vehicle_type !== "") {
                $('#errorlvehical_id1').css({
                    "display": "none"
                });
            } else {
                $('#errorlvehical_id1').css({
                    "display": ""
                });
            }
        });
        $('body').on('change', '.model_addname', function() {
            var model_name = $('.model_addname').val();

            if (model_name !== "") {
                $('#errorlmodelname1').css({
                    "display": "none"
                });
            } else {
                $('#errorlmodelname1').css({
                    "display": ""
                });
            }
        });
        $('body').on('change', '#price1', function() {
            var price = $('#price1').val();

            if (price !== "") {
                $('#ppe').css({
                    "display": "none"
                });
            } else {
                $('#ppe').css({
                    "display": ""
                });
            }
        });
        $('body').on('click', '.addcustomer', function(e) {
            var fname = $('#firstname').val();
            if (fname !== "") {
                $('#errorlfirstname').css({
                    "display": "none"
                });
            } else {
                $('#errorlfirstname').css({
                    "display": ""
                });
            }
            var lname = $('#lastname').val();
            if (lname !== "") {
                $('#errorllastname').css({
                    "display": "none"
                });
            } else {
                $('#errorllastname').css({
                    "display": ""
                });
            }
            var email = $('#email').val();
            if (email !== "") {
                $('#errorlemail').css({
                    "display": "none"
                });
            } else {
                $('#errorlemail').css({
                    "display": ""
                });
            }
            var password = $('#password').val();
            if (password !== "") {
                $('#errorlpassword').css({
                    "display": "none"
                });
            } else {
                $('#errorlpassword').css({
                    "display": ""
                });
            }
            var password_confirmation = $('#password_confirmation').val();
            if (password_confirmation !== "") {
                $('#errorlpassword_confirmation').css({
                    "display": "none"
                });
            } else {
                $('#errorlpassword_confirmation').css({
                    "display": ""
                });
            }
            var mobile = $('#mobile').val();
            if (mobile !== "") {
                $('#errorlmobile').css({
                    "display": "none"
                });
            } else {
                $('#errorlmobile').css({
                    "display": ""
                });
            }
            var country_id = $('#country_id').val();
            if (country_id !== "") {
                $('#errorlcountry_id').css({
                    "display": "none"
                });
            } else {
                $('#errorlcountry_id').css({
                    "display": ""
                });
            }
            var address = $('#address').val();
            if (address !== "") {
                $('#errorladdress').css({
                    "display": "none"
                });
            } else {
                $('#errorladdress').css({
                    "display": ""
                });
            }
        });
        $('body').on('change', '#firstname', function() {
            var fname = $('#firstname').val();
            if (fname !== "") {
                $('#errorlfirstname').css({
                    "display": "none"
                });
            } else {
                $('#errorlfirstname').css({
                    "display": ""
                });
            }
        });
        $('body').on('change', '#lastname', function() {
            var lastname = $('#lastname').val();
            if (lastname !== "") {
                $('#errorllastname').css({
                    "display": "none"
                });
            } else {
                $('#errorllastname').css({
                    "display": ""
                });
            }
        });
        $('body').on('change', '#email', function() {
            var email = $('#email').val();
            if (email !== "") {
                $('#errorlemail').css({
                    "display": "none"
                });
            } else {
                $('#errorlemail').css({
                    "display": ""
                });
            }
        });
        $('body').on('change', '#country_id', function() {
            var country_id = $('#country_id').val();
            if (country_id !== "") {
                $('#errorlcountry_id').css({
                    "display": "none"
                });
            } else {
                $('#errorlcountry_id').css({
                    "display": ""
                });
            }
        });
        $('body').on('change', '#address', function() {
            var address = $('#address').val();
            if (address !== "") {
                $('#errorladdress').css({
                    "display": "none"
                });
            } else {
                $('#errorladdress').css({
                    "display": ""
                });
            }
        });
        $('body').on('change', '#password', function() {
            var password = $('#password').val();
            if (password !== "") {
                $('#errorlpassword').css({
                    "display": "none"
                });
            } else {
                $('#errorlpassword').css({
                    "display": ""
                });
            }
            if (password.length > 6) {
                $('#errorlpassword_length').css({
                    "display": "none"
                });
            } else {
                $('#errorlpassword_length').css({
                    "display": ""
                });
            }
        });
        $('body').on('change', '#mobile', function() {
            var mobile = $('#mobile').val();
            if (mobile !== "") {
                $('#errorlmobile').css({
                    "display": "none"
                });
            } else {
                $('#errorlmobile').css({
                    "display": ""
                });
            }
            if (mobile.length > 6) {
                $('#errorlmobile_length').css({
                    "display": "none"
                });
            } else {
                $('#errorlmobile_length').css({
                    "display": ""
                });
            }
        });
        $('body').on('keyup', '#password_confirmation', function() {
            console.log("confirm password called");
            var password = $('#password').val();
            var password_confirmation = $(this).val(); // Use $(this) to get the value of the current element

            // Hide the error message for password_confirmation if it's not empty
            if (password_confirmation !== "") {
                $('#errorlpassword_confirmation').css("display", "none");
            } else {
                $('#errorlpassword_confirmation').css("display", "");
            }

            // Check if passwords match and hide the error message accordingly
            if (password === password_confirmation) {
                $('#errorlpassword_confirmation_same').css("display", "none");
            } else {
                $('#errorlpassword_confirmation_same').css("display", "");
            }
        });

        function handleCustomerChange() {
            var url = $('.select_vhi').attr('cus_url');
            var cus_id = $('.select_vhi').val();
            var modelnms = $('.select_vhi').val();

            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    cus_id: cus_id,
                    modelnms: modelnms
                },
                success: function(response) {
                    $('.modelnms').remove();
                    $('#vhi').append(response);
                }
            });
        }

        //For customer vehicle dropdown
        handleCustomerChange();
    });
</script>
=======

>>>>>>> 723c46cc149b3e892bfe937a70101070799b9d16
<script>
    var msg35 = "{{ trans('message.OK') }}";
    $(document).ready(function() {

        $('.modal').on('show.bs.modal', function () {
            // Add blur class to all modals except the currently shown modal
            $('.modal').not(this).addClass('blur-modal');
        });

        $('.modal').on('hidden.bs.modal', function () {
            // Remove blur class from all modals
            $('.modal').removeClass('blur-modal');
        });


        var msg100 = "{{ trans('message.An error occurred :') }}";

        $("#formcustomer").on('submit', (function(event) {

            function define_variable() {
                return {
                    firstname: $("#firstname").val(),
                    email: $("#email").val(),
                    password: $("#password").val(),
                    password_confirmation: $("#password_confirmation").val(),
                    mobile: $("#mobile").val(),
                    country_id: $("#country_id option:selected").val(),
                    state_id: $("#state_id option:selected").val(),
                    city: $("#city option:selected").val(),
                    address: $("#address").val(),
                    name_pattern: /^[a-zA-Z\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]+$/,
                    name_pattern2: /^[a-zA-Z\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]*$/,
                    company_patt: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]*$/,
                    lenghtLimit: /^[0-9]{6,16}$/,
                    mobile_pattern: /^[- +()]*[0-9][- +()0-9]*$/,
                    email_pattern: /^([a-zA-Z0-9_\.\-\+\'])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/
                };
            }

            event.preventDefault();
            var call_var_customeradd = define_variable();
            var errro_msg = [];
            //first name
            if (call_var_customeradd.firstname == "") {
                var msg = "{{ trans('message.First name is required.') }}";
                $('#errorlfirstname').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorlfirstname').html("");
                errro_msg = [];
            }

            if (!call_var_customeradd.name_pattern.test(call_var_customeradd.firstname)) {
                var msg = "{{ trans('message.First name is only alphabets and space.') }}";
                $("#firstname").val("");
                $('#errorlfirstname').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorlfirstname').html("");
                errro_msg = [];
            }

            if (!call_var_customeradd.firstname.replace(/\s/g, '').length) {

                var msg = "{{ trans('message.Only blank space not allowed') }}";
                $("#firstname").val("");
                $('#errorlfirstname').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorlfirstname').html("");
                errro_msg = [];
            }

            if (!call_var_customeradd.name_pattern2.test(call_var_customeradd.firstname)) {
                var msg = "{{ trans('message.At first position only alphabets are allowed.') }}";
                $("#firstname").val("");
                $('#errorlfirstname').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorlfirstname').html("");
                errro_msg = [];
            }

            
            

            

            

            

            //Email 
            if (call_var_customeradd.email == "") {
                var msg = "{{ trans('message.Email is required.') }}";
                $('#errorlemail').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorlemail').html("");
                errro_msg = [];
            }

            if (!call_var_customeradd.email.replace(/\s/g, '').length) {

                var msg = "{{ trans('message.Only blank space not allowed') }}";
                $("#email").val("");
                $('#errorlemail').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorlfirstname').html("");
                errro_msg = [];
            }

            if (!call_var_customeradd.email_pattern.test(call_var_customeradd.email)) {
                var msg =
                    "{{ trans('message.Please enter a valid email address. Like : sales@mojoomla.com') }}";
                $('#errorlemail').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorlemail').html("");
                errro_msg = [];
            }

            //Password 
            if (call_var_customeradd.password == "") {
                var msg = "{{ trans('message.Password is required.') }}";
                $('#errorlpassword').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorlpassword').html("");
                errro_msg = [];
            }
            //Confirm Password 
            if (call_var_customeradd.password_confirmation == "") {
                var msg = "{{ trans('message.Confirm password is required.') }}";
                $('#errorlpassword_confirmation').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorlpassword_confirmation').html("");
                errro_msg = [];
            }

            //same Password and password_confirmation  
            if (call_var_customeradd.password != call_var_customeradd.password_confirmation) {
                var msg = "{{ trans('message.Password and Confirm Password does not match.') }}";
                $('#errorlpassword_confirmation').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorlpassword').html("");
                errro_msg = [];
            }

            //Mobile number 
            if (call_var_customeradd.mobile == "") {
                var msg = "{{ trans('message.Contact number is required.') }}";
                $('#errorlmobile').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorlmobile').html("");
                errro_msg = [];
            }
            if (!call_var_customeradd.mobile_pattern.test(call_var_customeradd.mobile)) {
                var msg =
                    "{{ trans('message.Contact number must be number, plus, minus and space only.') }}";
                $("#mobile").val("");
                $('#errorlmobile').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorlmobile').html("");
                errro_msg = [];
            }

            if (!call_var_customeradd.mobile.replace(/\s/g, '').length) {

                var msg = "{{ trans('message.Only blank space not allowed') }}";
                $("#mobile").val("");
                $('#errorlmobile').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorlmobile').html("");
                errro_msg = [];
            }

            
            //Country 
            if (call_var_customeradd.country_id == "") {
                var msg = "{{ trans('message.Country field is required.') }}";
                $('#errorlcountry_id').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorlcountry_id').html("");
                errro_msg = [];
            }
            //Address 
            if (call_var_customeradd.address == "") {
                var msg = "{{ trans('message.Address field is required.') }}";
                $('#errorladdress').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorladdress').html("");
                errro_msg = [];
            }

            if (!call_var_customeradd.address.replace(/\s/g, '').length) {

                var msg = "{{ trans('message.Only blank space not allowed') }}";
                $("#address").val("");
                $('#errorladdress').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorladdress').html("");
                errro_msg = [];
            }

            if (errro_msg == "") {
                var firstname = $('#firstname').val();
                var gender = $(".gender:checked").val();
                var dob = $("#datepicker").val();
                var email = $("#email").val();
                var password = $("#password").val();
                var mobile = $("#mobile").val();
                var country_id = $("#country_id option:selected").val();
                var state_id = $("#state_id option:selected").val();
                var city = $("#city option:selected").val();
                var address = $("#address").val();

                $.ajax({
                    type: 'POST',
                    url: '{!! url('service/customeradd') !!}',
                    data: new FormData(this),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    contentType: false,
                    cache: false,
                    processData: false,

                    success: function(data) {
                        $('.select_vhi').append('<option value=' + data['customerId'] +
                            '>' + data[
                                'customer_fullname'] + '</option>');

                        var firstname = $('#firstname').val('');
                        var gender = $(".gender:checked").val('');
                        var dob = $("#datepicker").val('');
                        var email = $("#email").val('');
                        var password = $("#password").val('');
                        var mobile = $("#mobile").val('');
                        var country_id = $("#country_id option:selected").val('');
                        var state_id = $("#state_id option:selected").val('');
                        var city = $("#city option:selected").val('');
                        var address = $("#address").val('');
                        $(".addcustomermsg").removeClass("hide");

                        $('.hidden_customer_id').val(data['customerId']);
                        $('#myModal').modal('toggle');
                    },
                    error: function(e) {
                        alert(msg100 + " " + e.responseText);
                        console.log(e);
                    }
                });
            }
        }));

        /*customer model state to city*/
        $('.select_country').change(function() {
            countryid = $(this).val();
            var url = $(this).attr('countryurl');
            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    countryid: countryid
                },
                success: function(response) {
                    $('.state_of_country').html(response);
                }
            });
        });


        $('body').on('change', '.state_of_country', function() {
            stateid = $(this).val();

            var url = $(this).attr('stateurl');
            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    stateid: stateid
                },
                success: function(response) {
                    $('.city_of_state').html(response);
                }
            });
        });

        /*vehical Type from brand*/
        $('.select_vehicaltype').change(function() {
            vehical_id = $(this).val();
            var url = $(this).attr('vehicalurl');

            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    vehical_id: vehical_id
                },
                success: function(response) {
                    $('.select_vehicalbrand').html(response);
                }
            });
        });

        

        var msg100 = "{{ trans('message.An error occurred :') }}";

        /*vehicle add*/
        $('body').on('click', '.addvehicleservice', function(event) {

            function define_variable() {
                return {
                    vehical_id1: $("#vehical_id1").val(),
                    chasicno1: $("#chasicno1").val(),
                    vehicabrand1: $("#vehicabrand1").val(),
                    modelname1: $("#modelname1").val(),
                    engineno1: $("#engineno1").val(),
                    pp: $('#price1').val(),
                    pricePattern: /^[0-9]*$/,
                };
            }

            event.preventDefault();
            var call_var_vehicleadd = define_variable();
            var errro_msg = [];
            //Vehicle type
            if (call_var_vehicleadd.vehical_id1 == "") {
                var msg = "Vehical type is required";
                $('#errorlvehical_id1').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorlvehical_id1').html("");
                errro_msg = [];
            }

            //Vehical brand
            if (call_var_vehicleadd.vehicabrand1 == "") {
                var msg = "Vehical brand is required";
                $('#errorlvehicabrand1').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorlvehicabrand1').html("");
                errro_msg = [];
            }
            //Model name
            if (call_var_vehicleadd.modelname1 == "") {
                var msg = "Model name is required";
                $('#errorlmodelname1').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#errorlmodelname1').html("");
                errro_msg = [];
            }
            //Price
            if (call_var_vehicleadd.pp == "") {
                var msg = "Price is required";
                $('#ppe').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#ppe').html("");
                errro_msg = [];
            }

            if (!call_var_vehicleadd.pp.replace(/\s/g, '').length) {
                var msg = "Only blank space not allowed";
                $('#price1').val("");
                $('#ppe').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#ppe').html("");
                errro_msg = [];
            }

            if (!call_var_vehicleadd.pricePattern.test(call_var_vehicleadd.pp)) {
                var msg = "Only numeric data allowed";
                $('#price1').val("");
                $('#ppe').html(msg);
                errro_msg.push(msg);
                return false;
            } else {
                $('#ppe').html("");
                errro_msg = [];
            }

            if (errro_msg == "") {
                var vehical_id1 = $('#vehical_id1').val();
                var chasicno1 = $('#chasicno1').val();
                var vehicabrand1 = $('#vehicabrand1').val();
                var modelyear1 = $('#modelyear1').val();
                var fueltype1 = $('#fueltype1').val();
                var gearno1 = $('#gearno1').val();
                var modelname1 = $('#modelname1').val();
                var price1 = $('#price1').val();
                var odometerreading1 = $('#odometerreading1').val();
                var dom1 = $('#dom1').val();
                var gearbox1 = $('#gearbox1').val();
                var gearboxno1 = $('#gearboxno1').val();
                var engineno1 = $('#engineno1').val();
                var enginesize1 = $('#enginesize1').val();
                var keyno1 = $('#keyno1').val();
                var engine1 = $('#engine1').val();
                var numberPlate = $('#number_plate').val();
                var customer_id = $('.hidden_customer_id').val();
                var branch_id_vehicle = $('.select_branch_vehicle').val();

                $.ajax({

                    type: 'get',
                    url: '{!! url('/service/vehicleadd') !!}',
                    data: {
                        vehical_id1: vehical_id1,
                        chasicno1: chasicno1,
                        vehicabrand1: vehicabrand1,
                        modelyear1: modelyear1,
                        fueltype1: fueltype1,
                        gearno1: gearno1,
                        modelname1: modelname1,
                        price1: price1,
                        odometerreading1: odometerreading1,
                        dom1: dom1,
                        gearbox1: gearbox1,
                        gearboxno1: gearboxno1,
                        engineno1: engineno1,
                        enginesize1: enginesize1,
                        keyno1: keyno1,
                        engine1: engine1,
                        numberPlate: numberPlate,
                        customer_id: customer_id,
                        branch_id_vehicle: branch_id_vehicle
                    },
                    success: function(data) {

                        var modelname1 = $('#modelname1').val();

                        $('.modelnameappend').append('<option value=' + data + '>' +
                            modelname1 + '</option>');
                        var vehical_id1 = $('#vehical_id1').val('');
                        var chasicno1 = $('#chasicno1').val('');
                        var vehicabrand1 = $('#vehicabrand1').val('');
                        var modelyear1 = $('#modelyear1').val('');
                        var fueltype1 = $('#fueltype1').val('');
                        var gearno1 = $('#gearno1').val('');
                        var modelname1 = $('#modelname1').val('');
                        var price1 = $('#price1').val('');
                        var odometerreading1 = $('#odometerreading1').val('');
                        var dom1 = $('#dom1').val('');
                        var gearbox1 = $('#gearbox1').val('');
                        var gearboxno1 = $('#gearboxno1').val('');
                        var engineno1 = $('#engineno1').val('');
                        var enginesize1 = $('#enginesize1').val('');
                        var keyno1 = $('#keyno1').val('');
                        var engine1 = $('#engine1').val('');
                        var number_plate = $('#number_plate').val('');
                        $(".addvehiclemsg").removeClass("hide");
                        $('#vehiclemymodel').modal('toggle');

                    },
                    error: function(e) {
                        alert(msg31 + " " + e.responseText);
                        console.log(e);
                    }
                });
            }
        });


        var msg10 = "{{ trans('message.Please enter only alphanumeric data') }}";
        var msg11 = "{{ trans('message.Only blank space not allowed') }}";
        var msg12 = "{{ trans('message.This Record is Duplicate') }}";

        /*Add Vehicle Model*/
        $('.vehi_model_add').click(function() {
            var model_name = $('.vehi_modal_name').val();
            var model_url = $(this).attr('modelurl');
            var brand_id = $('.vehi_brand_id').val();

            var msg9 = "{{ trans('message.Please enter model name') }}";

            function define_variable() {
                return {
                    vehicle_model_value: $('.vehi_modal_name').val(),
                    vehicle_model_pattern: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]+$/,
                    vehicle_model_pattern2: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]*$/
                };
            }

            var call_var_vehiclemodeladd = define_variable();

            if (model_name == "") {
                swal({
                    title: msg9,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });
            } else if (!call_var_vehiclemodeladd.vehicle_model_pattern.test(call_var_vehiclemodeladd
                    .vehicle_model_value)) {
                $('.vehi_modal_name').val("");
                swal({
                    title: msg14,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });
            } else if (!model_name.replace(/\s/g, '').length) {
                $('.vehi_modal_name').val("");
                swal({
                    title: msg15,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });
            } else if (!call_var_vehiclemodeladd.vehicle_model_pattern2.test(call_var_vehiclemodeladd
                    .vehicle_model_value)) {
                $('.vehi_modal_name').val("");
                swal({
                    title: msg34,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });
            } else {
                $.ajax({
                    type: 'GET',
                    url: model_url,
                    data: {
                        model_name: model_name,
                        brand_id: brand_id
                    },

                    beforeSend: function() {
                        $(".vehi_model_add").prop('disabled', true);
                    },

                    success: function(data) {
                        var newd = $.trim(data);
                        var classname = 'mod-' + newd;

                        if (newd == '01') {
                            swal({
                                title: msg16,
                                cancelButtonColor: '#C1C1C1',
                                buttons: {
                                    cancel: msg35,
                                },
                                dangerMode: true,
                            });
                        } else {
                            $('.vehi_model_class').append('<tr class=" data_color_name row mx-1 ' + classname +
                                '"><td class="text-start col-6">' +
                                model_name +
                                '</td><td class="text-end col-6"><button type="button" modelid=' +
                                data +
                                ' deletemodel="{!! url('/vehicle/vehicle_model_delete') !!}" class="btn btn-danger text-white border-0 modeldeletes"><i class="fa fa-trash" aria-hidden="true"></i></button></a></td><tr>'
                            );
                            $('.model_addname').append("<option value='" + model_name +
                                "'>" + model_name +
                                "</option>");
                            $('.vehi_modal_name').val('');
                        }

                        $(".vehi_model_add").prop('disabled', false);
                        return false;
                    },
                });
            }
        });

        $('body').on('click', '.modeldeletes', function() {
            var mod_del_id = $(this).attr('modelid');
            var del_url = $(this).attr('deletemodel');

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
                        url: del_url,
                        data: {
                            mod_del_id: mod_del_id
                        },
                        success: function(data) {
                            $('.mod-' + mod_del_id).remove();
                            $(".color_name_data option[value=" + mod_del_id + "]")
                                .remove();
                            swal({
                                title: msg5,
                                text: msg6,
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

        /*vehicle type*/
        $('.vehicaltypeadd').click(function() {

            var vehical_type = $('.vehical_type').val();
            var url = $(this).attr('url');

            var msg13 = "{{ trans('message.Please enter vehicle type') }}";
            var msg14 = "{{ trans('message.Please enter only alphanumeric data') }}";
            var msg15 = "{{ trans('message.Only blank space not allowed') }}";
            var msg16 = "{{ trans('message.This Record is Duplicate') }}";

            function define_variable() {
                return {
                    vehicle_type_value: $('.vehical_type').val(),
                    vehicle_type_pattern: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]+$/,
                    vehicle_type_pattern2: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]*$/
                };
            }

            var call_var_vehicletypeadd = define_variable();

            if (vehical_type == "") {
                swal({
                    title: msg13,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });
            } else if (!call_var_vehicletypeadd.vehicle_type_pattern.test(call_var_vehicletypeadd
                    .vehicle_type_value)) {
                $('.vehical_type').val("");
                swal({
                    title: msg14,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });
            } else if (!vehical_type.replace(/\s/g, '').length) {
                $('.vehical_type').val("");
                swal({
                    title: msg15,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });
            } else if (!call_var_vehicletypeadd.vehicle_type_pattern2.test(call_var_vehicletypeadd
                    .vehicle_type_value)) {
                $('.vehical_type').val("");
                swal({
                    title: msg34,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });
            } else {
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {
                        vehical_type: vehical_type
                    },
                    success: function(data) {
                        var newd = $.trim(data);
                        var classname = 'del-' + newd;

                        if (newd == '01') {
                            swal({
                                title: msg16,
                                cancelButtonColor: '#C1C1C1',
                                buttons: {
                                    cancel: msg35,
                                },
                                dangerMode: true,
                            });
                        } else {
                            $('.vehical_type_class').append('<tr class="' + classname +
                                ' data_vehicle_type_name"><td class="text-center">' +
                                vehical_type +
                                '</td><td class="text-center"><button type="button" vehicletypeid=' +
                                data +
                                ' deletevehical="{!! url(' / vehicle / vehicaltypedelete ') !!}" class="btn btn-danger btn-sm deletevehicletype fa fa-trash"></button></a></td><tr>'
                            );

                            $('.select_vehicaltype').append('<option value=' + data + '>' +
                                vehical_type + '</option>');

                            $('.vehical_type').val('');

                            $('.vehical_id').append('<option value=' + data + '>' +
                                vehical_type + '</option>');

                            $('.vehical_type').val('');
                        }
                    },
                });
            }
        });

        /*vehical Type delete*/
        $('body').on('click', '.deletevehicletype', function() {

            var vtypeid = $(this).attr('vehicletypeid');
            var url = $(this).attr('deletevehical');

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
                            vtypeid: vtypeid
                        },
                        success: function(data) {
                            $('.del-' + vtypeid).remove();
                            $(".color_name_data option[value=" + vtypeid + "]")
                                .remove();
                            swal({
                                title: msg5,
                                text: msg6,
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


        /*vehical brand*/
        $('.vehicalbrandadd').click(function() {
            var vehical_id = $('.vehical_id').val();
            var vehical_brand = $('.vehical_brand').val();
            var url = $(this).attr('vehiclebrandurl');

            var msg17 = "{{ trans('message.Please first select vehicle type') }}";
            var msg18 = "{{ trans('message.Please enter vehicle brand') }}";
            var msg19 = "{{ trans('message.Please enter only alphanumeric data') }}";
            var msg20 = "{{ trans('message.Only blank space not allowed') }}";
            var msg21 = "{{ trans('message.This Record is Duplicate') }}";

            function define_variable() {
                return {
                    vehicle_brand_value: $('.vehical_brand').val(),
                    vehicle_brand_pattern: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]+$/,
                    vehicle_brand_pattern2: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]*$/
                };
            }

            var call_var_vehiclebrandadd = define_variable();

            if ($("#vehicleTypeSelect")[0].selectedIndex <= 0) {

                swal({
                    title: msg17,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });
            } else {
                if (vehical_brand == "") {
                    swal({
                        title: msg18,
                        cancelButtonColor: '#C1C1C1',
                        buttons: {
                            cancel: msg35,
                        },
                        dangerMode: true,
                    });
                } else if (!call_var_vehiclebrandadd.vehicle_brand_pattern.test(call_var_vehiclebrandadd
                        .vehicle_brand_value)) {
                    $('.vehical_brand').val("");
                    swal({
                        title: msg19,
                        cancelButtonColor: '#C1C1C1',
                        buttons: {
                            cancel: msg35,
                        },
                        dangerMode: true,
                    });

                } else if (!vehical_brand.replace(/\s/g, '').length) {
                    // var str = "    ";
                    $('.vehical_brand').val("");
                    swal({
                        title: msg20,
                        cancelButtonColor: '#C1C1C1',
                        buttons: {
                            cancel: msg35,
                        },
                        dangerMode: true,
                    });
                } else if (!call_var_vehiclebrandadd.vehicle_brand_pattern2.test(
                        call_var_vehiclebrandadd
                        .vehicle_brand_value)) {
                    $('.vehical_brand').val("");
                    swal({
                        title: msg34,
                        cancelButtonColor: '#C1C1C1',
                        buttons: {
                            cancel: msg35,
                        },
                        dangerMode: true,
                    });
                } else {
                    $.ajax({
                        type: 'GET',
                        url: url,
                        data: {
                            vehical_id: vehical_id,
                            vehical_brand: vehical_brand
                        },
                        success: function(data) {
                            var newd = $.trim(data);
                            var classname = 'del-' + newd;

                            if (newd == "01") {
                                swal({
                                    title: msg21,
                                    cancelButtonColor: '#C1C1C1',
                                    buttons: {
                                        cancel: msg35,
                                    },
                                    dangerMode: true,
                                });
                            } else {
                                $('.vehical_brand_class').append('<tr class="' + classname +
                                    ' data_vehicle_brand_name"><td class="text-center">' +
                                    vehical_brand +
                                    '</td><td class="text-center"><button type="button" brandid=' +
                                    data +
                                    'deletevehicalbrand="{!! url('vehicle/vehicalbranddelete') !!}" class="btn btn-danger btn-sm deletevehiclebrands fa fa-trash"></button></a></td><tr>'
                                );

                                $('.select_vehicalbrand').append('<option value=' + data +
                                    '>' + vehical_brand +
                                    '</option>');

                                $('.vehical_brand').val('');
                            }
                        },
                    });
                }
            }
        });


        /*vehical brand delete*/
        $('body').on('click', '.deletevehiclebrands', function() {
            var vbrandid = $(this).attr('brandid');
            var url = $(this).attr('deletevehicalbrand');

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
                            vbrandid: vbrandid
                        },
                        success: function(data) {
                            $('.del-' + vbrandid).remove();
                            $(".color_name_data option[value=" + vbrandid + "]")
                                .remove();
                            swal({
                                title: msg5,
                                text: msg6,
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



        var today = new Date();
        var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
        var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
        var dateTime = date + ' ' + time;

        $('.datepicker').datetimepicker({
            format: "<?php echo getDatepicker(); ?>",
            todayBtn: true,
            autoclose: 1,
            minView: 2,
            endDate: new Date(),
            language: "{{ getLangCode() }}",
        });



        $(".datepickercustmore").datetimepicker({
            format: "<?php echo getDatepicker(); ?>",
            minDate: new Date(),
            todayBtn: true,
            autoclose: 1,
            minView: 2,
            language: "{{ getLangCode() }}",
        });
        $('.datepicker2').datetimepicker({
            format: "<?php echo getDateTimepicker(); ?>",
            todayBtn: true,
            autoclose: 1,
            startDate: new Date(),
            language: "{{ getLangCode() }}",
        });

        $('.datepicker1').datetimepicker({
            format: "<?php echo getDatepicker(); ?>",
            todayBtn: true,
            autoclose: 1,
            minView: 2,
            endDate: new Date(),
            language: "{{ getLangCode() }}",
        });
        $('.myDatepicker2').datetimepicker({
            format: "yyyy",
            endDate: new Date(),
            minView: 4,
            autoclose: true,
            startView: 4,
            language: "{{ getLangCode() }}",
        });

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



        var msg1 = "{{ trans('message.Alert') }}";
        var msg2 = "{{ trans('message.Please select customer!') }}";

        $('body').on('change', '.select_vhi', function() {

            var url = $(this).attr('cus_url');
            var cus_id = $(this).val();
            var modelnms = $(this).val();

            $.ajax({

                type: 'GET',
                url: url,
                data: {
                    cus_id: cus_id,
                    modelnms: modelnms
                },
                success: function(response) {

                    $('.modelnms').remove();
                    $('#vhi').append(response);
                }

            });
        });


        $('body').on('click', '#vhi', function() {

            var cus_id = $('.select_vhi').val();

            if (cus_id == "") {

                swal({
                    title: msg1,
                    text: msg2,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });

                return false;
            }
        });

        /*If vehicle add when customer is selected otherwise not add vehicle*/
        $('body').on('click', '.vehiclemodel', function() {

            var cus_id = $('.select_vhi').val();

            if (cus_id == "") {
                swal({
                    title: msg1,
                    text: msg2,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });

                $('#vehiclemymodel').modal('toggle');
                return false;

            } else {
                $('#vehiclemymodel').show();
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

        /*Fuel type*/
        $('.fueltypeadd').click(function() {

            var fuel_type = $('.fuel_type').val();
            var url = $(this).attr('fuelurl');

            var msg21 = "{{ trans('message.Please enter fuel type') }}";
            var msg22 = "{{ trans('message.Please enter only alphanumeric data') }}";
            var msg23 = "{{ trans('message.Only blank space not allowed') }}";
            var msg24 = "{{ trans('message.This Record is Duplicate') }}";
            var msg25 = "{{ trans('message.An error occurred :') }}";

            function define_variable() {
                return {
                    vehicle_fuel_value: $('.fuel_type').val(),
                    vehicle_fuel_pattern: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]+$/,
                    vehicle_fuel_pattern2: /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]*$/
                };
            }

            var call_var_vehiclefueladd = define_variable();

            if (fuel_type == "") {
                swal({
                    title: msg21,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });
            } else if (!call_var_vehiclefueladd.vehicle_fuel_pattern.test(call_var_vehiclefueladd
                    .vehicle_fuel_value)) {
                $('.fuel_type').val("");
                swal({
                    title: msg22,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });

            } else if (!fuel_type.replace(/\s/g, '').length) {
                // var str = "    ";
                $('.fuel_type').val("");
                swal({
                    title: msg23,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });
            } else if (!call_var_vehiclefueladd.vehicle_fuel_pattern2.test(call_var_vehiclefueladd
                    .vehicle_fuel_value)) {
                $('.fuel_type').val("");
                swal({
                    title: msg34,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });

            } else {
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {
                        fuel_type: fuel_type
                    },
                    success: function(data) {
                        var newd = $.trim(data);
                        var classname = 'del-' + newd;

                        if (newd == '01') {
                            swal({
                                title: msg24,
                                cancelButtonColor: '#C1C1C1',
                                buttons: {
                                    cancel: msg35,
                                },
                                dangerMode: true,
                            });
                        } else {
                            $('.fuel_type_class').append('<tr class="' + classname +
                                ' data_of_type"><td class="text-center">' +
                                fuel_type +
                                '</td><td class="text-center"><button type="button" fuelid=' +
                                data +
                                ' deletefuel="{!! url(' / vehicle / fueltypedelete ') !!}" class="btn btn-danger btn-sm fueldeletes fa fa-trash"></button></a></td><tr>'
                            );

                            $('.select_fueltype').append('<option value=' + data + '>' +
                                fuel_type + '</option>');

                            $('.fuel_type').val('');
                        }
                    },
                });
            }
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
        $('#cust_id').on('change', function() {

            var supplierValue = $('select[name=Customername]').val();

            if (supplierValue != null) {
                $('#cust_id-error').css({
                    "display": "none"
                });

                /*If select customer after customer id assigned to vehicle add form customer_id inputbox*/
                $('.hidden_customer_id').val(supplierValue);
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
        var k = 0;
        $('.observation_Plus3').click(function() {
            k = k + 1;
            if (k % 2 != 0) {
                $(this).parent().find(".fa-plus:first").removeClass("fa-plus").addClass(
                    "fa-minus");

            } else {
                $(this).parent().find(".fa-minus:first").removeClass("fa-minus").addClass(
                    "fa-plus");
            }
        });
        var j = 0;
        $('.observation_Plus4').click(function() {
            j = j + 1;
            if (j % 2 != 0) {
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
        $('.observation_Plus6').click(function() {
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


        /*If firstly enter any whitespace then clear textbox*/
        $('body').on('keyup', '#firstname', function() {

            var firstname = $(this).val();

            if (!firstname.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

       


        $('body').on('keyup', '#mobile', function() {

            var mobile = $(this).val();

            if (!mobile.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        

        $('body').on('keyup', '#address', function() {

            var address = $(this).val();

            if (!address.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '.vehical_type', function() {

            var vehical_typeVal = $(this).val();

            if (!vehical_typeVal.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '.vehical_brand', function() {

            var vehical_brandVal = $(this).val();

            if (!vehical_brandVal.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '.fuel_type', function() {

            var fuel_typeVal = $(this).val();

            if (!fuel_typeVal.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '.vehi_modal_name', function() {

            var vehi_modal_nameVal = $(this).val();

            if (!vehi_modal_nameVal.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });


        $('body').on('keyup', '#chasicno1', function() {

            var chasicno1 = $(this).val();

            if (!chasicno1.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '#gearno1', function() {

            var gearno1 = $(this).val();

            if (!gearno1.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '#price1', function() {

            var price1 = $(this).val();

            if (!price1.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '#odometerreading1', function() {

            var odometerreading1 = $(this).val();

            if (!odometerreading1.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '#gearbox1', function() {

            var gearbox1 = $(this).val();

            if (!gearbox1.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '#gearboxno1', function() {

            var vehi_modal_nameVal = $(this).val();

            if (!vehi_modal_nameVal.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '#engineno1', function() {

            var engineno1 = $(this).val();

            if (!engineno1.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '#enginesize1', function() {

            var enginesize1 = $(this).val();

            if (!enginesize1.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '#engine1', function() {

            var engine1 = $(this).val();

            if (!engine1.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '#keyno1', function() {

            var keyno1 = $(this).val();

            if (!keyno1.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '#number_plate', function() {

            var number_plate = $(this).val();

            if (!number_plate.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '.titalQuotation', function() {

            var titalQuotation = $(this).val();

            if (!titalQuotation.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

        $('body').on('keyup', '#details', function() {

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
        $('body').on('click', '.quotationSubmitButton', function(e) {
            $('#QuotationAdd-Form input, #QuotationAdd-Form select, #QuotationAdd-Form textarea').each(

                function(index) {
                    var input = $(this);

                    if (input.attr('name') == "Customername" || input.attr('name') ==
                        "vehicalname" || input.attr(
                            'name') == "date" || input.attr('name') == "repair_cat" || input.attr(
                            'name') ==
                        "service_type") {
                        if (input.val() == "") {
                            return false;
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
                                $('.error_customfield_main_div_' + ids).removeClass('has-error');
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
        $('body').on('click', '.fueldeletes', function() {
            var msg3 = "{{ trans('message.Cancel') }}";
            var msg4 = "{{ trans('message.Yes, delete!') }}";
            var msg5 = "{{ trans('message.Done!') }}";
            var msg6 = "{{ trans('message.It was succesfully deleted!') }}";
            var msg7 = "{{ trans('message.Cancelled') }}";
            var msg8 = "{{ trans('message.Your data is safe') }}";
            var fueltypeid = $(this).attr('fuelid');
            var url = $(this).attr('deletefuel');
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
                            fueltypeid: fueltypeid
                        },
                        success: function(data) {
                            $('.del-' + fueltypeid).remove();
                            $(".color_name_data option[value=" + fueltypeid + "]")
                                .remove();
                            swal({
                                title: msg5,
                                text: msg6,
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
                                repair_category_name + '</option>');

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
                            // alert(colorid)
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
        Array.from(document.getElementsByClassName('showmodal')).forEach((e) => {
            e.addEventListener('click', function(element) {
                element.preventDefault();
                if (e.hasAttribute('data-show-modal')) {
                    showModal(e.getAttribute('data-show-modal'));
                }
            });
        });

        // Show modal dialog
        function showModal(modal) {
            const mid = document.getElementById(modal);
            let myModal = new bootstrap.Modal(mid);
            myModal.show();
        }
        $('body').on('change', '.select_vehicaltype', function() {
            var vehicle_type = $('.select_vehicaltype').val();

            if (vehicle_type !== "") {
                $('#errorlvehical_id1').css({
                    "display": "none"
                });
            } else {
                $('#errorlvehical_id1').css({
                    "display": ""
                });
            }
        });
        $('body').on('change', '.model_addname', function() {
            var model_name = $('.model_addname').val();

            if (model_name !== "") {
                $('#errorlmodelname1').css({
                    "display": "none"
                });
            } else {
                $('#errorlmodelname1').css({
                    "display": ""
                });
            }
        });
        $('body').on('change', '#price1', function() {
            var price = $('#price1').val();

            if (price !== "") {
                $('#ppe').css({
                    "display": "none"
                });
            } else {
                $('#ppe').css({
                    "display": ""
                });
            }
        });
        $('body').on('click', '.addcustomer', function(e) {
            var fname = $('#firstname').val();
            if (fname !== "") {
                $('#errorlfirstname').css({
                    "display": "none"
                });
            } else {
                $('#errorlfirstname').css({
                    "display": ""
                });
            }
            
            var email = $('#email').val();
            if (email !== "") {
                $('#errorlemail').css({
                    "display": "none"
                });
            } else {
                $('#errorlemail').css({
                    "display": ""
                });
            }
            var password = $('#password').val();
            if (password !== "") {
                $('#errorlpassword').css({
                    "display": "none"
                });
            } else {
                $('#errorlpassword').css({
                    "display": ""
                });
            }
            var password_confirmation = $('#password_confirmation').val();
            if (password_confirmation !== "") {
                $('#errorlpassword_confirmation').css({
                    "display": "none"
                });
            } else {
                $('#errorlpassword_confirmation').css({
                    "display": ""
                });
            }
            var mobile = $('#mobile').val();
            if (mobile !== "") {
                $('#errorlmobile').css({
                    "display": "none"
                });
            } else {
                $('#errorlmobile').css({
                    "display": ""
                });
            }
            var country_id = $('#country_id').val();
            if (country_id !== "") {
                $('#errorlcountry_id').css({
                    "display": "none"
                });
            } else {
                $('#errorlcountry_id').css({
                    "display": ""
                });
            }
            var address = $('#address').val();
            if (address !== "") {
                $('#errorladdress').css({
                    "display": "none"
                });
            } else {
                $('#errorladdress').css({
                    "display": ""
                });
            }
        });
        $('body').on('change', '#firstname', function() {
            var fname = $('#firstname').val();
            if (fname !== "") {
                $('#errorlfirstname').css({
                    "display": "none"
                });
            } else {
                $('#errorlfirstname').css({
                    "display": ""
                });
            }
        });
       
        });
        $('body').on('change', '#email', function() {
            var email = $('#email').val();
            if (email !== "") {
                $('#errorlemail').css({
                    "display": "none"
                });
            } else {
                $('#errorlemail').css({
                    "display": ""
                });
            }
        });
        $('body').on('change', '#country_id', function() {
            var country_id = $('#country_id').val();
            if (country_id !== "") {
                $('#errorlcountry_id').css({
                    "display": "none"
                });
            } else {
                $('#errorlcountry_id').css({
                    "display": ""
                });
            }
        });
        $('body').on('change', '#address', function() {
            var address = $('#address').val();
            if (address !== "") {
                $('#errorladdress').css({
                    "display": "none"
                });
            } else {
                $('#errorladdress').css({
                    "display": ""
                });
            }
        });
        $('body').on('change', '#password', function() {
            var password = $('#password').val();
            if (password !== "") {
                $('#errorlpassword').css({
                    "display": "none"
                });
            } else {
                $('#errorlpassword').css({
                    "display": ""
                });
            }
            if (password.length > 6) {
                $('#errorlpassword_length').css({
                    "display": "none"
                });
            } else {
                $('#errorlpassword_length').css({
                    "display": ""
                });
            }
        });
        $('body').on('change', '#mobile', function() {
            var mobile = $('#mobile').val();
            if (mobile !== "") {
                $('#errorlmobile').css({
                    "display": "none"
                });
            } else {
                $('#errorlmobile').css({
                    "display": ""
                });
            }
            if (mobile.length > 6) {
                $('#errorlmobile_length').css({
                    "display": "none"
                });
            } else {
                $('#errorlmobile_length').css({
                    "display": ""
                });
            }
        });
        $('body').on('keyup', '#password_confirmation', function() {
            console.log("confirm password called");
            var password = $('#password').val();
            var password_confirmation = $(this).val(); // Use $(this) to get the value of the current element

            // Hide the error message for password_confirmation if it's not empty
            if (password_confirmation !== "") {
                $('#errorlpassword_confirmation').css("display", "none");
            } else {
                $('#errorlpassword_confirmation').css("display", "");
            }

            // Check if passwords match and hide the error message accordingly
            if (password === password_confirmation) {
                $('#errorlpassword_confirmation_same').css("display", "none");
            } else {
                $('#errorlpassword_confirmation_same').css("display", "");
            }
        });

        function handleCustomerChange() {
            var url = $('.select_vhi').attr('cus_url');
            var cus_id = $('.select_vhi').val();
            var modelnms = $('.select_vhi').val();

            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    cus_id: cus_id,
                    modelnms: modelnms
                },
                success: function(response) {
                    $('.modelnms').remove();
                    $('#vhi').append(response);
                }
            });
        }

        //For customer vehicle dropdown
        handleCustomerChange();
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    // Get the checkbox for applying discount
    var applyDiscountCheckbox = document.getElementById("applyDiscountCheckbox");

    // Get the discount options container
    var discountOptions = document.getElementById("discountOptions");

    // Get the discount percentage input field
    var discountPercentageInput = document.getElementById("discountPercentageInput");

    // Add event listener to the checkbox for applying discount
    applyDiscountCheckbox.addEventListener("change", function () {
        // Toggle display of discount options based on checkbox state
        if (applyDiscountCheckbox.checked) {
            discountOptions.style.display = "block";
        } else {
            discountOptions.style.display = "none";
            discountPercentageInput.style.display = "none"; // Hide discount percentage input if checkbox is unchecked
        }
    });

    // Add event listener to discount option select
    var discountOptionSelect = document.getElementById("discountOption");
    discountOptionSelect.addEventListener("change", function () {
        // Show discount percentage input when an option is selected
        discountPercentageInput.style.display = "block";
    });
});


</script>


<script>
    var msg10 = "{{ trans('message.OK') }}"
    $(document).ready(function() {

        /*datetimepicker*/
        $('.datepicker').datetimepicker({
            format: "<?php echo getDatepicker(); ?>",
            todayBtn: true,
            autoclose: 1,
            minView: 2,
            endDate: new Date(),
            language: "{{ getLangCode() }}",
        });

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
                    var total_price = response.price * qty;

                    if (response.qty == "not available") {
                        $('#qty').attr('max', 0);
                    } else {
                        $('#qty').attr('max', response.qty);
                    }
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
            beforeSend: function() {},
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
                        $("#load_service_data").html(
                            "<center><h3>Loading...</h3></center>");
                    }
                });
            }
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
                                cancel: msg11,
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
                        cancel: msg11,
                    },
                    dangerMode: true,
                });
            }
        })

    });



    $("#add_new_product").click(function() {
        // var row_id = $("#tab_taxes_detail > tbody > tr").length;
        var url = $(this).attr('url');

        var row_len = jQuery(".row_number").length;
        if (row_len > 0) {
            var num = jQuery(".row_number:last").val();
            var row_id = parseInt(num) + 1;
        } else {
            var row_id = 0;
        }

        var msg16 = "{{ trans('app.An error occurred :') }}";
        $.ajax({
            type: 'GET'
            , url: url
            , data: {
                row_id: row_id
            }
            , beforeSend: function() {
                // $("#add_new_product").prop('disabled', true);
            }
            , success: function(response) {
                console.log(response);
                $("#tab_taxes_detail > tbody").append(response.html);
                $('.adddatatable').table().row.add($(response.html)).draw();
                $("#add_new_product").prop('disabled', false);
                return false;
            }
            , error: function(e) {
                alert(msg16 + " " + e.responseText);
                console.log(e);
            }
        });

        
    });



    $('body').on('click', '.product_delete', function() {
        var row_id = $(this).attr('data-id');


        $('table#tab_taxes_detail tr#row_id_' + row_id).fadeOut();

        $('table#tab_taxes_detail tr.child').fadeOut();
        $('table#tab_taxes_detail tr#row_id_' + row_id).html(
            '<option value="">Select product</option>');
        $('table#tab_taxes_detail tr#row_id_' + row_id).html(
            '<input type="text" name="" class="form-control qty" value="" id="tax_1" readonly="true">'
        );
        $('table#tab_taxes_detail tr#row_id_' + row_id).html(
            '<input type="text" name="" class="form-control price" value="" id="tax_1" readonly="true">'
        );
        $('table#tab_taxes_detail tr#row_id_' + row_id).html(
            '<input type="text" name="" class="form-control total_price" value="" id="tax_1" readonly="true">'
        );
        $('table#tab_taxes_detail tr#row_id_' + row_id).html(
            '<span class="product_delete" style="cursor: pointer;" data-id="0"><i class="fa fa-trash"></i> Delete</span>'
        );
        return false;
    });



    $('body').on('change', '.productid', '.qty', function() {
        var row_id = $(this).attr('row_did');
        var p_id = $(this).val();

        var qty = $('.qty_' + row_id).val();
        var price = $('.price_' + row_id).val();
        var url = $(this).attr('url');

        var msg17 = "{{ trans('message.An error occurred :') }}";
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
                $('.total_price_' + row_id).val(price);
                // $('.total_price_' + row_id).val(total_price);
                $('.qty_' + row_id).val(1);
                var product_no = json_obj['product_no'];
                // $('.qty_' + row_id).html(product_no);
            },
            error: function(e) {
                alert(msg17 + " " + e.responseText);
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
    $('body').on('change', '.qty', function() {
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



    $(function() {
        $('#supplier_select').change(function() {
            var supplier_id = $(this).val();
            var url = $(this).attr('url');

            var msg19 = "{{ trans('message.An error occurred :') }}";
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
                    alert(msg19 + " " + e.responseText);
                    console.log(e);
                }
            });
        });
    });
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

    // $('body').on('click', '.qty', function(event) {
    //     // $(".qty" ).keypress(function() {

    //     var row_id = $(this).attr('row_id');
    //     var productid = $('.select_productname_' + row_id).find(":selected").val();
    //     var qty = $(this).val();
    //     var url = $(this).attr('prd_url');

    //     var msg21 = "{{ trans('message.Product Not Available') }}";
    //     var msg22 = "{{ trans('message.Current Stock :') }}";

    //     $.ajax({
    //         type: 'GET',
    //         url: url,
    //         data: {
    //             qty: qty,
    //             productid: productid
    //         },
    //         success: function(response) {
    //             //var newd = $.trim(response);
    //             if (response.success == '1') {
    //                 //swal('No Product Available');
    //                 swal({
    //                     title: msg21 + '\n' + msg22 + ' ' + response
    //                         .currentStock,
    //                     cancelButtonColor: '#C1C1C1',
    //                     buttons: {
    //                         cancel: msg10,
    //                     },
    //                     dangerMode: true,
    //                 });


    //                 jQuery('.qty_' + row_id).val('');
    //                 jQuery('.total_price_' + row_id).val('');
    //                 return false;
    //             }
    //         },
    //     });

    // });

    // $('body').on('keydown paste', '.qty', function(e) {
    //     e.preventDefault();
    // });

    // // Allow changing the value using up and down arrows
    // $('body').on('keydown', '.qty', function(e) {
    //     var keyCode = e.keyCode || e.which;

    //     if (keyCode === 38 || keyCode === 40) {
    //         // Allow the up and down arrows to change the value
    //         e.preventDefault();

    //         // Get the current value
    //         var currentValue = parseInt($(this).val()) || 0;

    //         // Increment or decrement the value based on the arrow key pressed
    //         var newValue = (keyCode === 38) ? currentValue + 1 : currentValue - 1;

    //         // Update the input value
    //         $(this).val(newValue);
    //     }
    // });

    $('body').on('click', '.productid', function() {
        var rowId = $(this).attr('row_did');
        var url = $(this).attr('url');
        var manufacture_selected = $('.select_producttype_' + rowId).val();

        var msg25 = "{{ trans('message.First Select Manufacturer') }}";

        if (manufacture_selected == "") {
            swal({
                title: msg35,
                cancelButtonColor: '#C1C1C1',
                buttons: {
                    cancel: msg10,
                },
                dangerMode: true,
            });

        }
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

    $('.salesPartAddSubmitButton').click(function(e) {

        var bill_no = $('#bill_no').val();
        var date = $('.dateValue').val();
        var selectCustomer = $('#customer_select_box1').val();
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
            $('#customer_select_box1-error').css({
                "display": ""
            });
            $('.div_customer_select_error').addClass('has-error');
            $('.select2-selection--single').addClass('has-error');
        } else {
            $('#customer_select_box1-error').css({
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
                return false;
            } else {
                $('#quantity_error_' + i).css({
                    "display": "none"
                });
                $('.tbl_td_quantity_error_' + i).removeClass('has-error');
                return true;
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


        $('#salespartAddForm input, #salespartAddForm select, #salespartAddForm textarea').each(

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
            $('#customer_select_box1-error').css({
                "display": ""
            });
            $('.div_customer_select_error').addClass('has-error');
        } else {
            $('#customer_select_box1-error').css({
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
</script>
<script>

    var msg1 = "{{ trans('message.Are You Sure?') }}";
var msg2 = "{{ trans('message.You will not be able to recover this data afterwards!') }}";
var msg3 = "{{ trans('message.Cancel') }}";
var msg4 = "{{ trans('message.Yes, delete!') }}";
var msg5 = "{{ trans('message.Done!') }}";
var msg6 = "{{ trans('message.Manufacturer Deleted Successfully') }}";
var msg7 = "{{ trans('message.Cancelled') }}";
var msg8 = "{{ trans('message.Your data is safe') }}";
var unitdelete = "{{ trans('message.Unit Of Measurement Deleted Successfully') }}";
var colordelete = "{{ trans('message.Color Deleted Successfully') }}";

    $(document).ready(function() {

            /*Product Type Delete  model*/
$('body').on('click', '.deleteproducted', function() {
    // alert('delete');
  var ptypeid = $(this).attr('data-id');
  var url = $(this).attr('deleteproduct');
  swal({
    title: msg1,
    text: msg2,
    icon: 'warning',
    cancelButtonColor: '#C1C1C1',
    buttons: [msg3, msg4],
    dangerMode: true,
  }).then((isConfirm) => {
    if (isConfirm) {
      $.ajax({
        type: 'GET',
        url: url,
        data: {
          ptypeid: ptypeid
        },
        success: function() {
          $('.del-' + ptypeid).remove();
          $(".data_of_type option[value=" + ptypeid + "]")
            .remove();
          swal({
            title: msg5,
            text: msg6,
            icon: "success",
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
        icon: "success",
        cancelButtonColor: '#C1C1C1',
        buttons: {
          cancel: msg35,
        },
        dangerMode: true,
      });

    }
  });


});

        $('.vehical_name').select2();
        var msg7 = "{{ trans('message.OK') }}"

        $('.v_check').click(function() {
            var vehical_name = $('.vehical_name').val();

            var msg1 = "{{ trans('message.Select Vehicles') }}";
            var msg2 = "{{ trans('message.Please Select Vehicles Name') }}";

            if (vehical_name == null) {
                swal({  
                    title: msg1,  
                    text: msg2,  
                    icon: 'warning',
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg7,
                    },
                    dangerMode: true,
                });
                
                //alert("Please select vehicle name");
            }
        });



        $('body').on('change', '.check_cat', function() {
            var check_cat = $('.check_cat option:selected').text();
            var checkpoint_id = $('.check_cat option:selected').data('checkpoint-id');

            $('#val_app').val(check_cat);
            $('#val_checkpoint_id').val(checkpoint_id);
        });

        var max_fields = 20; //maximum input boxes allowed
        var wrapper = $(".checkpointname"); //Fields wrapper
        var add_button = $(".add_field_button"); //Add button ID
        var x = 1; //initlal text box count
        $(add_button).click(function(e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++;
                $(wrapper).append('<div class="row mt-3 parentClass_' + x +
                    '"><label class="control-label checkpointtext col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3 text-end">{{ trans('message.Check Point') }}<label class="color-danger">&nbsp;&nbsp;*</label></label>' +
                    '<input class="form-control col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3 addcheckpoint checkpointsData checkpointsDataddmore" maxlength="30" id="chek_pt" type="text" placeholder="{{ trans('message.Enter Checkpoint Name') }}" required="true" name="checkpoint[]" rowid="' +
                    x + '"/>' + 
                    '<a href="#" class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3 remove_field ms-4"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a></div>'
                );
            }
        });

        $(wrapper).on("click", ".remove_field", function(e) {
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })




        $('.add_cat').click(function() {

            var url = "<?php echo url('/newcategory'); ?>";
            var category = $('.add_newcat').val();
            var vehical_name = $('.vehical_name').val();

            var msg1 = "{{ trans('message.Select Vehicles') }}";
            var msg2 = "{{ trans('message.Please Select Vehicles Name') }}";
            var msg3 = "{{ trans('message.Enter Category Name') }}";
            var msg4 = "{{ trans('message.Please enter category name') }}";
            var msg5 = "{{ trans('message.Error Message') }}";
            var msg6 = "{{ trans('message.Somthing went wrong') }}";
            var msg40 = "{{ trans('message.Alert') }}";
            var msg41 =
                "{{ trans('message.Start should be alphabets only after supports alphanumeric, space, dot, @, _, and - are allowed.') }}";
            var msg42 = "{{ trans('message.Successfully Submitted') }}";

            if (vehical_name == null || category == '') {
                if (vehical_name == null) {

                    swal({  
                        title: msg1,  
                        text: msg2,  
                        icon: 'warning',
                        cancelButtonColor: '#C1C1C1',
                        buttons: {
                            cancel: msg7,
                        },
                        dangerMode: true,
                    });
                } else if (category == '') {

                    swal({  
                        title: msg3,  
                        text: msg4,  
                        icon: 'warning',
                        cancelButtonColor: '#C1C1C1',
                        buttons: {
                            cancel: msg7,
                        },
                        dangerMode: true,
                    });
                }
            // } else if (!category.match(
            //         /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]*$/
            //     )) {
            //         swal({  
            //             title: msg40,  
            //             text: msg41,  
            //             icon: 'warning',
            //             cancelButtonColor: '#C1C1C1',
            //             buttons: {
            //                 cancel: msg7,
            //             },
            //             dangerMode: true,
            //         });
                
            } else {
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {
                        category: category,
                        vehical_name: vehical_name
                    },
                    success: function(response) {
                        $('.category').append("<option value=" + category + " data-checkpoint-id=" + response + " selected>" +
                            category + "</option>");
                        $('#val_app').val(category);
                        $('#val_checkpoint_id').val(response);
                        $('.add_newcat').val("");
                        $('#add_category').modal('toggle');
                    },
                    error: function() {

                        swal({  
                            title: msg5,  
                            text: msg6,  
                            icon: 'warning',
                            cancelButtonColor: '#C1C1C1',
                            buttons: {
                                cancel: msg7,
                            },
                            dangerMode: true,
                        });
                    }
                });
            }

        });

        /*If vehicle name select is empty then checkpoint category and checkpoint both field are disabled, otherwise both field are unables*/
        $('body').on('change', '.vehical_name', function() {

            var vahicleValue = $(this).val();

            if (vahicleValue != null) {
                $('.check_cat').attr('disabled', false);
                $('.checkpoint').attr('disabled', false);
            }
        });

        /*Manually using Jquery to make validation for error time make full div danger color alert*/
        $('body').on('keyup', '.checkpointsData', function() {

            var checkpointValue = $(this).val();
            var regexs =
                /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]*$/;

            var ids = $(this).attr("rowid");

            if (!checkpointValue.replace(/\s/g, '').length) {
                $(this).val("");
            // } else if (!regexs.test(checkpointValue)) {
            //     $(this).val("");
            //     $('#checkpointsData-error_' + ids).css({
            //         "display": ""
            //     });
            //     $('.parentClass_' + ids).addClass('has-error');
            } else if (regexs.test(checkpointValue)) {
                $('#checkpointsData-error_' + ids).css({
                    "display": "none"
                });
                $('.parentClass_' + ids).removeClass('has-error');
            }
        });


        /*If any white space then make empty value of these all field*/
        $('body').on('keyup', '.add_newcat', function() {

            var add_newcat = $(this).val();

            if (!add_newcat.replace(/\s/g, '').length) {
                $(this).val("");
            }
        });

    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Embed PHP array into JavaScript
    const stockQuantities = @json($stockQuantities);

    document.querySelectorAll('.quantity').forEach(function (input) {
        input.addEventListener('input', function () {
            const rowId = this.getAttribute('row_id');
            const productId = document.querySelector(`#productid[row_did="${rowId}"]`).value;
            const quantityEntered = parseInt(this.value, 10);
            const availableStock = stockQuantities[productId] || 0;

            let errorMessage = '';
            if (quantityEntered === 0) {
                errorMessage = 'Please enter a valid quantity.';
            } else if (quantityEntered > availableStock) {
                errorMessage = `Quantity entered exceeds available stock (${availableStock}).`;
                // Set the input value to the maximum available stock
                this.value = availableStock;
            }

            const errorElement = document.querySelector(`#quantity_error_${rowId}`);
            if (errorMessage) {
                errorElement.textContent = errorMessage;
                errorElement.style.display = 'block';
            } else {
                errorElement.style.display = 'none';
            }
        });
    });
});

</script>
<!-- Form field validation -->
{!! JsValidator::formRequest('App\Http\Requests\StoreQuotationAddEditFormRequest', '#QuotationAdd-Form') !!}
<script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>



@endsection