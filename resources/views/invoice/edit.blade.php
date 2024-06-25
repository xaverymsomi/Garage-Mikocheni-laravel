@extends('layouts.app')
@section('content')
<!-- Code Start -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a>
                        <a href="{!! url('/invoice/list') !!}" id=""><i class=""><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}"></i><span class="titleup">
                                {{ trans('message.Edit Invoice') }}</span></a>
                    </div>
                    @include('dashboard.profile')
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
            <div class="x_panel mb-0">
                <div class="x_content">
                    <form method="post" id="form_add" action="{{ url('/invoice/list/edit/update/' . $invoice_edit->id) }}" enctype="multipart/form-data" name="Form" class="form-horizontal upperform" onsubmit="return enableSample()">

                        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
                            <h4><b>{{ trans('message.INVOICE DETAILS') }}</b></h4>
                            <hr style="margin-top:0px;">
                            <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12"></p>
                        </div>

                        <div class="row row-mb-0">
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="cus_name">{{ trans('message.Invoice Number') }} <label class="color-danger">*</label></label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="text" name="Invoice_Number" class="form-control" value="{{ $invoice_edit->invoice_number }}" readonly>
                                </div>
                            </div>

                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="cus_name">{{ trans('message.Customer Name') }} <label class="color-danger">*</label></label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <select name="Customer" id="cust" class="form-control select_cus customer_name form-select" customer_url="{!! url('invoice/get_jobcard_no') !!}">
                                        <option value="">{{ trans('message.Select Customer') }}</option>
                                        @foreach ($customer as $customers)
                                        <option value="{{ $customers->customer_id }}" <?php if ($customers->customer_id == $invoice_edit->customer_id) {
                                                                                            echo 'selected';
                                                                                        } ?>>
                                            <?php echo getCustomerName($customers->customer_id); ?></option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row row-mb-0">
                            @if ($invoice_edit->type == 1 || $invoice_edit->type == 0)
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                <?php if (getVehicleName($invoice_edit->job_card) == null) { ?>
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="job_card">{{ trans('message.Jobcard Number') }} <label class="color-danger">*</label>
                                    </label>
                                <?php } else { ?>
                                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="job_card">{{ trans('message.Select Vehicle') }} <label class="color-danger">*</label>
                                    </label>
                                <?php } ?>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <select name="Job_card" id="jb" class="form-control job_number form-select" disabled>
                                        @if (!empty($invoice_edit))
                                        <option class="job_no" value="<?php echo $invoice_edit->job_card; ?>"><?php if (getVehicleName($invoice_edit->job_card) == null) {
                                                                                                                    echo $invoice_edit->job_card;
                                                                                                                } else {
                                                                                                                    echo getVehicleName($invoice_edit->job_card);
                                                                                                                } ?>
                                        </option>
                                        @endif
                                    </select>
                                    <input type="hidden" class="service_id" name="jobcard_no" value="{{ $invoice_edit->sales_service_id }}">
                                </div>
                            </div>
                            @endif

                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 currency" for="cus_name">{{ trans('message.Total Amount') }}
                                    (<?php echo getCurrencySymbols(); ?>) <label class="color-danger">*</label>
                                </label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="text" id="ttl_amt" name="Total_Amount" class="form-control ttl_amount" value="{{ number_format($invoice_edit->total_amount,2) }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row row-mb-0">
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="Date">{{ trans('message.Invoice Date') }} <label class="color-danger">*</label></label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 date">
                                    <input type="text" name="Date" autocomplete="off" id="date_of_birth" class="form-control invoiceDate datepicker" value="{{ date(getDateFormat(), strtotime($invoice_edit->date)) }}" placeholder="<?php echo getDateFormat(); ?>" onkeypress="return false;" required>
                                </div>
                            </div>

                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="branch">{{ trans('message.Branch') }} <label class="color-danger">*</label></label>

                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <select class="form-control select_branch form-select" name="branch">
                                        @foreach ($branchDatas as $branchData)
                                        <option value="{{ $branchData->id }}" <?php if ($invoice_edit->branch_id == $branchData->id) {
                                                                                    echo 'selected';
                                                                                } ?>>
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
                                        <option value="">{{ trans('message.Select Payment Status') }}</option>
                                        <option value="1" <?php if ($invoice_edit->payment_status == '1') {
                                                                echo 'selected';
                                                            } ?>>{{ trans('message.Partially paid') }}
                                        </option>
                                        <option value="2" <?php if ($invoice_edit->payment_status == '2') {
                                                                echo 'selected';
                                                            } ?>>{{ trans('message.Full Paid') }}
                                        </option>
                                        <option value="0" <?php if ($invoice_edit->payment_status == '0') {
                                                                echo 'selected';
                                                            } ?>>{{ trans('message.Unpaid') }}</option>
                                    </select>
                                    <input type="hidden" value="{{ $invoice_edit->payment_status }}" name="Status">
                                </div>
                            </div>

                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 paymentTypeMainDiv">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="cus_name">{{ trans('message.Payment Type') }} <label class="color-danger">*</label></label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <select name="Payment_type" class="form-control paymentType form-select">
                                        <option value="">{{ trans('message.Select Payment Type') }}</option>
                                        @if (!empty($tbl_payments))
                                        @foreach ($tbl_payments as $tbl_paymentss)
                                        <option value="{{ $tbl_paymentss->id }}" <?php if ($invoice_edit->payment_type == $tbl_paymentss->id) {
                                                                                        echo 'selected';
                                                                                    } ?>>
                                            {{ $tbl_paymentss->payment }}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <input type="hidden" value="{{ $invoice_edit->payment_type }}" name="Payment_type">
                                </div>
                            </div>
                        </div>
                        <div class="row row-mb-0">
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 paidAmountMainDiv">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="cus_name">{{ trans('message.Paid Amount') }} (<?php echo getCurrencySymbols(); ?>) <label class="color-danger">*</label></label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                <?php
                                    $paidAmount = $invoice_edit->amount_recevied;
                                    if (empty($paidAmount) || $invoice_edit->payment_status == '0') {
                                        $paidAmount = 0;
                                    }
                                    ?>    
                                    <input type="text" name="paidamount" value="{{ number_format($paidAmount,2) }}" class="form-control paidamount">
                                    <input type="hidden" id="amount_recevied" value="{{ $invoice_edit->amount_recevied }}">
                                </div>
                            </div>

                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="cus_name">{{ trans('message.Grand Total') }} (<?php echo getCurrencySymbols(); ?>) <label class="color-danger">*</label></label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="text" id="grandtotal" name="grandtotal" class="form-control grandtotal" value="{{ number_format($invoice_edit->grand_total,2) }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row amountDueMainDiv">
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 color-danger">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 " for="cus_name">{{ trans('message.Due Amount') }} (<?php echo getCurrencySymbols(); ?>) <label class="color-danger">*</label></label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="text" name="dueamount" id="dueamount" class="form-control dueamount" value="{{ number_format($dueamount,2) }}" readonly>
                                </div>
                            </div>
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="cus_name">{{ trans('message.Details') }}</label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <textarea name="Details" class="form-control">{{ $invoice_edit->details }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row row-mb-0">
                        <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 pt-0" for="cus_name">{{ trans('message.Discount (%)') }} </label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="text" name="Discount" maxlength="3" id="disc" class="form-control discount" value="{{ number_format($invoice_edit->discount,2) }}">
                                </div>
                            </div>
                           

                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="cus_name">{{ trans('message.Tax') }}
                                </label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <table>
                                        <tbody>
                                            <?php $edit_tax = explode(', ', $invoice_edit->tax_name); ?>
                                            @foreach ($tax as $taxes)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" id="tax" class="checkbox-inline check_tax sele_tax myCheckbox" name="Tax[]" value="<?php
                                                                                                                                                                echo $taxes->taxname . ' ' . $taxes->tax; ?>" taxrate="{{ $taxes->tax }}" style="height:20px; width:20px; margin-right:5px; position: relative; top: 6px; margin-bottom: 12px;" <?php if (in_array($taxes->taxname . ' ' . $taxes->tax, $edit_tax)) {
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
                        </div>

                       
                       

                        <!-- Custom Filed data value -->
                        @if (!empty($tbl_custom_fields))
                        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space">
                            <h4><b>{{ trans('message.Custom Fields') }}</b></h4>
                            <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 ln_solid"></p>
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
                        $userid = $invoice_edit->id;
                        $datavalue = getCustomDataInvoice($tbl_custom, $userid);

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
                                                                                                                                                //$formName = "product";
                                                                                                                                                $getRadioValue = getRadioLabelValueForUpdateForAllModules($tbl_custom_field->form_name, $invoice_edit->id, $tbl_custom_field->id);

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
                                    $getCheckboxValue = getCheckboxLabelValueForUpdateForAllModules($tbl_custom_field->form_name, $invoice_edit->id, $tbl_custom_field->id);
                                    ?>
                                    <div class="required_checkbox_parent_div_{{ $tbl_custom_field->id }}" style="margin-top: 5px;">
                                        @foreach ($checkboxLabelArrayList as $k => $val)
                                        <input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}][]" value="{{ $val }}" isRequire="{{ $required }}" fieldNameIs="{{ $tbl_custom_field->label }}" custm_isd="{{ $tbl_custom_field->id }}" class="checkbox_{{ $tbl_custom_field->id }} required_checkbox_{{ $tbl_custom_field->id }} checkbox_simple_class common_value_is_{{ $myCounts }} common_simple_class" rows_id="{{ $myCounts }}" <?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                                    if ($val == getCheckboxValForAllModule($tbl_custom_field->form_name, $invoice_edit->id, $tbl_custom_field->id, $val)) {
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
                                <button type="submit" class="btn btn-success submit updateInvoiceButton">{{ trans('message.UPDATE') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>

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


        /*on keyup in discount*/
        $('body').on('keyup', '#disc', function () {

            var msg1 = "{{ trans('message.Discount Rate') }}";
            var msg2 = "{{ trans('message.Percentage must be less than or equal to 100') }}";

            var total1 = parseFloat($('.ttl_amount').val().replace(/,/g, '')) || 0;
            var amountDueIs = $('#dueamount').val();
            var disc = parseFloat($('#disc').val()) || 0;

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
            var total = total1 - (total1 * (disc / 100));
            var final = 0;
            $('.myCheckbox:checked').each(function () {
                var values = parseFloat($(this).attr('taxrate'));
                final += isNaN(values) ? 0 : values;
            });

            var totaltax = (total * final) / 100;

            var grandtotal = total + totaltax;

            $('#grandtotal').val(grandtotal);
        });


        // changes taxt
        $('body').on('click', '.myCheckbox', function() {

            var total1 = parseFloat($('.ttl_amount').val().replace(/,/g, '')) || 0;

            var disc = parseFloat($('#disc').val()) || 0;

            var total = total1 - (total1 * (disc / 100));

            var final = 0;
            $('.myCheckbox:checked').each(function() {
                var values = parseFloat($(this).attr('taxrate'));
                final += isNaN(values) ? 0 : values;
            });

            var totaltax = (total * final) / 100;
            var grandtotal = total + totaltax;
            $('#grandtotal').val(grandtotal.toFixed(2));
        });

        //paid amount
        $('body').on('keyup', '.paidamount', function() {

            var paidamount = $(this).val();
            var dueamount = $('#dueamount').val();
            var amount_recevied = $('#amount_recevied').val();
            var totalgrand = parseInt(dueamount) + parseInt(amount_recevied);

            var grandtotal = $('#grandtotal').val();

            var statusValue = $('select[name=Status]').val();
            var rgs = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)$/g;

            var msg3 = "{{ trans('message.Pay Amount') }}";
            var msg4 =
                "{{ trans('message.Please pay half or less than grand total amount, because you select half pay') }}";
            var msg5 =
                "{{ trans('message.Please pay only grand total amount, because you select full pay') }}";
            var msg6 = "{{ trans('message.Please pay only due amount, because you select full pay') }}";

            if (statusValue == 1) {
                if (parseInt(paidamount) > parseInt(grandtotal)) {
                    $(this).val(grandtotal / 2);
                    $('#dueamount').val(grandtotal / 2);
                    swal({
                        title: msg3,
                        text: msg4,
                        cancelButtonColor: '#C1C1C1',
                        buttons: {
                            cancel: msg8,
                        },
                        dangerMode: true,
                    });
                } else if (parseInt(paidamount) == parseInt(grandtotal)) {
                    $(this).val(grandtotal / 2);
                    $('#dueamount').val(grandtotal / 2);
                    swal({
                        title: msg3,
                        text: msg4,
                        cancelButtonColor: '#C1C1C1',
                        buttons: {
                            cancel: msg8,
                        },
                        dangerMode: true,
                    });
                } else if (parseInt(paidamount) == 0) {
                    $(this).val(grandtotal / 2);
                    $('#dueamount').val(grandtotal / 2);
                    swal({
                        title: msg3,
                        text: msg4,
                        cancelButtonColor: '#C1C1C1',
                        buttons: {
                            cancel: msg8,
                        },
                        dangerMode: true,
                    });
                    alert("hello");
                } else if (parseInt(paidamount) < parseInt(grandtotal)) {
                    $('#dueamount').val(grandtotal - paidamount);
                } else if (!paidamount.replace(/\s/g, '').length) {
                    $(this).val("");
                    $('#dueamount').val(grandtotal);
                } else if (!rgs.test(paidamount)) {}
            } else if (statusValue == 2) {
                if (parseInt(paidamount) > parseInt(grandtotal)) {
                    $(this).val(grandtotal);
                    $('#dueamount').val(0);
                    swal({
                        title: msg3,
                        text: msg6,
                        cancelButtonColor: '#C1C1C1',
                        buttons: {
                            cancel: msg8,
                        },
                        dangerMode: true,
                    });

                } else if (parseInt(paidamount) < parseInt(grandtotal)) {
                    $(this).val(grandtotal);
                    $('#dueamount').val(0);
                    swal({
                        title: msg3,
                        text: msg6,
                        cancelButtonColor: '#C1C1C1',
                        buttons: {
                            cancel: msg8,
                        },
                        dangerMode: true,
                    });
                } else if (parseInt(paidamount) == 0) {
                    $(this).val(grandtotal);
                    $('#dueamount').val(0);
                    swal({
                        title: msg3,
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
            } else if (statusValue == 0) {
                $(this).val(0);
            }
        });

        //jobcard number 
        $('body').on('change', '.select_cus', function() {

            var url = $(this).attr('customer_url');
            var cus_name = $('.select_cus :selected').val();

            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    cus_name: cus_name
                },
                success: function(response) {
                    $('.job_no').remove();
                    $('.job_number').append(response);
                },
                error: function(e) {
                    console.log(e);
                }
            });
        });

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
                    var s_id = $.trim(response);
                    $('.service_id').val(s_id);
                },
                error: function(e) {
                    console.log(e);
                }
            });
        });



        function enableSample() {}

        /* discount field accept only numbers */
        $('body').on('keyup', '.discount', function() {

            var discountAmt = $(this).val();
            var useRegex = /^[0-9]*\d?(\.\d{1,2})?$/;

            if (discountAmt > 100) {
                $(this).val(0);
            } else if (!discountAmt.replace(/\s/g, '').length) {
                $(this).val("");
            } else if (!useRegex.test(discountAmt)) {
                $(this).val("");
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
                $('#cust-error').css({
                    "display": "none"
                });
            }

            if (customerValue != null) {
                $(this).parent().parent().removeClass('has-error');
            }
        });

        $('body').on('change', '.paymentStatusSelect', function() {

            var statusValue = $('select[name=Status]').val();
            var grandTotalValue = $('.grandtotal').val();
            var dueAmount = $('.dueamount').val();

            if (statusValue != null) {
                if (statusValue == 1) {
                    $('.paidAmountMainDiv').css({
                        "display": ""
                    });
                    $('.paymentTypeMainDiv').css({
                        "display": ""
                    });
                    $('.amountDueMainDiv').css({
                        "display": ""
                    });
                    $('.paidamount').val(grandTotalValue / 2);
                } else if (statusValue == 2) {
                    $('.paidAmountMainDiv').css({
                        "display": ""
                    });
                    $('.paymentTypeMainDiv').css({
                        "display": ""
                    });
                    $('.amountDueMainDiv').css({
                        "display": ""
                    });
                    $('.paidamount').val(grandTotalValue);
                    $('.dueamount').val(0);
                } else if (statusValue == 0) {
                    $('.paidAmountMainDiv').css({
                        "display": "none"
                    });
                    $('.paymentTypeMainDiv').css({
                        "display": "none"
                    });
                    $('.amountDueMainDiv').css({
                        "display": "none"
                    });
                    $('.paidamount').val("");
                    $('.paymentType').val("");
                }
            }
        });


        /*Custom Field manually validation*/
        var msg1 = "{{ trans('message.field is required') }}";
        var msg2 = "{{ trans('message.Only blank space not allowed') }}";
        var msg3 = "{{ trans('message.Special symbols are not allowed.') }}";
        var msg4 = "{{ trans('message.At first position only alphabets are allowed.') }}";

        /*Form submit time check validation for Custom Fields */
        $('body').on('click', '.updateInvoiceButton', function(e) {
            $('#form_add input, #form_add select, #form_add textarea').each(

                function(index) {
                    var input = $(this);

                    if (input.attr('name') == "Customer" || input.attr('name') == "Job_card" ||
                        input.attr('name') ==
                        "Date" || input.attr('name') == "Status") {
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
                                $('.error_customfield_main_div_' + rowid).removeClass('has-error');
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