@extends('layouts.app')
@section('content')


<style>
    button.btn.btn-default.buttons-print {
        border: 1px solid black;
        margin-right: 10px;
    }

    button.btn.btn-default.buttons-excel {
        border: 1px solid black;
    }

    @media screen and (max-width:540px) {
        div#product_uses_info {
            margin-top: -150px;
        }

        span.titleup {
            margin-left: -10px;
        }
    }
</style>
<div class="right_col servi" role="main">

    <div id="stockview" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="myLargeModalLabel" class="modal-title">{{ trans('message.Stock History') }}</h4>
                    <button type="button" data-bs-dismiss="modal" class="btn-close"></button>

                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
    <div class="page-title">
        <div class="nav_menu">
            <nav>
                <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><a id=""><i class=""></i><span class="titleup">
                            {{ trans('message.Reports') }}</span></a>
                </div>
                @include('dashboard.profile')
            </nav>
        </div>
    </div>

    <div class="x_content table-responsive">
        <ul class="nav nav-tabs">
            <!-- <li class="nav-item">
                @can('report_view')
                <a href="{!! url('/report/salesreport') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span>
                    <i class="">&nbsp;</i><b>{{ trans('message.VEHICLE SALES') }}</b></a>
                @endcan
            </li> -->
            <li class="nav-item">
                @can('report_view')
                <a href="{!! url('/report/servicereport') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.SERVICES') }}</b></a>
                @endcan
            </li>
            <li class="nav-item">
                @can('report_view')
                <a href="{!! url('/report/productreport') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.PRODUCT STOCK') }}</b></a>
                @endcan
            </li>
            <li class="nav-item">
                @can('report_view')
                <a href="{!! url('/report/productuses') !!}" class="nav-link active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.PRODUCT USAGE') }}</b></a>
                @endcan
            </li>
            <li class="nav-item">
                @can('report_view')
                <a href="{!! url('/report/servicebyemployee') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.EMP. SERVICES') }}</b></a>
                @endcan
            </li>
        </ul>
    </div>

    <div class="row row-mb-0">
        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
            <div class="x_panel row-mb-0">
                <div class="x_content">
                    <form method="post" action="{!! url('/report/uses_product') !!}" enctype="multipart/form-data" class="form-horizontal upperform">
                        <div class="row mt-3 row-mb-0">
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 {{ $errors->has('start_date') ? ' has-error' : '' }}">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="Country">{{ trans('message.Start Date') }} <label class="color-danger">*</label>
                                </label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 date " id="start_dates">
                                    {{-- <span class="input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span> --}}

                                    <input type="text" name="start_date" id="start_date " autocomplete="off" class="form-control start_date" value="{{ !empty($s_date) ? date(getDateFormat(), strtotime($s_date)) : date(getDateFormat(), strtotime('first day of this month')) }}" placeholder="<?php echo getDatepicker(); ?>" onkeypress="return false;" />

                                    <span id="common_error_span" class="help-block error-help-block text-danger" style="display: none">{{ trans('message.Please Select Start Date.') }}</span>
                                </div>
                                @if ($errors->has('start_date'))
                                <span class="help-block denger" style="margin-left: 27%;">
                                    <strong>{{ $errors->first('start_date') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 {{ $errors->has('end_date') ? ' has-error' : '' }}">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="Country">{{ trans('message.End Date') }} <label class="color-danger">*</label>
                                </label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 date ">
                                    {{-- <span class="input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span> --}}

                                    <input type="text" name="end_date" id="end_date_product_uses" autocomplete="off" class="form-control end_date" value="{{ old('p_date', date('Y-m-d')) }}" placeholder="<?php echo getDatepicker(); ?>" onkeypress="return false;" />
                                    <span id="common_error_span_end" class="help-block error-help-block text-danger" style="display: none">{{ trans('message.Please Select End Date.') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row row-mb-0">
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="option">{{ trans('message.Manufacturer Name') }} </label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <select class="form-control select_producttype form-select" name="m_product" m_url="{!! url('/report/producttype/name') !!}">
                                        <option value="all" <?php if ($all_product == 'all') {
                                                                echo 'selected';
                                                            } ?>>{{ trans('message.All') }}</option>
                                        @if (!empty($Select_product))
                                        @foreach ($Select_product as $Select_products)
                                        <option value="{{ $Select_products->id }}" <?php if ($Select_products->id == $all_product) {
                                                                                        echo 'selected';
                                                                                    } ?>>
                                            {{ $Select_products->type }}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="option">{{ trans('message.Product Name') }} </label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <select class="form-control select_productname form-select" name="product_name">
                                        <option value="item" <?php if ($all_item == 'item') {
                                                                    echo 'selected';
                                                                } ?>>{{ trans('message.Items') }}</option>
                                        @if (!empty($productname))
                                        @foreach ($productname as $productreports)
                                        <option value="{{ $productreports->id }}" <?php if ($productreports->id == $all_item) {
                                                                                        echo 'selected';
                                                                                    } ?>>
                                            {{ $productreports->name }}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row mt-3">
                            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 text-lg-end">
                                <button type="submit" class="btn btn-success colorname">{{ trans('message.Go') }}</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    @if(!empty($productreport) && count($productreport) > 0)
        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
            <div class="x_panel table_up_div">
                <table id="supplier" class="table jambo_table" style="width:100%">
                    <thead>
                        <tr>
                            <th> </th>
                            <th>{{ trans('message.Product Number') }}</th>
                            <th>{{ trans('message.Manufacturer Name') }}</th>
                            <th>{{ trans('message.Product Name') }}</th>
                            <!-- <th>{{ trans('message.Date') }}</th> -->
                            <th>{{ trans('message.Total Stock') }}</th>
                            <th>{{ trans('message.Product Sales') }}</th>
                            <th>{{ trans('message.Product Service') }}</th>
                            <!--<th>{{ trans('message.Current Stock') }} </th> -->
                            @can('report_view')
                            <th>{{ trans('message.Action') }} </th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @if (!empty($productreport))
                        @foreach ($productreport as $productreports)
                        <tr>
                            <td>{{ $i }}</td>
                            <td><a data-bs-toggle="modal" data-bs-target="#stockview" productid="{{ $productreports->product_id }}" s_date="{{ $s_date }}" e_date="{{ $e_date }}" url="{!! url('/report/stock/modalviewPart') !!}" class="stocksave">{{ $productreports->product_no }} </a>
                                <!-- <a data-toggle="tooltip" data-placement="bottom" title="Product Number" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                            </td>
                            <td>{{ getProductName($productreports->product_type_id) }} 
                                <!-- <a data-toggle="tooltip" data-placement="bottom" title="Manufacturer Name" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                            </td>
                            <td>{{ $productreports->name }} 
                                <!-- <a data-toggle="tooltip" data-placement="bottom" title="Product Name" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                            </td>
                            <td>{{ getTotalProduct($productreports->id, $s_date, $e_date) }} 
                                <!-- <a data-toggle="tooltip" data-placement="bottom" title="Total Stock" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                            </td>
                            @if ($productreports->category == 0)
                            <td>{{ getCellProduct($productreports->id, $s_date, $e_date) }} 
                                <!-- <a data-toggle="tooltip" data-placement="bottom" title="Product Sales" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                            </td>
                            @else
                            <td>{{ getCellProductSale($productreports->id, $s_date, $e_date) }} 
                                <!-- <a data-toggle="tooltip" data-placement="bottom" title="Product Sales" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                            </td>
                            @endif
                            @if ($productreports->category != 0)
                            <td>{{ getTotalServiceProduct($productreports->id, $s_date, $e_date) }} 
                                <!-- <a data-toggle="tooltip" data-placement="bottom" title="Product Service" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                            </td>
                            @else
                            <td>0 
                                <!-- <a data-toggle="tooltip" data-placement="bottom" title="First Name" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                            </td>
                            @endif
                            @if ($productreports->category == 0)
                            @can('report_view')
                            <td><button type="button" data-bs-toggle="modal" data-bs-target="#stockview" productid="{{ $productreports->product_id }}" s_date="{{ $s_date }}" e_date="{{ $e_date }}" url="{!! url('/report/stock/modalview') !!}" class="btn btn-round btn-info stocksave">{{ trans('message.View') }}</button>
                            </td>
                            @endcan
                            @else
                            @can('report_view')
                            <td>
                                <div class="dropdown_toggle">
                                    <img src="{{ URL::asset('public/img/list/dots.png') }}" class="btn dropdown-toggle border-0" type="button" id="dropdownMenuButtonAction" data-bs-toggle="dropdown" aria-expanded="false">

                                    <ul class="dropdown-menu heder-dropdown-menu action_dropdown shadow py-2" aria-labelledby="dropdownMenuButtonAction">
                                        @can('stock_view')
                                        <li><button type="button" data-bs-toggle="modal" data-bs-target="#stockview" productid="{{ $productreports->product_id }}" s_date="{{ $s_date }}" e_date="{{ $e_date }}" url="{!! url('/report/stock/modalviewPart') !!}" class="btn border-0 stocksave"><img src="{{ URL::asset('public/img/list/Vector.png') }}" class="me-3">{{ trans('message.View') }}</button></li>
                                        @endcan
                                    </ul>
                                </div>
                            </td> 
                            @endcan
                            @endif
                        </tr>
                        <?php $i++; ?>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    @else
      <p class="d-flex justify-content-center"><img src="{{ URL::asset('public/img/dashboard/No-Data.png') }}" width="300px"></p>
    @endif
    </div>

</div>
<!-- content page end -->

<!-- language change in user selected -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var pdf = "{{ trans('message.PDF') }}";
        var print = "{{ trans('message.print') }}";
        var excel = "{{ trans('message.excel') }}";

        var search = "{{ trans('message.Search...') }}";
        var info = "{{ trans('message.Showing page _PAGE_ - _PAGES_') }}";
        var zeroRecords = "{{ trans('message.No Data Found') }}";
        var infoEmpty = "{{ trans('message.No records available') }}";

        $('#supplier').DataTable({
            columnDefs: [{
                width: 2,
                targets: 0
            }],
            fixedColumns: true,
            paging: true,
            scrollCollapse: true,
            scrollX: true,
            // scrollY: 300,

            responsive: true,
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'pdf',
                    text: pdf
                },
                {
                    extend: 'print',
                    text: print
                },
                {
                    extend: 'excel',
                    text: excel
                },
            ],
            // buttons: [
            //   'pdf', 'print', 'excel'
            // ],

            pagingType: 'simple_numbers',
            "language": {
                search: '',
                searchPlaceholder: search,
                lengthMenu: "_MENU_  ",
                info: info,
                zeroRecords: zeroRecords,
                infoEmpty: infoEmpty,
                infoFiltered: '(filtered from _MAX_ total records)',
            },
            aoColumnDefs: [{
                bSortable: false,
                aTargets: [-1]
            }]
        });
        $(".colorname").click(function() {
            var start_date = $('.start_date').val();
            var end_date = $('.end_date').val();
            if (start_date === "") {
                $('#common_error_span').css({
                    "display": ""
                });
            } else {
                $('#common_error_span').css({
                    "display": "none"
                });
                return true;
            }
            if (end_date === "") {
                $('#common_error_span_end').css({
                    "display": ""
                });
                return false;
            } else {
                $('#common_error_span_end').css({
                    "display": "none"
                });
                return true;
            }
        });
        $('body').on('change', '.start_date', function() {
            var start_date = $('.start_date').val();
            if (start_date === "") {
                $('#common_error_span').css({
                    "display": ""
                });
            } else {
                $('#common_error_span').css({
                    "display": "none"
                });
            }
        });
        $('body').on('change', '.end_date', function() {
            var end_date = $('.end_date').val();
            if (end_date === "") {
                $('#common_error_span_end').css({
                    "display": ""
                });
            } else {
                $('#common_error_span_end').css({
                    "display": "none"
                });
            }
        });


        $('.select_producttype').change(function() {
            var m_id = $(this).val();

            var url = $(this).attr('m_url');

            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    m_id: m_id
                },
                success: function(response) {
                    $('.select_productname').html(response);
                }
            });
        });


        $(".start_date,.input-group-addon").click(function() {
            var dateend = $('#end_date').val('');
        });

        $(".start_date").datetimepicker({
                format: "<?php echo getDatepicker(); ?>",
                minView: 2,
                autoclose: 1,
            }).on('changeDate', function(selected) {
                var startDate = new Date(selected.date.valueOf());

                $('.end_date').datetimepicker({
                    format: "<?php echo getDatepicker(); ?>",
                    minView: 2,
                    autoclose: 1,
                }).datetimepicker('setStartDate', startDate);
            })
            .on('clearDate', function(selected) {
                $('.end_date').datetimepicker('setStartDate', null);
            })

        $(".start_date").on("dp.change", function(e) {
            $('.end_date').data("DateTimePicker").minDate(e.date);

        });
        $(".end_date").on("dp.change", function(e) {
            $('.start_date').data("DateTimePicker").maxDate(e.date);
        });


        $('.end_date').click(function() {
            var date = $('#start_date').val();
            var msg1 = "{{ trans('message.First Select Start Date') }}";
            var msg35 = "{{ trans('message.OK') }}";

            if (date == '') {
                swal({
                    title: msg1,
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                        cancel: msg35,
                    },
                    dangerMode: true,
                });

            } else {
                $('.end_date').datetimepicker({
                    format: "<?php echo getDatepicker(); ?>",
                })
            }
        });



        $('body').on('click', '.stocksave', function() {
            $('.modal-body').html("");
            var productid = $(this).attr("productid");
            var s_date = $(this).attr("s_date");
            var e_date = $(this).attr("e_date");
            var url = $(this).attr('url');

            var msg2 = "{{ trans('message.An error occurred :') }}";

            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    productid: productid,
                    s_date: s_date,
                    e_date: e_date
                },
                success: function(data) {
                    $('.modal-body').html(data.html);
                },
                beforeSend: function() {
                    $(".modal-body").html(
                        "<center><h2 class=text-muted><b>Loading...</b></h2></center>");
                },
                error: function(e) {
                    alert(msg2 + " " + e.responseText);
                    console.log(e);
                }
            });
        });
    });
</script>


@endsection