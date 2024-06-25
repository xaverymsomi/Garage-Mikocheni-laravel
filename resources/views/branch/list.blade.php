@extends('layouts.app')
@section('content')
<style>
    @media screen and (max-width:540px) {
        div#branch_info {
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
                    <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><i class=""></i><span class="titleup">{{ trans('message.Branch') }}
                            @can('branch_add')
                            <a href="{!! url('/branch/add') !!}" id="">
                                <img src="{{ URL::asset('public/img/icons/plus Button.png') }}" class="mb-2">
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
    @if(!empty($branchDatas) && count($branchDatas) > 0)
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_content">
            </div>
            <div class="x_panel">
                <table id="supplier" class="table jambo_table" style="width:100%">
                    <thead>
                        <tr>
                            @can('branch_delete')
                            <th></th>
                            @endcan
                            <th>{{ trans('message.Image') }}</th>
                            <th>{{ trans('message.Branch Name') }}</th>
                            <th>{{ trans('message.Contact Number') }}</th>
                            <th>{{ trans('message.Email') }}</th>
                            <th>{{ trans('message.Address') }}</th>
                            <!-- <th>{{ trans('message.Enable Branch') }}</th> -->

                            @if (getUserRoleFromUserTable(Auth::User()->id) != 'Customer')
                            <th>{{ trans('message.Action') }}</th>
                            @endif

                            @if (getUserRoleFromUserTable(Auth::User()->id) == 'Customer')
                            @if (Gate::allows('branch_add') || Gate::allows('branch_edit') || Gate::allows('branch_delete') || Gate::allows('branch_view'))
                            <th>{{ trans('message.Action') }}</th>
                            @endif
                            @endif
                        </tr>

                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($branchDatas as $branchData)
                        <tr data-user-id="{{ $branchData->id }}">
                            <!-- <td>{{ $i }}</td> -->
                            @can('branch_delete')
                            <td>
                                <label class="container checkbox">
                                    <input type="checkbox" name="chk">
                                    <span class="checkmark"></span>
                                </label>
                            </td>
                            @endcan

                            <td><a href="{!! url('/branch/view/' . $branchData->id) !!}"><img src="{{ URL::asset('public/img/branch/' . $branchData->branch_image) }}" width="52px" height="52px" class="datatable_img"></a></td>

                            <td><a href="{!! url('/branch/view/' . $branchData->id) !!}">{{ $branchData->branch_name }}</a></td>
                            <td>{{ $branchData->contact_number }}</td>
                            <td>{{ $branchData->branch_email }}</td>
                            <td>{{ $branchData->branch_address }}</td>
                            <!-- <td>{{ $branchData->branch_status }}</td> -->

                            <td>
                                <div class="dropdown_toggle">
                                    <img src="{{ URL::asset('public/img/list/dots.png') }}" class="btn dropdown-toggle border-0" type="button" id="dropdownMenuButtonaction" data-bs-toggle="dropdown" aria-expanded="false">

                                    <ul class="dropdown-menu heder-dropdown-menu action_dropdown shadow py-2" aria-labelledby="dropdownMenuButtonaction">
                                        @can('branch_view')
                                        <li><a class="dropdown-item" href="{!! url('/branch/view/' . $branchData->id) !!}"><img src="{{ URL::asset('public/img/list/Vector.png') }}" class="me-3">{{ trans('message.View') }}</a></li>
                                        @endcan

                                        @can('branch_edit')
                                        <li><a class="dropdown-item" href="{!! url('/branch/edit/' . $branchData->id) !!}"><img src="{{ URL::asset('public/img/list/Edit.png') }}" class="me-3"> {{ trans('message.Edit') }}</a></li>
                                        @endcan

                                        @can('branch_delete')
                                        <div class="dropdown-divider m-0"></div>
                                        <li><a class="dropdown-item sa-warning" url="{!! url('/branch/delete/' . $branchData->id) !!}" style="color:#FD726A"><img src="{{ URL::asset('public/img/list/Delete.png') }}" class="me-3">{{ trans('message.Delete') }}</a></li>
                                        @endcan
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php $i++; ?>
                        @endforeach
                    </tbody>
                </table>
                @can('branch_delete')
                <button id="select-all-btn" class="btn select_all"><input type="checkbox" name="selectAll"> {{ trans('message.Select All') }}</button>
                <button id="delete-selected-btn" class="btn btn-danger text-white border-0" data-url="{!! url('/branch/delete/') !!}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                @endcan
            </div>
        </div>
    @else
      <p class="d-flex justify-content-center mt-5 pt-5"><img src="{{ URL::asset('public/img/dashboard/No-Data.png') }}" width="300px"></p>
    @endif
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


        /******* Delete Employee ******/
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