@extends('layouts.app')
@section('content')
<style>
    @media screen and (max-width:540px) {
        div#income_info {
            margin-top: -179px;
        }

        span.titleup {
            margin-left: -10px;
        }
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><span class="titleup">{{ trans('message.Income') }}
                            @can('income_add')
                            <a href="{!! url('/income/add') !!}" id="">
                                <img src="{{ URL::asset('public/img/icons/plus Button.png') }}" class="mb-2">
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

                {{-- nav tabs new code start --}}
                <div class="x_content">
                    <ul class="nav nav-tabs">
                        @can('income_view')
                        <li class="nav-item">
                            <a href="{!! url('/income/list') !!}" class="nav-link active"><span class="visible-xs"></span> <i class=""></i><b>{{ trans('message.INCOME LIST') }}</b></a>
                        </li>
                        @endcan
                        @can('income_view')
                        <li class="nav-item">
                            <a href="{!! url('/income/month_income') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.MONTHLY INCOME REPORTS') }}</b></a>
                        </li>
                        @endcan
                    </ul>
                </div>
                {{-- nav tabs new code end --}}
                <div class="x_panel table_up_div">
                @if(!empty($income) && count($income) > 0)
                    <table id="supplier" class="table jambo_table" style="width:100%">
                        <thead>
                            <tr>
                                @can('income_delete')
                                <th> </th>
                                @endcan
                                <th>{{ trans('message.Customer Name') }}</th>
                                <th>{{ trans('message.Invoice Number') }}</th>
                                <th>{{ trans('message.Amount') }} (<?php echo getCurrencySymbols(); ?>)</th>
                                <th>{{ trans('message.Payment Type') }}</th>
                                <th>{{ trans('message.Date') }}</th>
                                <th>{{ trans('message.Main Label') }}</th>

                                <!-- Custom Field Data Label Name-->
                                @if (!empty($tbl_custom_fields))
                                @foreach ($tbl_custom_fields as $tbl_custom_field)
                                <th>{{ $tbl_custom_field->label }}</th>
                                @endforeach
                                @endif
                                <!-- Custom Field Data End -->

                                @canany(['income_edit', 'income_delete'])
                                <th>{{ trans('message.Action') }}</th>
                                @endcanany
                            </tr>
                        </thead>

                        <tbody>
                            <?php $i = 1; ?>

                            @foreach ($income as $incomes)
                            @if (getSumOfIncome($incomes->tbl_income_id) != 0)
                            <tr data-user-id="{{ $incomes->id }}">
                                @can('income_delete')
                                <td>
                                    <label class="container checkbox">
                                        <input type="checkbox" name="chk">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                @endcan
                                <td><a href="{!! url('/income/edit/' . $incomes->tbl_income_id) !!}">{{ getCustomerName($incomes->customer_id) }}</a> 
                                    <!-- <a data-toggle="tooltip" data-placement="bottom" title="Customer Name" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                                </td>
                                <td>
                                    <a href="{!! url('/income/edit/' . $incomes->tbl_income_id) !!}">{{ $incomes->invoice_number }} </a>
                                    <!-- <a data-toggle="tooltip" data-placement="bottom" title="Invoice Number" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                                </td>
                                <td>{{ number_format(getSumOfIncome($incomes->tbl_income_id), 2) }} 
                                    <!-- <a data-toggle="tooltip" data-placement="bottom" title="Amount(<?php echo getCurrencySymbols(); ?>)" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                                </td>
                                <td>{{ GetPaymentMethod($incomes->payment_type) }} 
                                    <!-- <a data-toggle="tooltip" data-placement="bottom" title="Payment Type" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                                </td>
                                <td>{{ date(getDateFormat(), strtotime($incomes->date)) }} 
                                    <!-- <a data-toggle="tooltip" data-placement="bottom" title="Date" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                                </td>
                                <td>{{ $incomes->main_label }} 
                                    <!-- <a data-toggle="tooltip" data-placement="bottom" title="Main Label" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                                </td>

                                <!-- Custom Field Data Value-->
                                @if (!empty($tbl_custom_fields))
                                @foreach ($tbl_custom_fields as $tbl_custom_field)
                                <?php
                                $tbl_custom = $tbl_custom_field->id;
                                $userid = $incomes->tbl_income_id;

                                $datavalue = getCustomDataIncome($tbl_custom, $userid);
                                ?>

                                @if ($tbl_custom_field->type == 'radio')
                                @if ($datavalue != '')
                                <?php
                                $radio_selected_value = getRadioSelectedValue($tbl_custom_field->id, $datavalue);
                                ?>
                                <td>{{ $radio_selected_value }}</td>
                                @else
                                <td>{{ trans('message.Data not available') }}</td>
                                @endif
                                @else
                                @if ($datavalue != null)
                                <td>{{ $datavalue }}</td>
                                @else
                                <td>{{ trans('message.Data not available') }}</td>
                                @endif
                                @endif
                                @endforeach
                                @endif
                                <!-- Custom Field Data End -->

                                <!-- Have Access Right then do it -->
                                @canany(['income_edit', 'income_delete'])
                                <td>
                                    <div class="dropdown_toggle">
                                        <img src="{{ URL::asset('public/img/list/dots.png') }}" class="btn dropdown-toggle border-0" type="button" id="dropdownMenuButtonaction" data-bs-toggle="dropdown" aria-expanded="false">

                                        <ul class="dropdown-menu heder-dropdown-menu action_dropdown shadow py-2" aria-labelledby="dropdownMenuButtonaction">

                                            @can('income_edit')
                                            <li><a class="dropdown-item" href="{!! url('/income/edit/' . $incomes->tbl_income_id) !!}"><img src="{{ URL::asset('public/img/list/Edit.png') }}" class="me-3"> {{ trans('message.Edit') }}</a></li>
                                            @endcan

                                            @can('income_delete')
                                            <div class="dropdown-divider m-0"></div>
                                            <li><a class="dropdown-item sa-warning" url="{!! url('/income/delete/' . $incomes->tbl_income_id) !!}" style="color:#FD726A"><img src="{{ URL::asset('public/img/list/Delete.png') }}" class="me-3">{{ trans('message.Delete') }}</a></li>
                                            @endcan
                                        </ul>
                                    </div>
                                </td>
                                @endcanany

                            </tr>
                            <?php $i++; ?>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                    @can('income_delete')
                    <button id="select-all-btn" class="btn select_all"><input type="checkbox" name="selectAll"> {{ trans('message.Select All') }}</button>
                    <button id="delete-selected-btn" class="btn btn-danger text-white border-0" data-url="{!! url('/income/delete/') !!}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    @endcan
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
        });


        /*delete income*/
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
    });
</script>
@endsection