@extends('layouts.app')
@section('content')
<style>
  .removeimage {
    float: left;
    padding: 5px;
    height: 70px;
  }

  .removeimage .text {
    position: relative;
    bottom: 45px;
    display: block;
    left: 20px;
    font-size: 18px;
    color: red;
    visibility: hidden;
  }

  .removeimage:hover .text {
    visibility: visible;
  }

  @media (min-width: 320px) and (max-width: 522px) {
    .newAddLine::before {
      white-space: pre;
      content: "\a";
    }

    .newAddForButton {
      margin-top: 20px;
      margin-right: 30px;
    }
  }

  @media (max-width: 320px) and (min-width: 360px) {
    .newAddForButton {
      margin-top: 20px;
    }
  }
</style>

<!-- page content -->
<div class="right_col" role="main">
  <div class="page-title">
    <div class="nav_menu">
      <nav>
        <div class="nav toggle">
          <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><a href="{{ URL::previous() }}" id=""><i class=""><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}"></i><span class="titleup">
              {{ trans('Sell Vehicle') }}</span></a>
        </div>
        @include('dashboard.profile')
      </nav>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
      <div class="x_panel mb-0">
        <div class="x_content">
          <form id="vehicleEdit-Form" action="updates/{{ $company_vehicle->id }}" method="post" enctype="multipart/form-data" class="form-horizontal upperform">
            <div class="row row-mb-0">
                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 div_bill_no_error">
                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="last-name">{{ trans('message.Bill No') }} <label class="color-danger">*</label></label>
                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                        <input type="text" id="bill_no" name="bill_no" class="form-control" value="{{ $code }}" readonly>

                        <span id="bill_no-error" class="help-block error-help-block color-danger" style="display: none">{{ trans('message.Bill number is required.') }}</span>
                    </div>
                </div>

                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 div_date_error">
                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="last-name">{{ trans('message.Sales Date') }} <label class="color-danger">*</label></label>
                    <div class=" col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 date ">
                        <input type="text" id="salesDate" name="date" autocomplete="off" class="form-control dateValue datepicker" placeholder="<?php echo getDatepicker(); ?>" value="{{ old('p_date', date('Y-m-d')) }}" onkeypress="return false;">
                        <span id="salesDate-error" class="help-block error-help-block color-danger" style="display: none">{{ trans('message.Date is required.') }}</span>
                    </div>
                </div>
            </div>

            <div class="row row-mb-0">
                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 div_customer_select_error">
                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Customer Name') }} <label class="color-danger">*</label></label>
                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                        <select class="form-control customer_select form-select" id="customer_select_box1" name="cus_name">
                            <option value="">{{ trans('message.Select Customer') }}</option>
                            @if (!empty($customer))
                            @foreach ($customer as $customers)
                            <option value="{{ $customers->id }}">
                                {{ $customers->name }}
                            </option>
                            @endforeach
                            @endif
                        </select>

                        <span id="customer_select_box1-error" class="help-block error-help-block color-danger" style="display: none">{{ trans('message.Customer name is required.') }}</span>
                    </div>
                </div>

                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                    <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="first-name">{{ trans('message.Salesman') }} <label class="color-danger">*</label></label>
                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                        <select class="form-control salesmanname form-select" name="salesmanname" id="salesmanname">
                            <option value="">{{ trans('message.Select Name') }}</option>
                            @if (!empty($employee))
                            @foreach ($employee as $employees)
                            <option value="{{ $employees->id }}">
                                {{ $employees->name }}
                            </option>
                            @endforeach
                            @endif
                        </select>

                        <span id="salesmanname-error" class="help-block error-help-block color-danger" style="display: none">{{ trans('message.Salesman name is required.') }}</span>
                    </div>
                </div>
            </div>

            <div class="row row-mb-0">
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
            <div class="row">
                <div class="col-xl-5 col-md-6 col-sm-6">
                    <div class="guardian_div mb-3">
                        <div class="center-container">
                            <section id="selected-image">
                                <img src="{{ URL::asset('public/companyvehicle/' . $company_vehicle->image) }}" alt="Selected Image" height="200px" class="center-image">
                            </section>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 member_right table-responsive mb-3" style="border: 1px solid #dedede;">

                    <h2><label class="text-dark fw-bold"> {{ trans('message.More Info.') }} </label></h2>
                    <div class="row">

                        <div class="col-xl-6 col-md-6 col-sm-12 mt-2">
                            <label class=""> {{ trans('message.Vehicle Name :') }} </label>
                            <label class="fw-bold">{{ getVehicleBrand($company_vehicle->name) }} </label>
                        </div>

                        

                        <div class="col-xl-6 col-md-6 col-sm-12 mt-2">
                          <label class=""> {{ trans('Body Type') }} : </label>
                          <label class="fw-bold"> {{ getVehicleType($company_vehicle->manufacturer) }} </label>
                      </div>
                      <div class="col-xl-6 col-md-6 col-sm-12 mt-2">
                        <label class=""> {{ trans('Model Name') }} : </label>
                        <label class="fw-bold"> {{ ($company_vehicle->model_name) }} </label>
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-12 mt-2">
                      <label class=""> {{ trans('Date of Manufactured') }} : </label>
                          <label class="fw-bold"> {{ $company_vehicle->year }} </label>
                      </div>
                      <div class="col-xl-6 col-md-6 col-sm-12 mt-2">
                        <label class=""> {{ trans('Plate Number') }} : </label>
                        <label class="fw-bold"> {{ $company_vehicle->plate_number }} </label>
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-12 mt-2">
                      <label class=""> {{ trans('Engine Number') }} : </label>
                      <label class="fw-bold"> {{ $company_vehicle->engine_no }} </label>
                  </div>
                  <div class="col-xl-6 col-md-6 col-sm-12 mt-2">
                    <label class=""> {{ trans('Chassis Number') }} : </label>
                    <label class="fw-bold"> {{ $company_vehicle->chassis_no }} </label>
                </div>

                        <div class="col-xl-6 col-md-6 col-sm-12 mt-2">
                            <label class=""> {{ trans('Available in Stock') }} : </label>
                            <label class="fw-bold"> {{ $company_vehicle->quantity }} </label>
                        </div>

                       
                        
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12 form-group table-responsive">
                    <table class="table table-bordered adddatatable" id="tab_taxes_detail" align="center">
                        <thead>
                            <tr>
                                <th class="actionre">{{ trans('message.Manufacturer Name') }}</th>
                                <th class="actionre">{{ trans('message.Product Name') }}</th>
                                <th class="actionre">{{ trans('message.Quantity') }}</th>
                                <th class="actionre" style="width:10%;">{{ trans('message.Price') }}
                                    (<?php echo getCurrencySymbols(); ?>)</th>
                               </tr>
                        </thead>
                        <tbody>
                            <tr id="row_id_1">
                                <td class="tbl_td_selectManufac_error_1">
                                    <input class="form-control" type="text" name="" value="{{ getVehicleType($company_vehicle->manufacturer) }}">
                                </td>
                                <td class="tbl_td_selectProductname_error_1">
                                    <input class="form-control" type="text" name="" id="" value="{{ getVehicleBrand($company_vehicle->name) }}">
                                </td>
                                <td class="tbl_td_quantity_error_1">
                                    <input type="number" name="quantity" class="quantity form-control qty qty_1 qtyt" id="qty_1" autocomplete="off" row_id="1" value="1" maxlength="8" oninput="calculateTotalPrice()">
                                </td>
                                <td class="tbl_td_price_error_1">
                                    {{ $company_vehicle->Price }}
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Total Price</td>
                                <td id="total_price">{{ $company_vehicle->Price }}</td>
                            </tr>
                        </tbody>
                        
                    </table>
                </div>
            </div>

            <div class="row">
                <label for="Note">Note *</label>
                <p># Please Enter the valid quantity otherwise you will get error to proceed.</p>
            </div>
            <div class="row">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <!-- <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                <a class="btn btn-primary" href="{{ URL::previous() }}">{{ trans('message.CANCEL') }}</a>
              </div> -->
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                <button type="submit" class="btn btn-success updateVehicleButton">{{ trans('message.UPDATE') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->



<!-- Scripts starting -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    // Function to format number with commas
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    // Function to calculate and update total price
    function calculateTotalPrice() {
        var quantity = parseInt(document.getElementById('qty_1').value);
        var maxQuantity = parseInt("{{ $company_vehicle->quantity }}");
        var pricePerItem = parseFloat("{{ $company_vehicle->Price }}"); // Assuming price is a float

        // Validate quantity
        if (isNaN(quantity) || quantity <= 0) {
            alert('Please enter a valid quantity greater than 0.');
            document.getElementById('qty_1').value = 1; // Reset to default value
            quantity = 1;
        } else if (quantity > maxQuantity) {
            alert('Quantity cannot exceed the available stock.');
            document.getElementById('qty_1').value = maxQuantity; // Set to maximum available quantity
            quantity = maxQuantity;
        }

        var totalPrice = quantity * pricePerItem;
        var formattedTotalPrice = numberWithCommas(totalPrice.toFixed(2)); // Format with commas and 2 decimal places
        document.getElementById('total_price').textContent = formattedTotalPrice;
    }

    // Function to format price cells in the table
    function formatPriceCells() {
        var priceElements = document.querySelectorAll('.tbl_td_price_error_1');
        priceElements.forEach(function(element) {
            var price = parseFloat(element.textContent);
            var formattedPrice = numberWithCommas(price.toFixed(2)); // Format with commas and 2 decimal places
            element.textContent = formattedPrice;
        });
    }

    // Call formatPriceCells() initially to format existing prices
    formatPriceCells();
</script>





<script>
  var msg35 = "{{ trans('message.OK') }}"
  $(document).ready(function() {



    $('.myDatepicker2').datetimepicker({
      format: "yyyy",
      endDate: new Date(),
      minView: 4,
      autoclose: true,
      startView: 4,
      language: "{{ getLangCode() }}",
    });

    $(".datepicker").datetimepicker({
      format: "<?php echo getDatepicker(); ?>",
      minDate: new Date(),
      todayBtn: true,
      autoclose: 1,
      minView: 2,
      language: "{{ getLangCode() }}",
    });


    var msg14 = "{{ trans('message.Please enter only alphanumeric data') }}";
    var msg15 = "{{ trans('message.Only blank space not allowed') }}";
    var msg16 = "{{ trans('message.This Record is Duplicate') }}";

    /*vehical type*/
    $('.vehicaltypeadd').click(function() {

      var vehical_type = $('.vehical_type').val();
      var url = $(this).attr('url');

      var msg13 = "{{ trans('message.Please enter vehicle type') }}";

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

            if (data == '01') {
              swal({
                title: msg16,
                cancelButtonColor: '#C1C1C1',
                buttons: {
                  cancel: msg35,
                },
                dangerMode: true,
              });

            } else {
              $('.vehical_type_class').append('<tr class=" row mx-1 ' + classname +
                ' data_of_type"><td class="text-start">' + vehical_type +
                '</td><td class="text-end"><button type="button" vehicletypeid=' + data +
                ' deletevehical="{!! url(' / vehicle / vehicaltypedelete ') !!}" class="btn btn-danger text-white border-0 deletevehicletype"><i class="fa fa-trash" aria-hidden="true"></i></button></a></td><tr>'
              );
              $('.select_vehicaltype').append('<option value=' + data + '>' + vehical_type + '</option>');
              $('.vehical_type').val('');
            }
          },
        });
      }
    });

    var msg1 = "{{ trans('message.Are You Sure?') }}";
    var msg2 = "{{ trans('message.You will not be able to recover this data afterwards!') }}";
    var msg3 = "{{ trans('message.Cancel') }}";
    var msg4 = "{{ trans('message.Yes, delete!') }}";
    var msg5 = "{{ trans('message.Done!') }}";
    var msg6 = "{{ trans('message.It was succesfully deleted!') }}";
    var msg7 = "{{ trans('message.Cancelled') }}";
    var msg8 = "{{ trans('message.Your data is safe') }}";
    var vtypedelete = "{{ trans('message.Vehicle Type Deleted Successfully') }}";
    var vbranddelete = "{{ trans('message.Vehicle Brand Deleted Successfully') }}";
    var fueldelete = "{{ trans('message.Fuel Type Deleted Successfully') }}";
    var modeldelete = "{{ trans('message.Model Deleted Successfully') }}";
    var colordelete = "{{ trans('message.Color Deleted Successfully') }}";

    /*vehical Type delete*/
    $('body').on('click', '.deletevehicletype', function() {

      var vtypeid = $(this).attr('vehicletypeid');
      var url = $(this).attr('deletevehical');
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
              $(".select_vehicaltype option[value=" + vtypeid + "]")
                .remove();
              swal({
                title: msg5,
                text: vtypedelete,
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
            title: msg14,
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
            title: msg15,
            cancelButtonColor: '#C1C1C1',
            buttons: {
              cancel: msg35,
            },
            dangerMode: true,
          });
        } else if (!call_var_vehiclebrandadd.vehicle_brand_pattern2.test(call_var_vehiclebrandadd
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

              if (data == '01') {
                swal({
                  title: msg16,
                  cancelButtonColor: '#C1C1C1',
                  buttons: {
                    cancel: msg35,
                  },
                  dangerMode: true,
                });
              } else {
                $('.vehical_brand_class').append('<tr class=" row mx-1 ' + classname +
                  ' data_of_type"><td class="text-start">' + vehical_brand +
                  '</td><td class="text-end"><button type="button" brandid=' + data +
                  ' deletevehicalbrand="{!! url(' / vehicle / vehicalbranddelete ') !!}" class="btn btn-danger text-white border-0 deletevehiclebrands"><i class="fa fa-trash" aria-hidden="true"></i></button></a></td><tr>'
                );
                $('.select_vehicalbrand').append('<option value=' + data + '>' + vehical_brand +
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
              $(".select_vehicalbrand option[value=" + vbrandid + "]")
                .remove();
              swal({
                title: msg5,
                text: vbranddelete,
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


    /*Fuel type*/
    $('.fueltypeadd').click(function() {
      var fuel_type = $('.fuel_type').val();
      var url = $(this).attr('fuelurl');

      var msg21 = "{{ trans('message.Please enter fuel type') }}";

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
          title: msg14,
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
          title: msg15,
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

            if (data == '01') {
              swal({
                title: msg16,
                cancelButtonColor: '#C1C1C1',
                buttons: {
                  cancel: msg35,
                },
                dangerMode: true,
              });

            } else {
              $('.fuel_type_class').append('<tr class=" row mx-1 ' + classname +
                ' data_of_type"><td class="text-start">' + fuel_type +
                '</td><td class="text-end"><button type="button" fuelid=' + data +
                ' deletefuel="{!! url('/vehicle/fueltypedelete ') !!}" class="btn btn-danger text-white border-0 fueldeletes"><i class="fa fa-trash" aria-hidden="true"></i></button></a></td><tr>'
              );
              $('.select_fueltype').append('<option value=' + data + '>' + fuel_type + '</option>');
              $('.fuel_type').val('');
            }
          },
        });
      }
    });


    /*Fuel  Type delete*/
    $('body').on('click', '.fueldeletes', function() {

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
              $(".select_fueltype option[value=" + fueltypeid + "]")
                .remove();
              swal({
                title: msg5,
                text: fueldelete,
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
          success: function(data) {
            var newd = $.trim(data);
            var classname = 'mod-' + newd;
            if (data == '01') {
              swal({
                title: msg16,
                cancelButtonColor: '#C1C1C1',
                buttons: {
                  cancel: msg35,
                },
                dangerMode: true,
              });
            } else {
              $('.vehi_model_class').append('<tr class=" row mx-1 ' + classname + ' data_of_type"><td class="text-start">' +
                model_name + '</td><td class="text-end"><button type="button" modelid=' + data +
                ' deletemodel="{!! url(' / vehicle / vehicle_model_delete ') !!}" class="btn btn-danger text-white border-0 modeldeletes"><i class="fa fa-trash" aria-hidden="true"></i></button></a></td><tr>'
              );
              $('.model_addname').append('<option value=' + data + '>' + model_name + '</option>');
              $('.vehi_modal_name').val('');
            }
          },
        });
      }
    });


    $('body').on('click', '.modeldeletes', function() {

      var mod_del_id = $(this).attr('modelid');
      var del_url = $(this).attr('deletemodel');

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
              $(".model_addname option[value=" + mod_del_id + "]")
                .remove();
              swal({
                title: msg5,
                text: modeldelete,
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

                    $('.select_vehicalbrand').trigger('change');
                }
            });
        });

        /*vehical Model from brand*/
        $('.select_vehicalbrand').change(function() {
            id = $(this).val();
            var url = $(this).attr('url');

            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    id: id
                },
                success: function(response) { 
                    $('.model_addname').html(response);
                }
            });
        });

    var msg100 = "{{ trans('message.An error occurred :') }}";

    /*Vehical Description*/
    $("#add_new_description").click(function() {
      var row_id = $("#tab_decription_detail > tbody > tr").length;
      var url = $(this).attr('url');

      $.ajax({
        type: 'GET',
        url: url,
        data: {
          row_id: row_id
        },
        success: function(response) {
          $("#tab_decription_detail > tbody").append(response.html);
          return false;
        },
        error: function(e) {
          alert(msg100 + " " + e.responseText);
          console.log(e);
        }
      });
    });


    $('body').on('click', '.delete_description', function() {

      var description = $(this).attr('data-id');
      var url = $(this).attr('delete_description');

      $.ajax({
        type: 'GET',
        url: url,
        data: {
          description: description
        },
        beforeSend: function() {
          $("#add_new_description").prop('disabled', true); // disable button
        },
        success: function(response) {
          $('table#tab_decription_detail tr#row_id_' + description).remove();
          $("#add_new_description").prop('disabled', false); // enable button
        },
        error: function(e) {
          alert(msg100 + " " + e.responseText);
          console.log(e);
        }
      });
    });


    /*vehical color*/
    $("#add_new_color").click(function() {

      var color_id = $("#tab_color > tbody > tr").length;
      var url = $(this).attr('url');

      $.ajax({
        type: 'GET',
        url: url,
        data: {
          color_id: color_id
        },
        beforeSend: function() {
          $("#add_new_color").prop('disabled', true); // disable button
        },
        success: function(response) {
          $("#tab_color > tbody").append(response.html);
          $("#add_new_color").prop('disabled', false); // disable button
          return false;
        },
        error: function(e) {
          alert(msg100 + " " + e.responseText);
          console.log(e);
        }
      });
    });



    $('body').on('click', '.remove_color', function() {
      var color_id = $(this).attr('data-id');
      var url = $(this).attr('colordelete');

      $.ajax({
        type: 'GET',
        url: url,
        data: {
          color_id: color_id
        },
        success: function(response) {
          $('table#tab_color tr#color_id_' + color_id).remove();
        },
        error: function(e) {
          alert(msg100 + " " + e.responseText);
          console.log(e);
        }
      });
    });


    // Basic
    $('.dropify').dropify();

    // Translated
    $('.dropify-fr').dropify({
      messages: {
        default: 'Glissez-déposez un fichier ici ou cliquez',
        replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
        remove: 'Supprimer',
        error: 'Désolé, le fichier trop volumineux'
      }
    });

    // Used events
    var drEvent = $('#input-file-events').dropify();


    drEvent.on('dropify.beforeClear', function(event, element) {
      return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
    });

    drEvent.on('dropify.afterClear', function(event, element) {
      alert('File deleted');
    });

    drEvent.on('dropify.errors', function(event, element) {
      console.log('Has Errors');
    });

    var drDestroy = $('#input-file-to-destroy').dropify();

    drDestroy = drDestroy.data('dropify')
    $('#toggleDropify').on('click', function(e) {
      e.preventDefault();
      if (drDestroy.isDropified()) {
        drDestroy.destroy();
      } else {
        drDestroy.init();
      }
    })

    /*show  images in multiple selected*/
    $(".imageclass").click(function() {
      $(".classimage").empty();
    });


    function preview_images() {
      var total_file = document.getElementById("images").files.length;
      for (var i = 0; i < total_file; i++) {
        $('#image_preview').append(
          "<div class='col-md-3 col-sm-3 col-xs-12 removeimage delete_image classimage'><img src='" + URL
          .createObjectURL(event.target.files[i]) + "' width='100px' height='60px'> </div>");
      }
    }


    /*new image append*/
    $("#add_new_images").click(function() {
      var image_id = $("#tab_images > tbody > tr").length;
      var url = $(this).attr('url');

      $.ajax({
        type: 'GET',
        url: url,
        data: {
          image_id: image_id
        },
        success: function(response) {
          $("#tab_images > tbody").append(response);
          return false;
        },
        error: function(e) {
          alert(msg100 + " " + e.responseText);
          console.log(e);
        }
      });
    });



    $('body').on('click', '.delete_image', function() {

      var delete_image = $(this).attr('imgaeid');
      var url = $(this).attr('delete_image');

      $.ajax({
        type: 'GET',
        url: url,
        data: {
          delete_image: delete_image
        },
        success: function(response) {
          $('div#image_preview div#image_remove_' + delete_image).remove();
        },
        error: function(e) {
          alert(msg100 + " " + e.responseText);
          console.log(e);
        }
      });
      return false;
    });

    /*If put firstly any white space then clear textbox*/
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


    /*Custom Field manually validation*/
    var msg31 = "{{ trans('message.field is required') }}";
    var msg32 = "{{ trans('message.Only blank space not allowed') }}";
    var msg33 = "{{ trans('message.Special symbols are not allowed.') }}";
    var msg34 = "{{ trans('message.At first position only alphabets are allowed.') }}";

    /*Form submit time check validation for Custom Fields */
    $('body').on('click', '.updateVehicleButton', function(e) {
      $('#vehicleEdit-Form input, #vehicleEdit-Form select, #vehicleEdit-Form textarea').each(

        function(index) {
          var input = $(this);

          if (input.attr('name') == "vehical_id" || input.attr('name') == "vehicabrand" || input.attr(
              'name') == "fueltype" || input.attr('name') == "modelname" || input.attr('name') == "price") {
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

    // added by arjun for color module dynamic add item and remove item

    var msg51 = "{{ trans('message.Please enter only alphanumeric data') }}";
    var msg52 = "{{ trans('message.Only blank space not allowed') }}";
    var msg53 = "{{ trans('message.This Record is Duplicate') }}";
    var msg54 = "{{ trans('message.An error occurred :') }}";

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

                            $('.color').append('<option value=' + data + ' style="background-color:' + c_code + ';color: #ffffff;">' + c_name +
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


    var msg101 = "{{ trans('message.Are You Sure?') }}";
    var msg102 = "{{ trans('message.You will not be able to recover this data afterwards!') }}";
    var msg103 = "{{ trans('message.Cancel') }}";
    var msg104 = "{{ trans('message.Yes, delete!') }}";
    var msg105 = "{{ trans('message.Done!') }}";
    var msg106 = "{{ trans('message.It was succesfully deleted!') }}";
    var msg107 = "{{ trans('message.Cancelled') }}";
    var msg108 = "{{ trans('message.Your data is safe') }}";

    /*color Delete  model*/
    $('body').on('click', '.deletecolors', function() {
      var colorid = $(this).attr('id');
      var url = $(this).attr('deletecolor');
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
{!! JsValidator::formRequest('App\Http\Requests\VehicleAddEditFormRequest', '#vehicleEdit-Form') !!}
<script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>
@endsection