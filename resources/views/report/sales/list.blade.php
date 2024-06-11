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
        div#report_sales_info {
            margin-top: -150px;
        }

        span.titleup {
            margin-left: -10px;
        }
    }
</style>
{{-- <?php include 'vendors/chart/gcharts.php'; ?> --}}
<?php
$options = [
    'title' => trans('message.All Sales'),
    'titleTextStyle' => ['color' => '#73879C', 'fontSize' => 14, 'bold' => true, 'fontName' => '"Helvetica Neue" Roboto Arial "Droid Sans" sans-serif'],
    'legend' => ['position' => 'right', 'textStyle' => ['color' => '#73879C', 'fontSize' => 14, 'padding' => 30, 'bold' => true, 'fontName' => '"Helvetica Neue",Roboto,Arial,"Droid Sans",sans-serif']],

    'hAxis' => [
        'title' => trans('message.Year'),
        'titleTextStyle' => ['color' => '#73879C', 'fontSize' => 14, 'bold' => true, 'fontName' => '"Helvetica Neue",Roboto,Arial,"Droid Sans",sans-serif'],
        'textStyle' => ['color' => '#73879C', 'fontSize' => 14],
        'maxAlternation' => 2,
    ],
    'vAxis' => [
        'title' => trans('message.Sales'),
        'minValue' => 0,
        'maxValue' => 4,
        'width' => 100,
        'format' => '#',
        'titleTextStyle' => ['color' => '#73879C', 'fontSize' => 16, 'bold' => true, 'fontName' => '"Helvetica Neue",Roboto,Arial,"Droid Sans",sans-serif'],
        'textStyle' => ['color' => '#73879C', 'fontSize' => 12],
    ],
    'colors' => ['#26b99a'],
    'bar' => [
        'groupWidth' => '100',
    ],
];
$chartStatus = 'no';
if (!empty($Sales)) {
    $chartStatus = 'yes';
}
foreach ($Sales as $data) {
    $datas = $data->counts;
}
$chart_array = [];
$chart_array[] = [trans('message.date'), trans('message.counts'), ['role' => 'style']];
foreach ($Sales as $Saless) {
    $chart_array[] = [$Saless->date, (int) $Saless->counts, '#26b99a'];
}

?>
<div class="right_col" role="main">
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
                <a href="{!! url('/report/salesreport') !!}" class="nav-link active"><span class="visible-xs"></span> <i class="">&nbsp;</i><b>{{ trans('message.VEHICLE SALES') }}</b></a>
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
                <a href="{!! url('/report/productuses') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.PRODUCT USAGE') }}</b></a>
                @endcan
            </li>
            <li class="nav-item">
                @can('report_view')
                <a href="{!! url('/report/servicebyemployee') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.EMP. SERVICES') }}</b></a>
                @endcan
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <form method="post" action="{!! url('/report/record_sales') !!}" enctype="multipart/form-data" class="form-horizontal upperform">
                        <div class="row mt-3">
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 {{ $errors->has('start_date') ? ' has-error' : '' }}">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 currency" for="date">{{ trans('message.Start Date') }} <label class="color-danger">*</label>
                                </label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 date">

                                    <input type="text" name="start_date" id="start_date_report" autocomplete="off" class="form-control start_date" value="<?php if (!empty($s_date)) {
                                                                                                                                                                echo date(getDateFormat(), strtotime($s_date));
                                                                                                                                                            } else {
                                                                                                                                                                echo old('start_date');
                                                                                                                                                            } ?>" placeholder="<?php echo getDatepicker(); ?>" onkeypress="return false;" />

                                    <span id="common_error_span" class="help-block error-help-block text-danger" style="display: none">{{ trans('message.Please Select Start Date.') }}</span>
                                </div>
                            </div>

                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 {{ $errors->has('end_date') ? ' has-error' : '' }}">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 currency" for="date">{{ trans('message.End Date') }} <label class="color-danger">*</label>
                                </label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 date">

                                    <input type="text" name="end_date" id="end_date_report" autocomplete="off" class="form-control end_date" value="<?php if (!empty($e_date)) {
                                                                                                                                                        echo date(getDateFormat(), strtotime($e_date));
                                                                                                                                                    } else {
                                                                                                                                                        echo old('end_date');
                                                                                                                                                    } ?>" placeholder="<?php echo getDatepicker(); ?>" onkeypress="return false;" />
                                    <span id="common_error_span_end" class="help-block error-help-block text-danger" style="display: none">{{ trans('message.Please Select End Date.') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="option">{{ trans('message.Select salesman') }} </label>
                                </label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <select class="form-control form-select" name="s_salesman">
                                        <option value="all" <?php if ($all_salesman == 'all') {
                                                                echo 'selected';
                                                            } ?>>{{ trans('message.All') }}</option>
                                        @if (!empty($Select_salesman))
                                        @foreach ($Select_salesman as $Select_salesmans)
                                        <option value="{{ $Select_salesmans->id }}" <?php if ($Select_salesmans->id == $all_salesman) {
                                                                                        echo 'selected';
                                                                                    } ?>>
                                            {{ $Select_salesmans->name }}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="option">{{ trans('message.Select Customer') }} </label>
                                </label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <select class="form-control form-select" name="s_customer">
                                        <option value="all" <?php if ($all_customer == 'all') {
                                                                echo 'selected';
                                                            } ?>>{{ trans('message.All') }}</option>
                                        @if (!empty($Select_customer))
                                        @foreach ($Select_customer as $Select_customers)
                                        <option value="{{ $Select_customers->id }}" <?php if ($Select_customers->id == $all_customer) {
                                                                                        echo 'selected';
                                                                                    } ?>>
                                            {{ $Select_customers->name }}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>

                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row mt-3">
                            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 text-end">
                                <button type="submit" class="btn btn-success colorname">{{ trans('message.Go') }}</button>
                                <button type="button" onclick="myFunction()" class="btn btn-success" id="chartshow">{{ trans('message.View Chart') }}</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


    @if (!empty($datas))
    <div class="row">
        <div id="chartdiv" style="visibility:hidden;height:0;float:left;width:100%;">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel tab_bottom">
                    <div id="sales_report"></div>
                </div>
            </div>
        </div>
    </div>
    @endif


    <div class="row">
    @if(!empty($salesreport) && count($salesreport) > 0)
        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
            <div class="x_panel table_up_div">
                <table id="supplier" class="table jambo_table" style="width:100%">
                    <thead>
                        <tr>
                            <th> </th>
                            <th>{{ trans('message.Bill Number') }}</th>
                            <th>{{ trans('message.Customer Name') }}</th>
                            <th>{{ trans('message.Date') }}</th>
                            <th>{{ trans('message.Vehicle Name') }}</th>
                            <th>{{ trans('message.Salesman') }}</th>
                            <th>{{ trans('message.Price') }} (<?php echo getCurrencySymbols(); ?>)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @if (!empty($salesreport))
                        @foreach ($salesreport as $salesreports)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $salesreports->bill_no }} 
                                <!-- <a data-toggle="tooltip" data-placement="bottom" title="Bill Number" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                            </td>
                            <td>{{ getCustomerName($salesreports->customer_id) }} 
                                <!-- <a data-toggle="tooltip" data-placement="bottom" title="Customer Name" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                            </td>
                            <td>{{ date(getDateFormat(), strtotime($salesreports->date)) }} 
                                <!-- <a data-toggle="tooltip" data-placement="bottom" title="Date" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                            </td>
                            <td>{{ getVehicleName($salesreports->vehicle_id) }} 
                                <!-- <a data-toggle="tooltip" data-placement="bottom" title="Vehicle Name" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                            </td>
                            <td>{{ getAssignedName($salesreports->salesmanname) }} 
                                <!-- <a data-toggle="tooltip" data-placement="bottom" title="Salesman" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                            </td>
                            <td>{{ $salesreports->price }} 
                                <!-- <a data-toggle="tooltip" data-placement="bottom" title="Price( <?php echo getCurrencySymbols(); ?> )" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                            </td>
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
<!-- page content end -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ URL::asset('public/js/49/loader.js') }}" defer="defer"></script>

