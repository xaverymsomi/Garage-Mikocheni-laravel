@extends('layouts.app')
@section('content')
<style>
    .table>thead>tr>th {
        padding: 12px 2px 12px 4px;
    }
</style>

<!-- page content -->
<div class="right_col" role="main">
    <!--invoice modal-->
    <div id="myModal-job" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="myLargeModalLabel" class="modal-title"><?php echo $logo->system_name; ?></h4>
                    <a href=""><button type="button" class="btn-close"></button></a>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <!--Payment modal-->
    <div id="myModal-payment" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content modal-data">

            </div>
        </div>
    </div>
    <div class="">
        <div class="page-title">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a>
                        <span class="titleup">{{ trans('message.Invoices') }}
                            @can('invoice_add')
                            <a href="{!! url('/invoice/add') !!}" id="">
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
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_content">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            @can('invoice_view')
                            <a href="{!! url('/invoice/list') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span>
                                <i class=""></i><b>{{ trans('message.INVOICE LIST') }}</b></a>
                            @endcan
                        </li>
                        <li class="nav-item">
                            @can('invoice_view')
                            <a href="{!! url('/invoice/sale_part') !!}" class="nav-link active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.SOLD PART INVOICE LIST') }}</b></a>
                            @endcan
                        </li>
                    </ul>
                </div>
                <div class="x_panel mb-0">
                    @if(!empty($invoice) && count($invoice) > 0)
                    <table id="supplier" class="table jambo_table" style="width:100%">
                        <thead>
                            <tr>
                                <!-- <th> </th> -->
                                <th>{{ trans('message.Invoice Number') }}</th>
                                <th>{{ trans('message.Customer Name') }}</th>
                                <th>{{ trans('message.Invoice For') }}</th>
                                <th>{{ trans('message.Total Amount') }} ({{ getCurrencySymbols() }})</th>
                                <th>{{ trans('message.Paid Amount') }} ({{ getCurrencySymbols() }})</th>
                                <th>{{ trans('message.Date') }}</th>
                                <th>{{ trans('message.Status') }}</th>
                                <th>{{ trans('message.Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($invoice as $invoices)
                            <tr class="texr-left">
                                <!-- <td>{{ $i }}</td> -->
                                <td>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#myModal-job" type_id="{{ $invoices->type }}" serviceid="{{ $invoices->sales_service_id }}" auto_id="{{ $invoices->id }}" url="{!! url('/jobcard/modalview') !!}" sale_url="{!! url('/sales_part/list/modal') !!}" class="dropdown-item save">{{ $invoices->invoice_number }} 
                                        <!-- <a data-toggle="tooltip" data-placement="bottom" title="Invoice Number" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                                    </button>
                                </td>
                                <td>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#myModal-job" type_id="{{ $invoices->type }}" serviceid="{{ $invoices->sales_service_id }}" auto_id="{{ $invoices->id }}" url="{!! url('/jobcard/modalview') !!}" sale_url="{!! url('/sales_part/list/modal') !!}" class="dropdown-item save">{{ getCustomerName($invoices->customer_id) }} 
                                        <!-- <a data-toggle="tooltip" data-placement="bottom" title="Customer Name" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a>\ -->
                                    </button>
                                </td>
                                @if ($invoices->type == 2)
                                <td>{{ trans('message.Part') }} 
                                    <!-- <a data-toggle="tooltip" data-placement="bottom" title="Invoice For" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                                </td>
                                @else
                                <td>
                                    @if (getVehicleName($invoices->job_card) == null)
                                    {{ $invoices->job_card }}
                                    @else{{ getVehicleName($invoices->job_card) }}
                                    @endif
                                    <!-- <a data-toggle="tooltip" data-placement="bottom" title="Invoice For" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                                </td>
                                @endif

                                <td>{{ number_format($invoices->grand_total, 2) }} 
                                    <!-- <a data-toggle="tooltip" data-placement="bottom" title="Total Amount ({{ getCurrencySymbols() }})" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                                </td>
                                <td>{{ number_format($invoices->paid_amount, 2) }} 
                                    <!-- <a data-toggle="tooltip" data-placement="bottom" title="Paid Amount ({{ getCurrencySymbols() }})" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                                </td>

                                <td>{{ date(getDateFormat(), strtotime($invoices->date)) }} 
                                    <!-- <a data-toggle="tooltip" data-placement="bottom" title="Date" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                                </td>
                                <td><?php if ($invoices->payment_status == 0) {
                                        echo '<span style="color: rgb(255, 0, 0);">' .  trans('message.Unpaid') . '</span>';
                                    } elseif ($invoices->payment_status == 1) {
                                        echo '<span style="color: rgb(255, 165, 0);">' .  trans('message.Partially paid') . '</span>';
                                    } elseif ($invoices->payment_status == 2) {
                                        echo '<span style="color: rgb(0, 128, 0);">' .  trans('message.Full Paid') . '</span>';
                                    } else {
                                        echo '<span style="color: rgb(255, 0, 0);">' .  trans('message.Unpaid') . '</span>';
                                    }
                                    ?>
                                    <!-- <a data-toggle="tooltip" data-placement="bottom" title="Status" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                                </td>
                                <td>
                                    <div class="dropdown_toggle">
                                        <img src="{{ URL::asset('public/img/list/dots.png') }}" class="btn dropdown-toggle border-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <ul class="dropdown-menu heder-dropdown-menu action_dropdown shadow py-2" aria-labelledby="dropdownMenuButton1">
                                            @if (getUserRoleFromUserTable(Auth::User()->id) == 'admin' ||
                                            getUserRoleFromUserTable(Auth::User()->id) == 'supportstaff' ||
                                            getUserRoleFromUserTable(Auth::User()->id) == 'accountant' ||
                                            getUserRoleFromUserTable(Auth::User()->id) == 'employee')
                                            @if ($invoices->type != 2)
                                            @can('invoice_view')
                                            <li><button type="button" data-bs-toggle="modal" data-bs-target="#myModal-job" type_id="{{ $invoices->type }}" serviceid="{{ $invoices->sales_service_id }}" auto_id="{{ $invoices->id }}" url="{!! url('/jobcard/modalview') !!}" sale_url="{!! url('/sales/list/modal') !!}" class="dropdown-item save"><img src="{{ URL::asset('public/img/list/Vector.png') }}" class="me-3">&nbsp;{{ trans('message.View Invoice') }}</button></li>
                                            @endcan
                                            @else
                                            @can('invoice_view')
                                            <li><button type="button" data-bs-toggle="modal" data-bs-target="#myModal-job" type_id="{{ $invoices->type }}" serviceid="{{ $invoices->sales_service_id }}" auto_id="{{ $invoices->id }}" url="{!! url('/jobcard/modalview') !!}" sale_url="{!! url('/sales_part/list/modal') !!}" class="dropdown-item save"><img src="{{ URL::asset('public/img/list/Vector.png') }}" class="me-3">&nbsp;{{ trans('message.View Invoice') }}</button></li>
                                            @endcan
                                            @endif
                                            @can('invoice_edit')
                                            <li><a href="{!! url('/invoice/list/edit/' . $invoices->id) !!}" class="dropdown-item"><img src="{{ URL::asset('public/img/list/Edit.png') }}" class="me-3">&nbsp;{{ trans('message.Edit') }}</a></li>
                                            @endcan
                                            @can('invoice_delete')
                                            @endcan

                                            @if (Gate::allows('invoice_edit') || Gate::allows('invoice_delete'))
                                            @canany(['invoice_edit', 'invoice_delete'])
                                            <li><button type="button" data-bs-toggle="modal" data-bs-target="#myModal-payment" invoice_id="{{ $invoices->id }}" url="{!! url('/invoice/payment/paymentview') !!}" class="dropdown-item Payment">
                                                    <img src="{{ URL::asset('public/img/list/payment.png') }}" class="me-3">{{ trans('message.Payment History') }}</button></li>

                                            @if ($invoices->grand_total == $invoices->paid_amount)
                                            <li><a href="{!! url('/invoice/pay/' . $invoices->id) !!}" class="dropdown-item"><img src="{{ URL::asset('public/img/list/pay.png') }}" class="me-3">{{ trans('message.Pay') }}</a></li>
                                            @else
                                            <li><a href="{!! url('/invoice/pay/' . $invoices->id) !!}" class="dropdown-item"><img src="{{ URL::asset('public/img/list/pay.png') }}" class="me-3">{{ trans('message.Pay') }}</a></li>
                                            @endif
                                            @endcanany
                                            @endif
                                            @elseif(getUserRoleFromUserTable(Auth::User()->id) == 'Customer')
                                            @can('invoice_view')
                                            <li><button type="button" data-toggle="modal" data-target="#myModal-job" type_id="{{ $invoices->type }}" serviceid="{{ $invoices->sales_service_id }}" auto_id="{{ $invoices->id }}" url="{!! url('/jobcard/modalview') !!}" sale_url="{!! url('/sales/list/modal') !!}" class="dropdown-item save"><img src="{{ URL::asset('public/img/list/Vector.png') }}" class="me-3">&nbsp;{{ trans('message.View Invoice') }}</button></li>
                                            @endcan
                                            @can('invoice_edit')
                                            <li><a href="{!! url('/invoice/list/edit/' . $invoices->id) !!}" class="dropdown-item"><img src="{{ URL::asset('public/img/list/Edit.png') }}" class="me-3">&nbsp;{{ trans('message.Edit') }}</a></li>
                                            @endcan
                                            @can('invoice_delete')
                                            @endcan

                                            <?php
                                            $grand_total = $invoices->grand_total;
                                            $paid_amount = $invoices->paid_amount;
                                            $amountdue = $grand_total - $paid_amount;
                                            ?>

                                            @can('invoice_view')
                                            <li><button type="button" data-toggle="modal" data-target="#myModal-payment" invoice_id="{{ $invoices->id }}" url="{!! url('/invoice/payment/paymentview') !!}" class="dropdown-item Payment">
                                                    <img src="{{ URL::asset('public/img/list/payment.png') }}" class="me-3"> {{ trans('message.Payment History') }}</button></li>
                                            @endcan

                                            @can('invoice_view')
                                            @if ($amountdue != 0)
                                            <script src="https://js.stripe.com/v3/"></script>
                                            <form method="post" action="{{ url('invoice/stripe') }}" class="medium" id="medium">
                                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                                <input type='hidden' name="invoice_amount" value="{{ $amountdue }}">
                                                <input type='hidden' name="invoice_id" value="{{ $invoices->id }}">
                                                <input type='hidden' name="invoice_no" value="{{ $invoices->invoice_number }}">

                                                <!-- <input type="submit" class="submit2  btn btn-round btn-success" value="{{ trans('message.Pay') }}" data-key="{{ $updatekey->publish_key }}" data-email="{{ getCustomerEmail($invoices->customer_id) }}" data-name="{{ $logo->system_name }}" data-description="Invoice Number - {{ $invoices->invoice_number }}" data-amount="{{ $amountdue * 100 }}" /> -->
                                                <button type="submit" class="submit2 dropdown-item"  data-key="{{ $updatekey->publish_key }}" data-email="{{ getCustomerEmail($invoices->customer_id) }}" data-name="{{ $logo->system_name }}" data-description="Invoice Number - {{ $invoices->invoice_number }}" data-amount="{{ $amountdue * 100 }}" ><img src="{{ URL::asset('public/img/list/pay.png') }}" class="me-3">{{ trans('message.Pay') }}</button>

                                                <script src="https://checkout.stripe.com/v2/checkout.js"></script>
                                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
                                                <script>
                                                    $(document).ready(function() {
                                                        $('.submit2').on('click', function(event) {
                                                            event.preventDefault();

                                                            var $button = $(this),
                                                                $form = $button.parents('form');
                                                            var opts = $.extend({}, $button.data(), {
                                                                token: function(result) {
                                                                    $form.append($('<input>').attr({
                                                                        type: 'hidden',
                                                                        name: 'stripeToken',
                                                                        value: result.id
                                                                    })).submit();
                                                                }
                                                            });
                                                            StripeCheckout.open(opts);
                                                        });
                                                    });
                                                </script>
                                            </form>
                                            @else
                                            <li><input type="submit" class="dropdown-item" value="{{ trans('message.Pay') }}" /></li>
                                            @endif
                                            @endcan
                                            @endif
                                            <li><a href="{{ route('salespartSend', ['id' => $invoices->id]) }}" target="_blank" class="dropdown-item"><img src="{{ URL::asset('public/img/list/WhatsApp.png') }}" class="me-2"> {{ trans('message.Share on WhatsApp') }}</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php $i++; ?>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="d-flex justify-content-center mt-5 pt-5"><img src="{{ URL::asset('public/img/dashboard/No-Data.png') }}" width="300px"></p>
                    @endif
                </div>
            </div>
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
                [0, 'desc']
            ]
        });


        /*Delete invoice*/
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

        //view invoice 
        $('body').on('click', '.save', function() {

            $('.modal-body').html("");
            var type_id = $(this).attr("type_id");
            var serviceid = $(this).attr("serviceid");
            var auto_id = $(this).attr("auto_id");

            if (type_id == 0) {
                var url = $(this).attr('url');
            } else {
                var url = $(this).attr('sale_url');
            }

            var currentPageAction = getParameterByName('page_action');

            // Construct the URL for AJAX request with page_action parameter
            if (currentPageAction) {
                url += '?page_action=' + currentPageAction;
            }

            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    serviceid: serviceid,
                    auto_id: auto_id
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

        // For get getParameterByName
        function getParameterByName(name, url = window.location.href) {
            name = name.replace(/[\[\]]/g, '\\$&');
            var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, ' '));
        }

        //view Payment 
        $('body').on('click', '.Payment', function() {

            $('.modal-data').html("");
            var invoice_id = $(this).attr("invoice_id");
            var url = $(this).attr('url');

            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    invoice_id: invoice_id
                },
                success: function(data) {
                    $('.modal-data').html(data.html);
                },
                beforeSend: function() {
                    $(".modal-data").html(
                        "<center><h2 class=text-muted><b>Loading...</b></h2></center>");
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