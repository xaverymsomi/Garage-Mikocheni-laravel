@extends('layouts.app')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div>
        <div class="page-title">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><a href="{!! url('/sales_part/list') !!}" id=""><i class=""><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}"></i><span class="titleup">
                                {{ trans('message.Add Part Sell') }}</span></a>
                    </div>
                    @include('dashboard.profile')
                </nav>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form id="salespartAddForm" method="post" action="{!! url('/sales_part/store') !!}" enctype="multipart/form-data" class="form-horizontal upperform salesPartAddForm">

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
                                                        {{ $manufacture_nm->vehicle_type }}
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
                                                    @foreach ($brand as $brands)
                                                    <option value="{{ $brands->id }}">{{ $brands->Model }}
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

                            <div class="row">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <!-- <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                                    <a class="btn btn-primary salesPartAddCancelButton" href="{{ URL::previous() }}">{{ trans('message.CANCEL') }}</a>
                                </div> -->
                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 mx-0">
                                    <button type="submit" class="btn btn-success salesPartAddSubmitButton" id="Hello">{{ trans('message.SUBMIT') }}</button>
                                </div>
                            </div>


                        </form>
                    </div>
                    <!-- Color Add or Remove Model-->
                    <div class="col-md-6">
                        <div id="responsive-modal-color" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                                        <h4 class="modal-title">{{ trans('message.Color') }}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" action="" method="">
                                            <table class="table colornametype" align="center" style="width:40em">
                                                <thead>
                                                    <tr>
                                                        <td class="text-center">
                                                            <strong>{{ trans('message.Color Name') }}</strong>
                                                        </td>
                                                        <td class="text-center">
                                                            <strong>{{ trans('message.Action') }}</strong>
                                                        </td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($color as $colors)
                                                    <tr class="del-{{ $colors->id }} data_color_name">
                                                        <td class="text-center ">{{ $colors->color }}</td>
                                                        <td class="text-center">

                                                            <button type="button" colorid="{{ $colors->id }}" deletecolor="{!! url('sales/colortypedelete') !!}" class="btn btn-danger btn-xs colordelete">X</button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                            <div class="col-md-8 form-group data_popup">
                                                <label>{{ trans('message.Color Name') }}: <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control c_name" name="c_name" placeholder="{{ trans('message.Enter color name') }}" />
                                            </div>

                                            <div class="col-md-4 form-group data_popup" style="margin-top:24px;">
                                                <button type="button" class="btn btn-success addcolor" colorurl="{!! url('sales/color_name_add') !!}">{{ trans('message.Submit') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->


<!-- Scripts starting -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

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
@endsection