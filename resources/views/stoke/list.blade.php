@extends('layouts.app')
@section('content')
<style>
    @media screen and (max-width:540px) {
        div#stock_info {
            margin-top: -177px;
        }

        span.titleup {
            margin-left: -10px;
        }
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div id="stockview" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content stock w-100">
                <div class="modal-header">
                    <h4 id="myLargeModalLabel" class="modal-title"> {{ getNameSystem() }} </h4>
                    <!-- <h4 id="myLargeModalLabel" class="modal-title">{{ trans('message.Stock') }}</h4> -->
                    <a href="{!! url('/stoke/list') !!}" class="prints"><input type="submit" class="btn-close " data-bs-dismiss="modal" value=""></a>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
    <div id="managestock" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content stock w-100">
                <div class="modal-header">
                    <h4 id="myLargeModalLabel" class="modal-title"> {{ getNameSystem() }} </h4>
                    <!-- <h4 id="myLargeModalLabel" class="modal-title">{{ trans('message.Stock') }}</h4> -->
                    <a href="{!! url('/stoke/list') !!}" class="prints"><input type="submit" class="btn-close " data-bs-dismiss="modal" value=""></a>
                </div>
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
                        &nbsp;<a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><span class="titleup">{{ trans('message.Stock') }}</span>
                        @can('purchase_add')
                        <a href="{!! url('/purchase/add') !!}" id="">
                            <img src="{{ URL::asset('public/img/icons/plus Button.png') }}">
                        </a>
                        @endcan
                        </span>
                    </div>
                    @include('dashboard.profile')
                </nav>
            </div>
        </div>
    </div>
    @include('success_message.message')
    <div class="row">
        @if(!empty($stock) && count($stock) > 0)
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel bgr">
                <table id="supplier" class="table jambo_table " style="width:100%">
                    <thead>
                        <tr>
                            <th>{{ trans('message.Image') }}</th>
                            <th>{{ trans('message.Product Number') }}</th>
                            <th>{{ trans('message.Manufacturer Name') }}</th>
                            <th>{{ trans('message.Product Name') }}</th>
                            <th>{{ trans('message.Quantity') }}</th>
                            <th>{{ trans('message.Unit Of Measurement') }}</th>
                            <th>{{ trans('message.Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($stock as $stocks)
                        <tr>
                            <td>
                                <a type="button" data-bs-toggle="modal" data-bs-target="#stockview" stockid="{{ $stocks->id }}" url="{!! url('/stoke/list/stockview') !!}" class=" stocksave"><img src="{{ url('public/product/' . $stocks->product_image) }}" width="52px" height="52px" class=""></a>
                            </td>
                            <td><a type="button" data-bs-toggle="modal" data-bs-target="#stockview" stockid="{{ $stocks->id }}" url="{!! url('/stoke/list/stockview') !!}" class=" stocksave">{{ $stocks->product_no }} </a>
                                 <!-- <a data-toggle="tooltip" data-placement="bottom" title="Product Number" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                            </td>
                            <td>{{ getProductName($stocks->product_type_id) }} 
                                <!-- <a data-toggle="tooltip" data-placement="bottom" title="Manufacturer Name" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                            </td>
                            <td>{{ getProduct($stocks->product_id) }} 
                                <!-- <a data-toggle="tooltip" data-placement="bottom" title="Product Name" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                            </td>
                            <td>{{ getStockCurrent($stocks->product_id) }} 
                                <!-- <a data-toggle="tooltip" data-placement="bottom" title="Quantity" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                            </td>
                            <td>{{ getUnitMeasurement($stocks->product_id) }}
                                <!-- <a data-toggle="tooltip" data-placement="bottom" title="Unit Of Measurement" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                            </td>
                            <td>
                                <div class="dropdown_toggle">
                                    <img src="{{ URL::asset('public/img/list/dots.png') }}" class="btn dropdown-toggle border-0" type="button" id="dropdownMenuButtonAction" data-bs-toggle="dropdown" aria-expanded="false">

                                    <ul class="dropdown-menu heder-dropdown-menu action_dropdown shadow py-2" aria-labelledby="dropdownMenuButtonAction">
                                        @can('stock_view')
                                        <li><a type="button" data-bs-toggle="modal" data-bs-target="#stockview" stockid="{{ $stocks->id }}" url="{!! url('/stoke/list/stockview') !!}" class="dropdown-item stocksave"><img src="{{ URL::asset('public/img/list/Vector.png') }}" class="me-3">{{ trans('message.View') }}</a></li>
                                        @endcan
                                        @can('stock_edit')
                                        <li><a type="button" data-bs-toggle="modal" data-bs-target="#managestock" stockid="{{ $stocks->id }}" url="{!! url('/stoke/list/managestock') !!}" class="dropdown-item managestock"><img src="{{ URL::asset('public/img/list/Edit.png') }}" class="me-3"> {{ trans('message.Manage Stock') }}</a></li>
                                        @endcan
                                    </ul>
                                </div>
                                <!-- <a class="dropdown-item" href="{!! url('/stoke/list/stockview' . $stocks->id) !!}"><img src="{{ URL::asset('public/img/list/Vector.png') }}" class="me-3"> {{ trans('message.View') }}</a> -->

                            </td>
                        </tr>
                        <?php $i++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
        <p class="d-flex justify-content-center mt-5 pt-5"><img src="{{ URL::asset('public/img/dashboard/No-Data.png') }}" width="300px"></p>
        @endif
    </div>
</div>
<!-- /page content -->



<!-- Scripts starting -->
<script src="{{ URL::asset('vendors/jquery/jquery.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

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
            pagingType: 'simple_numbers',
            "language": {
                lengthMenu: "_MENU_ ",
                info: info,
                zeroRecords: zeroRecords,
                infoEmpty: infoEmpty,
                infoFiltered: '(filtered from _MAX_ total records)',
                searchPlaceholder: search,
                search: ''
            },
            aoColumnDefs: [{
                bSortable: false,
                aTargets: [-1]
            }]
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



        $('body').on('click', '.stocksave', function() {

            $('.modal-body').html("");
            var stockid = $(this).attr("stockid");
            var url = $(this).attr('url');
            var msg10 = "{{ trans('message.An error occurred :') }}";

            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    stockid: stockid
                },
                success: function(data) {
                    $('.modal-body').html(data.html);
                },
                beforeSend: function() {
                    $(".modal-body").html(
                        "<center><h2 class=text-muted><b>Loading...</b></h2></center>");
                },
                error: function(e) {
                    alert(msg10 + " " + e.responseText);
                    console.log(e);
                }
            });
        });

        $('body').on('click', '.managestock', function() {

            $('.modal-body').html("");
            var stockid = $(this).attr("stockid");
            var url = $(this).attr('url');
            var msg10 = "{{ trans('message.An error occurred :') }}";

            console.log(url);
            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    stockid: stockid
                },
                success: function(data) {
                    $('.modal-body').html(data.html);
                },
                beforeSend: function() {
                    $(".modal-body").html(
                        "<center><h2 class=text-muted><b>Loading...</b></h2></center>");
                },
                error: function(e) {
                    alert(msg10 + " " + e.responseText);
                    console.log(e);
                }
            });
        });
    });
</script>
@endsection