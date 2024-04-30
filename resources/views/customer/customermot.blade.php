@extends('layouts.app')
@section('content')
<?php if (getLangCode() == 'pl') {
?>
    <style>
        @media (max-width: 320px) {
            ul.bar_tabs>li.active {
                margin-top: 0px !important;
                margin-left: 8px !important;
            }

            .x_panel {
                margin-top: 40px !important;
            }
        }

        @media (max-width: 30px) {
            ul.bar_tabs>li.active {
                margin-top: 0px !important;
                margin-left: 8px !important;
            }

            .x_panel {
                margin-top: 40px !important;
            }
        }

        /* new added */
        ul.recent_box {
            height: 220px;
            width: 100%;
        }
    </style>
<?php
} ?>
<?php if (
    getLangCode() == 'gr' ||
    getLangCode() == 'it' ||
    getLangCode() == 'id' ||
    getLangCode() == 'tr' ||
    getLangCode() == 'ro' ||
    getLangCode() == 'hr' ||
    getLangCode() == 'hu'
) {
?>
    <style>
        @media (max-width: 320px) {
            ul.bar_tabs>li.active {
                margin-top: 0px !important;
                margin-left: 0px !important;
            }

            .x_panel {
                margin-top: 40px !important;
            }
        }

        @media (max-width: 30px) {
            ul.bar_tabs>li.active {
                margin-top: 0px !important;
                margin-left: 0px !important;
            }

            .x_panel {
                margin-top: 40px !important;
            }
        }
    </style>
<?php
} ?>
<?php if (getlangCode() == 'ta') {
?>
    <style>
        @media (max-width: 320px) {
            ul.bar_tabs>li.active {
                margin-top: 0px !important;
                margin-left: 0px !important;
            }

            .x_panel {
                margin-top: 60px !important;
            }
        }

        @media (max-width: 30px) {
            ul.bar_tabs>li.active {
                margin-top: 0px !important;
                margin-left: 0px !important;
            }

            .x_panel {
                margin-top: 60px !important;
            }
        }

        @supports (-webkit-touch-callout: none) {
            ul.bar_tabs>li.active {
                margin-top: 1px !important;
                margin-left: 0px !important;
            }

            .x_panel {
                margin-top: 40px !important;
            }
        }
    </style>
<?php
} ?>
<?php if (
    getLangCode() == 'cs' ||
    getLangCode() == 'ru' ||
    getLangCode() == 'vi'
) {
?>
    <style>
        @media (max-width: 320px) {
            ul.bar_tabs>li.active {
                margin-top: 0px !important;
                margin-left: 0px !important;
            }

            .x_panel {
                margin-top: 40px !important;
            }
        }

        @media (max-width: 30px) {
            ul.bar_tabs>li.active {
                margin-top: 0px !important;
                margin-left: 0px !important;
            }

            .x_panel {
                margin-top: 40px !important;
            }
        }

        @supports (-webkit-touch-callout: none) {
            ul.bar_tabs>li.active {
                margin-top: 1px !important;
                margin-left: 0px !important;
            }

            .x_panel {
                margin-top: 40px !important;
            }
        }
    </style>
<?php
} ?>
<style>
    .right_side .table_row,
    .member_right .table_row {
        border-bottom: 1px solid #dedede;
        float: left;
        width: 100%;
        padding: 1px 0px 4px 2px;
    }

    .table_row .table_td {
        padding: 8px 8px !important;
    }

    .report_title {
        float: left;
        font-size: 20px;
        width: 100%;
    }

    @media (min-width: 320px) {
        .ul.bar_tabs>li.active {
            margin-left: 4px !important;
        }
    }
</style>

