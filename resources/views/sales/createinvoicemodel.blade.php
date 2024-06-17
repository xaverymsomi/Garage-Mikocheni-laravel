<div class="modal-header">
    <h4 class="modal-title" id="exampleModalLabel1">{{ trans('message.Create Invoice') }}</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="x_content">
        <form method="post" id="form_add" action="{{ url('/invoice/store') }}" enctype="multipart/form-data" name="Form" class="form-horizontal upperform saleAddForm">
            @csrf
            <div class="col-md-12 col-xs-12 col-sm-12">
                <!-- <h4><b>{{ trans('message.Invoice Details') }}</b></h4> -->
                
            </div>
            <div class="row">
                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                        <input type="hidden" value="1" name="Invoice_type">
                        <input type="hidden" name="jobcard_no" value="{{ $sale->id }}">

                    </div>

                </div>

                <div id="form_fields">
                    <div class="row mt-3">
                        <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                            <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 p-0 ps-2 mt-2" for="cus_name">{{ trans('message.Invoice Number') }} <label class="color-danger">*</label></label>
                            <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                <input type="text" name="Invoice_Number" class="form-control" value="{{ $code }}" readonly="">

                                <input type="hidden" name="paymentno" value="{{ $codepay }}">
                            </div>
                        </div>
                        <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                            <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 p-0 ps-1 mt-2" for="cus_name">{{ trans('message.Customer Name') }} <label class="color-danger">*</label></label>
                            <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                <input type="text" class="form-control" value="{{ getCustomerName($sale->customer_id) }}" readonly="" id="customer_select_box1">
                                <input type="hidden" name="Customer" value="{{ $sale->customer_id }}">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6" id="vehicle">
                            <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 ps-2" for="job_card">{{ trans('message.Select Vehicle') }} <label class="color-danger">*</label></label>
                            <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                <input type="text" value="{{ getModelName($sale->vehicle_id) }}" class="form-control">
                                <input type="hidden" name="Vehicle" value="{{ $sale->vehicle_id }}">
                            </div>
                        </div>
                        <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                            <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 currency" for="cus_name">{{ trans('message.Total Amount') }} (<?php echo getCurrencySymbols(); ?>)
                                <label class="color-danger">*</label></label>

                            <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                <?php
                                $total_sales = $sale->price;
                                // $total_sales = $total_rto + $price_sales;
                                ?>
                                <input type="text" name="Total_Amount" class="form-control ttl_amount" value="{{ $total_sales }}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">

                        <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                            <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="Date">{{ trans('message.Invoice Date') }} <label class="color-danger">*</label></label>
                            <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 date">
                                <input type="text" name="Date" autocomplete="off" id="date_of_birth" class="form-control invoiceDate datepicker" placeholder="yyyy-mm-dd" onkeypress="return false;" required="" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        
                        <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                            <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="branch">{{ trans('message.Branch') }} <label class="color-danger">*</label></label>

                            <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                <div class="select-wrapper">
                                    <select class="form-control select_branch form-select" name="branch">
                                        @foreach ($branchDatas as $branchData)
                                        <option value="{{ $branchData->id }}">
                                            {{ $branchData->branch_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class="arrow-icon"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                            <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="cus_name">{{ trans('message.Status') }} <label class="color-danger">*</label></label>
                            <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                <div class="select-wrapper">
                                    <select name="Status" class="form-control paymentStatusSelect form-select" required>
                                        <option value="">{{ trans('message.Select Payment Status') }}
                                        </option>
                                        <option value="1">{{ trans('message.Partially paid') }}</option>
                                        <option value="2">{{ trans('message.Full Paid') }}</option>
                                        <option value="0">{{ trans('message.Unpaid') }}</option>
                                    </select>
                                    <div class="arrow-icon"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6  paymentTypeMainDiv">
                            <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 p-0 ps-3 mt-2" for="cus_name">{{ trans('message.Payment Type') }} <label class="color-danger">*</label></label>
                            <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                <div class="select-wrapper">
                                    <select name="Payment_type" class="form-control paymentType form-select" required>
                                        <option value="">{{ trans('message.Select Payment Type') }}</option>
                                        @if (!empty($tbl_payments))
                                        @foreach ($tbl_payments as $tbl_paymentss)
                                        <option value="{{ $tbl_paymentss->id }}">
                                            {{ $tbl_paymentss->payment }}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <div class="arrow-icon"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 paidAmountMainDiv">
                            <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="cus_name">{{ trans('message.Paid Amount') }} (<?php echo getCurrencySymbols(); ?>)
                                <label class="color-danger">*</label></label>
                            <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                <input type="text" name="paidamount" class="form-control paidamount">
                            </div>
                        </div>

                        <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                            <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 p-0 ps-2 mt-2" for="cus_name">{{ trans('message.Grand Total') }} (<?php echo getCurrencySymbols(); ?>)
                                <label class="color-danger">*</label></label>
                            <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                <input type="text" id="grandtotal" name="grandtotal" class="form-control grandtotal" value="{{ $total_sales }}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                            <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="cus_name">{{ trans('message.Discount (%)') }} </label>
                            <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                <input type="text" maxlength="3" name="Discount" class="form-control discount" id="disc">
                            </div>
                        </div>
                        <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                            <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="cus_name">{{ trans('message.Details') }}</label>
                            <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                <textarea name="Details" class="form-control"></textarea>
                            </div>
                        </div>
                       
                    </div>

                    <div class="row mt-3"> 
                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                            <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="cus_name">{{ trans('message.Tax') }} </label>
                            <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                <table>
                                    <tbody>
                                        @foreach ($tax as $taxes)
                                        <tr>
                                            <td class="bg-white text-dark">
                                                <input type="checkbox" class="checkbox-inline check_tax sele_tax myCheckbox" name="Tax[]" value="<?php
                                                                                                                                                    echo $taxes->taxname . ' ' . $taxes->tax ; ?>" data-taxrate="{{ $taxes->tax }}" style="height:20px; width:20px; margin-right:5px; position: relative; top: 6px; margin-bottom: 12px">
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
                            <div class="row col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
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

                <input type="hidden" name="_token" value="NH74bfpPqL8FDT4EPtk5BUXOi06TgukLMeaTZFI2">

                <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 mt-3">
                    <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0 text-center">
                        <!-- <a class="btn btn-primary cancleinvoicebutton" href="{{ URL::previous() }}">{{ trans('message.CANCEL') }}</a> -->
                        </div>
                        <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">

                        <button type="submit" class="btn btn-success submitinvoiceButton">{{ trans('message.SUBMIT') }}</button>
                        </div>
                    
                </div>

            </div>
        </form>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary btn-sm mx-1" data-bs-dismiss="modal">{{ trans('message.Close') }}</button>
</div>

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

      var disc = $(this).val();
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
        var values = $(this).data('taxrate');
        final = parseFloat(values) + parseFloat(final);
      });

      var totalamount = parseFloat(total) - parseFloat(discount);
      var totaltax = (parseFloat(totalamount) * parseFloat(final)) / 100;
      var grandtotal = parseFloat(totalamount) + parseFloat(totaltax);

      $('#disc').val(disc);

      $('.grandtotal').val(grandtotal);
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
        var values = $(this).data('taxrate');
        final = parseFloat(values) + parseFloat(final);
      });

      var totalamount = parseFloat(total) - parseFloat(discount);
      var totaltax = (parseFloat(totalamount) * parseFloat(final)) / 100;
      var grandtotal = parseFloat(totalamount) + parseFloat(totaltax);

      $('.grandtotal').val(grandtotal);
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
      var statusValue = $(this).val(); // Get the value of the selected option
      var grandTotalValue = $('.grandtotal').val();

      if (statusValue != null) {
        console.log(statusValue);
        if (statusValue == 1) {
          $('.paidAmountMainDiv').css({
            "display": ""
          });
          $('.paymentTypeMainDiv').css({
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
          $('.paidamount').val(grandTotalValue);
        } else if (statusValue == 0) {
          $('.paidAmountMainDiv').css({
            "display": "none"
          });
          $('.paymentTypeMainDiv').css({
            "display": "none"
          });
          $('.paidamount').val("");
          $('.paymentType').val("");
          $('.paymentType').removeAttr('required');
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