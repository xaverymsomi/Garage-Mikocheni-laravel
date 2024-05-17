@extends('layouts.app')
@section('content')
<style>
    @media screen and (max-width:540px) {
        div#sales_part_info {
            margin-top: -179px;
        }
ler
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
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h4 id="myLargeModalLabel" class="modal-title">{{ trans('message.Invoice') }}</h4> -->
                    <h3> {{ getNameSystem() }}</h3>
                    <a href=""><button type="button" class="btn-close"></button></a>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="page-title">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        @if (getActiveCustomer(Auth::user()->id) == 'yes' || getActiveEmployee(Auth::user()->id) == 'yes')
                        <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a>
                        <span class="titleup">{{ trans('message.Part Sells') }}
                            @can('salespart_add')
                            <a href="{!! url('/sales_part/add') !!}" id="">
                                <img src="{{ URL::asset('public/img/icons/plus Button.png') }}" class="mb-2">
                            </a>
                            @endcan
                        </span>
                        @else
                        <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><span class="titleup">{{ trans('message.Purchase') }}
                        </span>
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
                    <table id="supplier" class="table jambo_table ">
                        <thead>
                            <tr>
                                <th>{{ trans('message.Bill Number') }}</th>
                                <th>{{ trans('message.Customer Name') }}</th>
                                <th>{{ trans('message.Date') }}</th>
                                <!-- <th>{{ trans('message.Part Brand') }}</th> -->
                                <th>{{ trans('message.Salesman') }}</th>
                                <th>{{ trans('message.Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($sales as $sale)
                            <tr>
                                <td>{{ $sale->bill_no }} 
                                    <!-- <a data-toggle="tooltip" data-placement="bottom" title="Bill Number" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                                </td>
                                <td>{{ getCustomerName($sale->customer_id) }} 
                                    <!-- <a data-toggle="tooltip" data-placement="bottom" title="Customer Name" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                                </td>
                                <td>{{ date(getDateFormat(), strtotime($sale->date)) }} 
                                    <!-- <a data-toggle="tooltip" data-placement="bottom" title="Date" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                                </td>
                                <!-- <td>{{ getPart($sale->product_id)->name ?? '' }} <a data-toggle="tooltip" data-placement="bottom" title="Part Brand" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a></td> -->
                                <td>{{ getAssignedName($sale->salesmanname) }} 
                                    <!-- <a data-toggle="tooltip" data-placement="bottom" title="Salesman" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                                </td>
                                <td>
                                    <div class="dropdown_toggle">
                                        <img src="{{ URL::asset('public/img/list/dots.png') }}" class="btn dropdown-toggle border-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">

                                        <ul class="dropdown-menu heder-dropdown-menu action_dropdown shadow py-2" aria-labelledby="dropdownMenuButton1">
                                            @if (getUserRoleFromUserTable(Auth::User()->id) == 'admin' || getUserRoleFromUserTable(Auth::User()->id) == 'supportstaff' || getUserRoleFromUserTable(Auth::User()->id) == 'accountant' || getUserRoleFromUserTable(Auth::User()->id) == 'employee' || getUserRoleFromUserTable(Auth::User()->id) == 'branch_admin')
                                            <?php $sales_invoice = getInvoiceNumbers($sale->id); ?>

                                            @if ($sales_invoice == 'No data')
                                            @if (Gate::allows('salespart_add'))
                                            @can('salespart_add')
                                            <li><a href="{!! url('invoice/sale_part_invoice/add/' . $sale->id) !!}" class="dropdown-item ms-2"><img src="{{ URL::asset('public/img/list/create.png') }}" class="me-3">{{ trans('message.Create Invoice') }}</a></li>
                                            @endcan
                                            @else
                                            @can('salespart_view')
                                            <li><a href="{!! url('invoice/add/') !!}" class="dropdown-item ms-2"><img src="{{ URL::asset('public/img/list/Vector.png') }}" class="me-3">&nbsp;{{ trans('message.View Invoices') }}</a></li>
                                            @endcan
                                            @endif
                                            @else
                                            @can('salespart_view')
                                            <li><button type="button" data-bs-toggle="modal" data-bs-target="#myModal" saleid="{{ $sale->id }}" invoice_number="{{ getInvoiceNumbers($sale->id) }}" url="{!! url('/sales_part/list/modal') !!}" class="dropdown-item save ms-2"><img src="{{ URL::asset('public/img/list/Vector.png') }}" class="me-3">&nbsp;{{ trans('message.View Invoices') }}</button></li>
                                            @endcan
                                            @endif

                                            @can('salespart_edit')
                                            <li><a href="{!! url('sales_part/edit/' . $sale->id) !!}" class="dropdown-item ms-2"><img src="{{ URL::asset('public/img/list/Edit.png') }}" class="me-3">&nbsp;{{ trans('message.Edit') }}</a></li>
                                            @endcan
                                            @else
                                            <?php $sales_invoice = getInvoiceNumbers($sale->id); ?>
                                            @if ($sales_invoice == 'No data')
                                            @if (Gate::allows('salespart_add'))
                                            @can('salespart_add')
                                            <li><a href="{!! url('invoice/sale_part_invoice/add/' . $sale->id) !!}" class="dropdown-item ms-2"><img src="{{ URL::asset('public/img/list/create.png') }}" class="me-3">{{ trans('message.Create Invoice') }}</a></li>
                                            @endcan
                                            @else
                                            @can('salespart_view')
                                            <li><a href="{!! url('invoice/add/') !!}" class="dropdown-item ms-2"><img src="{{ URL::asset('public/img/list/Vector.png') }}" class="me-3">&nbsp;{{ trans('message.View Invoices') }}</a></li>
                                            @endcan
                                            @endif
                                            @else
                                            @can('salespart_view')
                                            <li><button type="button" data-bs-toggle="modal" data-bs-target="#myModal" saleid="{{ $sale->id }}" invoice_number="{{ getInvoiceNumbers($sale->id) }}" url="{!! url('/sales_part/list/modal') !!}" class="dropdown-item save ms-2">{{ trans('message.View Invoices') }}</button></li>
                                            @endcan
                                            @endif

                                            @can('salespart_edit')
                                            <li><a href="{!! url('sales_part/edit/' . $sale->id) !!}" class="dropdown-item"><img src="{{ URL::asset('public/img/list/Edit.png') }}" class="me-3">&nbsp;{{ trans('message.Edit') }}</a></li>
                                            @endcan
                                            @endif
                                        </ul>
                                    </div>
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
            order: [
                [2, 'asc']
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

            $('.modal-body').html("");
            var saleid = $(this).attr("saleid");
            var invoice_number = $(this).attr("invoice_number");
            var url = $(this).attr('url');

            var currentPageAction = getParameterByName('page_action');
            // Construct the URL for AJAX request with page_action parameter
            if (currentPageAction) {
                url += '?page_action=' + currentPageAction;
            }
            var msg14 = "{{ trans('message.An error occurred :') }}";

            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    saleid: saleid,
                    invoice_number: invoice_number
                },
                success: function(data) {
                    $('.modal-body').html(data.html);
                },
                beforeSend: function() {
                    $(".modal-body").html(
                        "<center><h2 class=text-muted><b>Loading...</b></h2></center>");
                },
                error: function(e) {
                    alert(msg14 + " " + e.responseText);
                    console.log(e);
                }
            });
        });
    });
    // For get getParameterByName
    function getParameterByName(name, url = window.location.href) {
      name = name.replace(/[\[\]]/g, '\\$&');
      var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
      results = regex.exec(url);
      if (!results) return null;
      if (!results[2]) return '';
      return decodeURIComponent(results[2].replace(/\+/g, ' '));
    }
</script>
@endsection