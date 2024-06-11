@extends('layouts.app')
@section('content')
<style>
    @media screen and (max-width:540px) {
        div#sales_info {
            margin-top: -179px;
        }

        span.titleup {
            margin-left: -10px;
        }
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content  modal-body-data">

            </div>
        </div>
    </div>

    <!-- Create invoice -->
    <div class="modal fade" id="myModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content modal-body-data">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">{{ trans('message.Create Invoice') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{ trans('message.Close') }}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <div class="page-title">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        @if (getActiveCustomer(Auth::user()->id) == 'yes' || getActiveEmployee(Auth::user()->id) == 'yes' || getBranchadminsactive(Auth::user()->id) == 'yes')
                        <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><span class="titleup">{{ trans('message.Vehicle Sells') }}
                            @can('sales_add')
                            <a href="{!! url('/sales/add') !!}" id="">
                                <img src="{{ URL::asset('public/img/icons/plus Button.png') }}" class="mb-2">
                            </a>
                            @endcan
                        </span>
                        @else
                        <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i><span class="titleup">
                                {{ trans('message.Purchase') }}</span></a>
                        @endif
                    </div>
                    @include('dashboard.profile')
                </nav>
            </div>
        </div>
        @include('success_message.message')
        <div class="row">
        @if(!empty($sales) && count($sales) > 0)
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel table_up_div">
                    <table id="supplier" class="table jambo_table" style="width:100%">
                        <thead>
                            <tr>
                                @can('sales_delete')
                                <th> </th>
                                @endcan
                                <th>{{ trans('message.Bill Number') }}</th>
                                <th>{{ trans('message.Customer Name') }}</th>
                                <th>{{ trans('message.Date') }}</th>
                                <th>{{ trans('message.Model Name') }}</th>
                                <th>{{ trans('message.Salesman') }}</th>
                                <th>{{ trans('message.Assign To') }}</th>
                                <th>{{ trans('message.Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $i = 1; ?>
                            @foreach ($sales as $sale)
                            <tr data-user-id="{{ $sale->id }}">
                                <!-- <td>{{ $i }}</td> -->
                                @can('sales_delete')
                                <td>
                                    <label class="container checkbox">
                                        <input type="checkbox" name="chk">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                @endcan

                                <td>{{ $sale->bill_no }} <a data-toggle="tooltip" data-placement="bottom" title="Bill Number" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a></td>
                                <td>{{ getCustomerName($sale->customer_id) }} <a data-toggle="tooltip" data-placement="bottom" title="Customer Name" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a></td>
                                <td>{{ date(getDateFormat(), strtotime($sale->date)) }} <a data-toggle="tooltip" data-placement="bottom" title="Date" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a></td>
                                <td>{{ getModelName($sale->vehicle_id) }} <a data-toggle="tooltip" data-placement="bottom" title="Model Name" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a></td>
                                <td>{{ getAssignedName($sale->salesmanname) }} <a data-toggle="tooltip" data-placement="bottom" title="Salesman" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a></td>
                                <td>{{ getAssignedName($sale->assigne_to) }} <a data-toggle="tooltip" data-placement="bottom" title="Assign To" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a></td>

                                <td>
                                    <div class="dropdown_toggle">
                                        <img src="{{ URL::asset('public/img/list/dots.png') }}" class="btn dropdown-toggle border-0" type="button" id="dropdownMenuButtonaction" data-bs-toggle="dropdown" aria-expanded="false">
                                        <ul class="dropdown-menu heder-dropdown-menu action_dropdown shadow py-2" aria-labelledby="dropdownMenuButtonaction">
                                            @if (getUserRoleFromUserTable(Auth::User()->id) == 'admin' || getUserRoleFromUserTable(Auth::User()->id) == 'supportstaff' || getUserRoleFromUserTable(Auth::User()->id) == 'accountant' || getUserRoleFromUserTable(Auth::User()->id) == 'employee' || getUserRoleFromUserTable(Auth::User()->id) == 'branch_admin')
                                            <?php $sales_invoice = getInvoiceNumber($sale->id); ?>
                                            <li>@if ($sales_invoice == 'No data')
                                                @if (Gate::allows('sales_add'))
                                                @can('sales_add')
                                                <!-- <a class="dropdown-item" href="{!! url('invoice/add/' . $sale->id) !!}"><img src="{{ URL::asset('public/img/list/create.png') }}" class="me-3"> {{ trans('message.Create Invoice') }}</button></a> -->
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#myModal1" class="dropdown-item invoice" saleid="{{ $sale->id }}" url="{!! url('/sales/invoice') !!}"><img src="{{ URL::asset('public/img/list/create.png') }}" class="me-3">{{ trans('message.Create Invoice') }} </button>

                                                @endcan
                                                @else
                                                @can('sales_view')
                                                <button type="button" class="btn btn-round btn-info" disabled><img src="{{ URL::asset('public/img/list/create.png') }}" class="me-3">{{ trans('message.Create Invoice') }}</button>
                                                @endcan
                                                @endif
                                                @else
                                                @can('sales_view')
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#myModal" saleid="{{ $sale->id }}" invoice_number="{{ getInvoiceNumber($sale->id) }}" url="{!! url('/sales/list/modal') !!}" class="btn border-0 ms-2 save"><img src="{{ URL::asset('public/img/list/Vector.png') }}" class="me-3">{{ trans('message.View Invoices') }}</button>
                                                @endcan
                                                @endif
                                            </li>
                                            <li> @can('sales_edit')
                                                <a class="dropdown-item" href="{!! url('sales/list/edit/' . $sale->id) !!}"><img src="{{ URL::asset('public/img/list/Edit.png') }}" class="me-3">&nbsp;{{ trans('message.Edit') }}</button></a>
                                                @endcan
                                            <li>@can('sales_delete')
                                                <div class="dropdown-divider m-0"></div>
                                                <a url="{!! url('sales/list/delete/' . $sale->id) !!}" class="dropdown-item sa-warning" style="color:#FD726A"><img src="{{ URL::asset('public/img/list/Delete.png') }}" class="me-3">{{ trans('message.Delete') }}</button></a>
                                                @endcan
                                            </li>
                                            @else
                                            <li><?php $sales_invoice = getInvoiceNumber($sale->id); ?>

                                                @if ($sales_invoice == 'No data')
                                                @if (Gate::allows('sales_add'))
                                                @can('sales_add')
                                                <!-- <a href="{!! url('invoice/add/' . $sale->id) !!}"><button type="button" class="btn btn-round btn-info"><img src="{{ URL::asset('public/img/list/create.png') }}" class="me-3"> {{ trans('message.Create Invoice') }}</button></a> -->
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#myModal1" class="dropdown-item invoice" saleid="{{ $sale->id }}" url="{!! url('/sales/invoice') !!}"><img src="{{ URL::asset('public/img/list/create.png') }}" class="me-3">{{ trans('message.Create Invoice') }} </button>

                                                @endcan
                                                @else
                                                @can('sales_view')
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#myModal" saleid="{{ $sale->id }}" invoice_number="{{ getInvoiceNumber($sale->id) }}" url="{!! url('/sales/list/modal') !!}" class="btn border-0 ms-2 save"><img src="{{ URL::asset('public/img/list/Vector.png') }}" class="me-3">{{ trans('message.View Invoices') }}</button>
                                                @endcan
                                                @endif
                                                @else
                                                @can('sales_view')
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#myModal" saleid="{{ $sale->id }}" invoice_number="{{ getInvoiceNumber($sale->id) }}" url="{!! url('/sales/list/modal') !!}" class="btn border-0 ms-2 save"><img src="{{ URL::asset('public/img/list/Vector.png') }}" class="me-3">{{ trans('message.View Invoices') }}</button>
                                                @endcan
                                                @endif
                                            </li>
                                            <li>
                                                @can('sales_edit')
                                                <a href="{!! url('sales/list/edit/' . $sale->id) !!}"><button type="button" class="btn btn-round btn-success">{{ trans('message.Edit') }}</button></a>
                                                @endcan
                                            <li>
                                                @can('sales_delete')
                                                <div class="dropdown-divider m-0"></div>
                                                <a url="{!! url('sales/list/delete/' . $sale->id) !!}" class="sa-warning"><button type="button" class="btn btn-round btn-danger">{{ trans('message.Delete') }}</button></a>
                                                @endcan
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php $i++; ?>
                            @endforeach
                        </tbody>
                    </table>
                    @can('sales_delete')
                    <button id="select-all-btn" class="btn select_all"><input type="checkbox" name="selectAll"> {{ trans('message.Select All') }}</button>
                    <button id="delete-selected-btn" class="btn btn-danger text-white border-0" data-url="{!! url('sales/list/delete/') !!}"><i class="fa fa-trash" aria-hidden="true"></i></button>
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

<script>
    $(document).ready(function() {

        var search = "{{ trans('message.Search...') }}";
        var info = "{{ trans('message.Showing page _PAGE_ - _PAGES_') }}";
        var zeroRecords = "{{ trans('message.No Data Found') }}";
        var infoEmpty = "{{ trans('message.No records available') }}";

        /*language change in user selected*/
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



        /*delete sales*/
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

            $('.modal-body-data').html("");

            var saleid = $(this).attr("saleid");
            var invoice_number = $(this).attr("invoice_number");
            var url = $(this).attr('url');

            var msg11 = "{{ trans('message.Attention') }}";
            var msg12 = "{{ trans('message.There are some errors found in the code') }}";
            var msg10 = "{{ trans('message.OK') }}";
            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    saleid: saleid,
                    invoice_number: invoice_number
                },
                success: function(data) {
                    $('.modal-body-data').html(data.html);
                },
                beforeSend: function() {
                    $(".modal-body-data").html(
                        "<center><h2 class=text-muted><b>Loading...</b></h2></center>");
                },

                error: function(e) {
                    swal({
                        title: msg11,
                        text: msg12,
                        icon: 'warning',
                        cancelButtonColor: '#C1C1C1',
                        buttons: {
                            cansel: msg10
                        },
                        dangerMode: true,
                    });

                    window.location.reload();
                    console.log(e);
                }
            });
        });

        //create invoice
        $('body').on('click', '.invoice', function() {

            $('.modal-body-data').html("");
            var saleid = $(this).attr("saleid");
            var url = $(this).attr('url');

            console.log(saleid);
            console.log(url);
            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    saleid: saleid,
                },
                success: function(data) {
                    // console.log(data.html);
                    $('.modal-body-data').html(data.html);
                },
                beforeSend: function() {
                    $(".modal-body-data").html("<center><h2 class=text-muted><b>Loading...</b></h2></center>");
                },
                error: function(e) {
                    alert("An error occurred: " + e.responseText);
                    console.log(e);
                }
            });
        });
    });
</script>
@endsection