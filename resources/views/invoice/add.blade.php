@extends('layouts.app')
@section('content')

<style>
    .select2-container {
        width: 100% !important;
    }
</style>

<!-- Code Start -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="nav_menu">
                <nav>   
                    <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a>
                        <a href="{!! url('/invoice/list') !!}" id=""><i class=""><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}"></i><span class="titleup">
                                {{ trans('message.Add Invoice') }}</span></a>
                    </div>
                    @include('dashboard.profile')
                </nav>
            </div>
        </div>
    </div>
    <div class="x_content">
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <form method="post" id="form_add" action="{{ url('/invoice/store') }}" enctype="multipart/form-data" name="Form" class="form-horizontal upperform saleAddForm">
                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <h4 class="fw-bold">{{ trans('message.INVOICE DETAILS') }}</h4>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 mb-2">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                                    {{ trans('message.Invoice For') }}
                                    <label class="color-danger">*</label></label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <select name="Invoice_type" class="form-control invoicetype form-select" sales_url="{!! url('invoice/sales_customer') !!}">
                                        <option value="">{{ trans('message.Select Type') }}</option>
                                        <option value="0">{{ trans('message.Service Invoice') }}</option>
                                        <!-- <option value="1">{{ trans('message.Sales Invoice') }}</option> -->
                                    </select>
                                </div>

                            </div>

                            <div id="form_fields" style="display:none">
                                <div class="row row-mb-0">
                                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                        <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="cus_name">{{ trans('message.Invoice Number') }} <label class="color-danger">*</label></label>
                                        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                            <input type="text" name="Invoice_Number" class="form-control" value="{{ $code }}" readonly>

                                            <input type="hidden" name="paymentno" value="{{ $codepay }}">
                                        </div>
                                    </div>

                                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                        <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="cus_name">{{ trans('message.Customer Name') }} <label class="color-danger">*</label></label>
                                        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                            <select name="Customer" class="form-control select_cus customer_name form-select" id="customer_select_box1" customer_url="{!! url('invoice/get_jobcard_no') !!}" vehicle_url="{!! url('invoice/get_vehicle') !!}" required>
                                                @if (!empty($customer))
                                                <option>{{ trans('message.Select Customer') }}</option>
                                                @foreach ($customer as $customers)
                                                <option value="{{ $customers->customer_id }}">
                                                    <?php echo getCustomerName($customers->customer_id);  
                                                    ?></option>
                                                @endforeach
                                                @endif
                                                <!-- if redirect from jobcard list -->
                                                @if (!empty($customer_job))
                                                <option value="{{ $customer_job->customer_id }}" id="jobcard_list_job" selected><?php echo getCustomerName($customer_job->customer_id); ?></option>
                                                @endif

                                                <!-- if redirect from sales list -->
                                                @if (!empty($tbl_sales))
                                                <option value="{{ $tbl_sales->customer_id }}" id="sales_list_id" selected><?php echo getCustomerName($tbl_sales->customer_id); ?></option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row row-mb-0">
                                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6" id="job" style="display:none">
                                        <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="job_card">{{ trans('message.Jobcard Number') }} <label class="color-danger">*</label></label>

                                        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                            <select name="Job_card" id="jobcard" class="form-control job_number form-select" job_url="{!! url('invoice/get_service_no') !!}" required>

                                                @if (!empty($customer_job))
                                                <option value="<?php echo $customer_job->id; ?>" class="job_no" selected>
                                                    <?php echo $customer_job->jocard_no; ?></option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    @if (!empty($customer_job))
                                    <input type="hidden" name="jobcard_no" value="{{ $customer_job->id }}">
                                    <input type="hidden" name="Invoice_type" value="{{ 0 }}">
                                    @elseif(!empty($tbl_sales))
                                    <input type="hidden" name="jobcard_no" value="{{ $tbl_sales->id }}">
                                    <input type="hidden" name="Invoice_type" value="{{ 1 }}">
                                    @else
                                    <input type="hidden" name="jobcard_no" class="servi_id" value="">
                                    @endif

                                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6" id="vehicle" style="display:none">
                                        <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="job_card">{{ trans('message.Select Vehicle') }} <label class="color-danger">*</label></label>
                                        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                            <select name="Vehicle" id="vhi_invoice" class="form-control vehi_name form-select" vehicle_amt="{!! url('invoice/get_vehicle_total') !!}" required>
                                                @if (!empty($tbl_sales))
                                                <option value="<?php echo $tbl_sales->vehicle_id; ?>" class="vehi_id" selected>
                                                    <?php echo getModelName($tbl_sales->vehicle_id); ?></option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                        <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 currency" for="cus_name">{{ trans('message.Total Amount') }} (<?php echo getCurrencySymbols(); ?>)
                                            <label class="color-danger">*</label></label>

                                        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                            @if (!empty($tbl_sales))
                                            <?php
                                            $price_sales = $tbl_sales->price;
                                            $total_sales = $total_rto + $price_sales;
                                            ?>
                                            <input type="text" name="Total_Amount" class="form-control ttl_amount" value="{{ $total_sales }}" readonly>
                                            @elseif(!empty($total_amount))
                                            <input type="text" name="Total_Amount" class="form-control ttl_amount" value="{{ $total_amount }}" readonly>
                                            @else
                                            <input type="text" name="Total_Amount" class="form-control ttl_amount" value="{{ $total_amount ?? '' }}" readonly>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row row-mb-0">

                                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                        <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="Date">{{ trans('message.Invoice Date') }} <label class="color-danger">*</label></label>

                                        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 date">
                                            <input type="text" name="Date" autocomplete="off" id="date_of_birth" class="form-control invoiceDate datepicker" placeholder="<?php echo getDatepicker(); ?>" value="{{ old('date', date('Y-m-d')) }}"onkeypress="return false;" required>
                                        </div>
                                    </div>
                                    
                                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                        <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="branch">{{ trans('message.Branch') }} <label class="color-danger">*</label></label>

                                        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                            <select class="form-control select_branch form-select" name="branch">
                                                @foreach ($branchDatas as $branchData)
                                                <option value="{{ $branchData->id }}">
                                                    {{ $branchData->branch_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                               
                                   

                                </div>
                                <div class="row row-mb-0">
                                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                        <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="cus_name">{{ trans('message.Status') }} <label class="color-danger">*</label></label>
                                        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                            <select name="Status" class="form-control paymentStatusSelect form-select" required>
                                                <option value="">{{ trans('message.Select Payment Status') }}
                                                </option>
                                                <option value="1">{{ trans('message.Partially paid') }}</option>
                                                <option value="2">{{ trans('message.Full Paid') }}</option>
                                                <option value="0">{{ trans('message.Unpaid') }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6  paymentTypeMainDiv">
                                        <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="cus_name">{{ trans('message.Payment Type') }} <label class="color-danger">*</label></label>
                                        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                            <select name="Payment_type" class="form-control paymentType form-select">
                                                <option value="">{{ trans('message.Select Payment Type') }}</option>
                                                @if (!empty($tbl_payments))
                                                @foreach ($tbl_payments as $tbl_paymentss)
                                                <option value="{{ $tbl_paymentss->id }}">
                                                    {{ $tbl_paymentss->payment }}
                                                </option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-mb-0">
                                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 paidAmountMainDiv">
                                        <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="cus_name">{{ trans('message.Paid Amount') }} (<?php echo getCurrencySymbols(); ?>)
                                            <label class="color-danger">*</label></label>
                                        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                            <input type="text" name="paidamount" class="form-control paidamount">
                                        </div>
                                    </div>

                                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                        <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="cus_name">{{ trans('message.Grand Total') }} (<?php echo getCurrencySymbols(); ?>)
                                            <label class="color-danger">*</label></label>
                                        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                            <input type="text" id="grandtotal" name="grandtotal" class="form-control grandtotal" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                
                                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                        <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="cus_name">{{ trans('message.Details') }}</label>
                                        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                            <textarea name="Details" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                        <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="cus_name">{{ trans('message.Discount (%)') }} </label>
                                        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                            <input type="text" maxlength="3" name="Discount" class="form-control discount" id="disc">
                                        </div>
                                    </div>
                                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                        <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="cus_name">{{ trans('message.Tax') }} </label>
                                        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                            <table>
                                                <tbody>
                                                    @foreach ($tax as $taxes)
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" id="tax" class="checkbox-inline check_tax sele_tax myCheckbox" name="Tax[]" value="<?php
                                                                                                                                                                        echo $taxes->taxname . ' ' . $taxes->tax ; ?>" taxrate="{{ $taxes->tax }}" style="height:20px; width:20px; margin-right:5px; position: relative; top: 6px; margin-bottom: 12px;">

                                                            <?php
                                                            echo $taxes->taxname . '&nbsp' . $taxes->tax; ?>%
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                 
                            </div>

                            <!-- Start Custom Field, (If register in Custom Field Module)  -->
                            @if (!empty($tbl_custom_fields))
                            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space mt-3">
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

                            $subDivCount++;
                            ?>
                            @if ($myCounts % 2 == 0)
                            <div class="row col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 row-mb-0">
                                @endif
                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 error_customfield_main_div_{{ $myCounts }}">

                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="account-no">{{ $tbl_custom_field->label }} <label class="color-danger">{{ $red }}</label></label>
                                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
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
                                            <input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}]" value="{{ $k }}" <?php if ($k == 0) {
                                                                                                                                                        echo 'checked';
                                                                                                                                                    } ?>>{{ $val }} &nbsp;
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
                                            <input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}][]" value="{{ $val }}" isRequire="{{ $required }}" fieldNameIs="{{ $tbl_custom_field->label }}" custm_isd="{{ $tbl_custom_field->id }}" class="checkbox_{{ $tbl_custom_field->id }} required_checkbox_{{ $tbl_custom_field->id }} checkbox_simple_class common_value_is_{{ $myCounts }} common_simple_class" rows_id="{{ $myCounts }}"> {{ $val }}
                                            &nbsp;
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
                            <!-- <div class="row">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                    <a class="btn supplierCancleButton" href="{{ URL::previous() }}">{{ trans('CANCEL') }}</a>
                                </div>
                            </div>
                        
                            </div>
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group">                         
                                <button type="submit" class="btn supplierSubmitButton">{{ trans('SUBMIT') }}</button> 
                            </div>
                            </div> -->

                            <div class="row mt-3">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <!-- <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                                    <a class="btn btn-primary InvoiceCancelButton" href="{{ URL::previous() }}">{{ trans('message.CANCEL') }}</a>
                                </div> -->
                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 InvoicesubmitButton my-1 mx-0">
                                    <button type="submit" class="btn btn-success InvoicesubmitButton">{{ trans('message.SUBMIT') }}</button>
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

        var msg8 = "{{ trans('message.OK') }}";
        $('.datepicker').datetimepicker({
            format: "<?php echo getDatepicker(); ?>",
            todayBtn: true,
            autoclose: 1,
            minView: 2,
            startDate: new Date(),
            language: "{{ getLangCode() }}",
        });

        // Initialize select2
        $("#selUser").select2();

        $('#form_add').submit(function() {

            var dis = $('#disc').val();

            var msg1 = "{{ trans('message.Discount Rate') }}";
            var msg2 = "{{ trans('message.Percentage must be less than or equal to 100') }}";

            if (dis > 100) {
                swal({
                    title: msg1,
                    text: msg2,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg8,
                    },
                    dangerMode: true,
                });
                return false;
            }
        });

        /*For JobCard Number*/
        $('body').on('change', '.select_cus', function() {
            var type = $(".invoicetype option:selected").val();
            var msg3 = "{{ trans('message.Invoice Alert') }}";
            var msg4 = "{{ trans('message.Invoice is already created...') }}";

            if (type == 0) {
                var url = $(this).attr('customer_url');
                var cus_name = $('.select_cus :selected').val();

                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {
                        cus_name: cus_name
                    },

                    success: function(response) {
                        if ($.trim(response) == '') {
                            swal({
                                title: msg3,
                                text: msg4,
                                cancelButtonColor: '#C1C1C1',
                                buttons: {
                                    cancel: msg8,
                                },
                                dangerMode: true,
                            });
                            $('.job_number').html(
                                '<option value="">Select Jobcard</option>');
                            return false;
                        }
                        $('.job_number').html('<option value="">Select Jobcard</option>');
                        $('.job_number').append(response);
                        $('.ttl_amount').val('0');
                        $('#grandtotal').val('0');
                    },
                    error: function(e) {
                        console.log(e);
                    }
                });
            } else {
                var vehi_url = $(this).attr('vehicle_url');
                var cus_name = $('.select_cus :selected').val();
                $.ajax({
                    type: "GET",
                    url: vehi_url,
                    data: {
                        cus_name: cus_name
                    },
                    success: function(response) {
                        if ($.trim(response) == '') {
                            swal({
                                title: msg3,
                                text: msg4,
                                cancelButtonColor: '#C1C1C1',
                                buttons: {
                                    cancel: msg8,
                                },
                                dangerMode: true,
                            });

                            $('.vehi_name').html(
                                '<option value="">Select Vehicle</option>');
                            return false;
                        }
                        $('.vehi_name').html('<option value="">Select Vehicle</option>');
                        $('.vehi_name').append(response);
                        $('.ttl_amount').val('0');
                        $('#grandtotal').val('0');
                    },
                    error: function(e) {
                        console.log(e);
                    }
                });
            }
        });

        //change jobcard number
        $('body').on('change', '.job_number', function() {

            var url = $(this).attr('job_url');
            var job_no = $('.job_number :selected').val();
            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    job_no: job_no
                },
                success: function(response) {
                    $('.ttl_amount').val(response[1]);
                    $('.servi_id').val(response[0]);
                    var total = $('.ttl_amount').val();
                    var disc = $('#disc').val();
                    if (disc != '') {
                        var discount = (parseFloat(total) * parseFloat(disc)) / 100;
                    } else {
                        var discount = 0;
                    }

                    var final = 0;
                    $('.myCheckbox:checked').each(function() {
                        var values = $(this).attr('taxrate');
                        final = parseFloat(values) + parseFloat(final);
                    });

                    var totalamount = parseFloat(total) - parseFloat(discount);
                    var totaltax = (parseFloat(totalamount) * parseFloat(final)) / 100;
                    var grandtotal = parseFloat(totalamount) + parseFloat(totaltax);
                    $('#grandtotal').val(grandtotal);
                },
                error: function(e) {
                    console.log(e);
                }
            });
        });


        //change vehicle name 
        $('body').on('change', '.vehi_name', function() {

            var vehicle_url = $(this).attr('vehicle_amt');
            var vehi_id = $('.vehi_name :selected').val();

            $.ajax({
                type: 'GET',
                url: vehicle_url,
                data: {
                    vehi_id: vehi_id
                },

                success: function(response) {
                    $('.ttl_amount').val(response[1]);
                    $('.servi_id').val(response[0]);
                    var total = $('.ttl_amount').val();
                    var disc = $('#disc').val();
                    if (disc != '') {
                        var discount = (parseFloat(total) * parseFloat(disc)) / 100;
                    } else {
                        var discount = 0;
                    }

                    var final = 0;
                    $('.myCheckbox:checked').each(function() {
                        var values = $(this).attr('taxrate');
                        final = parseFloat(values) + parseFloat(final);
                    });

                    var totalamount = parseFloat(total) - parseFloat(discount);
                    var totaltax = (parseFloat(totalamount) * parseFloat(final)) / 100;
                    var grandtotal = parseFloat(totalamount) + parseFloat(totaltax);
                    $('#grandtotal').val(grandtotal);
                },
                error: function(e) {
                    console.log(e);
                }
            });
        });


        /* on keyup in discount*/
        $('body').on('keyup', '#disc', function() {

            var msg1 = "{{ trans('message.Discount Rate') }}";
            var msg2 = "{{ trans('message.Percentage must be less than or equal to 100') }}";
            var total1 = $('.ttl_amount').val();
            if (total1 != '') {
                var total = total1;
            } else {
                var total = 0;
            }

            var disc = $('#disc').val();
            var discount = 0;
            if (disc != '') {
                if (disc > 100) {
                    swal({
                        title: msg1,
                        text: msg2,
                        cancelButtonColor: '#C1C1C1',
                        buttons: {
                            cancel: msg8,
                        },
                        dangerMode: true,
                    });

                    $('#disc').val(0);
                    discount = 0;
                } else {
                    discount = (parseFloat(total) * parseFloat(disc)) / 100;
                }
            } else {
                discount = 0;
            }

            var final = 0;

            $('.myCheckbox:checked').each(function() {
                var values = $(this).attr('taxrate');
                final = parseFloat(values) + parseFloat(final);
            });

            var totalamount = parseFloat(total) - parseFloat(discount);
            var totaltax = (parseFloat(totalamount) * parseFloat(final)) / 100;
            var grandtotal = parseFloat(totalamount) + parseFloat(totaltax);

            $('#grandtotal').val(grandtotal);
        });

        // changes taxt
        $('body').on('click', '.myCheckbox', function() {

            var total1 = $('.ttl_amount').val();

            if (total1 != '') {
                var total = total1;
            } else {
                var total = 0;
            }

            var disc = $('#disc').val();
            if (disc != '') {
                var discount = (parseFloat(total) * parseFloat(disc)) / 100;

            } else {
                var discount = 0;
            }

            var final = 0;
            $('.myCheckbox:checked').each(function() {
                var values = $(this).attr('taxrate');
                final = parseFloat(values) + parseFloat(final);
            });

            var totalamount = parseFloat(total) - parseFloat(discount);
            var totaltax = (parseFloat(totalamount) * parseFloat(final)) / 100;
            var grandtotal = parseFloat(totalamount) + parseFloat(totaltax);

            $('#grandtotal').val(grandtotal);
        });


        //-------if redirect from jobcard list-------
        var sales_list_id = $('#sales_list_id').val();

        if (sales_list_id != null) {
            $("#form_fields").show();
            $("#vehicle").show();
            $("#job").hide();
            $("#getid").show();
            $("#vhi").removeAttr('required', true);
            $("#jobcard").attr('required', false);
        }

        //-------if redirect from jobcard list-------
        var job_list_no = $('#jobcard_list_job').val();
        if (job_list_no != null) {
            $("#form_fields").show();
            $("#vehicle").hide();
            $("#getid").hide();
            $("#job").show();
            $("#vhi").removeAttr('required', false);
            $("#jobcard").attr('required', true);
        }


        var ttl_amount = $('.ttl_amount').val();
        var ttl_amount1 = $('#grandtotal').val(ttl_amount);

        //--------------------------------------------
        $('body').on('change', '.invoicetype', function() {

            var type = $(".invoicetype option:selected").val();
            $('#form_fields').slideDown(900);
            if (type == 0) {
                $("#vehicle").hide();
                $("#job").show();
                $("#vhi").removeAttr('required', false);
                $("#jobcard").attr('required', true);
            } else {
                $("#job").hide();
                $("#vehicle").show();
                $("#jobcard").removeAttr('required', false);
                $("#vhi").attr('required', true);
            }
            var sales_url = $(this).attr('sales_url');

            $.ajax({
                type: 'GET',
                url: sales_url,
                data: {
                    type: type
                },
                success: function(response) {
                    $('.customer_name').html("");
                    $('.customer_name').html(
                        '<option value="">{{ trans("message.Select Customer") }}</option>'
                    );
                    $('.customer_name').append(response);
                },
                error: function(e) {
                    console.log(e);
                }
            });
        });

        // Initialize select2
        $("#customer_select_box").select2();


        var type = $(".invoicetype option:selected").val();
        if (type == null) {} else {
            $('#customer_select_box').removeClass("select_customer_auto_search");
        }


        /*When option selected as an unpaid after paid amount textbox is disable*/
        $('body').on('change', '.paymentStatusSelect', function() {

            var statusValue = $('select[name=Status]').val();
            var grandTotalValue = $('.grandtotal').val(); 
            var paidAmountField = $('.paidamount');

            if (statusValue != null) {
                if (statusValue == 1) {
                    $('.paidAmountMainDiv').css({
                        "display": ""
                    });
                    $('.paymentTypeMainDiv').css({
                        "display": ""
                    });
                    $('.paidamount').val(grandTotalValue / 2);
                    paidAmountField.removeClass('is-invalid');
                    paidAmountField.addClass('is-valid');
                } else if (statusValue == 2) {
                    $('.paidAmountMainDiv').css({
                        "display": ""
                    });
                    $('.paymentTypeMainDiv').css({
                        "display": ""
                    });
                    $('.paidamount').val(grandTotalValue);
                    paidAmountField.removeClass('is-invalid');
                    paidAmountField.addClass('is-valid');
                } else if (statusValue == 0) {
                    $('.paidAmountMainDiv').css({
                        "display": "none"
                    });
                    $('.paymentTypeMainDiv').css({
                        "display": "none"
                    });
                    $('.paidamount').val("");
                    $('.paymentType').val("");
                }
            }
        });

        /* discount field accept only numbers */
        $('body').on('keyup', '.discount', function() {

            var discountAmt = $(this).val();
            var rgx = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)$/g;

            if (discountAmt > 100) {
                $(this).val(0);
            } else if (!discountAmt.replace(/\s/g, '').length) {
                $(this).val("");
            } else if (!rgx.test(discountAmt)) {
                $(this).val("");
            }
        });


        //paid amount
        $('body').on('keyup', '.paidamount', function() {

            var paidamount = $(this).val();
            var totalgrand = $('#grandtotal').val();
            var statusValue = $('select[name=Status]').val();

            var rgs = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)$/g;

            var msg5 = "{{ trans('message.Pay Amount') }}";
            var msg6 =
                "{{ trans('message.Please pay half or less than grand total amount, because you select half pay') }}";
            var msg7 =
                "{{ trans('message.Please pay only grand total amount, because you select full pay') }}";


            if (statusValue == 1) {
                if (parseInt(paidamount) > parseInt(totalgrand)) {
                    $(this).val(totalgrand / 2);
                    swal({
                        title: msg5,
                        text: msg6,
                        cancelButtonColor: '#C1C1C1',
                        buttons: {
                            cancel: msg8,
                        },
                        dangerMode: true,
                    });

                } else if (parseInt(paidamount) == parseInt(totalgrand)) {
                    $(this).val(totalgrand / 2);
                    swal({
                        title: msg5,
                        text: msg6,
                        cancelButtonColor: '#C1C1C1',
                        buttons: {
                            cancel: msg8,
                        },
                        dangerMode: true,
                    });

                } else if (parseInt(paidamount) == 0) {
                    $(this).val(totalgrand / 2);
                    swal({
                        title: msg5,
                        text: msg6,
                        cancelButtonColor: '#C1C1C1',
                        buttons: {
                            cancel: msg8,
                        },
                        dangerMode: true,
                    });

                } else if (!paidamount.replace(/\s/g, '').length) {
                    $(this).val("");
                } else if (!rgs.test(paidamount)) {
                    $(this).val("");
                }
            } else if (statusValue == 2) {
                if (parseInt(paidamount) > parseInt(totalgrand)) {
                    $(this).val(totalgrand);
                    swal({
                        title: msg5,
                        text: msg7,
                        cancelButtonColor: '#C1C1C1',
                        buttons: {
                            cancel: msg8,
                        },
                        dangerMode: true,
                    });

                } else if (parseInt(paidamount) < parseInt(totalgrand)) {
                    $(this).val(totalgrand);
                    swal({
                        title: msg5,
                        text: msg7,
                        cancelButtonColor: '#C1C1C1',
                        buttons: {
                            cancel: msg8,
                        },
                        dangerMode: true,
                    });

                } else if (parseInt(paidamount) == 0) {
                    $(this).val(totalgrand / 2);
                    swal({
                        title: msg5,
                        text: msg7,
                        cancelButtonColor: '#C1C1C1',
                        buttons: {
                            cancel: msg8,
                        },
                        dangerMode: true,
                    });

                } else if (!paidamount.replace(/\s/g, '').length) {
                    $(this).val("");
                } else if (!rgs.test(paidamount)) {
                    $(this).val("");
                }
            }
        });

        /*If select box have value then error msg and has error class remove*/
        $('body').on('change', '.invoiceDate', function() {

            var dateValue = $(this).val();

            if (dateValue != null) {
                $('#date_of_birth-error').css({
                    "display": "none"
                });
            }

            if (dateValue != null) {
                $(this).parent().parent().removeClass('has-error');
            }
        });


        $('.customer_name').on('change', function() {

            var customerValue = $('select[name=Customer]').val();

            if (customerValue != null) {
                $('#customer_select_box-error').css({
                    "display": "none"
                });
            }

            if (customerValue != null) {
                $(this).parent().parent().removeClass('has-error');
            }
        });



        /*Custom Field manually validation*/
        var msg1 = "{{ trans('message.field is required') }}";
        var msg2 = "{{ trans('message.Only blank space not allowed') }}";
        var msg3 = "{{ trans('message.Special symbols are not allowed.') }}";
        var msg4 = "{{ trans('message.At first position only alphabets are allowed.') }}";

        /*Form submit time check validation for Custom Fields */
        $('body').on('click', '.submitButton', function(e) {
            $('#form_add input, #form_add select, #form_add textarea').each(

                function(index) {
                    var input = $(this);

                    if (input.attr('name') == "Customer" || input.attr('name') == "Job_card" ||
                        input.attr('name') ==
                        "Date" || input.attr('name') == "Status") {
                        if (input.val() == "") {
                            return false;
                        }
                    } else if (input.attr('isRequire') == 'required') {
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


<!-- Form field validation -->
{!! JsValidator::formRequest('App\Http\Requests\InvoiceAddEditFormRequest', '#form_add') !!}
<script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>

@endsection