@extends('layouts.app')
@section('content')

<style>
  .table>tbody>tr>td {
    padding: 5px;
  }

  .price {
    font-size: 15px;
    color: #555 !important;
  }
</style>

<!-- page content -->
<div class="right_col" role="main">
  <div class="page-title">
    <div class="nav_menu">
      <nav>
        <div class="nav toggle">
          <a id="menu_toggle">&nbsp;<i class="fa fa-bars sidemenu_toggle"></i></a><span class="titleup"><a href="{!! url('/purchase/list') !!}" id=""><i class=""><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}"></i><span class="titleup">
                {{ trans('message.Add Purchase') }}</span></a>
        </div>
        @include('dashboard.profile')
      </nav>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_content">
          <form id="purchaseAdd-Form" method="post" action="{{ url('/purchase/store') }}" enctype="multipart/form-data" class="form-horizontal upperform purchaseAddForm">

            <div class="row row-mb-0">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Purchase No') }} <label class="color-danger">*</label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" id="p_no" name="p_no" value="{{ $code }}" class="form-control" value="" readonly>
                </div>
              </div>

              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="last-name">{{ trans('message.Purchase Date') }} <label class="color-danger">*</label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8  date">
                  <input type="text" id="pur_date" name="p_date" autocomplete="off" class="form-control datepicker purchaseDate" value="{{ old('p_date', date('Y-m-d')) }}" placeholder="<?php echo getDatepicker(); ?>" onkeypress="return false;" required />
                </div>
              </div>
            </div>

            <div class="row row-mb-0">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 ">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 form-label" for="last-name">{{ trans('message.Supplier Name') }} <label class="color-danger">*</label></label>
                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-8 col-sm-8 col-xs-8 form-group">
                  <select class="form-control select_supplier_auto_search s_product w-100 form-select" name="s_name" id="supplier_select" url="{!! url('purchase/add/getrecord') !!}" s_url="{!! url('purchase/add/getsupplierproduct') !!}" required>
                    <option value="">{{ trans('message.select supplier') }}</option>
                    @if (!empty($supplier))
                    @foreach ($supplier as $suppliers)
                    <option value="{{ $suppliers->id }}">{{ $suppliers->company_name }}</option>
                    @endforeach
                    @endif
                  </select>
                  <div class="invalid-feedback">
                    Please select an option.
                  </div>
                </div>
              </div>

              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 mobile-no-div">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 pt-0" for="first-name">{{ trans('message.Mobile No') }} <label class="color-danger">*</label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" id="mobile" name="mobile" class="form-control" placeholder="{{ trans('message.Enter Mobile No') }}" readonly>
                </div>
              </div>
            </div>

            <div class="row row-mb-0">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="last-name">{{ trans('message.Email') }} <label class="color-danger">*</label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" id="email" name="email" class="form-control" placeholder="{{ trans('message.Enter Email') }} " readonly>
                </div>
              </div>

              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="last-name">{{ trans('message.Billing Address') }} <label class="color-danger">*</label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <textarea id="address" name="address" class="form-control" readonly></textarea>
                </div>
              </div>
            </div>

            <div class="row row-mb-0">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="branch">{{ trans('message.Branch') }} <label class="color-danger">*</label></label>

                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <select class="form-control select_branch form-select" name="branch">
                    @foreach ($branchDatas as $branchData)
                    <option value="{{ $branchData->id }}">{{ $branchData->branch_name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            <div class="row col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 form-group mt-4">
              <div class="col-md-10 col-lg-10 col-xl-10 col-xxl-10 col-sm-10 col-xs-10 header">
                <h4><b>{{ trans('message.PURCHASE DETAILS') }}</b>
                  <button type="button" id="add_new_product" class="btn btn-outline-secondary btn-sm add_details" s_url="{!! url('purchase/add/getsupplierproduct') !!}" url="{!! url('purchase/add/getproductname') !!}">{{ trans('+') }}</button>
                </h4>
              </div>
            </div>
            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 table-responsive float-none">
              <table class="table table-bordered adddatatable" id="tab_taxes_detail" align="center">
                <thead>
                  <tr>
                    <th class="actionre">{{ trans('message.Manufacturer Name') }}</th>
                    <th class="actionre">{{ trans('message.Product Name') }}</th>
                    <th class="actionre">{{ trans('message.Quantity') }}</th>
                    <th class="actionre">{{ trans('VAT') }}</th>
                    <th class="actionre">{{ trans('message.Price') }} (<?php echo getCurrencySymbols(); ?>)</th>
                    <th class="actionre">{{ trans('message.Amount') }} (<?php echo getCurrencySymbols(); ?>)</th>
                    <th class="actionre">{{ trans('message.Action') }}</th>

                  </tr>
                </thead>
                <tbody> 
                  <tr id="row_id_1">
                    <td class="my-form-group">
                      <input type="hidden" value="1" name="product[tr_id][]" />
                      <div class="select-wrapper">
                        <select required class="form-control select_producttype form-select" name="product[Manufacturer_id][]" m_url="{!! url('/purchase/producttype/name') !!}" man_sel_url="{!! url('purchase/getfirstproductdata') !!}" row_did="1" row_id="1" data-id="1" style="width:100%;">
                          <option value="">{{ trans('message.Select Manufacturer') }}</option>                          
                        </select>
                        <div class="arrow-icon"></div>
                      </div>
                    </td>
                    <td class="my-form-group">
                      <div class="select-wrapper">
                      <select name="product[product_id][]" class="form-control productid select_productname_1 form-select" url="{!! url('purchase/add/getproduct') !!}" row_did="1" data-id="1" style="width:100%;" required="required">
                          <option value="">{{ trans('message.Select Product') }}</option>
                        </select>
                        <div class="arrow-icon"></div>
                      </div>
                    </td>
                    <td>
                      <input type="number" name="product[qty][]" url="{!! url('purchase/add/getqty') !!}" class="quantity form-control qty qty_1" id="qty_1" row_id="1" value="1" maxlength="8">
                      <!-- <span class="qty_1">{{ $first_product->product_no??"" }}</span> -->
                    </td>
                     
                     <td class="my-form-group">
                     <!--  <input type="hidden" value="1" name="product[tr_id][]" /> -->
                      <div class="select-wrapper">
                        <select required class="form-control form-select vat vat_1" name="product[vat][]" id="vat_1" row_id="1" style="width:100%;">
                          <option value="0">{{ trans('No TAX') }}</option>   
                          <option value="0.18">{{ trans('18%') }}</option>                       
                        </select>
                        <div class="arrow-icon"></div>
                      </div>
                    </td>

                    <td>
                      <input required type="text" name="product[price][]" class="product form-control prices price_1" value="" id="price_1" style="width:100%;" row_id="1" style="width:100%;">
                    </td>
                    <td>
                      <input type="text" name="product[total_price][]" class="product form-control total_price total_price_1" value="" style="width:100%;" id="total_price_1" readonly="true">
                    </td>
                    <td align="center">

                    </td>
                    <input type="hidden" value="1" name="row_number" class="row_number">
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- Start Custom Field, (If register in Custom Field Module)  -->
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
            $subDivCount++;
            ?>
            @if ($myCounts % 2 == 0)
            <div class="row">
              @endif

              <div class="row form-group col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 error_customfield_main_div_{{ $myCounts }}">

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
                    <input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}][]" value="{{ $val }}" isRequire="{{ $required }}" fieldNameIs="{{ $tbl_custom_field->label }}" custm_isd="{{ $tbl_custom_field->id }}" class="checkbox_{{ $tbl_custom_field->id }} required_checkbox_{{ $tbl_custom_field->id }} checkbox_simple_class common_value_is_{{ $myCounts }} common_simple_class" rows_id="{{ $myCounts }}"> {{ $val }} &nbsp;
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

            <!-- Submit and Cancel Part -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row">
              <!-- <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                <a class="btn btn-primary purchaseCancleButton" href="{{ URL::previous() }}">{{ trans('message.CANCEL') }}</a>
              </div> -->
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                <button type="submit" class="btn btn-success purchaseSubmitButton">{{ trans('message.SUBMIT') }}</button>
              </div>
            </div>
            <!-- Submit and Cancel Part End-->
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<script>
  $(document).ready(function() {


    $('body').on('change', '.select_producttype', function() {
      var row_id = $(this).attr('row_did');
      var m_id = $(this).val();
      var url = $(this).attr('m_url');

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


    var msg100 = "{{ trans('app.An error occurred :') }}";

    // $("#add_new_product").click(function() {
    //   var url = $(this).attr('url');
    //   var supplier_id = $('#supplier_select').val();

    //   var row_len = jQuery(".row_number").length;
    //   if (row_len > 0) {
    //     var num = jQuery(".row_number:last").val();
    //     var row_id = parseInt(num) + 1;
    //   } else {
    //     var row_id = 0;
    //   }

    //   $.ajax({
    //     type: 'GET',
    //     url: url,
    //     data: {
    //       row_id: row_id,
    //       supplier_id: supplier_id
    //     },

    //     beforeSend: function() {
    //       $("#add_new_product").prop('disabled', false);
    //     },
    //     success: function(response) {
    //       $("#tab_taxes_detail > tbody").append(response.html);
    //       $('.adddatatable').add($(response.html));
    //       $("#add_new_product").prop('disabled', false);
    //       return false;
    //     },
    //     error: function(e) {
    //       alert(msg100 + " " + e.responseText);
    //       console.log(e);
    //     }
    //   });
    // });



    $('body').on('click', '.product_delete', function() {

      var row_id = $(this).attr('data-id');
      $('table#tab_taxes_detail tr#row_id_' + row_id).fadeOut();
      $('table#tab_taxes_detail tr.child').fadeOut();

      $('table#tab_taxes_detail tr#row_id_' + row_id).html('<option value="">Select product</option>');
      $('table#tab_taxes_detail tr#row_id_' + row_id).html(
        '<input type="text" name="" class="form-control qty" value="" id="tax_1" readonly="true">');
      $('table#tab_taxes_detail tr#row_id_' + row_id).html(
        '<input type="text" name="" class="form-control price" value="" id="tax_1" readonly="true">');
      $('table#tab_taxes_detail tr#row_id_' + row_id).html(
        '<input type="text" name="" class="form-control total_price" value="" id="tax_1" readonly="true">');
      $('table#tab_taxes_detail tr#row_id_' + row_id).html('<span class="product_delete" data-id="0"></span>');
      return false;
    });


    $('body').on('change', '.productid', '.qty', function() {
      var row_id = $(this).attr('row_did');
      var p_id = $(this).val();
      var qty = $('.qty_' + row_id).val();
      var vat = $('.vat_' + row_id).val();
      var price = $('.price_' + row_id).val();
      var url = $(this).attr('url');

      $.ajax({
        type: 'GET',
        url: url,
        data: {
          p_id: p_id
        },
        success: function(response) {
          var json_obj = jQuery.parseJSON(response);
          var price = json_obj['price'];
          // var total_price = price * qty;

          var totalprice = price * qty;
          var totalvat = totalprice * vat;
          // alert(vat);
          var total_price = totalprice + totalvat;
          $('.price_' + row_id).val(price);
          $('.total_price_' + row_id).val(total_price);
          var product_no = json_obj['product_no'];
          $('.qty_' + row_id).html(product_no);
        },
        error: function(e) {
          alert(msg100 + " " + e.responseText);
          console.log(e);
        }
      });
    });

    $('body').on('change', '.qty', function() {
      var row_id = $(this).attr('row_id');
      var p_id = $('.select_productname_' + row_id).val();
      var priceVal = $('.price_' + row_id).val();

      var msg3 = "{{ trans('app.First select product name') }}";
      var msg4 = "{{ trans('app.An error occurred :') }}";

      var vat = $('.vat_' + row_id).val();

      if (p_id == '') {
        alert(msg3);
        $('.qty_' + row_id).val('1');
      } else if (this.value == "") {
        $('.qty_' + row_id).val('1');
        $('.total_price_' + row_id).val(priceVal * 1);
      } else {
        if (/\D/g.test(this.value)) {
          $('.qty_' + row_id).val('1');
          $('.total_price_' + row_id).val(priceVal * 1);
        } else {
          var qty = $('.qty_' + row_id).val();

          var price = $('.price_' + row_id).val();

          var url = $(this).attr('url');
          $.ajax({
            type: 'GET',
            url: url,
            data: {
              qty: qty,
              price: price
            },
            success: function(response) {
              var totalprice = price * qty;
              var totalvat = totalprice * vat;
              // alert(vat);
               total_price = totalprice + totalvat;
              // total_price = price * qty;
              $('.total_price_' + row_id).val(total_price);
            },
            beforeSend: function() {},
            error: function(e) {
              alert(msg100 + " " + e.responseText);
              console.log(e);
            }
          });
        }
      }
    });

     $('body').on('change', '.vat', function() {
      var row_id = $(this).attr('row_id');
      var p_id = $('.select_productname_' + row_id).val();
      var priceVal = $('.price_' + row_id).val();

      var msg3 = "{{ trans('app.First select product name') }}";
      var msg4 = "{{ trans('app.An error occurred :') }}";

      var vat = $('.vat_' + row_id).val();

    
          var qty = $('.qty_' + row_id).val();

          var price = $('.price_' + row_id).val();

          var url = $(this).attr('url');
          $.ajax({
            type: 'GET',
            url: url,
            data: {
              qty: qty,
              price: price
            },
            success: function(response) {
              var totalprice = price * qty;
              var totalvat = totalprice * vat;
              // alert(vat);
               total_price = totalprice + totalvat;
              // total_price = price * qty;
              $('.total_price_' + row_id).val(total_price);
            },
            beforeSend: function() {},
            error: function(e) {
              alert(msg100 + " " + e.responseText);
              console.log(e);
            }
          });
        
      
    });


    $(function() {
      $('#supplier_select').change(function() {
        var supplier_id = $(this).val();
        var url = $(this).attr('url');

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
            alert(msg100 + " " + e.responseText);
            console.log(e);
          }
        });
      });
    });


    $(".datepicker").datetimepicker({
      format: "<?php echo getDatepicker(); ?>",
      maxDate: new Date(),
      todayBtn: true,
      autoclose: 1,
      minView: 2,
      endDate: new Date(),
      language: "{{ getLangCode() }}",
    });

    /*Using Slect2 make auto searchable dropdown for supplier select*/
    // Initialize select2
    $(".select_supplier_auto_search").select2();

    /*Price field should editable and editable price should change the Total-Amount (on-time editable price )*/
    $('body').on('change', '.prices', function() {
      var row_id = $(this).attr('row_id');
      var qty = $('.qty_' + row_id).val();
      var price = $('.price_' + row_id).val();
      var vat = $('.vat_' + row_id).val();
    
      var totalprice = price * qty;
      var totalvat = totalprice * vat;
      var total_price = totalprice + totalvat;


      if (price == 0 || price == null) {
        $('.price_' + row_id).val("");
        $('.price_' + row_id).attr('required', true);
      } else {
        $('.price_' + row_id).val(price);
        $('.total_price_' + row_id).val(total_price);
      }
    });


    /*Select product type time chages all value of selected product*/
    $('body').on('change', '.select_producttype', function() {
      var row_id = $(this).attr('row_id');
      var selected_option_value = $(this, ':selected').val();
      var url = $(this).attr('man_sel_url');

      $.ajax({
        type: "GET",
        url: url,
        data: {
          productTypeId: selected_option_value
        },
        success: function(response) {
          if (response.success == 'yes') {
            $('.price_' + row_id).val(response.data);
            $('.total_price_' + row_id).val(response.data);
            $('.qty_' + row_id).val(1);
            $('.qty_' + row_id).text(response.product_number);
          }
        }
      });
    });


    /*Key up time price field should value with 1*/
    $('body').on('keyup', '.prices', function() {
      var row_id = $(this).attr('row_id');
      var price = $('.price_' + row_id).val();

      if (price == '') {
        $('.price_' + row_id).val(1);
      } else {
        if (/\D/g.test(this.value)) {
          $('.price_' + row_id).val(1);
        }
      }
    });


    /*If date field have value then error msg and has error class remove*/
    $('body').on('change', '.purchaseDate', function() {
      var pDateValue = $(this).val();

      if (pDateValue != null) {
        $('#pur_date-error').css({
          "display": "none"
        });
      }

      if (pDateValue != null) {
        $(this).parent().parent().removeClass('has-error');
      }
    });


    /*If select box have value then error msg and has error class remove*/
    $(document).ready(function() {
      $('#supplier_select').on('change', function() {

        var supplierValue = $('select[name=s_name]').val();

        if (supplierValue != null) {
          $('#supplier_select-error').css({
            "display": "none"
          });
        }

        if (supplierValue != null) {
          $(this).parent().parent().removeClass('has-error');
        }
      });
    });



    /*Custom Field manually validation*/
    var msg1 = "{{ trans('app.field is required') }}";
    var msg2 = "{{ trans('app.Only blank space not allowed') }}";
    var msg3 = "{{ trans('app.Special symbols are not allowed.') }}";
    var msg4 = "{{ trans('app.At first position only alphabets are allowed.') }}";

    /*Form submit time check validation for Custom Fields */
    $('body').on('click', '.purchaseSubmitButton', function(e) {
      $('#purchaseAdd-Form input, #purchaseAdd-Form select, #purchaseAdd-Form textarea').each(

        function(index) {
          var input = $(this);

          if (input.attr('name') == "p_date" || input.attr('name') == "s_name") {
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

    $('.s_product').on('change', function() {
      var url = $(this).attr('s_url');
      var supplier_id = $(this).val();

      var productTypeDropdown = $('.select_producttype');

      $.ajax({
        type: 'GET',
        url: url,
        data: {
          supplier_id: supplier_id
        },
        beforeSend: function() {},
        success: function(data) {
          var selectedProducts = JSON.parse(data);

          productTypeDropdown.find('option:not(:first)').remove();

          if (supplier_id) {
            if (selectedProducts && selectedProducts.length > 0) {
              $.each(selectedProducts, function(index, product) {
                productTypeDropdown.append('<option value="' + product.product_type_id + '">' + product.type + '</option>');
              });
            }
          } else {
            productTypeDropdown.append('<option value="">{{ trans('message.select_supplier') }}</option>');
          }
        },

        error: function(e) {
          console.log(e);
        }
      });
    });

    // $('body').on('click', '.add_details', function() {
    //   var url = $(this).attr('s_url');
    //   var supplier_id = $('#supplier_select').val();
    //   console.log(supplier_id);

    //   var productTypeDropdown = $('.select_producttype');

    //   $.ajax({
    //     type: 'GET',
    //     url: url,
    //     data: {
    //       supplier_id: supplier_id
    //     },
    //     beforeSend: function() {},
    //     success: function(data) {
    //       var selectedProducts = JSON.parse(data);

    //       productTypeDropdown.find('option:not(:first)').remove();

    //       if (supplier_id) {
    //         if (selectedProducts && selectedProducts.length > 0) {
    //           $.each(selectedProducts, function(index, product) {
    //             productTypeDropdown.append('<option value="' + product.product_type_id + '">' + product.type + '</option>');
    //           });
    //         }
    //       } else {
    //         productTypeDropdown.append('<option value="">{{ trans('message.select supplier') }}</option>');
    //       }
    //     },

    //     error: function(e) {
    //       console.log(e);
    //     }
    //   });
    // });
  });
</script>

<script>
  $(document).ready(function () {
    // Define a variable to store selected values
    var selectedValues = { };

  $("#add_new_product").click(function () {
      var url = $(this).attr('url');
  var supplier_id = $('#supplier_select').val();

  var row_len = jQuery(".row_number").length;
      if (row_len > 0) {
        var num = jQuery(".row_number:last").val();
  var row_id = parseInt(num) + 1;
      } else {
        var row_id = 0;
      }

  // Save selected values before adding a new row
  $('.select_producttype').each(function () {
        var rowId = $(this).closest('tr').data('row-id');
  selectedValues[rowId] = $(this).val();
      });

  $.ajax({
    type: 'GET',
  url: url,
  data: {
    row_id: row_id,
  supplier_id: supplier_id
        },
  beforeSend: function () {
    $("#add_new_product").prop('disabled', false);
        },
  success: function (response) {
    $("#tab_taxes_detail > tbody").append(response.html);
  $('.adddatatable').add($(response.html));

  // Restore selected values after adding a new row
  $.each(selectedValues, function (rowId, value) {
    $('tr[data-row-id="' + rowId + '"] .select_producttype').val(value);
          });

  $("#add_new_product").prop('disabled', false);
  return false;
        },
  error: function (e) {
    alert(msg100 + " " + e.responseText);
  console.log(e);
        }
      });
    });

  $('body').on('click', '.add_details', function () {
      var url = $(this).attr('s_url');
  var supplier_id = $('#supplier_select').val();
  console.log(supplier_id);

  var productTypeDropdown = $(this).closest('tr').find('.select_producttype');

  $.ajax({
    type: 'GET',
  url: url,
  data: {
    supplier_id: supplier_id
        },
  beforeSend: function () { },
  success: function (data) {
          var selectedProducts = JSON.parse(data);

  productTypeDropdown.find('option:not(:first)').remove();

  if (supplier_id) {
            if (selectedProducts && selectedProducts.length > 0) {
    $.each(selectedProducts, function (index, product) {
      productTypeDropdown.append('<option value="' + product.product_type_id + '">' + product.type + '</option>');
    });
            }
          } else {
    productTypeDropdown.append('<option value="">{{ trans('message.select supplier') }}</option>');
          }
        },
  error: function (e) {
    console.log(e);
        }
      });
    });
  });
</script>


<!-- Form field validation -->
{!! JsValidator::formRequest('App\Http\Requests\PurchaseAddEditFormRequest', '#purchaseAdd-Form') !!}
<script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>

@endsection