<!-- page content -->
<div class="right_col" role="main">
    <div id="myModal-job" class="modal fade setTableSizeForSmallDevices" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content modal-body-data">
            </div>
        </div>
    </div>
    <!-- free service  model-->
    <div id="myModal-free-open" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg modal-xs">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="myLargeModalLabel" class="modal-title"> {{ trans('message.Free Service Details') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
    <!-- Paid Service view -->
    <div id="myModal-paid-service" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg modal-xs">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="myLargeModalLabel" class="modal-title">{{ trans('message.Paid Service Details') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
    <!--  Repeat job service view -->
    <div id="myModal-repeatjob" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg modal-xs">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="myLargeModalLabel" class="modal-title">{{ trans('message.Repeat Job Service Details') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
    <!--  Free service customer view -->
    <div id="myModal-customer-modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg modal-xs">
            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
    <div class="">
        <div class="page-title">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <span class="titleup"><a href="{{ URL::previous() }}"><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}" class="me-2"></a>{{ $customer->name . ' ' . $customer->lastname }}</span>
                    </div>
                    @include('dashboard.profile')
                </nav>
            </div>
        </div>
    </div>
    <div class="view_page_header_bg mt-4">
        <div class="row">
            <div class="col-xl-10 col-md-9 col-sm-10">
                <div class="user_profile_header_left">
                    <img class="user_view_profile_image" src="{{ URL::asset('public/customer/' . $customer->image) }}">
                    <div class="row">
                        <div class="view_top1">
                            <div class="col-xl-12 col-md-12 col-sm-12">
                                <label class="nav_text h5">
                                    {{ $customer->name . ' ' . $customer->lastname }}&nbsp;
                                </label>
                                <div class="view_user_edit_btn d-inline">
                                    <a href="{!! url('/customer/list/edit/' . $customer->id) !!}">
                                        <img src="{{ URL::asset('public/img/dashboard/Edit.png') }}">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-12 col-md-12 col-sm-12 nav_text mt-2">
                                <i class="fa fa-phone"></i>&nbsp;{{ $customer->mobile_no }}&nbsp;&nbsp;&nbsp;
                                <i class="fa fa-envelope"></i>&nbsp;{{ $customer->email }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12">
                            <div class="view_top1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <i class="fa-solid fa-location-dot"></i>&nbsp;&nbsp;
                                        <lable class="">
                                            {{ $customer->address }}, <?php echo getCityName($customer->city_id) != null ? getCityName($customer->city_id) . ',' : ''; ?>{{ getStateName($customer->state_id) }}, {{ getCountryName($customer->country_id) }}.
                                        </lable>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-3 col-md-3 col-sm-2">
                <div class="group_thumbs">
                    <img src="{{ URL::asset('public/img/dashboard/Design.png') }}" height="93px" width="134px">
                </div>
            </div>
        </div>
    </div>
    @if (session('message'))
    <div class="row massage">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="checkbox checkbox-success checkbox-circle mb-2 alert alert-success alert-dismissible fade show">
                <input id="checkbox-10" type="checkbox" checked="">
                <label for="checkbox-10 colo_success" style="margin-left: 20px;font-weight: 600;"> {{ session('message') }} </label>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="padding: 1rem 0.75rem;"></button>
            </div>
        </div>
    </div>
    @endif
    <section id="" class="">

        <div class="panel-body padding_0">
            <div class="row mt-4">
                <div class="col-xl-12 col-md-12 col-sm-12">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="">
                            <a href="{!! url('/customer/list/' . $customer->id) !!}" class="tab">
                                {{ trans('message.GENERAL') }}</a>
                        </li>
                        <li class="">
                            <a href="{!! url('/customer/list/vehicle/' . $customer->id) !!}" class="tab">
                                {{ trans('message.VEHICLE DETAILS') }}</a>
                        </li>
                        <li class="">
                            <a href="{!! url('/customer/list/jobcard/' . $customer->id) !!}" class="tab">
                                {{ trans('message.JOB CARDS') }}</a>
                        </li>
                        <li class="">
                            <a href="{!! url('/customer/list/quotation/' . $customer->id) !!}" class="tab">
                                {{ trans('message.QUOTATIONS') }}</a>
                        </li>
                        <li class="">
                            <a href="{!! url('/customer/list/invoice/' . $customer->id) !!}" class="tab">
                                {{ trans('message.INVOICES') }}</a>
                        </li>
                        <li class="">
                            <a href="{!! url('/customer/list/payment/' . $customer->id) !!}" class="tab">
                                {{ trans('message.PAYMENTS') }}</a>
                        </li>
                        <li class="active">
                            <a href="{!! url('/customer/list/mot/' . $customer->id) !!}" class="tab active">
                                {{ trans('message.MOT') }}</a>
                        </li>
                    </ul>

                </div>
            </div>

        </div>
        <div class="x_panel bgr">
            <table id="supplier" class="table responsive jumbo_table" style="width:100%">
                <thead>
                    <tr>
                        <th>{{ trans('message.Vehicle Id') }}</th>
                        <th>{{ trans('message.Service Id') }}</th>
                        <th>{{ trans('message.MOT Test Status') }}</th>
                        <th>{{ trans('message.MOT Test Number') }}</th>
                        <th>{{ trans('message.Date') }}</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <!-- END PANEL BODY DIV-->

    </section>
</div>
<!-- Page content end -->



<!-- Scripts starting -->
<script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>

<script type="text/javascript">
    /****** Free Service only *******/
    $(document).ready(function() {
        $(".freeserviceopen").click(function() {
            $('.modal-body').html("");

            var f_serviceid = $(this).attr("f_serviceid");
            var url = $(this).attr('url');

            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    f_serviceid: f_serviceid
                },
                success: function(data) {
                    $('.modal-body').html(data.html);
                },
                beforeSend: function() {
                    $(".modal-body").html(
                        "<center><h2 class=text-muted><b>Loading...</b></h2></center>");
                },
                error: function(e) {
                    alert("An error occurred: " + e.responseText);
                    console.log(e);
                }
            });
        });


        /****** Paid Service only *******/
        $(".paidservice").click(function() {
            $('.modal-body').html("");

            var p_serviceid = $(this).attr("p_serviceid");
            var url = $(this).attr('url');

            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    p_serviceid: p_serviceid
                },
                success: function(data) {
                    $('.modal-body').html(data.html);
                },
                beforeSend: function() {
                    $(".modal-body").html(
                        "<center><h2 class=text-muted><b>Loading...</b></h2></center>");
                },
                error: function(e) {
                    alert("An error occurred: " + e.responseText);
                    console.log(e);
                }
            });
        });

        /******* Repeat job  Service only *******/
        $(".repeatjobservice").click(function() {
            $('.modal-body').html("");

            var r_service = $(this).attr("r_service");
            var url = $(this).attr('url');

            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    r_service: r_service
                },
                success: function(data) {
                    $('.modal-body').html(data.html);
                },
                beforeSend: function() {
                    $(".modal-body").html(
                        "<center><h2 class=text-muted><b>Loading...</b></h2></center>");
                },
                error: function(e) {
                    alert("An error occurred: " + e.responseText);
                    console.log(e);
                }
            });
        });

        /******* Free cusomer model service *******/
        $(".customeropenmodel").click(function() {
            $('.modal-body').html("");
            var open_customer_id = $(this).attr("open_customer_id");
            var url = $(this).attr('url');

            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    servicesid: open_customer_id
                },
                success: function(data) {
                    $('.modal-body').html(data.html);
                },
                beforeSend: function() {
                    $(".modal-body").html(
                        "<center><h2 class=text-muted><b>Loading...</b></h2></center>");
                },
                error: function(e) {
                    alert("An error occurred: " + e.responseText);
                    console.log(e);
                }
            });
        });
    });
    $(document).ready(function() {
        var search = "{{ trans('message.Search...') }}";
        var info = "{{ trans('message.Showing page _PAGE_ - _PAGES_') }}";
        var zeroRecords = "{{ trans('message.Nothing found - sorry') }}";
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
            "language": {
                lengthMenu: "_MENU_ ",
                info: info,
                zeroRecords: zeroRecords,
                infoEmpty: infoEmpty,
                infoFiltered: '(filtered from _MAX_ total records)',
                searchPlaceholder: search,
                search: '',
            },
            aoColumnDefs: [{
                bSortable: false,
                aTargets: [-1]
            }],

        });
    });
</script>
@endsection