@extends('layouts.app')

@section('content')
<style>
    @media screen and (max-width:540px) {
        div#service_info {
            margin-top: -177px;
        }

        span.titleup {
            margin-left: -10px;
        }
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" size="xl">
            <!-- Modal content-->
            <div class="modal-content modal_data p-2">
            </div>
        </div>
    </div>

    <!-- Modal for Coupon Data -->
    <div class="modal fade" id="coupaon_data" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content used_coupn_modal_data">

            </div>
        </div>
    </div>
    <!-- End Modal for Coupon Data -->
    <div class="">
        <div class="page-title">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a>
                        <i class=""></i><span class="titleup">{{ trans('message.Services') }}
                            @can('service_add')
                            <a id="" href="{!! url('/service/add') !!}">
                                <img src="{{ URL::asset('public/img/icons/plus Button.png') }}">
                            </a>
                            @endcan
                        </span>
                    </div>
                    @include('dashboard.profile')
                </nav>
            </div>
        </div>
        @include('success_message.message')
        <div class="row">
        @if(!empty($service) && count($service) > 0)
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel table_up_div">
                    <table id="supplier" class="table jambo_table" style="width:100%">
                        <thead>
                            <tr>
                                @can('service_delete')
                                <th> </th>
                                @endcan
                                <th>{{ trans('message.Job No') }}</th>
                                <th>{{ trans('message.Customer Name') }}</th>
                                <th>{{ trans('message.Date') }}</th>
                                <th>{{ trans('message.Service Category') }}</th>
                                <th>{{ trans('message.Assign To') }}</th>
                                <!-- <th>{{ trans('message.Free Service Coupen') }}</th> -->
                                <th>{{ trans('message.Number Plate') }}</th>
                                <th>{{ trans('message.Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($service))
                            <?php $i = 1; ?>
                            @foreach ($service as $services)
                            <tr data-user-id="{{ $services->id }}">
                                @can('service_delete')
                                <td>
                                    <label class="container checkbox">
                                        <input type="checkbox" name="chk">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                @endcan
                                <td>
                                    <a data-bs-toggle="modal" data-bs-target="#myModal" serviceid="{{ $services->id }}" url="{!! url('/service/list/view') !!}" class="save">{{ $services->job_no }} 
                                        <!-- <a data-toggle="tooltip" data-placement="bottom" title="Job No" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                                    </a>
                                </td>
                                <td>
                                    <a data-bs-toggle="modal" data-bs-target="#myModal" serviceid="{{ $services->id }}" url="{!! url('/service/list/view') !!}" class="save">{{ getCustomerName($services->customer_id) }} 
                                        <!-- <a data-toggle="tooltip" data-placement="bottom" title="Customer Name" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                                    </a>
                                </td>
                                <?php $date_db = date('Y-m-d', strtotime($services->service_date)); ?>
                                @if (!empty($current_month) && strpos($available, $date_db) !== false)
                                <td>
                                    <span class="label label-danger" style="font-size:13px;">{{ date(getDateFormat(), strtotime($date_db)) }} 
                                        <!-- <a data-toggle="tooltip" data-placement="bottom" title="Date" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                                    </span>
                                </td>
                                @else
                                <td> {{ date(getDateFormat(), strtotime($date_db)) }} 
                                    <!-- <a data-toggle="tooltip" data-placement="bottom" title="Date" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                                </td>
                                @endif
                                <td>{{ $services->service_category }} 
                                    <!-- <a data-toggle="tooltip" data-placement="bottom" title="Service Category" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                                </td>
                                <td>{{ getAssignTo($services->assign_to) }} 
                                    <!-- <a data-toggle="tooltip" data-placement="bottom" title="Assign To" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                                </td>
                                <!-- <?php $coupon = getAllCoupon($services->customer_id, $services->vehicle_id);
                                ?>
                                @if ($services->service_type == 'free')
                                <td style="width:20%;display:contents;">
                                    @foreach ($coupon as $coup)
                                    <?php $useddata = getUsedCoupon($services->customer_id, $services->vehicle_id, $coup->job_no);
                                    ?>
                                    @if ($useddata == 1)
                                    <button class="bg-danger badge p-2" disabled>{{ $coup->job_no }}</span>

                                        @elseif($useddata == 'empty')
                                        <button class="btn btn-warning btn-xs coupon_btn badge p-2" data-bs-toggle="modal" data-bs-target="#coupaon_data" id="coup_data" coupon_no="{{ $coup->job_no }}" servi_id="{{ $services->id }}" url="{!! url('/service/used_coupon_data') !!}">{{ $coup->job_no }}</span>
                                            @elseif($useddata == 0)
                                            <button class="bg-success badge p-2" disabled>{{ $coup->job_no }}</span>
                                                @endif
                                                @endforeach
                                </td>
                                @else
                                <td>{{ trans('message.Paid Service') }} <a data-toggle="tooltip" data-placement="bottom" title="Free Service Coupon" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a></td>
                                @endif -->
                                <td>{{ getVehicleNumberPlate($services->vehicle_id) ?? trans('message.Not Added') }} 
                                    <!-- <a data-toggle="tooltip" data-placement="bottom" title="Number Plate" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                                </td>
                                <td>
                                    <div class="dropdown_toggle">
                                        <img src="{{ URL::asset('public/img/list/dots.png') }}" class="btn dropdown-toggle border-0" type="button" id="dropdownMenuButtonaction" data-bs-toggle="dropdown" aria-expanded="false">

                                        <ul class="dropdown-menu heder-dropdown-menu action_dropdown shadow py-2" aria-labelledby="dropdownMenuButtonaction">
                                            @can('service_view')
                                            <li><button type="button" data-bs-toggle="modal" data-bs-target="#myModal" serviceid="{{ $services->id }}" url="{!! url('/service/list/view') !!}" class="dropdown-item save border-0"><img src="{{ URL::asset('public/img/list/Vector.png') }}" class="me-3"> {{ trans('message.View') }}</button></li>
                                            <!-- <li><a class="dropdown-item" href="{!! url('/service/list/view/' . $services->id) !!}"><img src="{{ URL::asset('public/img/list/Vector.png') }}" class="me-3"> {{ trans('message.View') }}</a></li> -->
                                            @endcan

                                            @can('service_edit')
                                            <li><a class="dropdown-item" href="{!! url('/service/list/edit/' . $services->id) !!}"><img src="{{ URL::asset('public/img/list/Edit.png') }}" class="me-3"> {{ trans('message.Edit') }}</a></li>
                                            @endcan

                                            @can('service_delete')
                                            <div class="dropdown-divider m-0"></div>
                                            <li><a class="dropdown-item sa-warning" url="{!! url('/service/list/delete/' . $services->id) !!}" style="color:#FD726A"><img src="{{ URL::asset('public/img/list/Delete.png') }}" class="me-3">{{ trans('message.Delete') }}</a></li>
                                            @endcan
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php $i++; ?>
                            @endforeach
                            @endif

                        </tbody>
                    </table>
                    @can('service_delete')
                    <button id="select-all-btn" class="btn select_all"><input type="checkbox" name="selectAll"> {{ trans('message.Select All') }}</button>
                    <button id="delete-selected-btn" class="btn btn-danger text-white border-0" data-url="{!! url('/service/list/delete/') !!}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    @endcan
                </div>
            </div>
        @else
            <p class="d-flex justify-content-center mt-5 pt-5"><img src="{{ URL::asset('public/img/dashboard/No-Data.png') }}" width="300px"></p>
        @endif
        </div>
    </div>
</div>
<!-- /page content -->


<!-- Scripts starting -->
<script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<!-- language change in user selected -->
<script>
    $(document).ready(function() {

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
            order: [
                [1, 'desc']
            ]

        });


        $('body').on('click', '.sa-warning', function() {

            var url = $(this).attr('url');
            var msg1 = "{{ trans('message.Are You Sure?') }}";
            var msg2 = "{{ trans('message.You will not be able to recover this data afterwards!') }}";
            var msg3 = "{{ trans('message.Cancel') }}";
            var msg4 = "{{ trans('message.Yes, delete!') }}";

            swal({
                title: msg1,
                text: msg2,
                icon: 'warning',
                cancelButtonColor: '#C1C1C1',
                buttons: [msg3, msg4],
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    window.location.href = url;
                }
            });

        });


        $('body').on('click', '.save', function() {
            var servicesid = $(this).attr("serviceid");
            var url = $(this).attr('url');
            var msg10 = "{{ trans('message.An error occurred :') }}";

            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    servicesid: servicesid
                },
                success: function(data) {
                    $('.modal_data').html(data.html);
                },
                error: function(e) {
                    alert(msg10 + " " + e.responseText);
                    console.log(e);
                }
            });

        });



        $('body').on('click', '.coupon_btn', function() {
            var coupon_no = $(this).attr('coupon_no');
            var ser_id = $(this).attr('servi_id');
            var url = $(this).attr('url');

            $.ajax({

                url: url,
                type: 'GET',
                data: {
                    coupon_no: coupon_no,
                    ser_id: ser_id
                },

                success: function(response) {

                    $('.used_coupn_modal_data').html(response.html);
                },
                erro: function(e) {
                    console.log(e);
                }
            });
        });
    });
</script>
@endsection