<script>
    $(document).ready(function() {

        var pdf = "{{ trans('message.PDF') }}";
        var print = "{{ trans('message.print') }}";
        var excel = "{{ trans('message.excel') }}";

        var search =  "{{ trans('message.Search...') }}";
        var info = "{{ trans('message.Showing page _PAGE_ - _PAGES_') }}";
        var zeroRecords = "{{ trans('message.No Data Found') }}";
        var infoEmpty = "{{ trans('message.No records available') }}";

        $('#supplier').DataTable({
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
            columnDefs: [{
                width: 2,
                targets: 0
            }],
            fixedColumns: true,
            paging: true,
            scrollCollapse: true,
            scrollX: true,
            // scrollY: 300,

            "search": {
                "search": "",
            },
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

        $(".start_date,.input-group-addon").click(function() {
            var dateend = $('#end_date').val('');

        });

        // datepicker code
        $(".start_date,.input-group-addon").click(function() {
            var dateend = $('#end_date').val('');
        });
        $(".colorname").click(function() {
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();
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
        $('body').on('change', '#start_date', function() {
            var start_date = $('#start_date').val();
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
        $('body').on('change', '#end_date', function() {
            var end_date = $('#end_date').val();
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

        $(".start_date").datetimepicker({
                format: "<?php echo getDatepicker(); ?>",
                minView: 2,
                autoclose: 1,
                language: "{{ getLangCode() }}",
                // language: 'ar',
            }).on('changeDate', function(selected) {
                var startDate = new Date(selected.date.valueOf());

                $('.end_date').datetimepicker({
                    format: "<?php echo getDatepicker(); ?>",
                    minView: 2,
                    autoclose: 1,
                    language: "{{ getLangCode() }}",
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
                        cancel: msg35
                    },
                    dangerMode: true,
                });

            } else {
                $('.end_date').datetimepicker({
                    format: "<?php echo getDatepicker(); ?>",
                })

            }
        });


        // google chart code
        google.charts.load("current", {
            packages: ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var chart_report = <?php echo json_encode($chart_array); ?>;
            var option = <?php echo json_encode($options); ?>;
            var data = google.visualization.arrayToDataTable(chart_report);
            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                },
                2
            ]);
            var chart = new google.visualization.ColumnChart(document.getElementById("sales_report"));
            chart.draw(view, option);
        }

    });
</script>

<script>
    function myFunction() {
        var service = '<?php echo $chartStatus; ?>';
        if (service === 'yes') {
            var x = document.getElementById("chartdiv");
            if (x.style.visibility === "hidden") {
                x.style.visibility = "inherit";
                x.style.height = "auto";
                x.style.float = "left";
                x.style.width = "100%";

            } else {
                x.style.visibility = "hidden";
                x.style.height = "0";
                x.style.float = "left";
                x.style.width = "100%";
            }
        } else {
            var msg10 = "{{ trans('message.Data not avialable to display on chart.') }}";
            var msg36 = "{{ trans('message.OK') }}";
            swal({
                title: msg10,
                cancelButtonColor: '#C1C1C1',
                buttons: {
                    cancel: msg36,
                },
                dangerMode: true,
            });
        }

    }
</script>

@endsection