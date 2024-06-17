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
</style>
<div class="right_col" role="main">
    <div class="page-title">
        <div class="nav_menu">
            <nav>
                <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars"></i><span class="titleup">&nbsp
                            {{ trans('message.Report') }}</span></a>
                </div>
                @include('dashboard.profile')
            </nav>
        </div>
    </div>

    <div class="x_content">
        <ul class="nav nav-tabs">
            <!-- <li class="nav-item">
                @can('report_view')
                <a href="{!! url('/report/salesreport') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span> <i class="fa fa-tty fa-lg">&nbsp;</i><b>{{ trans('message.Vehicle Sales') }}</b></a>
                @endcan
            </li> -->
            <li class="nav-item">
                @can('report_view')
                <a href="{!! url('/report/servicereport') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="fa-brands fa-slack fa-lg">&nbsp;</i><b>{{ trans('message.Services') }}</b></a>
                @endcan
            </li>
            <li class="nav-item">
                @can('report_view')
                <a href="{!! url('/report/productreport') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="fa-brands fa-product-hunt fa-lg">&nbsp;</i><b>{{ trans('message.Product Stock') }}</b></a>
                @endcan
            </li>
            <li class="nav-item">
                @can('report_view')
                <a href="{!! url('/report/productuses') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="fa-brands fa-product-hunt fa-lg">&nbsp;</i><b>{{ trans('message.Product Usage') }}</b></a>
                @endcan
            </li>
            <li class="nav-item">
                @can('report_view')
                <a href="{!! url('/report/servicebyemployee') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="fa-brands fa-slack fa-lg">&nbsp;</i><b>{{ trans('message.Emp. Services') }}</b></a>
                @endcan
            </li>
            <li class="nav-item">
                @can('report_view')
                <a href="{!! url('/report/email') !!}" class="nav-link active"><span class="visible-xs"></span> <i class="fa fa-envelope" aria-hidden="true">&nbsp;</i><b>{{ trans('Emails') }}</b></a>
                @endcan
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <form method="post" action="{!! url('/report/record_email') !!}" enctype="multipart/form-data" class="form-horizontal upperform">
                        <div class="row mt-3">
                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 {{ $errors->has('start_date') ? ' has-error' : '' }}">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 currency" for="date">{{ trans('message.Start Date') }} <label class="color-danger">*</label>
                                </label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 date">

                                    <input type="text" name="start_date" id="start_date" autocomplete="off" class="form-control start_date" value="<?php if (!empty($startDate)) {
                                                                                                                                                        echo date(getDateFormat(), strtotime($startDate));
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

                                    <input type="text" name="end_date" id="end_date" autocomplete="off" class="form-control end_date" value="<?php if (!empty($endDate)) {
                                                                                                                                                    echo date(getDateFormat(), strtotime($endDate));
                                                                                                                                                } else {
                                                                                                                                                    echo old('end_date');
                                                                                                                                                } ?>" placeholder="<?php echo getDatepicker(); ?>" onkeypress="return false;" />
                                    <span id="common_error_span_end" class="help-block error-help-block text-danger" style="display: none">{{ trans('message.Please Select End Date.') }}</span>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row mt-3">
                            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 text-end">
                                <button type="submit" class="btn btn-success colorname">{{ trans('message.Go') }}</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">

            <div class="x_panel table_up_div">
                <table id="datatable1" class="table table-striped jambo_table" style="margin-top:20px;">
                    <thead>
                        <tr>
                            <th>{{ trans('Date') }}</th>
                            <th>{{ trans('Recipient_email') }}</th>
                            <th>{{ trans('Subject') }}</th>
                            <th>{{ trans('Content') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($email as $emails)
                        <tr>
                            <td>{{ $emails->created_at }}</td>
                            <td>{{ $emails->recipient_email }}</td>
                            <td>{{ $emails->subject }}</td>
                            <td>{{ $emails->content }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- page content end -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ URL::asset('public/js/49/loader.js') }}" defer="defer"></script>

<script>
    $(document).ready(function() {

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
    });
</script>

<script>
    $(document).ready(function() {
        var pdf = "{{ trans('message.PDF') }}";
        var print = "{{ trans('message.print') }}";
        var excel = "{{ trans('message.excel') }}";
        $('#datatable1').DataTable({
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
            "language": {

                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/<?php echo getLanguageChange();
                                                                        ?>.json"
            },
            aoColumnDefs: [{
                bSortable: false,
                aTargets: [-1]
            }]
        });
    });
</script>
@endsection 