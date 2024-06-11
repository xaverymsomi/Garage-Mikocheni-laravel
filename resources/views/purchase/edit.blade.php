<!-- Solved by Mukesh [Buglist row number: 588] -->
<style>
  .table-condensed {
    font-size: 14px;
  }

  .table-condensed th {
    font-size: 12px;
  }
</style>
@extends('layouts.app')
@section('content')

<!-- page content -->
<div class="right_col" role="main">
  <div class="page-title">
    <div class="nav_menu">
      <nav>
        <div class="nav toggle">
          <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><span class="titleup"><a href="{!! url('/purchase/list') !!}" id=""><i class=""><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}"></i><span class="titleup">
              {{ trans('message.Edit Purchase') }}</span></a>
        </div>
        @include('dashboard.profile')
      </nav>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">  
      <div class="x_panel">
        <div class="x_content">
          <form id="purchaseEdit-Form" action="update/{{ $purchase->id }}" method="post" enctype="multipart/form-data" class="form-horizontal upperform">

            <div class="row row-mb-0">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Purchase No') }} <label class="color-danger">*</label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">

                  <input type="text" id="p_no" name="p_no" class="form-control" value="{{ $purchase->purchase_no }}" readonly>
                </div>
              </div>

              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="last-name">{{ trans('message.Purchase Date') }} <label class="color-danger">*</label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 date">
                  <input type="text" id="pur_date" name="p_date" autocomplete="off" value="{{ date(getDateFormat(), strtotime($purchase->date)) }}" class="form-control datepicker purchaseDate" placeholder="<?php echo getDateFormat(); ?>" required onkeypress="return false;" />
                </div>
              </div>
            </div>

            <div class="row row-mb-0">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="last-name">{{ trans('message.Supplier Name') }} <label class="color-danger">*</label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" value="{{ $supplier->name }}" class="form-control"required readonly>
                  <input type="hidden" value="{{ $supplier->id }}" class="form-control s_product" name="s_name" id="supplier_select" required readonly>
                </div>
              </div>

              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Mobile No') }} <label class="color-danger">*</label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" id="mobile" name="mobile" value="{{ $purchase->mobile }}" class="form-control" placeholder="{{ trans('message.Enter Mobile No') }}" readonly>
                </div>
              </div>
            </div>

            <div class="row row-mb-0">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="last-name">
                  {{ trans('message.Email') }} <label class="color-danger">*</label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <input type="text" id="email" name="email" class="form-control" value="{{ $purchase->email }}" placeholder="{{ trans('message.Enter Email') }}" readonly>
                </div>
              </div>
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="last-name">{{ trans('message.Billing Address') }} <label class="color-danger">*</label></label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <textarea id="address" name="address" class="form-control" readonly>{{ $purchase->address }}</textarea>
                </div>
              </div>
            </div>

            <div class="row row-mb-0">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="branch">{{ trans('message.Branch') }} <label class="color-danger">*</label></label>

                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <select class="form-control select_branch form-select" name="branch">
                    @foreach ($branchDatas as $branchData)
                    <option value="{{ $branchData->id }}" <?php if ($purchase->branch_id == $branchData->id) {
                                                            echo 'selected';
                                                          } ?>>{{ $branchData->branch_name }}</option>
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
              <table class="table table-bordered" id="tab_taxes_detail" align="center">
                <thead>
                  <tr>
                    <!-- <th class="actionre">{{ trans('message.Category') }}</th> -->
                    <th class="actionre fw-bold">{{ trans('message.Manufacturer Name') }}</th>
                    <th class="actionre fw-bold">{{ trans('message.Product Name') }}</th>
                    <th class="actionre fw-bold">{{ trans('message.Quantity') }}</th>
                    <th class="actionre">{{ trans('VAT') }}</th>
                    <th class="actionre fw-bold" style="width:10%;">{{ trans('message.Price') }} (<?php echo getCurrencySymbols(); ?>)</th>
                    <th class="actionre fw-bold" style="width:13%;">{{ trans('message.Amount') }} (<?php echo getCurrencySymbols(); ?>)</th>
                    <th class="actionre fw-bold">{{ trans('message.Action') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $row_id = 0; ?>
                  @foreach ($stock as $stocks)
                  <tr id="row_id_<?php echo $row_id; ?>">
                    <td class="my-form-group">
                      <select class="form-control select_producttype form-select" name="product[Manufacturer_id][]" m_url="{!! url('/purchase/producttype/name') !!}" man_sel_url="{!! url('purchase/getfirstproductdata') !!}" row_id="{{ $row_id }}" row_did="{{ $row_id }}" style="width:100%;" data-id="{{ $row_id }}" required>
                        <!-- <option value="">-{{ trans('message.Select item') }}-</option> -->
                        @if (!empty($Select_product))
                        @foreach ($Select_product as $Select_products)
                        <option value="{{ $Select_products->product_type_id }}" <?php if ($Select_products->product_type_id == getproducttyid($stocks->product_id)) {
                                                                                  echo 'selected';
                                                                                } ?>>{{ $Select_products->type }}</option>
                        @endforeach
                        @endif
                      </select>
                    </td>
                    <td class="my-form-group">
                      <input type="hidden" name="product[tr_id][]" value="<?php echo $stocks->id; ?>" class="" form-control" data-id="<?php echo $row_id; ?>" id="<?php echo $row_id; ?>">
                      <select name="product[product_id][]" class="form-control productid select_productname_<?php echo $row_id; ?> form-select" url="{!! url('purchase/add/getproduct') !!}" row_did="<?php echo $row_id; ?>" data-id="<?php echo $row_id; ?>" style="width:100%;" required="required">
                        <!-- <option value="">{{ trans('message.Select Product') }}</option> -->
                        @if (!empty($product))
                        @foreach ($product as $products)
                        <option value="{{ $products->id }}" <?php if ($products->id == $stocks->product_id) {
                                                              echo 'selected';
                                                            } ?>>{{ $products->name }}</option>
                        @endforeach
                        @endif
                      </select>
                    </td>
                    <td>
                      <input type="number" name="product[qty][]" url="{!! url('purchase/add/getqty') !!}" class="quantity form-control qty qty_<?php echo $row_id; ?>" id="qty_<?php echo $row_id; ?>" row_id="<?php echo $row_id; ?>" value="{{ $stocks->qty }}" maxlength="8">
                      <!-- <span class="qty_<?php echo $row_id; ?>">{{ getProductcode($stocks->product_id) }}</span> -->
                    </td>

                    <td class="my-form-group">
                   
                      <select name="product[vat][]" class="form-control vat vat_<?php echo $row_id; ?> form-select" row_id="<?php echo $row_id; ?>" style="width:100%;" required="required">
                        <!-- <option value="">{{ trans('message.Select Product') }}</option> -->
                      
                        <option value="{{ $stocks->vat }}"><?php if($stocks->vat == "0.18"){$vat = "18%";} else {$vat = "No Tax";} ?> {{ $vat }}</option>
                        <option value="{{ 0 }}">No Tax</option>
                        <option value="{{ 0.18 }}">18%</option>
                       
                       
                      </select>
                    </td>

                    <td>
                      <!-- <input type="text" name="product[price][]" class="product form-control prices price_<?php echo $row_id; ?>" value="{{ $stocks->price }}" id="price_<?php echo $row_id; ?>" style="width:100%;"  readonly="true"> -->
                      <input type="text" name="product[price][]" class="product form-control prices price_<?php echo $row_id; ?>" value="{{ $stocks->price }}" id="price_<?php echo $row_id; ?>" row_id="<?php echo $row_id; ?>" style="width:100%;">
                    </td>
                    <td>
                      <input type="text" name="product[total_price][]" class="product form-control total_price total_price_<?php echo $row_id; ?>" value="{{ $stocks->total_amount }}" id="total_price_<?php echo $row_id; ?>" style="width:100%;" readonly="true">
                    </td>
                    <td align="center">
                      <span class="product_delete" data-id="<?php echo $row_id; ?>" pid="<?php echo $stocks->id; ?>" url="{!! url('purchase/deleteproduct') !!}"><i class="fa-solid fa-trash-can fa-2x"></i></span>

                    </td>
                    <input type="hidden" value="{{ $row_id }}" name="row_number" class="row_number">
                  </tr>
                  <?php
                  $row_id++; ?>
                  @endforeach
                </tbody>
              </table>
            </div>


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
            $userid = $purchase->id;
            $datavalue = getCustomDataPurchase($tbl_custom, $userid);

            $subDivCount++;
            ?>

            @if ($myCounts % 2 == 0)
            <div class="row">
              @endif

              <div class="row form-group col-md-6  col-sm-6 col-xs-12 error_customfield_main_div_{{ $myCounts }}">
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
                    <input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}]" value="{{ $k }}" <?php
                                                                                                                            //$formName = "product";
                                                                                                                            $getRadioValue = getRadioLabelValueForUpdateForAllModules($tbl_custom_field->form_name, $purchase->id, $tbl_custom_field->id);

                                                                                                                            if ($k == $getRadioValue) {
                                                                                                                              echo 'checked';
                                                                                                                            } ?>> {{ $val }} &nbsp;
                    @endforeach
                  </div>
                  @endif
                  @elseif($tbl_custom_field->type == 'checkbox')
                  <?php
                  $checkboxLabelArrayList = getCheckboxLabelsList($tbl_custom_field->id);
                  ?>
                  @if (!empty($checkboxLabelArrayList))
                  <?php
                  $getCheckboxValue = getCheckboxLabelValueForUpdateForAllModules($tbl_custom_field->form_name, $purchase->id, $tbl_custom_field->id);
                  ?>
                  <div class="required_checkbox_parent_div_{{ $tbl_custom_field->id }}" style="margin-top: 5px;">
                    @foreach ($checkboxLabelArrayList as $k => $val)
                    <input type="{{ $tbl_custom_field->type }}" name="custom[{{ $tbl_custom_field->id }}][]" value="{{ $val }}" isRequire="{{ $required }}" fieldNameIs="{{ $tbl_custom_field->label }}" custm_isd="{{ $tbl_custom_field->id }}" class="checkbox_{{ $tbl_custom_field->id }} required_checkbox_{{ $tbl_custom_field->id }} checkbox_simple_class common_value_is_{{ $myCounts }} common_simple_class" rows_id="{{ $myCounts }}" <?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                if ($val == getCheckboxValForAllModule($tbl_custom_field->form_name, $purchase->id, $tbl_custom_field->id, $val)) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                  echo 'checked';
                                                                                                                                                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                                                                                                                                                                ?>> {{ $val }} &nbsp;
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

             <!-- Submit and Cancel Part -->
             <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row">
              <!-- <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
              <a class="btn btn-primary" href="{{ URL::previous() }}">{{ trans('message.CANCEL') }}</a>
              </div> -->
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
              <button type="submit" class="btn btn-success updatePurchaseButton">{{ trans('message.UPDATE') }}</button>
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


 <!-- Scripts starting -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
  $(document).ready(function() {
    // var m_id = $(".select_producttype").val();
    
    // var row_id = $(".productid").attr('row_did');
    // var url = $(".select_producttype").attr('m_url');
    // $.ajax({
        // type: 'GET',
        // url: url,
        // data: {
          // m_id: m_id
        // },
        // success: function(response) {
          // $('.select_productname_' + row_id).html(response);
        // }
      // });
    $('.datepicker').datetimepicker({
      format: "<?php echo getDatepicker(); ?>",
      maxDate: new Date(),
      todayBtn:true,
      autoclose: 1,
      minView: 2,
      endDate: new Date(),
      language: "{{ getLangCode() }}",
    });

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


    $(function() {
      $('#supplier_select').change(function() {
        var supplier_id = $(this).val();
        var url = $(this).attr('url');

        var msg1 = "{{ trans('message.An error occurred :') }}";

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
            alert(msg1 + " " + e.responseText);
            console.log(e);
          }
        });
      });
    });


    $("#add_new_product").click(function() {
      var url = $(this).attr('url');
      var supplier_id = $('#supplier_select').val();

      var row_len = jQuery(".row_number").length;
      if (row_len > 0) {
        var num = jQuery(".row_number:last").val();
        var row_id = parseInt(num) + 1;
      } else {
        var row_id = 0;
      }

      $.ajax({
        type: 'GET',
        url: url,
        data: {
          row_id: row_id,
          supplier_id: supplier_id
        },

        beforeSend: function() {
          $("#add_new_product").prop('disabled', false);
        },
        success: function(response) {
          $("#tab_taxes_detail > tbody").append(response.html);
          $('.adddatatable').add($(response.html));
          $("#add_new_product").prop('disabled', false);
          return false;
        },
        error: function(e) {
          alert(msg100 + " " + e.responseText);
          console.log(e);
        }
      });
    });

    jQuery('body').on('click', '.product_delete', function() {
      // if (confirm("Are you sure want to delete this row..?")) {
        jQuery(this).parents("tr").remove();
        return false;
      // }
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

    /*If select box have value then error msg and has error class remove*/
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


    /*Custom Field manually validation*/
    var msg1 = "{{ trans('message.field is required') }}";
    var msg2 = "{{ trans('message.Only blank space not allowed') }}";
    var msg3 = "{{ trans('message.Special symbols are not allowed.') }}";
    var msg4 = "{{ trans('message.At first position only alphabets are allowed.') }}";

    /*Form submit time check validation for Custom Fields */
    $('body').on('click', '.updatePurchaseButton', function(e) {
      $('#purchaseEdit-Form input, #purchaseEdit-Form select, #purchaseEdit-Form textarea').each(

        function(index) {
          var input = $(this);

          if (input.attr('name') == "p_date" || input.attr('name') == "s_name") {
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

    $('body').on('click', '.add_details', function() {
      var url = $(this).attr('s_url');
      var supplier_id = $('#supplier_select').val();
      console.log(supplier_id);

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
  });
</script>


<!-- Form field validation -->
{!! JsValidator::formRequest('App\Http\Requests\PurchaseAddEditFormRequest', '#purchaseEdit-Form') !!}
<script type="text/javascript"
  src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>

@endsection
