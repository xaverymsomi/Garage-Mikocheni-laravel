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
                <form method="post" action="{!! url('/quotation/updatesalespart') !!}" class="addJobcardForm">
                    <input type="hidden" class="service_id" name="service_id" value="{{ $service->id }}" />
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
                                <input type="hidden" name="product[tr_id][]" value="<?php echo $stocks->id; ?>" class="form-control" data-id="<?php echo $row_id; ?>" id="<?php echo $row_id; ?>">
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
                                <input type="text" name="product[price][]" class="product form-control prices price_<?php echo $row_id; ?>" value="{{ $stocks->price }}" autocomplete="off" id="price_<?php echo $row_id; ?>" row_id="<?php echo $row_id; ?>" style="width:100%;" required="true">
        
                                <span id="price_error_<?php echo $row_id; ?>" class="help-block error-help-block color-danger" style="display: none">{{ trans('message.Price is required.') }}</span>
                              </td>
                              <td class="tbl_td_totaPrice_error_<?php echo $row_id; ?>">
                                <input type="text" name="product[total_price][]" class="product form-control total_price total_price_<?php echo $row_id; ?>" value="{{ $stocks->price * $stocks->quantity }}" id="total_price_<?php echo $row_id; ?>" style="width:100%;" readonly="true" required="true" >
        
                                <span id="total_price_error_<?php echo $row_id; ?>" class="help-block error-help-block color-danger" style="display: none">{{ trans('message.Total price is required.') }}</span>
                              </td>
                              <td align="center">
                                <span class="product_delete" data-id="<?php echo $row_id; ?>" pid="<?php echo $stocks->id; ?>" url="{!! url('/quotation/deleteproduct') !!}"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></span>
                              </td>
                            </tr>
                            <?php
                            $row_id++; ?>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                      <div class="row">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <!-- <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                            <a class="btn btn-primary" href="{{ URL::previous() }}">{{ trans('message.CANCEL') }}</a>
                        </div> -->
                        <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                            <button type="submit" class="btn btn-success updateQuotationButton">{{ trans('message.UPDATE') }}</button> 
                            {{-- <a href="{{ url('quotation/list/updateSales/' . $service->id) }}" class="btn btn-success">{{ trans('message.Save and continue') }}</button></a> --}}
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
@endsection