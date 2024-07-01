@extends('layouts.app')
@section('content')
<style>
    @media screen and (max-width:540px) {
        div#quotation_info {
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
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content modal_data">
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
                        <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><span class="titleup">{{ trans('Receipt') }}
                            @can('quotation_add')
                            <a href="{!! url('/receipt/add') !!}" id="">
                                <img src="{{ URL::asset('public/img/icons/plus Button.png') }}" class="">
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
                <div class="x_panel table_up_div mb-0">
                    <table id="supplier" class="table jambo_table" style="width:100%">
                        <thead>
                            <tr>
                                @can('quotation_delete')
                                <th> </th>
                                @endcan
                                <th>{{ trans('message.Date') }}</th>
                                <th>{{ trans('Mode') }}</th>
                                <th>{{ trans('Reference #') }}</th>
                                <th>{{ trans('Processed By') }}</th>
                                <th>{{ trans('message.Customer Name') }}</th>
                                <th>{{ trans('message.Amount') }} </th>
                                <th>{{ trans('message.Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php $i = 1; ?>
                            @foreach ($service as $services)
                            <tr data-user-id="{{ $services->id }}">
                                @can('quotation_delete')
                                <td>
                                    <label class="container checkbox">
                                        <input type="checkbox" name="chk">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                @endcan
                                <td>{{ $services->created_at }}</td>
                                <td>{{ $services->mode }}</td>
                                <td>{{ $services->reference_no }}</td>
                                <td>{{ $services->added_by }}</td>
                                <td>{{ $services->customer }}</td>
                                <td>{{ $services->amount }}</td>
                                <td>
                                    <div class="dropdown_toggle">
                                        <img src="{{ URL::asset('public/img/list/dots.png') }}" class="btn dropdown-toggle border-0" type="button" id="dropdownMenuButtonaction" data-bs-toggle="dropdown" aria-expanded="false">

                                        <ul class="dropdown-menu heder-dropdown-menu action_dropdown shadow py-2" aria-labelledby="dropdownMenuButtonaction">
                                            @can('quotation_view')
                                            <li class="px-2"><button type="button" data-bs-toggle="modal" data-bs-target="#myModal" serviceid="{{ $services->id }}" url="{!! url('/quotation/list/view') !!}" class="btn border-0 save"><img src="{{ URL::asset('public/img/list/Vector.png') }}" class="me-3">{{ trans('message.View') }}</button></li>
                                            @endcan

                                            @can('quotation_edit')
                                            

                                            
                                            @endcan

                                            <li><a href="{{ route('quotationSend', ['service_id' => $services->id]) }}" target="_blank" class="dropdown-item"><img src="{{ URL::asset('public/img/list/WhatsApp.png') }}" class="me-2"> {{ trans('message.Share on WhatsApp') }}</a></li>
                                            @can('quotation_delete')
                                            <div class="dropdown-divider m-0"></div>
                                            <li><a class="dropdown-item sa-warning" url="{!! url('/quotation/list/delete/' . $services->id) !!}" style="color:#FD726A"><img src="{{ URL::asset('public/img/list/Delete.png') }}" class="me-3">{{ trans('message.Delete') }}</a></li>
                                            @endcan
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php $i++; ?>
                            @endforeach
                        </tbody>
                    </table>
                    @can('quotation_delete')
                    <button id="select-all-btn" class="btn select_all"><input type="checkbox" name="selectAll"> {{ trans('message.Select All') }}</button>
                    <button id="delete-selected-btn" class="btn btn-danger text-white border-0" data-url="{!! url('/quotation/list/delete/') !!}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    @endcan
                </div>
            </div>
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


        /*delete service*/
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

        /*Finalize Quotation*/
        $('body').on('click', '.sa-final', function() {

            var url = $(this).attr('url');
            var msg1 = "{{ trans('message.Are you sure you want to finalize this quotation?') }}";
            var msg2 = "{{ trans('message.On your confirmation  system will generate new Job Card automatically.') }}";
            var msg3 = "{{ trans('message.Cancel') }}";
            var msg4 = "{{ trans('message.Yes, Final!') }}";

            swal({
                title: msg1,
                text: msg2,
                icon: 'warning',
                cancelButtonColor: '#C1C1C1',
                buttons: [msg3, msg4],
                dangerMode: true,
            }).then((willFinal) => {
                if (willFinal) {
                    window.location.href = url;
                }
            });
        });


        $('body').on('click', '.save', function() {
            var servicesid = $(this).attr("serviceid");
            var msg10 = "{{ trans('message.An error occurred :') }}";
            var url = $(this).attr('url');
            var currentPageAction = getParameterByName('page_action');
            
            // Construct the URL for AJAX request with page_action parameter
            if (currentPageAction) {
                url += '?page_action=' + currentPageAction;
            }

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

        // For get getParameterByName
        function getParameterByName(name, url = window.location.href) {
            name = name.replace(/[\[\]]/g, '\\$&');
            var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, ' '));
        }


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